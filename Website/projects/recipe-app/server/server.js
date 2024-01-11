// server.js
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const mysql = require('mysql2/promise');

const app = express();
const PORT = process.env.PORT || 5000;

app.use(bodyParser.json());
app.use(cors());

// Connect to MySQL (replace 'your-mysql-config' with your MySQL connection details)
const connection = await mysql.createConnection({
    host: 'your-mysql-host',
    user: 'your-mysql-user',
    password: 'your-mysql-password',
    database: 'your-mysql-database',
});

// Define the Recipe schema
const recipeSchema = `
  CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    cookingSteps TEXT NOT NULL
  )
`;

// Create the Recipe table
await connection.query(recipeSchema);

app.get('/', (req, res) => {
    res.send('Hello from the server!');
});

// Route for adding a new recipe
app.post('/api/recipes', async (req, res) => {
    const { name, ingredients, cookingSteps } = req.body;

    // Validation - ensure required fields are present
    if (!name || !ingredients || !cookingSteps) {
        return res.status(400).json({ error: 'Missing required fields' });
    }

    try {
        // Insert a new recipe into the database
        const [result] = await connection.execute(
            'INSERT INTO recipes (name, ingredients, cookingSteps) VALUES (?, ?, ?)',
            [name, ingredients, cookingSteps]
        );

        // Respond with the newly created recipe
        const newRecipe = {
            id: result.insertId,
            name,
            ingredients,
            cookingSteps,
        };

        res.status(201).json(newRecipe);
    } catch (error) {
        console.error('Error:', error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

// Route for fetching all recipes
app.get('/api/recipes', async (req, res) => {
    try {
        // Fetch all recipes from the database
        const [rows] = await connection.execute('SELECT * FROM recipes');
        res.json(rows);
    } catch (error) {
        console.error('Error:', error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

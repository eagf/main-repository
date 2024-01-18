require('dotenv').config();

const express = require('express');
const path = require('path');
const mysql = require('mysql2/promise');
const cors = require('cors');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const bodyParser = require('body-parser');
const cookieParser = require('cookie-parser');

// nohup node server.js &

const app = express();

app.use(bodyParser.json());
app.use(cookieParser());

app.use(cors({
    origin: 'https://eliasferket.com/projects/recipe-app/build', // React app
    methods: ['GET', 'POST', 'DELETE', 'UPDATE', 'PUT', 'PATCH'],
    credentials: true
}));

app.options('*', cors());



app.use(express.static(path.join(__dirname, 'build')));

async function initializeServer() {
    try {

        // MySQL connection

        const dbConfig = {
            host: process.env.DB_HOST,
            user: process.env.DB_USER,
            password: process.env.DB_PASS,
            database: process.env.DB_NAME
        };

        const db = await mysql.createConnection(dbConfig);
        console.log('Connected to MySQL');

        console.log('Server is running out of: ', __dirname);

        // Submit a recipe

        app.post('/api/recipes', async (req, res) => {
            try {
                const authHeader = req.headers.authorization;
                if (!authHeader || !authHeader.startsWith('Bearer ')) {
                    return res.status(401).send('Access denied. No token provided.');
                }

                const token = authHeader.split(' ')[1];
                let decoded;
                try {
                    decoded = jwt.verify(token, 'your_secret_key');
                } catch (err) {
                    return res.status(401).send('Invalid or expired token.');
                }
                const userID = decoded.userId;

                const { recipeName, ingredients, cookingSteps } = req.body;
                const [recipeResult] = await db.query('INSERT INTO recipes (recipeName, cookingSteps, userID) VALUES (?, ?, ?)', [recipeName, cookingSteps, userID]);
                const recipeID = recipeResult.insertId;


                for (const ingredient of ingredients) { // Process each ingredient
                    let ingredientID;

                    const [existing] = await db.query('SELECT ingredientID FROM ingredients WHERE ingredientName = ? ', [ingredient]); // Check if ingredient already exists
                    if (existing.length > 0) {// Ingredient exists, use its ID
                        ingredientID = existing[0].ingredientID;
                    } else { // Ingredient does not exist, insert new ingredient
                        const [newIngredientResult] = await db.query('INSERT INTO ingredients (ingredientName) VALUES (?)', [ingredient]);
                        ingredientID = newIngredientResult.insertId;
                    }
                    // Link ingredient with the recipe in the junction table
                    await db.query('INSERT INTO recipe_ingredients (recipeID, ingredientID) VALUES (?, ?)', [recipeID, ingredientID]);
                }

                res.status(200).send('Recipe added successfully');
            } catch (err) {
                if (err.name === 'JsonWebTokenError') {
                    return res.status(401).send('Invalid token.');
                }
                res.status(500).send('Error processing request');
            }
        });

        // Get all the recipes from one user

        app.get('/api/recipes', async (req, res) => {
            try {
                const token = req.headers.authorization.split(' ')[1];
                const decoded = jwt.verify(token, 'your_secret_key');
                const userID = decoded.userId;
                const searchTerm = req.query.searchTerm || '';

                let query = 'SELECT r.recipeID, r.recipeName, r.cookingSteps, GROUP_CONCAT(i.ingredientName) as ingredients ' +
                    'FROM recipes r ' +
                    'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' +
                    'LEFT JOIN ingredients i ON ri.ingredientID = i.ingredientID ' +
                    'WHERE r.userID = ? ';

                let queryParams = [userID];

                if (searchTerm !== '') {
                    query += 'AND LOWER(i.ingredientName) = LOWER(?) ';
                    queryParams.push(searchTerm.trim());
                }

                query += 'GROUP BY r.recipeID';

                const [recipes] = await db.query(query, queryParams);

                const formattedRecipes = recipes.map(recipe => ({
                    ...recipe,
                    ingredients: recipe.ingredients ? recipe.ingredients.split(',') : []
                }));

                res.status(200).json(formattedRecipes);
            } catch (err) {
                console.error('Error fetching recipes:', err.message);
                return res.status(500).send('Error processing request');
            }
        });

        // Get a specific recipe

        app.get('/api/recipes/:id', async (req, res) => {
            try {
                const { id } = req.params;
                const token = req.headers.authorization.split(' ')[1];
                const decoded = jwt.verify(token, 'your_secret_key');
                const userID = decoded.userId;

                // Fetch the specific recipe that belongs to the logged-in user
                const [recipes] = await db.query(
                    'SELECT r.recipeID, r.recipeName, r.cookingSteps, GROUP_CONCAT(i.ingredientName) as ingredients ' +
                    'FROM recipes r ' +
                    'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' +
                    'LEFT JOIN ingredients i ON ri.ingredientID = i.ingredientID ' +
                    'WHERE r.userID = ? AND r.recipeID = ? ' +
                    'GROUP BY r.recipeID', [userID, id]
                );

                if (recipes.length > 0) {
                    const recipe = recipes[0];
                    recipe.ingredients = recipe.ingredients ? recipe.ingredients.split(',') : [];
                    res.status(200).json(recipe);
                } else {
                    res.status(404).send('Recipe not found');
                }
            } catch (err) {
                console.error('Error fetching recipe:', err.message);
                res.status(500).send('Error processing request');
            }
        });

        // Delete a recipe

        app.delete('/api/recipes/:id', async (req, res) => {
            try {
                const { id } = req.params;

                // Delete from recipe_ingredients table
                await db.query('DELETE FROM recipe_ingredients WHERE recipeID = ?', [id]);

                // Delete from recipes table
                await db.query('DELETE FROM recipes WHERE recipeID = ?', [id]);

                res.status(200).send('Recipe deleted successfully');
            } catch (err) {
                res.status(500).send('Error deleting recipe');
            }
        });

        // Endpoint to delete all recipes of the logged-in user

        app.delete('/api/delete-all-recipes', async (req, res) => {
            try {
                const authHeader = req.headers.authorization;
                if (!authHeader || !authHeader.startsWith('Bearer ')) {
                    return res.status(401).send('Access denied. No token provided.');
                }

                const token = authHeader.split(' ')[1];
                const decoded = jwt.verify(token, 'your_secret_key');
                const userID = decoded.userId;

                // First delete entries from the recipe_ingredients table
                await db.query(
                    'DELETE ri FROM recipe_ingredients ri JOIN recipes r ON ri.recipeID = r.recipeID WHERE r.userID = ?',
                    [userID]
                );

                // Then delete from recipes table
                await db.query('DELETE FROM recipes WHERE userID = ?', [userID]);

                res.status(200).send('All recipes deleted successfully');
            } catch (err) {
                if (err.name === 'JsonWebTokenError') {
                    return res.status(401).send('Invalid token.');
                }
                console.error('Error processing request:', err);
                res.status(500).send('Error processing request');
            }
        });

        // registreren

        const saltRounds = 10;

        app.post('/api/register', async (req, res) => {
            const { email, name, password } = req.body;

            try {
                // Hash the password
                const hashedPassword = await bcrypt.hash(password, saltRounds);

                // Check if the user already exists
                const [existingUsers] = await db.query('SELECT * FROM users WHERE email = ?', [email]);
                if (existingUsers.length > 0) {
                    return res.status(400).send('User already exists');
                }

                // Insert the new user into the database
                const [result] = await db.query('INSERT INTO users (email,name, password) VALUES (?, ?, ?)', [email, name, hashedPassword]);

                if (result.affectedRows) {
                    res.status(201).send('User registered successfully');
                } else {
                    res.status(500).send('Error registering user');
                }
            } catch (err) {
                console.error('Registration error:', err);
                res.status(500).send('Internal server error');
            }
        });

        // Inloggen

        app.post('/api/login', async (req, res) => {
            const { email, password } = req.body;

            try {
                // Fetch the user from the database using the provided email
                const [users] = await db.query('SELECT * FROM users WHERE email = ?', [email]);
                const user = users[0];

                if (!user) {
                    return res.status(401).send('Invalid email or password');
                }

                // Compare the provided password with the stored hashed password
                const validPassword = await bcrypt.compare(password, user.password);
                if (validPassword) {
                    const token = jwt.sign({ userId: user.userID }, 'your_secret_key', { expiresIn: '1h' });
                    res.cookie('token', token, { httpOnly: true, secure: true, sameSite: 'strict', maxAge: 3600000 });
                    res.send({ token: token }); // Send the token
                } else {
                    res.status(401).send('Invalid email or password');
                }


            } catch (error) {
                res.status(500).send('Internal server error');
            }
        });

        // Logout

        app.post('/api/logout', (req, res) => {
            res.send('Logged out successfully');
        });

        // Serve the React application for any other route not handled by your API
        app.get('*', (req, res) => {
            res.sendFile(path.join(__dirname, 'build', 'index.html'));
        });

        // Start server

        const PORT = process.env.PORT || 8081;
        app.listen(PORT, () => {
            console.log(`Server running on port ${PORT}`);
        });
    } catch (error) {
        console.error('Error initializing server:', error);
    }
}

initializeServer();

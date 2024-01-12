const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'your_username',
    password: 'your_password',
    database: 'recipe-db'
});

db.connect(err => {
    if (err) throw err;
    console.log('Connected to MySQL');
});

// Routes
app.post('/api/recipes', (req, res) => {
    // Code to handle recipe submission will go here
});

// Start server
const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});

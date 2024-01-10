// server.js
const express = require('express');
const path = require('path');
const fs = require('fs').promises;

const app = express();
const port = 3000;

// Serve static files (including your HTML file)
app.use(express.static(path.join(__dirname, 'public')));

// Serve API endpoint for file list
app.get('/files', async (req, res) => {
    try {
        const files = await getFilesList();
        res.json(files);
    } catch (error) {
        console.error('Error fetching file list:', error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

// Helper function to fetch the list of files
async function getFilesList() {
    const filesFolder = path.join(__dirname, 'files');
    const fileNames = await fs.readdir(filesFolder);
    return fileNames;
}

// Start the server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});

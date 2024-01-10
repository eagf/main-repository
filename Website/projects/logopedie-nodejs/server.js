"use strict";

const express = require('express');
const fs = require('fs');
const path = require('path');

const app = express();
const port = 3000;

app.use(express.static('public')); // Assuming your server.js and documenten folder are in the same directory.

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'documenten.html'));
});

app.get('/files', (req, res) => {
  // Read the contents of the "documenten" folder
  const documentenFolderPath = path.join(__dirname, 'documenten');
  
  fs.readdir(documentenFolderPath, (err, files) => {
    if (err) {
      console.error('Error reading directory:', err);
      res.status(500).json({ error: 'Internal Server Error' });
      return;
    }

    res.json(files);
  });
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
const express = require('express');
const fs = require('fs');
const path = require('path');

const app = express();
const port = 3000; // Choose a port number

app.use(express.static('public'));

app.get('/file-titles', (req, res) => {
  const filesDir = path.join(__dirname, 'files');

  fs.readdir(filesDir, (err, files) => {
    if (err) {
      console.error(err);
      return res.status(500).json({ error: 'Internal Server Error' });
    }

    const fileTitles = files.map(file => path.parse(file).name);
    res.json(fileTitles);
  });
});

app.listen(port, () => {
  console.log(`Server is listening at http://localhost:${port}`);
});

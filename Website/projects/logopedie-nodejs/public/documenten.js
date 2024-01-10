"use strict";

fetch('/files')
    .then(response => response.json())
    .then(files => {
        const gridContainer = document.getElementById('documenten-grid-container');
        files.forEach(file => {
            const gridItem = document.createElement('div');
            gridItem.className = 'grid-item';
            gridItem.textContent = file;
            gridContainer.appendChild(gridItem);
        });
    })
    .catch(error => console.error('Error fetching files:', error));

    
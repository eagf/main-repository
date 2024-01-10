"use strict";

document.addEventListener('DOMContentLoaded', () => {
    fetch('./files')
        .then(response => response.json())
        .then(files => {
            const fileListElement = document.getElementById('documenten-grid-container');
            files.forEach(file => {
                const listItem = document.createElement('li');
                const link = document.createElement('a');
                link.href = `/download/${file}`;
                link.textContent = file;
                link.download = file;
                listItem.appendChild(link);
                fileListElement.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error fetching file list:', error);
        });
});


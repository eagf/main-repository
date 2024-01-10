"use strict";

var responseClone;
fetch('https://eliasferket.com/project/logopedie-nodejs/documenten/')
    .then(function (response) {
        responseClone = response.clone();
        return response.json();
    })
    .then(files => {
        const gridContainer = document.getElementById('documenten-grid-container');
        files.forEach(file => {
            const gridItem = document.createElement('div');
            gridItem.className = 'grid-item';
            gridItem.textContent = file;
            gridContainer.appendChild(gridItem);
        });
    }, function (rejectionReason) {
        console.log('Error parsing JSON from response:', rejectionReason, responseClone);
        responseClone.text()
            .then(function (bodyText) {
                console.log('Received the following instead of valid JSON:', bodyText);
            });
    })
    .catch(error => console.error('Error fetching files:', error));


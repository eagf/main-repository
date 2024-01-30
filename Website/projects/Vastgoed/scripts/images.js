"use strict";

let uploadCounter = 1;
document.getElementById('addMoreImages').addEventListener('click', function () {
    uploadCounter++;
    const fileUploadContainer = document.getElementById('fileUploadContainer');
    const newFileUploadBlock = document.createElement('div');
    newFileUploadBlock.className = 'file-upload-block';
    newFileUploadBlock.innerHTML = `
            <label for="imageUpload${uploadCounter}">Upload afbeelding:</label>
            <input type="file" id="imageUpload${uploadCounter}" name="image[]" accept="image/*">
            <label for="description${uploadCounter}">Beschrijving:</label>
            <textarea id="description${uploadCounter}" name="description[]"></textarea>
        `;
    const removeButton = document.createElement('button');
    removeButton.innerText = 'Remove';
    removeButton.type = 'button';
    removeButton.className = 'remove-field-button';
    removeButton.onclick = function () {
        this.parentElement.remove();
    };
    newFileUploadBlock.appendChild(removeButton);
    fileUploadContainer.appendChild(newFileUploadBlock);
});

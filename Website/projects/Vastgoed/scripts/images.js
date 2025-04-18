// images.js

"use strict";

// Function to handle image preview
function handleImagePreview(e) {
    if (e.target.classList.contains('image-input')) {
        const file = e.target.files[0];
        const fileUploadBlock = e.target.closest('.file-upload-block');
        const previewDiv = fileUploadBlock.querySelector('.image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewDiv.innerHTML = `<img src="${e.target.result}" alt="Image preview" class="preview-image"/>`;
            };
            reader.readAsDataURL(file);
        }
    }
}

// Attach event listener to fileUploadContainer for handling image preview
const fileUploadContainer = document.getElementById('fileUploadContainer');
fileUploadContainer.addEventListener('change', handleImagePreview);

// Script for adding more image upload fields
let uploadCounter = 1;
document.getElementById('addMoreImages').addEventListener('click', function () {
    uploadCounter++;
    const newFileUploadBlock = document.createElement('div');
    newFileUploadBlock.className = 'file-upload-block';
    newFileUploadBlock.innerHTML = `
            <label for="imageUpload${uploadCounter}">Upload afbeelding:</label>
            <input type="file" class="image-input" id="imageUpload${uploadCounter}" name="image[]" accept="image/*">
            <div class="image-preview" id="imagePreview${uploadCounter}"></div>
            <label for="description${uploadCounter}">Beschrijving:</label>
            <textarea id="description${uploadCounter}" name="description[]"></textarea>
        `;
    const removeButton = document.createElement('button');
    removeButton.innerText = 'Verwijder';
    removeButton.type = 'button';
    removeButton.className = 'remove-field-button';
    removeButton.onclick = function () {
        this.parentElement.remove();
    };
    newFileUploadBlock.appendChild(removeButton);
    fileUploadContainer.appendChild(newFileUploadBlock);
});

document.addEventListener('DOMContentLoaded', function () {
    var sortable = new Sortable(document.getElementById('sortable'), {
        animation: 150,
        onEnd: function (evt) {
            var orderBlocks = document.querySelectorAll('.image-order-block');
            orderBlocks.forEach(function (block, index) {
                var orderNumber = block.querySelector('.order-number');
                var orderInput = block.querySelector('input[type="hidden"]');
                orderNumber.textContent = index + 1;
                orderInput.value = index + 1;
            });
        }
    });
});

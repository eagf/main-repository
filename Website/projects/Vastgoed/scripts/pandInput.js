// pandInputForm.js

"use strict";

function addKamerFields() {
    var kamerClone = document.querySelector('#kamerFields').cloneNode(true);

    kamerClone.querySelector('#kamerNaam').value = '';
    kamerClone.querySelector('#kamerOppervlakte').value = '';
    kamerClone.querySelector('#kamerDetail').value = '';

    // remove button
    const removeButton = document.createElement('button');
    removeButton.innerText = 'Remove';
    removeButton.type = 'button';
    removeButton.className = 'remove-field-button';
    removeButton.onclick = function () {
        this.parentElement.remove();
    };
    kamerClone.appendChild(removeButton);

    document.querySelector('#kamersForm').appendChild(kamerClone);
}

document.querySelector('#addKamer').addEventListener('click', addKamerFields);

function handleVrijOpChange() {
    const vrijOpSelect = document.getElementById('vrijOp');
    const dateFieldContainer = document.getElementById('dateFieldContainer');
    const specificDate = document.getElementById('specificDate');

    if (vrijOpSelect.value === 'date') {
        dateFieldContainer.style.display = 'block';
    } else {
        dateFieldContainer.style.display = 'none';
        specificDate.value = ''; 
    }
}

function updateVrijOp() {
    const specificDate = document.getElementById('specificDate').value;
    const vrijOpSelect = document.getElementById('vrijOp');

    if (specificDate) {
        vrijOpSelect.value = ''; 
    }
}

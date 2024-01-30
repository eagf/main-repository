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

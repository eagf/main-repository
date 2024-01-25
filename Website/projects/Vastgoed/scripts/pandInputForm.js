// pandInputForm.js

"use strict";

function addKamerFields() {
    // Clone the first set of fields
    var kamerClone = document.querySelector('#kamerFields').cloneNode(true);

    // Clear the values in the cloned fields
    kamerClone.querySelector('#kamerNaam').value = '';
    kamerClone.querySelector('#kamerOppervlakte').value = '';
    kamerClone.querySelector('#kamerDetail').value = '';

    // Append the cloned fields to the form
    document.querySelector('#kamersForm').appendChild(kamerClone);
}

document.querySelector('#addKamer').addEventListener('click', addKamerFields);

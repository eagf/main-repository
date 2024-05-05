// pandUpdateForm.js

"use strict";

function toggleDateInput() {
    var vrijOpSelect = document.getElementById("vrijOp");
    var vrijOpDate = document.getElementById("vrijOpDate");
    if (vrijOpSelect.value === "date") {
        vrijOpDate.style.display = "block";
        vrijOpDate.required = true;
    } else {
        vrijOpDate.style.display = "none";
        vrijOpDate.required = false;
        vrijOpDate.value = "";
    }
}

toggleDateInput();

function updateVrijOp() {
    const specificDate = document.getElementById('vrijOpDate').value;
    const vrijOpSelect = document.getElementById('vrijOp');

    if (specificDate) {
        vrijOpSelect.value = ''; 
    }
}

"use strict";

function toggleNav() {
    const nav = document.getElementById('header-list');
    const hamburger = document.getElementById('hamburger-icon');

    nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
    nav.style.marginTop = nav.style.display === 'flex' ? '10px' : '0';
    nav.style.marginBottom = nav.style.display === 'flex' ? '10px' : '0';

    hamburger.classList.toggle('active');
}

function checkWidthScreen() {
    var breedteScherm = window.innerWidth;

    var header = document.getElementById('header-list');

    if (breedteScherm > 768) {
        header.style.display = 'flex';
    }
    else {
        header.style.display = 'none';
    }
}

window.addEventListener('resize', function () {
    checkWidthScreen();
});

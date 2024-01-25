"use strict";

function toggleNav() {
    const nav = document.getElementById('header-nav');
    const navUl = nav.querySelector('ul');
    const hamburger = document.getElementById('hamburger-icon');
    navUl.style.display = navUl.style.display === 'flex' ? 'none' : 'flex';
    hamburger.classList.toggle('active');
}

function checkWidthScreen() {
    var breedteScherm = window.innerWidth;

    var header = document.getElementById('header-nav-ul');

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
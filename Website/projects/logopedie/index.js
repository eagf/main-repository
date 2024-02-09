"use strict";

var indicator = document.getElementById('scroll-indicator');
var body = document.body;
var html = document.documentElement;
var pageHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

function toggleIndicator() {
    if (window.scrollY > 50 || window.innerHeight + 100 >= pageHeight) {
        indicator.style.display = 'none';
    } else {
        indicator.style.display = 'block';
    }
}

window.addEventListener('scroll', toggleIndicator);

toggleIndicator();

indicator.addEventListener('click', function() {
    window.scrollBy({
        top: 1180, 
        left: 0,
        behavior: 'smooth' 
    });
});

// hamburger icon menu toggle

function toggleNav() {
    const nav = document.getElementById('header-list');
    const hamburger = document.getElementById('hamburger-icon');
    const image = document.querySelector('.header-img-container');

    nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
    nav.style.marginTop = nav.style.display === 'flex' ? '10px' : '0';
    nav.style.marginBottom = nav.style.display === 'flex' ? '20px' : '0';
    // image.style.display = nav.style.display === 'flex' ? 'flex' : 'none';

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
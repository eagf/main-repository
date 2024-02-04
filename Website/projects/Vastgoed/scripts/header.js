"use strict";

const hamburgerIcon = document.getElementById('hamburger-icon');
const nav = document.getElementById('header-nav');
const navUl = nav.querySelector('ul');

// hamburger icon clicked

hamburgerIcon.addEventListener('click', function () {
    navUl.style.display = navUl.style.display === 'flex' ? 'none' : 'flex';
    nav.style.marginTop = navUl.style.display === 'flex' ? '10px' : '0';
    nav.style.marginBottom = navUl.style.display === 'flex' ? '10px' : '0';
    this.classList.toggle('active');
})

// In case of resizing: header re-appear

var header = document.getElementById('header-nav-ul');

window.addEventListener('resize', function () {
    var breedteScherm = window.innerWidth;
    if (breedteScherm > 768) {
        header.style.display = 'flex';
    }
    else {
        header.style.display = 'none';
    }
});

// In case of scrolling

const scrollToTopIcon = document.getElementById('scroll-to-top');

window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
        scrollToTopIcon.style.display = 'block';
    } else {
        scrollToTopIcon.style.display = 'none'; 
    }
}, false);

scrollToTopIcon.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' }); 
});

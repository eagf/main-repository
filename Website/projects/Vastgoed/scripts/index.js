"use strict";

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, {
    threshold: 0.1 // % of the item visible
});

const contentSections = document.querySelectorAll('.content-section');
contentSections.forEach(section => {
    observer.observe(section);
});
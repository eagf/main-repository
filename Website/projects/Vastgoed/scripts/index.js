"use strict";

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }, (index + 1) * 300); // Delay for each subsequent element
        }
    });
}, {
    threshold: 0.1 // Percentage of the item visible
});

const contentSections = document.querySelectorAll('.content-section');

contentSections.forEach(section => {
    observer.observe(section);
});

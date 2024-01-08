"use strict";

setTimeout(function () {
    var backgroundSliders = document.querySelectorAll('.background-slider');
    backgroundSliders.forEach(function (element, index) {
        setTimeout(function () {
            element.classList.add('active');
        }, index * 100);
    });

    var knobs = document.querySelectorAll('.knob');
    knobs.forEach(function (element, index) {
        setTimeout(function () {
            element.classList.add('active');
        }, index * 100);
    });
}, 1000);

const observedCheck = new IntersectionObserver((elements) => {
    elements.forEach((element) => {
        console.log(element);
        if (element.isIntersecting) {
            element.target.classList.add('visible');
        } 
    })
})

const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((element) => observedCheck.observe(element));


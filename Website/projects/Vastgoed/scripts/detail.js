// detail.js

"use strict";

let currentIndex = 0;
const carouselContainer = document.querySelector('.detail-image-container');
const images = document.querySelectorAll('.detail-image');
const totalImages = images.length;

function moveToImage(index) {
    carouselContainer.style.transform = `translateX(-${index * 100}%)`;
    currentIndex = index;
}

// Left arrow click
document.querySelector('.left-arrow').addEventListener('click', () => {
    if (currentIndex > 0) {
        moveToImage(currentIndex - 1);
    } else {
        moveToImage(totalImages - 1);
    }
});

// Right arrow click
document.querySelector('.right-arrow').addEventListener('click', () => {
    moveToImage((currentIndex + 1) % totalImages);
});

// Hide arrows

const leftArrow = document.querySelector('.left-arrow');
const rightArrow = document.querySelector('.right-arrow');

function showArrows() {
    leftArrow.style.display = 'block';
    rightArrow.style.display = 'block';
}

carouselContainer.addEventListener('mouseover', showArrows);

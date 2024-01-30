"use strict";

let currentIndex = 0;
const carouselContainer = document.querySelector('.detail-image-container');
const images = document.querySelectorAll('.detail-image');
const totalImages = images.length;

function moveToImage(index) {
    carouselContainer.style.transform = `translateX(-${index * 100}%)`;
    currentIndex = index;
}

// Add event listeners to your controls here (if you have arrows or dots for navigation)
// Example: document.querySelector('.next-button').addEventListener('click', () => moveToImage(currentIndex + 1));

// Optional: Add auto-slide functionality
setInterval(() => {
    moveToImage((currentIndex + 1) % totalImages);
}, 3000); // Change image every 3000 milliseconds (3 seconds)




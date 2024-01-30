"use strict";

function submitForm() {
    var status = document.getElementById('statusToggle').checked ? 'Te huur' : 'Te koop';
    window.location.href = '?status=' + status;
}

const carousels = document.querySelectorAll('.card-carousel');

carousels.forEach(carousel => {
    let currentIndex = 0;
    let intervalId = null;
    const carouselContainer = carousel.querySelector('.card-image-container');
    const images = carousel.querySelectorAll('.card-image');
    const totalImages = images.length;

    function moveToImage(index) {
        carouselContainer.style.transform = `translateX(-${index * 100}%)`;
        currentIndex = index;
    }

    function startCarousel() {
        if (!intervalId) { 
            intervalId = setInterval(() => {
                moveToImage((currentIndex + 1) % totalImages);
            }, 1000); 
        }
    }

    function stopCarousel() {
        clearInterval(intervalId);
        intervalId = null;
        currentIndex = 0;
        moveToImage(currentIndex);
    }

    carousel.addEventListener('mouseover', startCarousel);
    carousel.addEventListener('mouseout', stopCarousel);
});
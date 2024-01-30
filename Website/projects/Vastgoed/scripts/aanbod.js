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
            }, 500); 
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

    // Mobile devices

   function initIntersectionObserver() {
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCarousel();
                    } else {
                        stopCarousel();
                    }
                });
            }, { threshold: 0.8 }); // when 80% visible

            observer.observe(carousel);
        }

        if (window.innerWidth < 768) {
            initIntersectionObserver();
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth < 768) {
                initIntersectionObserver();
            } else {
                stopCarousel();
            }
        });

});
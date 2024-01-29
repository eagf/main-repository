"use strict";

function submitForm() {
    var status = document.getElementById('statusToggle').checked ? 'Te huur' : 'Te koop';
    window.location.href = '?status=' + status;
}

document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.card-image-carousel');

    carousels.forEach(carousel => {
        let currentIndex = 0;
        const images = carousel.querySelectorAll('.card-image');
        const totalImages = images.length;

        images.forEach((img, index) => {
            if (index === currentIndex) {
                img.style.transform = 'translateX(0)';
                img.style.zIndex = '2'; // Make current image on top
            } else {
                img.style.transform = 'translateX(100%)';
                img.style.zIndex = '1'; // Other images below
            }
        });

        setInterval(() => {
            const nextIndex = (currentIndex + 1) % totalImages;

            images[nextIndex].style.zIndex = '3'; // Bring the next image to the top
            images[nextIndex].style.transform = 'translateX(0)'; // Slide in the next image

            setTimeout(() => {
                // After a delay, reset all other images to the right and manage z-index
                images.forEach((img, index) => {
                    if (index !== nextIndex) {
                        img.style.transform = 'translateX(100%)';
                        img.style.zIndex = '1';
                    }
                });

                images[currentIndex].style.zIndex = '2'; // Previous image goes below the current one
            }, 500); // Delay in milliseconds (adjust as needed)

            currentIndex = nextIndex;
        }, 3000); // Interval time in milliseconds (adjust as needed)
    });
});

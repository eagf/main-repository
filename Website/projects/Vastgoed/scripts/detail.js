// detail.js

"use strict";

// =============== Initialize slideshow ===============

const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    keyboard: {
        enabled: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // ... other options as needed
});

// Define the timeout duration in milliseconds (adjust as needed)
const timeoutDuration = 1000; // 1 second

let timerId;

const container = document.querySelector('.swiper-container');

container.addEventListener('mouseenter', () => {
  document.querySelector('.swiper-button-next').classList.remove('swiper-button-hidden');
  document.querySelector('.swiper-button-prev').classList.remove('swiper-button-hidden');

  // Clear any existing timer
  clearTimeout(timerId);
});

container.addEventListener('mouseleave', () => {
  // Start a new timer to hide buttons after timeout
  timerId = setTimeout(() => {
    document.querySelector('.swiper-button-next').classList.add('swiper-button-hidden');
    document.querySelector('.swiper-button-prev').classList.add('swiper-button-hidden');
  }, timeoutDuration);
});

// =============== Fullscreen functionality ===============

function enterCustomFullscreen() {
    const slideshowContainer = document.querySelector('.slideshow-container');
    slideshowContainer.classList.add('fullscreen');
    const closeBtn = document.querySelector('.close-btn');
    closeBtn.style.display = 'block';
    // Show descriptions and numbertext in fullscreen mode
    document.querySelectorAll('.text, .numbertext').forEach(element => element.style.display = 'block');
}

function exitCustomFullscreen() {
    const slideshowContainer = document.querySelector('.slideshow-container');
    slideshowContainer.classList.remove('fullscreen');
    const closeBtn = document.querySelector('.close-btn');
    closeBtn.style.display = 'none';
    // Hide descriptions and numbertext when exiting fullscreen
    document.querySelectorAll('.text, .numbertext').forEach(element => element.style.display = 'none');
}

// Modify the existing fullscreen toggle to call the correct functions
const images = document.querySelectorAll('.swiper-slide img');
images.forEach(img => {
    img.addEventListener('click', function () {
        // Check if already in fullscreen to decide which function to call
        const slideshowContainer = document.querySelector('.slideshow-container');
        if (slideshowContainer.classList.contains('fullscreen')) {
            exitCustomFullscreen();
        } else {
            enterCustomFullscreen();
        }
    });
});

// Update the close button functionality to call exitCustomFullscreen
const closeBtn = document.querySelector('.close-btn');
closeBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    exitCustomFullscreen();
});


// Adjust Esc key functionality to use exitCustomFullscreen
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        exitCustomFullscreen();
    }
});


// =============== Automatic arrow sliding EPC ===============

const arrowContainer = document.getElementById('epc-arrow-container');

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            arrowContainer.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
});


observer.observe(arrowContainer);

// =============== Changing color location symbol ===============

function changeImage() {
    document.getElementById('locationImg').src = './assets/img/locatieOranje.png'; 
}

function resetImage() {
    document.getElementById('locationImg').src = './assets/img/locatieBlauw.png'; 
}

function clickedImage() {
    var img = document.getElementById('locationImg');
    img.src = './assets/img/locatieOranje.png'; 
    img.classList.add('img-clicked'); 
    setTimeout(function() {
        resetImage();
        img.classList.remove('img-clicked');
    }, 1000);
}



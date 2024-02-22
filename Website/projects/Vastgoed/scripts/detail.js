// detail.js

"use strict";


// =============== Initialize slideshow ===============

var slideIndex = 1;
var isTouchedRecently = false; // Flag to track recent touch interaction

showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    var isFullscreen = document.querySelector('.slideshow-container').classList.contains('fullscreen');

    if (n > slides.length) slideIndex = 1;
    if (n < 1) slideIndex = slides.length;

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" activeDot", "");
    }

    // Show or hide numbertext based on fullscreen mode
    var numbertexts = document.getElementsByClassName("numbertext");
    for (i = 0; i < numbertexts.length; i++) {
        numbertexts[i].style.display = isFullscreen ? "block" : "none";
    }

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " activeDot";
}



// Attach event listeners to arrow buttons
document.querySelector('.prev').addEventListener('click', function (e) {
    if (isTouchedRecently) {
        isTouchedRecently = false; // Reset the flag
        return; // Exit early to avoid double execution
    }
    e.preventDefault();
    e.stopPropagation();
    plusSlides(-1);
});

document.querySelector('.next').addEventListener('click', function (e) {
    if (isTouchedRecently) {
        isTouchedRecently = false; // Reset the flag
        return; // Exit early to avoid double execution
    }
    e.preventDefault();
    e.stopPropagation();
    plusSlides(1);
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
const images = document.querySelectorAll('.mySlides img');
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
    } else if (event.key === "ArrowLeft") {
        plusSlides(-1);
    } else if (event.key === "ArrowRight") {
        plusSlides(1);
    }
});


// =============== swiping carousel ===============

let touchStartX = 0; 
let touchEndX = 0;

// touch event listeners 
const slideshowContainer = document.querySelector('.slideshow-container');

slideshowContainer.addEventListener('touchstart', function(event) {
    touchStartX = event.touches[0].clientX; // Get the initial touch position
}, false);

slideshowContainer.addEventListener('touchmove', function(event) {
    touchEndX = event.touches[0].clientX; // Update the touch position as the user swipes
}, false);

slideshowContainer.addEventListener('touchend', function(event) {
    handleSwipeGesture();
    isTouchedRecently = true; // Set the flag to indicate a touch interaction occurred
    setTimeout(() => { isTouchedRecently = false; }, 50); // Reset the flag after a short delay
}, false);


function handleSwipeGesture() {
    if (touchEndX < touchStartX) {
        plusSlides(1); // Swiped left, go to next slide
    }
    if (touchEndX > touchStartX) {
        plusSlides(-1); // Swiped right, go to previous slide
    }
}

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
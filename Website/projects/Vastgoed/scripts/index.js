"use strict";

// Automatically insert new divs when in view

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
    threshold: 0.2 // Percentage of the item visible
});

const contentSections = document.querySelectorAll('.content-section');

contentSections.forEach(section => {
    observer.observe(section);
});

// Carousel

const swiper = new Swiper('.swiper', {

    effect: "coverflow",
    loop: true,
    centeredSlides: true,
    slidesPerView: 1,
    coverflowEffect: {
      rotate: 0,
      stretch: 200,
      depth: 80,
      modifier: 1,
      slideShadows: true,
    },
    // Responsive breakpoints
    breakpoints: {
        // >= 320px
        320: {
            slidesPerView: 1
        },
        // >= 480px
        480: {
            slidesPerView: 2
        },
        // >= 640px
        640: {
            slidesPerView: 3,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 80,
                modifier: 1,
                slideShadows: false,
              },
        },
        // >= 1300px
        1300: {
            slidesPerView: 3,
            spaceBetween: 80,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 80,
                modifier: 1,
                slideShadows: false,
              },
        },
    },
    autoplay: {
        delay: 3000, 
        disableOnInteraction: true,
        pauseOnMouseEnter: true
    }


    // direction: 'horizontal',
    // loop: true,

    // slidesPerView: 1,
    // spaceBetween: 20,

    // // Responsive breakpoints
    // breakpoints: {
    //     // >= 320px
    //     320: {
    //         slidesPerView: 1
    //     },
    //     // >= 480px
    //     480: {
    //         slidesPerView: 2
    //     },
    //     // >= 640px
    //     640: {
    //         slidesPerView: 3
    //     }
    // },

    // autoplay: {
    //     delay: 3000, 
    //     disableOnInteraction: true,
    //     pauseOnMouseEnter: true
    // }
});

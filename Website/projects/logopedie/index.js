"use strict";

var indicator = document.getElementById('scroll-indicator');
var body = document.body;
var html = document.documentElement;
var pageHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

function toggleIndicator() {
    if (window.scrollY > 50 || window.innerHeight + 100 >= pageHeight) {
        indicator.style.display = 'none';
    } else {
        indicator.style.display = 'block';
    }
}

window.addEventListener('scroll', toggleIndicator);

toggleIndicator();

indicator.addEventListener('click', function() {
    window.scrollBy({
        top: 700, 
        left: 0,
        behavior: 'smooth' 
    });
});
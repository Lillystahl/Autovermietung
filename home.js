// JavaScript code for next and previous buttons (slider functionality)
let next = document.querySelector('.next');
let prev = document.querySelector('.prev');

next.addEventListener('click', function(){
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').appendChild(items[0]);
});

prev.addEventListener('click', function(){
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').prepend(items[items.length - 1]);
});
// JavaScript to toggle the login/signup container

// Handle switching between Signup and Login panels
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container1');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

/*
// Get the login button element
var loginButton = document.getElementById('loginButton');
const background = document.querySelector('.background');


// Get the container element that you want to toggle visibility
var container1 = document.querySelector('.container1');

// Get the blurred overlay element
var blurBackground = document.querySelector('.background');

// Add a click event listener to the login button
loginButton.addEventListener('click', function() {
    background.classList.toggle('active');
    // Toggle the visibility of container1 by adding/removing the 'active' class
    container1.classList.toggle('active');
});*/
// JavaScript, um die Sterne entsprechend der Bewertung auszufüllen
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".stars");

    stars.forEach(starElement => {
        const rating = parseInt(starElement.getAttribute("data-rating"));
        const starHTML = "&#9733;".repeat(rating) + "&#9734;".repeat(5 - rating);
        starElement.innerHTML = starHTML;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cities = document.querySelectorAll('.city');

    cities.forEach(city => {
        city.addEventListener('mouseover', function () {
            const markerType = this.dataset.marker;
            const marker = document.querySelector(`.map-marker.${markerType}-marker`);

            if (marker) {
                marker.classList.add('marker-hover');
            }
        });

        city.addEventListener('mouseout', function () {
            const markerType = this.dataset.marker;
            const marker = document.querySelector(`.map-marker.${markerType}-marker`);

            if (marker) {
                marker.classList.remove('marker-hover');
            }
        });
    });
});
// JavaScript code for next and previous buttons (slider functionality)
// Check if the page is the homepage and reset the form fields
if (window.location.href.indexOf("home.php") > -1) {
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.querySelector('.searchbar-inner form');
        form.reset();
    });
}

// Check if redirect was performed
let redirected = sessionStorage.getItem('redirected');
if (!redirected && window.location.href.indexOf("home.php") === -1) {
    // If not redirected and not on the homepage, redirect to Produktübersicht
    sessionStorage.setItem('redirected', 'true');
    window.location.replace('Produktübersicht.php');
}

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





// Check if the page is the homepage and reset the form fields
if (window.location.href.indexOf("home.php") > -1) {
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.querySelector('.searchbar-inner form');
        if (form) {
            form.reset();
        }
    });
}

// Check if redirect was performed
// NOTE: DRINGEND GUCKEN OB DAS HIER BENÖTIGT WIRD
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

document.addEventListener('DOMContentLoaded', function() {
    var dropdown = document.querySelector('.dropdown');
    var dropdownMenu = dropdown.querySelector('.dropdown-menu');

    dropdown.addEventListener('click', function(event) {
        event.stopPropagation(); // Verhindert, dass das Klicken im Dropdown-Element das Dropdown schließt
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});


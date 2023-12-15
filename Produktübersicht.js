// JavaScript Funktionen für die Anzeige und das Schließen der vergrößerten Ansicht
function openCarDetails() {
    document.getElementById("carDetailsOverlay").style.display = "block";
    document.body.style.overflow = "hidden"; // Deaktiviert das Scrollen auf der Hauptseite
}

function closeCarDetails() {
    document.getElementById("carDetailsOverlay").style.display = "none";
    document.body.style.overflow = "auto"; // Aktiviert das Scrollen auf der Hauptseite
}

const carDetailsPopup = document.getElementById('carDetailsPopup');
const carDetailsOverlay = document.getElementById('carDetailsOverlay');

if (carDetailsPopup && carDetailsOverlay) {
    // Event Listener für Klicks außerhalb des Popups
    carDetailsOverlay.addEventListener('click', function(event) {
        if (!carDetailsPopup.contains(event.target)) {
            // Klick erfolgte außerhalb des Popups, schließe es
            closeCarDetails(); // Funktion zum Schließen des Popups aufrufen
        }
    });
}

// Eventlistener für das Klickereignis auf einer Car Card, um die vergrößerte Ansicht zu öffnen
var carCards = document.getElementsByClassName("car-card");
for (var i = 0; i < carCards.length; i++) {
    carCards[i].addEventListener('click', function() {
        openCarDetails();
        // Setze die Werte der vergrößerten Ansicht auf die Werte der Car Card, die geklickt wurde
        var carDetailsImage = document.getElementById("carDetailsImage");
        carDetailsImage.src = this.getElementsByTagName("img")[0].src;
    });
}

window.onclick = function(event) {
    var carDetailsPopup = document.getElementById("carDetailsPopup"); // ID des Popups
    var carDetailsContent = document.getElementById("carDetailsContent"); // ID des weißen Bereichs im Popup
}

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


//Reset Home Logo
$(document).ready(function() {
    $('#resetSearchButton').click(function(e) {
        e.preventDefault();

        // Make an AJAX request to resetSearch.inc.php
        $.ajax({
            url: 'resetSearchProduktübersicht.inc.php',
            type: 'POST',
            success: function(response) {
                // On success, redirect to home.php
                window.location.href = 'home.php';
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });

    // Bind click event to the logo
    $('#logoLink').click(function(e) {
        e.preventDefault();

        // Make an AJAX request to resetSearch.inc.php
        $.ajax({
            url: 'ResetSearchHomeIcon.inc.php',
            type: 'POST',
            success: function(response) {
                // On success, redirect to home.php
                window.location.href = 'home.php';
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });

    $('.filter-reset').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'resetFilterbar.inc.php', // Replace with your PHP script name
            type: 'POST',
            success: function(response) {
                // Redirect to produktuebersicht.php after unsetting the filters
                window.location.href = 'Produktübersicht.php';
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error if needed
            }
        });
    });
});


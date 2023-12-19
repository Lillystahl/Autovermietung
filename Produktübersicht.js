const locationInput = document.querySelector('input[name="standort-location"]');
const locationList = document.querySelector('#locations');

locationInput.addEventListener('input', function() {
    const inputVal = this.value.toLowerCase();
    const options = locationList.querySelectorAll('option');
    
    // If the input is empty, restore the default placeholder
    if (!inputVal.trim()) {
        this.placeholder = 'Standort';
    }

    options.forEach(option => {
        const optionVal = option.value.toLowerCase();
        if (optionVal.startsWith(inputVal)) {
            option.hidden = false;
        } else {
            option.hidden = true;
        }
    });
});
// JavaScript Funktionen für die Anzeige und das Schließen der vergrößerten Ansicht
function openCarDetails(index) {
    // Erhalte das entsprechende Overlay und Popup basierend auf dem Index
    var overlay = document.getElementById('carDetailsOverlay_' + index);
    var popup = document.getElementById('carDetailsPopup_' + index);

    // Zeige das Overlay und das Popup an
    overlay.style.display = 'block';
    popup.style.display = 'block';

    document.body.style.overflow = "hidden"; // Deaktiviert das Scrollen auf der Hauptseite
}

function closeCarDetails() {
    document.querySelectorAll(".car-details-overlay").forEach(function(overlay) {
        overlay.style.display = "none";
    });

    document.body.style.overflow = "auto"; // Aktiviert das Scrollen auf der Hauptseite
}

document.querySelectorAll(".car-details-overlay").forEach(function(overlay) {
    overlay.addEventListener('click', function(event) {
        const popup = this.querySelector('.car-details-popup');

        if (popup && !popup.contains(event.target)) {
            closeCarDetails(); // Funktion zum Schließen des Popups aufrufen
        }
    });
});

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


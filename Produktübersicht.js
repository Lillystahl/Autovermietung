
document.addEventListener('DOMContentLoaded', function () {
    const overviewRows = document.querySelectorAll('.overview-row .car-card');
    const cardsPerPage = 20; // Total cards per page (4 rows * 5 cards)
    let currentPage = 1; // Current page, default is 1

    function showPage(pageNumber) {
        const startIndex = (pageNumber - 1) * cardsPerPage;
        const endIndex = pageNumber * cardsPerPage;

        overviewRows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = 'block'; // Show rows within the range
            } else {
                row.style.display = 'none'; // Hide rows outside the range
            }
        });
    }

    function handlePageClick(event) {
        event.preventDefault();
        const pageNumber = parseInt(event.target.textContent); // Get the clicked page number
        showPage(pageNumber);
        currentPage = pageNumber; // Update current page
    }

    // Initially display the first page
    showPage(currentPage);

    // Attach click event listeners to pagination links
    const pageLinks = document.querySelectorAll('.pagination a');
    pageLinks.forEach(link => {
        link.addEventListener('click', handlePageClick);
    });
});



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

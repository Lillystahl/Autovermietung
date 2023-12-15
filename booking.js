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

const indicator = document.getElementById('indicator');
const confirmDateButton = document.getElementById('confirm-date-button');

// Event Listener für den Klick auf den Button
confirmDateButton.addEventListener('click', function() {
    // Setze den Indikator für das Datum auf "complete"
    indicator.classList.add('complete');
});

document.addEventListener('DOMContentLoaded', function() {
    const confirmButton = document.getElementById('confirm-button');
    const confirmIndicator = document.getElementById('confirm-indicator');

    function handleConfirmation() {
        confirmIndicator.classList.add('complete');
    }

    confirmButton.addEventListener('click', handleConfirmation);
});

function toggleIndicator() {
    const indicator = document.getElementById('rechnungsadresse-indicator');
    indicator.classList.toggle('complete');
}

function togglePaymentIndicator() {
    const indicator = document.getElementById('zahlungsmethode-indicator');
    const options = document.getElementsByName('payment');

    for (const option of options) {
        if (option.checked) {
            indicator.classList.add('complete');
            return;
        }
    }

    indicator.classList.remove('complete');
}

const buchungsButton = document.querySelector('.buchungs-button');
const errorMessageBox = document.querySelector('.error-message');

buchungsButton.addEventListener('click', function() {
    const fromDate = document.getElementById('from-date');
    const toDate = document.getElementById('to-date');
    const indicator = document.getElementById('indicator');
    const confirmIndicator = document.getElementById('confirm-indicator');
    const rechnungsadresseIndicator = document.getElementById('rechnungsadresse-indicator');
    const zahlungsmethodeIndicator = document.getElementById('zahlungsmethode-indicator');

    if (
        indicator.classList.contains('complete') &&
        confirmIndicator.classList.contains('complete') &&
        rechnungsadresseIndicator.classList.contains('complete') &&
        zahlungsmethodeIndicator.classList.contains('complete')
    ) {
        //window.location.href = 'confirmation.html'; // Weiterleitung zur Bestätigungsseite
    } else {
        errorMessageBox.style.display = 'block'; // Fehlermeldung anzeigen
    }
});

$(document).ready(function() {
    // Bind click event to the logo
    $('#logoLink').click(function(e) {
        e.preventDefault();

        // Make an AJAX request to ResetSearchHomeIcon.inc.php
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
});

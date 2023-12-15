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

// JavaScript Funktionen für die Anzeige und das Schließen der vergrößerten Ansicht
function openCarDetails() {
    document.getElementById("carDetailsOverlay").style.display = "block";
    document.body.style.overflow = "hidden"; // Deaktiviert das Scrollen auf der Hauptseite
}

function closeCarDetails() {
    document.getElementById("carDetailsOverlay").style.display = "none";
    document.body.style.overflow = "auto"; // Aktiviert das Scrollen auf der Hauptseite
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

    if (event.target !== carDetailsContent && !carDetailsContent.contains(event.target)) {
        carDetailsPopup.style.display = "none"; // Schließe das Popup, wenn außerhalb geklickt wird
        document.body.style.overflow = "auto"; // Aktiviere das Scrollen auf der Hauptseite
    }
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
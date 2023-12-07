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
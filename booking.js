const fromDate = document.getElementById('from-date');
const toDate = document.getElementById('to-date');
const indicator = document.getElementById('indicator');

function checkDates() {
    if (fromDate.value && toDate.value) {
        const fromDateValue = new Date(fromDate.value);
        const toDateValue = new Date(toDate.value);
        
        if (toDateValue >= fromDateValue) {
            indicator.classList.add('complete');
        } else {
            indicator.classList.remove('complete');
        }
    } else {
        indicator.classList.remove('complete');
    }
}

fromDate.addEventListener('input', checkDates);
toDate.addEventListener('input', checkDates);

fromDate.addEventListener('input', checkDates);
toDate.addEventListener('input', checkDates);

const confirmButton = document.getElementById('confirm-button');
const confirmIndicator = document.getElementById('confirm-indicator');

confirmButton.addEventListener('click', function() {
  confirmIndicator.classList.add('complete');
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
        window.location.href = 'confirmation.html'; // Weiterleitung zur Bestätigungsseite
    } else {
        errorMessageBox.style.display = 'block'; // Fehlermeldung anzeigen
    }
});
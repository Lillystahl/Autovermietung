const fromDate = document.getElementById('from-date');
const toDate = document.getElementById('to-date');
const fromIndicator = document.getElementById('from-indicator');
const toIndicator = document.getElementById('to-indicator');

function checkDates() {
    if (fromDate.value && toDate.value) {
        const fromDateValue = new Date(fromDate.value);
        const toDateValue = new Date(toDate.value);
        if (toDateValue >= fromDateValue) {
            document.getElementById('datum').classList.add('complete');
        } else {
            document.getElementById('datum').classList.remove('complete');
        }
    } else {
        document.getElementById('datum').classList.remove('complete');
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
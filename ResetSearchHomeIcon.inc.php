<?php
session_start();

// Unset the session variables related to search parameters
unset($_SESSION['location']);
unset($_SESSION['vehicle_type']);
unset($_SESSION['start_date']);
unset($_SESSION['end_date']);
// ... unset other search-related session variables

// No need for header redirection here as the AJAX request handles it
?>
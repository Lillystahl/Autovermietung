<?php
session_start();

// Unset the session variables related to search parameters
$_SESSION['manufacturer'] = '';
$_SESSION['seats'] = '';
$_SESSION['doors'] = '';
$_SESSION['gearbox'] = '';
$_SESSION['minAge'] = '';
$_SESSION['drive'] = '';
$_SESSION['air_conditioning'] = '';
$_SESSION['gps'] = '';
$_SESSION['max_price'] = '';
$_SESSION['Sortierung'] = '';
// ... unset other filter-related session variables

// No need for header redirection here as the AJAX request handles it
?>
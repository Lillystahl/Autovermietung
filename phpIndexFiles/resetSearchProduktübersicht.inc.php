<?php
session_start();

// Unset the session variables related to search parameters
unset($_SESSION['location']);
unset($_SESSION['vehicle_type']);
unset($_SESSION['start_date']);
unset($_SESSION['end_date']);
unset($_SESSION['manufacturer']); 
unset($_SESSION['seats']); 
unset($_SESSION['doors']); 
unset($_SESSION['gearbox']); 
unset($_SESSION['minAge']); 
unset($_SESSION['drive']); 
unset($_SESSION['air_conditioning']);
unset($_SESSION['gps']);
unset($_SESSION['max_price']);
// ... unset other search-related session variables

// No need for header redirection here as the AJAX request handles it
?>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('process_form.php');

    processSearchForm();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Website</title>
    <link rel="stylesheet" href="homeStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>

<body>
    
    <!-- im header php function if block, der die session checkt und header anpasst
    block 1: header if session
    blokc 2: default header -->
    <header>
        <div class="header">
            <div class="header-left">
                <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                <h1><a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a></h1>
                <h1><a href="Top-deals.php" id="header2">Top-Deals</a></h1>
                <h1><a href="Geschaeftskunden.php" id="header3">Geschäftskunden</a></h1>
            </div>
            <div class="header-right">
                <div class="search-container">
                    <input type="text" placeholder="Search..." name="search" />
                </div>
                <div class="button-container">
                    <a href="#" class="Buchungs-button">Meine Buchungen</a>
                    <a href="Registrierung.php" class="Login-button">Logout</a>
                </div>
            </div>
    </div>
    </header>
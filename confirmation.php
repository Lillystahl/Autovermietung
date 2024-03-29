<?php
    require_once('phpIndexFiles/db_connect.php');
    require_once('phpIndexFiles/process_form.php');
    require_once('phpIndexFiles/config_session.inc.php');
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase Success!</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="jsAndStyles/bookingstyle.css">
    <link rel="stylesheet" href="jsAndStyles/homeStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="jsAndStyles/confirmation.js"></script>
</head>

<body>
    <header>
        <?php
            if(isset($_SESSION["user_id"])){
                echo '<div class="header">
                            <div class="header-left">
                                <a href="home.php" class="logo" id="logoLink"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                                <h1><a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a></h1>
                            </div>
                            <div class="header-right">
                                <div class="dropdown">
                                    <span class="user-section">
                                        Willkommen,&nbsp;<span class="user-name">' . $_SESSION["user_username"] . '</span>&nbsp;&nbsp;
                                        <i class="fa-regular fa-user"></i>&nbsp;
                                        <i class="fa-solid fa-caret-down"></i>
                                    </span>
                                    <ul class="dropdown-menu" id="dropdownMenu">
                                        <li><a href="MyBookings.php">Meine Buchungen</a></li>
                                        <li><a href="phpIndexFiles/logout.inc.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
            }else{
                echo'<div class="header">
                <div class="header-left">
                    <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                    <h1>
                        <a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a>
                    </h1>
                </div>
                <div class="header-right">
                    <div class="search-container">
                        <input type="text" placeholder="Search..." name="search" />
                    </div>
                    <div class="button-container">
                    <a href="Registrierung.php" class="Login-button">LogIn / SignUp</a>
                    </div>
                </div>
                </div>';
            }
            ?>
        </header>

    <content>
        <div class="confirmation-content">
            <h1>Vielen dank für Ihre Buchung bei RentEase! <a style="color: green;">✓</a></h1>
            <p>Ihre Buchung wurde erfolgreich bestätigt. Die Buchungsdetails finden sie unter "<a href="MyBookings.php" class="my-bookings-link">Meine Buchungen</a>". Wir wünschen eine gute Fahrt!</p>
            <!-- Weitere Informationen oder Inhalte zur Bestätigung -->
        </div>
    </content>

    <div class="footer-container">
        <div class="footer">
        <div class="footer-heading footer-1">
            <h2>About Us</h2>
            <a href="#">Blog</a>
            <a href="#">Kunden</a>
            <a href="Datenschutz.php">Datenschutz</a>
            <a href="AGB.php">AGB</a>
            <a href="Impressum.php">Impressum</a>
        </div>

        <div class="footer-heading footer-2">
            <h2>Contact Us</h2>
            <a href="#">Jobs</a>
            <a href="#">Contact</a>
            <a href="#">Sponsorships</a>
            <a href="#">Support</a>
        </div>

        <div class="footer-heading footer-3">
            <h2>Social Media</h2>
            <div class="sm">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="footer-heading footer-4">
            <div class="footer-email-form">
            <h2>Join our Newsletter</h2>
            <form>
                <div class="input-container">
                <input
                    type="email"
                    placeholder="Enter your E-Mail address"
                    id="footer-email"
                />
                <input type="submit" value="Sign Up" id="footer-email-button" />
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="footer-small">
        <div class="sub-holder">
            <div class="sub-container">
                <div class="app-container">
                    <span>Get the App</span>
                        <div class="app-icons">
                            <i class="fa-brands fa-app-store-ios"></i>
                            <i class="fa-brands fa-google-play"></i>
                        </div>
                    </div>
                    <div class="Copyright-container">
                        <span>ReantEase 2023 All rights reserved</span>
                    </div>
                    <div class="Payment-container">
                        <span>Payment Options</span>
                        <div class="payment-icons">
                            <i class="fa-brands fa-google-pay"></i>
                            <i class="fa-brands fa-apple-pay"></i>
                            <i class="fa-brands fa-paypal"></i>
                            <i class="fa-brands fa-cc-mastercard"></i>
                            <i class="fa-brands fa-cc-amex"></i>
                            <i class="fa-brands fa-cc-visa"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
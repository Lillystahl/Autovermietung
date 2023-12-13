<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('config_session.inc.php');
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Website</title>
    <link rel="stylesheet" href="homeStyle.css"/>
    <link rel="stylesheet" href="infoStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>

<body>
<header>
    <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                        <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                        <h1><a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a></h1>
                        <h1><a href="Top-deals.php" id="header2">Top-Deals</a></h1>
                        <h1><a href="Geschaeftskunden.php" id="header3">Geschäftskunden</a></h1>
                    </div>
                    <div class="header-right">
                        <div class="dropdown">
                            <span class="user-section">
                                Willkommen,&nbsp;<span class="user-name">' . $_SESSION["user_username"] . '</span>&nbsp;&nbsp;
                                <i class="fa-regular fa-user"></i>&nbsp;
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <li><a href="link_zu_meine_buchungen.php">Meine Buchungen</a></li>
                                <li><a href="logout.inc.php">Logout</a></li>
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
            <h1><a href="Top-deals.php" id="header2">Top-Deals</a></h1>
            <h1>
                <a href="Geschaeftskunden.php" id="header3">Geschäftskunden</a>
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
    <div class="aTextContainer">
        <div class="TextContainer">
            <h1>Privacy Policy</h1>
            <p>As of: [22.11.2023]</p>

            <p>
                We appreciate your interest in our car rental service. The protection of your personal data is important to us. Below, we inform you about the processing of your personal data in connection with the use of our website and services.
            </p>

            <h2>Data Controller</h2>
            <p>
                Responsible for data processing within the meaning of the General Data Protection Regulation (GDPR) is:
            </p>
            <p>CarFair</p>
            <p>[Address]</p>
            <p>[Email Address]</p>
            <p>[Phone Number]</p>

            <h2>Collection and Processing of Personal Data</h2>

            <h2>2.1. Personal Data</h2>
            <p>
                Personal data includes all information that relates to an identified or identifiable natural person. This includes, for example, your name, your contact details such as phone number and email address, as well as information about the services you have
                used.
            </p>

            <h2>2.2. Processing Purposes</h2>
            <p>We process your personal data for the following purposes:</p>
            <ul>
                <li>To carry out reservations and bookings of vehicles.</li>
                <li>
                    For the processing of rental agreements and related payment transactions.
                </li>
                <li>For communication with you as part of our services.</li>
                <li>
                    To fulfill legal obligations, such as the documentation of transactions.
                </li>
                <li>
                    For the improvement and optimization of our website and services.
                </li>
                <li>To ensure IT security and protection against fraud.</li>
            </ul>

            <h2>2.3. Legal Bases</h2>
            <p>
                The processing of your personal data is based on the GDPR. The processing is lawful, in particular, if it is necessary for the performance of a contract or for the implementation of pre-contractual measures, based on your consent, necessary for compliance
                with a legal obligation, or if our legitimate interests prevail and these are not overridden by your data protection rights or interests.
            </p>

            <h2>Transmission of Data to Third Parties</h2>
            <p>
                Your personal data will only be transferred to third parties if this is necessary for the processing of contractual relationships with you, if required by law, or if you have given your consent.
            </p>

            <h2>Data Security</h2>
            <p>
                We use technical and organizational security measures to protect your data against accidental or unlawful manipulation, loss, destruction, or unauthorized access by third parties.
            </p>

            <h2>Your Rights</h2>
            <p>
                You have the right to obtain information about the personal data stored by us, to correct, delete, or restrict processing. You can also object to the processing of your data and exercise the right to data portability. For questions or concerns regarding
                data protection, you can contact us.
            </p>

            <h2>Changes to this Privacy Policy</h2>
            <p>
                This privacy policy may be adjusted occasionally to reflect changes in our business practices and legal requirements. The current version can always be found on our website. We thank you for your trust and are available for any questions.
            </p>

            <p>CarFair</p>
            <p>[Company Address]</p>
            <p>[Email Address]</p>
            <p>[Phone Number]</p>
        </div>
    </div>

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
            <script src="home.js"></script>
        </div>
    </div>
</body>
</html>
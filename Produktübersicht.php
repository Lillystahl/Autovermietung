<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="ProduktübersichtStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<header>
        <div class="header">
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
        </div>
    </header>

    <div class="product-barcontainer">
        <div class="advanced-search-bar-top">
            <h2>Fahrzeug mieten</h2>
        <form>
            <div class="searchbar-inner">
                <input type="text" placeholder="Location" name="location">
                <input type="text" placeholder="Fahrzeugart" name="vehicle-type">
                <input type="date" placeholder="Start-Datum" name="start-date">
                <input type="date" placeholder="End-Datum" name="end-date">
                <button type="submit">Suchen</button>
            </div>
        </form>
        </div>
        <div class="filter-bar">
            <h2>Filter</h2>
            <form>
                <div class="filter-bar-inner">
                    <div class="top">
                        <span class="filter-label">Hersteller:</span>
                        <input type="text" name="Hersteller" class="input-long">
                        
                        <span class="filter-label">Sitze:</span>
                        <input type="text" name="Sitze" class="input-short">

                        <span class="filter-label">Türen:</span>
                        <input type="text" name="Türen" class="input-short">

                        <span class="filter-label">Getriebe:</span>
                        <input type="text" name="Getriebe" class="input-long">

                        <span class="filter-label">Alter:</span>
                        <input type="text" name="Alter" class="input-short">

                        <span class="filter-label">Antrieb:</span>
                        <input type="text" name="Antrieb" class="input-long">

                        <span class="filter-label">Klima:</span>
                        <input type="checkbox" name="Klima" class="filter-checkbox">

                        <span class="filter-label">GPS:</span>
                        <input type="checkbox" name="GPS" class="filter-checkbox">
                    </div>
                    <div class="bottom">
                        <span class="filter-label">Preis bis:</span>
                        <input type="text" placeholder="Euro/Tag" name="GPS" class="input-preis">

                        <span class="filter-label">Sortierung:</span>
                        <input type="text" name="Sitze" class="input-long">
                    </div>

                    <button type="submit" class="filter-apply">Filter Anwenden</button>
                    <button type="submit" class="filter-reset">Filter Zurücksetzen</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overview-parent">
        <div class="overview-container">
        <?php
        // Place the PHP code that handles the fetched location here
        if (isset($_GET['location'])) {
            $location = urldecode($_GET['location']);

            echo '<div class="car-card">';
            echo '<img class="car-image" src="https://example.com/car1.jpg" alt="Car Image">';
            echo '<div class="car-details">';
            echo '<div class="car-name">Mercedes C-Class</div>';
            echo '<div class="Location">Location: ' . $location . '</div>'; // Display fetched location here
            echo '<div class="key-facts">Year: 2023</div>';
            echo '<div class="key-facts">Mileage: 10,000 miles</div>';
            echo '<div class="key-facts">Fuel: Gasoline</div>';
            echo '<button class="rent-button">Rent Now</button>';
            echo '</div></div>';
        }
        ?>
        </div>
    </div>

    <div class="footer-container">
        <div class="footer">
        <div class="footer-heading footer-1">
            <h2>About Us</h2>
            <a href="#">Blog</a>
            <a href="#">Kunden</a>
            <a href="Datenschutz.html">Datenschutz</a>
            <a href="AGB.html">AGB</a>
            <a href="Impressum.html">Impressum</a>
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
</body>
</html>
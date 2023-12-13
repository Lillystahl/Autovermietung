<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('process_form.php');
    require_once('config_session.inc.php');
    require_once('process_form.php');    
    debugSession();
    var_dump($_POST);
    ProduktübersichtInputToSession();
    FilterToSession();
    getCategoryUrl();

?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Produktübersicht.js" defer></script>
</head>

<body>
<header>
    <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                    <a  href="home.php" class="logo" id="logoLink"> <img src="Images/ImageRE.png" alt="Company Logo" /> </a>
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
            <a  href="home.php" class="logo" id="logoLink"> <img src="Images/ImageRE.png" alt="Company Logo" /> </a>
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

    <div class="product-barcontainer">
        <div class="advanced-search-bar-top">
            <h2>Fahrzeug mieten</h2>
            <form action="" method="POST">
                <div class="searchbar-inner">
                    <input type="text" placeholder="<?php echo isset($_SESSION['location']) ? $_SESSION['location'] : 'Standort'; ?>" name="standort-location" value="<?php echo isset($_SESSION['location']) ? $_SESSION['location'] : ''; ?>">
                    <input type="text" placeholder="<?php echo isset($_SESSION['vehicle_type']) ? $_SESSION['vehicle_type'] : 'Kategorie'; ?>" name="vehicle-type" value="<?php echo isset($_SESSION['vehicle_type']) ? $_SESSION['vehicle_type'] : ''; ?>">
                    <input type="date" placeholder="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : 'start-date'; ?>" name="start-date" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>">
                    <input type="date" placeholder="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : 'end-date'; ?>" name="end-date" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>">
                    <button type="submit" name="filterbar1-submit">Suchen</button>
                    <button type="submit" id="resetSearchButton">Suche zurücksetzen</button>
                </div>
            </form>
        </div>
        <div class="filter-bar">
            <h2>Filter</h2>                                      
            <form action="" method="POST">
                <div class="filter-bar-inner">
                    <div class="top">

                    <div class="dropdown">
                        <label for="manufacturerDropdown" class="filter-label">Hersteller:</label>
                        <select id="manufacturerDropdown" name="Hersteller" class="input-long">
                            <option value="" selected disabled hidden>Hersteller</option>
                            <option value="Audi" <?php echo ($_SESSION['manufacturer'] ?? '') === 'Audi' ? 'selected' : ''; ?>>Audi</option>
                            <option value="BMW">BMW</option>
                            <option value="Ford">Ford</option>
                            <option value="Jaguar">Jaguar</option>
                            <option value="Maserati">Maserati</option>
                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                            <option value="Mercedes-AMG">Mercedes-AMG</option>
                            <option value="Opel">Opel</option>
                            <option value="Range Rover">Range Rover</option>
                            <option value="Skoda">Skoda</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                    </div>
                        
                    <div class="dropdown">
                        <label for="seatsDropdown" class="filter-label">Sitze:</label>
                        <select id="seatsDropdown" name="Sitze" class="input-short">
                            <option value="" selected disabled hidden>Anzahl</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>

                    <div class="dropdown">
                        <label for="doorsDropdown" class="filter-label">Türen:</label>
                        <select id="doorsDropdown" name="Türen" class="input-short">
                            <option value="" selected disabled hidden>Anzahl</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="dropdown">
                        <label for="gearboxDropdown" class="filter-label">Getriebe:</label>
                        <select id="gearboxDropdown" name="Getriebe" class="input-long">
                            <option value="" selected disabled hidden>Art</option>
                            <option value="manually">Manual</option>
                            <option value="automatic">Automatik</option>

                        </select>
                    </div>

                    <span class="filter-label">Mindest Alter:</span>
                    <input type="text" placeholder="Jahr" Name="MindestAlter" class="input-short">

                    <div class="dropdown">
                        <label for="driveDropdown" class="filter-label">Antrieb:</label>
                        <select id="driveDropdown" name="Antrieb" class="input-long">
                            <option value="" selected disabled hidden>Art</option>
                            <option value="Verbrenner">Verbrenner</option>
                            <option value="Elektrisch">Elektrisch</option>
                        </select>
                    </div>

                    <div class="dropdown">
                        <label for="klimaDropdown" class="filter-label">Klima:</label>
                        <select id="klimaDropdown" name="Klima" class="input-short">
                            <option value="" selected disabled hidden></option>
                            <option value="0">Ja</option>
                            <option value="1">Nein</option>
                        </select>
                    </div>

                    <div class="dropdown">
                        <label for="gpsDropdown" class="filter-label">GPS:</label>
                        <select id="gpsDropdown" name="GPS" class="input-short">
                            <option value="" selected disabled hidden></option>
                            <option value="0">Ja</option>
                            <option value="1">Nein</option>
                        </select>
                    </div>

                    </div>
                    <div class="bottom">
                        <span class="filter-label">Preis bis:</span>
                        <input type="text" placeholder="Euro/Tag" name="Preis" class="input-preis">

                        <div class="dropdown">
                            <label for="sortDropdown" class="filter-label">Sortierung:</label>
                            <select id="sortDropdown" name="Sortierung" class="input-long">
                                <option value="" selected disabled hidden>Wählen</option>
                                <option value="PriceAsc">Preis - Aufsteigend</option>
                                <option value="PriceDesc">Preis - Absteigend</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="filter-apply" name="applyFilter-submit">Filter Anwenden</button>
                    <button type="submit" class="filter-reset" name=resetFilter-submit>Filter Zurücksetzen</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overview-parent">
    <?php    
    // Check, ob ein Filter angewendet wurde
    if (isset($_SESSION['location']) && $_SESSION['location'] !== '' && isset($_SESSION['vehicle_type']) && $_SESSION['vehicle_type'] !== '') {

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $carsPerPage = 20;

        $result = fetchCarsLocAndType($conn, $currentPage, $carsPerPage);
        displayProductCards($result);

        // Pagination Links
        $totalCars = countLocAndTypeCars($conn); // Funktion, um die Gesamtanzahl an Autos zu erhalten
        $totalPages = ceil($totalCars / $carsPerPage);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="Produktübersicht.php?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
        echo "<script>";
        echo "console.log('loc and type');";
        echo "</script>";
        
    } elseif(isset($_SESSION['vehicle_type']) && $_SESSION['vehicle_type'] !== '') {

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $carsPerPage = 20;
        
        $result = fetchCarsType($conn, $currentPage, $carsPerPage);
        displayProductCards($result);

        // Pagination Links
        $totalCars = countTypeCars($conn); // Funktion, um die Gesamtanzahl an Autos zu erhalten
        $totalPages = ceil($totalCars / $carsPerPage);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="Produktübersicht.php?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
        echo "<script>";
        echo "console.log('Type');";
        echo "</script>";

    } elseif(isset($_SESSION['location']) && $_SESSION['location'] !== '') {

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $carsPerPage = 20;
        
        $result = fetchCarsLoc($conn, $currentPage, $carsPerPage);
        displayProductCards($result);

        // Pagination Links
        $totalCars = countTypeCars($conn); // Funktion, um die Gesamtanzahl an Autos zu erhalten
        $totalPages = ceil($totalCars / $carsPerPage);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="Produktübersicht.php?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
        echo "<script>";
        echo "console.log('Location');";
        echo "</script>";

    }else {
        
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $carsPerPage = 20;
        $result = fetchAllCars($conn, $currentPage, $carsPerPage);
        displayProductCards($result);

        // Pagination Links
        $totalCars = countAllCars($conn); // Funktion, um die Gesamtanzahl an Autos zu erhalten
        $totalPages = ceil($totalCars / $carsPerPage);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="Produktübersicht.php?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
        echo "<script>";
        echo "console.log('All cars');";
        echo "</script>";

    }
    ?>
</div>

    <div class="car-details-overlay" id="carDetailsOverlay">
        <div class="car-details-popup" id="carDetailsPopup">
            <span class="close-button"onclick="closeCarDetails()">&times;</span>
            <div class="popup-content">
                <!-- Hier könnten die zusätzlichen Produktinformationen und Bilder sein -->
                <img class="car-image-popup" id="carDetailsImage" src="https://example.com/car1.jpg" alt="Car Image">
                <div class="car-details-popup-content">
                    <div class="car-name-popup">Mercedes C-Class</div>
                    <div class="key-facts-popup">Year: 2023</div>
                    <div class="key-facts-popup">Mileage: 10,000 miles</div>
                    <!-- Weitere Details hier einfügen -->
                    <button class="rent-button-popup">Rent Now</button>
                </div>
            </div>
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
<?php
    require_once('db_connect.php');
    require_once('process_form.php');
    require_once('config_session.inc.php');   
    debugSession();
    inputToSession('filterbar1-submit');
    FilterToSession();
    getCategoryUrl();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase Produktübersicht</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
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
                                <li><a href="MyBookings.php">Meine Buchungen</a></li>
                                <li><a href="MyProfilePage.php">Mein Profil</a></li>
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
            <h2>Fahrzeugsuche</h2>
            <form action="" method="POST">
                <div class="searchbar-inner">
                    <div class="standort-filter-item">
                        <label for="standortDropdown" class="filter-label">Standort:</label>
                        <select id="standortDropdown" name="standort-location" class="input-long standort-input-long">
                            <option value="" selected disabled hidden>Standort</option>
                            <option value="" <?php echo ($_SESSION['location'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $locations = [
                                    "Berlin", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg",
                                    "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"
                                ];
                                foreach ($locations as $location) {
                                    $selected = ($_SESSION['location'] ?? '') === $location ? 'selected' : '';
                                    echo "<option value='$location' $selected>$location</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="vehicle-type-filter-item">
                        <label for="vehicleTypeDropdown" class="filter-label">Fahrzeugtyp:</label>
                        <select id="vehicleTypeDropdown" name="Fahrzeugtyp" class="input-long vehicle-type-dropdown">
                            <option value="" selected disabled hidden>Fahrzeugtyp</option>
                            <option value="" <?php echo ($_SESSION['vehicle_type'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $vehicleTypeOptions = [
                                    "Cabrio", "SUV", "Limousine", "Combi", "Mehrsitzer", "Coupe"
                                ]; // Adjust this array to contain your desired vehicle types

                                foreach ($vehicleTypeOptions as $vehicleType) {
                                    $selected = ($_SESSION['vehicle_type'] ?? '') === $vehicleType ? 'selected' : '';
                                    echo "<option value='$vehicleType' $selected>$vehicleType</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <input type="date" placeholder="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : 'start-date'; ?>" name="start-date" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>">
                    <input type="date" placeholder="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : 'end-date'; ?>" name="end-date" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>">
                    
                    <button type="submit" name="filterbar1-submit">Suchen</button>
                    <button type="submit" id="resetSearchButton">Suche zurücksetzen</button>
                </div>
            </form>
        </div>
        <div class="filter-bar">
            <h2>Suche filtern</h2>                                      
            <form action="" method="POST">
                <div class="filter-bar-inner">
                    <div class="top">

                    <div class="filter-item">
                        <label for="manufacturerDropdown" class="filter-label">Hersteller:</label>
                        <select id="manufacturerDropdown" name="Hersteller" class="input-long">
                            <option value="" selected disabled hidden>Hersteller</option>
                            <option value="" <?php echo ($_SESSION['manufacturer'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $manufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-Benz", "Mercedes-AMG", "Opel", "Range Rover", "Skoda", "Volkswagen"];
                                foreach ($manufacturers as $manufacturer) {
                                    $selected = ($_SESSION['manufacturer'] ?? '') === $manufacturer ? 'selected' : '';
                                    echo "<option value='$manufacturer' $selected>$manufacturer</option>";
                                }
                            ?>
                        </select>
                    </div>
                        
                    <div class="filter-item">
                        <span class="filter-label">Preis bis:</span>
                        <input type="text" placeholder="Euro/Tag" name="Preis" class="input-preis" value="<?php echo isset($_SESSION['max_price']) ? $_SESSION['max_price'] : ''; ?>">
                    </div>

                    <div class="filter-item">
                        <label for="seatsDropdown" class="filter-label">Sitzanzahl:</label>
                        <select id="seatsDropdown" name="Sitze" class="input-short">
                            <option value="" selected disabled hidden>Anzahl</option>
                            <option value="" <?php echo ($_SESSION['seats'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $seatOptions = ["2", "4", "5", "7", "8", "9"];
                                foreach ($seatOptions as $seat) {
                                    $selected = ($_SESSION['seats'] ?? '') === $seat ? 'selected' : '';
                                    echo "<option value='$seat' $selected>$seat</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-item">
                        <label for="doorsDropdown" class="filter-label">Türen:</label>
                        <select id="doorsDropdown" name="Türen" class="input-short">
                            <option value="" selected disabled hidden>Anzahl</option>
                            <option value="" <?php echo ($_SESSION['doors'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $doorOptions = ["2", "3", "4", "5"];
                                foreach ($doorOptions as $door) {
                                    $selected = ($_SESSION['doors'] ?? '') === $door ? 'selected' : '';
                                    echo "<option value='$door' $selected>$door</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-item">
                        <label for="gearboxDropdown" class="filter-label">Getriebeart:</label>
                        <select id="gearboxDropdown" name="Getriebe" class="input-long">
                        <option value="" selected disabled hidden>Anzahl</option>
                        <option value="" <?php echo ($_SESSION['gearbox'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                        <?php
                            $gearboxOptions = ["manually", "automatic"];
                            foreach ($gearboxOptions as $gearbox) {
                                $selected = ($_SESSION['gearbox'] ?? '') === $gearbox ? 'selected' : '';
                                echo "<option value='$gearbox' $selected>$gearbox</option>";
                            }
                        ?>
                        </select>
                    </div>
                    
                    <div class="filter-item">
                        <span class="filter-label">Mindest Alter:</span>
                        <input type="text" placeholder="Jahr" Name="MindestAlter" class="input-short" value="<?php echo isset($_SESSION['minAge']) ? $_SESSION['minAge'] : ''; ?>">
                    </div>

                    <div class="filter-item">
                        <label for="driveDropdown" class="filter-label">Motorart:</label>
                        <select id="driveDropdown" name="Antrieb" class="input-long">
                            <option value="" selected disabled hidden>Art</option>
                            <option value="" <?php echo ($_SESSION['drive'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $antriebOptions = [
                                    "Verbrenner" => "combuster",
                                    "Elektrisch" => "electric"
                                ];
                                foreach ($antriebOptions as $displayValue => $storedValue) {
                                    $selected = ($_SESSION['drive'] ?? '') === $storedValue ? 'selected' : '';
                                    echo "<option value='$storedValue' $selected>$displayValue</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-item">
                        <label for="klimaDropdown" class="filter-label">Klimaanlage:</label>
                        <select id="klimaDropdown" name="Klima" class="input-short">
                            <option value="" selected disabled hidden></option>
                            <option value="" <?php echo ($_SESSION['air_conditioning'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $klimaOptions = [
                                    ["value" => "0", "label" => "Nein"],
                                    ["value" => "1", "label" => "Ja"]
                                ];
                                foreach ($klimaOptions as $option) {
                                    $selected = ($_SESSION['air_conditioning'] ?? '') === $option['value'] ? 'selected' : '';
                                    echo "<option value='{$option['value']}' $selected>{$option['label']}</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-item">
                        <label for="gpsDropdown" class="filter-label">Navigationsgerät:</label>
                        <select id="gpsDropdown" name="GPS" class="input-short">
                        <option value="" selected disabled hidden></option>
                        <option value="" <?php echo ($_SESSION['gps'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                        <?php
                            $gpsOptions = [
                                ["value" => "1", "label" => "Ja"],
                                ["value" => "0", "label" => "Nein"]
                            ];
                            foreach ($gpsOptions as $option) {
                                $selected = ($_SESSION['gps'] ?? '') === $option['value'] ? 'selected' : '';
                                echo "<option value='{$option['value']}' $selected>{$option['label']}</option>";
                            }
                        ?>
                        </select>
                    </div>

                    </div>

                    <div class= "filter-button-container">
                        <button type="submit" class="filter-apply" name="applyFilter-submit">Filter Anwenden</button>
                        <button type="submit" class="filter-reset" name=resetFilter-submit>Filter Zurücksetzen</button>
                    </div>
                    
                    <h2 style= width:100%;>Sortierung</h2>
                    <div class="filter-item-sort">
                        <select id="sortDropdown" name="Sortierung" class="input-long">
                            <option value="" selected disabled hidden>Wählen</option>
                            <option value="" <?php echo ($_SESSION['Sortierung'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                            <?php
                                $sortOptions = [
                                    ["value" => "PriceAsc", "label" => "Preis - Aufsteigend"],
                                    ["value" => "PriceDesc", "label" => "Preis - Absteigend"]
                                ];
                                foreach ($sortOptions as $option) {
                                    $selected = ($_SESSION['Sortierung'] ?? '') === $option['value'] ? 'selected' : '';
                                    echo "<option value='{$option['value']}' $selected>{$option['label']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="overview-parent">
    <?php    
    // Check, ob ein Filter angewendet wurde

    
    if (
        isset($_SESSION['location'], $_SESSION['vehicle_type']) &&
        ($_SESSION['location'] !== '' || $_SESSION['vehicle_type'] !== '') ||
        (!isset($_SESSION['location']) && !isset($_SESSION['vehicle_type'])) ||
        ($_SESSION['location'] === '' && $_SESSION['vehicle_type'] === '')
    ){
             // Retrieving cars and displaying them with pagination
        $result = fetchCombinedCars($conn); // Fetch all cars without a limit

        // Define the number of cars to display per page
        $carsPerPage = 20;

        // Capture the returned value from displayProductCards
        $carCounter = displayProductCards($result);

        // Set $totalCars to the returned value
        $totalCars = $carCounter;

        // Calculate the total number of pages based on the count of cars and the cars per page
        $totalPages = ceil($totalCars / $carsPerPage);

        // Retrieve the current page number
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;


        // Display the pagination links
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="#" class="page-btn">' . $i . '</a>';
        }
        echo '</div>';
    }

    displayNoResultsMessage($result);
    ?>

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
            </div>
         </div>   
    </div>
</body>
</html>
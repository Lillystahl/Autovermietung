<?php
// process_form.php

// function which stores user inputs for searched in session variables 
//NOTE: DONT KNOW IF THIS CAN CAUSE CONFLICTS WHEN WE HAVE A LOGIN BECAUSE LOGIN CREATES A NEW SESSION (does not seem to be the case)
function homeInpuToSession() {
    if (isset($_POST['filterbar-submit'])) {
        $loc = filter_input(INPUT_POST, 'standort-location', FILTER_SANITIZE_SPECIAL_CHARS);
        $vehicleType = filter_input(INPUT_POST, 'vehicle-type', FILTER_SANITIZE_SPECIAL_CHARS);
        $startDate = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $endDate = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);

        $currentDate = date("Y-m-d"); // Get the current date

        // Check if at least one of location or vehicle type is provided and valid
        if ((!empty($loc) && ctype_alpha($loc)) || (!empty($vehicleType) && ctype_alpha($vehicleType))) {
            // Check if both dates are empty or both dates are provided and valid
            if ((empty($startDate) && empty($endDate)) || // Both dates empty (no filter applied)
                ((!empty($startDate) && !empty($endDate)) && // Both dates provided
                    (strtotime($startDate) >= strtotime($currentDate) && strtotime($endDate) >= strtotime($startDate)))) { // Valid range
                // Store inputs in session variables
                $_SESSION['location'] = $loc;
                $_SESSION['vehicle_type'] = $vehicleType;
                $_SESSION['start_date'] = $startDate;
                $_SESSION['end_date'] = $endDate;
                $_SESSION['manufacturer'] = '';
                $_SESSION['seats'] = '';
                $_SESSION['doors'] = '';
                $_SESSION['gearbox'] = '';
                $_SESSION['minAge'] = '';
                $_SESSION['drive'] = '';
                $_SESSION['air_conditioning'] = '';
                $_SESSION['gps'] = '';
                $_SESSION['max_price'] = '';
                
                // Redirect to the next page
                header("Location: Produktübersicht.php");
                exit();
            } else {
                // Invalid input for date range
                echo "<script>alert('Invalid date range. Start date cannot be older than the current date, end date cannot be before start date, and both dates must be provided if one is entered.');</script>";
            }
        } else {
            // Invalid input for location or vehicle type
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
        }
    }
}

function ProduktübersichtInputToSession() {
    if (isset($_POST['filterbar1-submit'])) {
        $loc = filter_input(INPUT_POST, 'standort-location', FILTER_SANITIZE_SPECIAL_CHARS);
        $vehicleType = filter_input(INPUT_POST, 'vehicle-type', FILTER_SANITIZE_SPECIAL_CHARS);
        $startDate = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $endDate = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);

        $currentDate = date("Y-m-d"); // Get the current date

        // Check if at least one of location or vehicle type is provided and valid
        if ((!empty($loc) && ctype_alpha($loc)) || (!empty($vehicleType) && ctype_alpha($vehicleType))) {
            // Check if both dates are empty or both dates are provided and valid
            if ((empty($startDate) && empty($endDate)) || // Both dates empty (no filter applied)
                ((!empty($startDate) && !empty($endDate)) && // Both dates provided
                    (strtotime($startDate) >= strtotime($currentDate) && strtotime($endDate) >= strtotime($startDate)))) { // Valid range
                // Store inputs in session variables
                $_SESSION['location'] = $loc;
                $_SESSION['vehicle_type'] = $vehicleType;
                $_SESSION['start_date'] = $startDate;
                $_SESSION['end_date'] = $endDate;
                $_SESSION['manufacturer'] = '';
                $_SESSION['seats'] = '';
                $_SESSION['doors'] = '';
                $_SESSION['gearbox'] = '';
                $_SESSION['minAge'] = '';
                $_SESSION['drive'] = '';
                $_SESSION['air_conditioning'] = '';
                $_SESSION['gps'] = '';
                $_SESSION['max_price'] = '';
                

                header("Location: Produktübersicht.php");
                    echo '<script>';
                    echo 'console.log(" Searched on Produktübersicht! ");';
                    echo '</script>';
                // Redirect to the next page
                exit();
            } else {
                // Invalid input for date range
                echo "<script>alert('Invalid date range. Start date cannot be older than the current date, end date cannot be before start date, and both dates must be provided if one is entered.');</script>";
            }
        } else {
            // Invalid input for location or vehicle type
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
        }
    }
}

function FilterToSession(){
    if (isset($_POST['applyFilter-submit'])) {
        $allowedManufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-Benz", "Mercedes-AMG", "Opel", "Range Rover", "Skoda", "Volkswagen",''];
        $allowedSeats = ["2", "4", "5", "7", "8", "9",''];
        $allowedDoors = ["2", "3", "4", "5",''];
        $allowedGearboxes = ["manually", "automatic",''];
        $allowedDrives = ["combuster", "electric",''];
        $allowedAirConditioning = ["0", "1",''];
        $allowedGPS = ["0", "1",''];
        
        $manufacturer = in_array($_POST['Hersteller'], $allowedManufacturers) ? $_POST['Hersteller'] : '';
        $seats = in_array($_POST['Sitze'], $allowedSeats) ? $_POST['Sitze'] : '';
        $doors = in_array($_POST['Türen'], $allowedDoors) ? $_POST['Türen'] : '';
        $gearbox = in_array($_POST['Getriebe'], $allowedGearboxes) ? $_POST['Getriebe'] : '';
        $age = $_POST['MindestAlter']; // No array validation for text inputs
        $drive = in_array($_POST['Antrieb'], $allowedDrives) ? $_POST['Antrieb'] : '';
        $airConditioning = in_array($_POST['Klima'], $allowedAirConditioning) ? $_POST['Klima'] : '';
        $gps = in_array($_POST['GPS'], $allowedGPS) ? $_POST['GPS'] : '';
        $maxPrice = $_POST['Preis']; // No array validation for text inputs

        // Store filter inputs in session variables
        $_SESSION['manufacturer'] = $manufacturer;
        $_SESSION['seats'] = $seats;
        $_SESSION['doors'] = $doors;
        $_SESSION['gearbox'] = $gearbox;
        $_SESSION['minAge'] = $age;
        $_SESSION['drive'] = $drive;
        $_SESSION['air_conditioning'] = $airConditioning;
        $_SESSION['gps'] = $gps;
        $_SESSION['max_price'] = $maxPrice;

        // Redirect to the desired page
        header("Location: Produktübersicht.php");
        exit();
    }
}


// Das hier funktioiert, ist aber nicht hübsch
function getCategoryUrl() {
    if(isset($_GET['category'])) {
        // Retrieve the 'category' GET parameter value
        $category = $_GET['category'];
    
        // Validate the category against your allowed categories
        $allowedCategories = array('Cabrio', 'SUV', 'Combi', 'Mehrsitzer', 'Coupe', 'Limousine');
    
        if(in_array($category, $allowedCategories)) {
            // Set the 'vehicle_type' session variable
            $_SESSION['vehicle_type'] = $category;
            // Redirect to the same page to remove the GET parameter from URL
            header('Location: Produktübersicht.php');
            $_SESSION['location'] = '';
            $_SESSION['start_date'] = '';
            $_SESSION['end_date'] = '';
            $_SESSION['manufacturer'] = '';
            $_SESSION['seats'] = '';
            $_SESSION['doors'] = '';
            $_SESSION['gearbox'] = '';
            $_SESSION['minAge'] = '';
            $_SESSION['drive'] = '';
            $_SESSION['air_conditioning'] = '';
            $_SESSION['gps'] = '';
            $_SESSION['max_price'] = '';
            exit();
        } else {
            // Invalid category, handle accordingly
            echo "Invalid category!";
        }
    } 
}


// debug function to see session variables
function debugSession() {
    echo '<script>';
    echo 'console.log("Session Variables: ", ' . json_encode($_SESSION) . ');';
    echo '</script>';
}

function fetchCarsLocAndType($conn, $page, $perPage) {
    $location = $_SESSION['location'];
    $vehicleType = $_SESSION['vehicle_type'];
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $start = ($page - 1) * $perPage;

    // Additional filters from session variables
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];

    // Prepare the SQL statement with necessary joins including additional filters
    $sql = "SELECT * 
            FROM cartablesview 
            WHERE location_name = :location
            AND cartablesview.category_type = :vehicleType
            AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
            AND (cartablesview.seats = :seats OR :seats = '')
            AND (cartablesview.doors = :doors OR :doors = '')
            AND (cartablesview.gear = :gearbox OR :gearbox = '')
            AND (cartablesview.min_age = :age OR :age = '')
            AND (cartablesview.category_drive = :drive OR :drive = '')
            AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
            AND (cartablesview.gps = :gps OR :gps = '')
            AND (cartablesview.vehicle_price <= :price OR :price = '')
            AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)
            LIMIT :start, :perPage";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    // Fetch the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Log the retrieved parameters and the result to the console
    echo "<script>";
    echo "console.log('vednorName:', '" . $vendorName . "');";
    echo "console.log('Location:', '" . $location . "');";
    echo "console.log('Vehicle Type:', '" . $vehicleType . "');";
    echo "console.log('Cars:', " . json_encode($result) . ");";
    echo "</script>";
    
    return $result;
}

function fetchCarsType($conn, $page, $perPage) {
        $vehicleType = $_SESSION['vehicle_type'];
        $startDate = $_SESSION['start_date'];
        $endDate = $_SESSION['end_date'];
        $start = ($page - 1) * $perPage;

        $vendorName = $_SESSION['manufacturer']; // Min Age filter from session
        $vendorName = $_SESSION['manufacturer'];
        $seats = $_SESSION['seats'];
        $doors = $_SESSION['doors'];
        $gearbox = $_SESSION['gearbox'];
        $minAge = $_SESSION['minAge'];
        $drive = $_SESSION['drive'];
        $airConditioning = $_SESSION['air_conditioning'];
        $gps = $_SESSION['gps'];
        $maxPrice = $_SESSION['max_price'];
        // Prepare the SQL statement with necessary joins
        $sql = "SELECT * 
        FROM cartablesview 
        WHERE category_type = :vehicleType
        AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
        AND (cartablesview.seats = :seats OR :seats = '')
        AND (cartablesview.doors = :doors OR :doors = '')
        AND (cartablesview.gear = :gearbox OR :gearbox = '')
        AND (cartablesview.min_age = :age OR :age = '')
        AND (cartablesview.category_drive = :drive OR :drive = '')
        AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
        AND (cartablesview.gps = :gps OR :gps = '')
        AND (cartablesview.vehicle_price <= :price OR :price = '')
        AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)
        LIMIT :start, :perPage";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':vehicleType', $vehicleType);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':manufacturer', $vendorName);
        $stmt->bindParam(':seats', $seats);
        $stmt->bindParam(':doors', $doors);
        $stmt->bindParam(':gearbox', $gearbox);
        $stmt->bindParam(':age', $minAge);
        $stmt->bindParam(':drive', $drive);
        $stmt->bindParam(':airConditioning', $airConditioning);
        $stmt->bindParam(':gps', $gps);
        $stmt->bindParam(':price', $maxPrice);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        // Fetch the result
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Print the retrieved parameters and the result to the console
        echo "<script>";
        echo "console.log('Vehicle Type:', '" . $vehicleType . "');";
        echo "console.log('Cars:', " . json_encode($result) . ");";
        echo "</script>";
        return $result;
}

function fetchCarsLoc($conn, $page, $perPage) {
        $location = $_SESSION['location'];
        $startDate = $_SESSION['start_date'];
        $endDate = $_SESSION['end_date'];
        $start = ($page - 1) * $perPage;

        $vendorName = $_SESSION['manufacturer']; // Min Age filter from session
        $seats = $_SESSION['seats'];
        $doors = $_SESSION['doors'];
        $gearbox = $_SESSION['gearbox'];
        $minAge = $_SESSION['minAge'];
        $drive = $_SESSION['drive'];
        $airConditioning = $_SESSION['air_conditioning'];
        $gps = $_SESSION['gps'];
        $maxPrice = $_SESSION['max_price'];
        // Prepare the SQL statement with necessary joins
        $sql = "SELECT * 
        FROM cartablesview 
        WHERE location_name = :location
        AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
        AND (cartablesview.seats = :seats OR :seats = '')
        AND (cartablesview.doors = :doors OR :doors = '')
        AND (cartablesview.gear = :gearbox OR :gearbox = '')
        AND (cartablesview.min_age = :age OR :age = '')
        AND (cartablesview.category_drive = :drive OR :drive = '')
        AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
        AND (cartablesview.gps = :gps OR :gps = '')
        AND (cartablesview.vehicle_price <= :price OR :price = '')
        AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)
        LIMIT :start, :perPage";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':manufacturer', $vendorName);
        $stmt->bindParam(':seats', $seats);
        $stmt->bindParam(':doors', $doors);
        $stmt->bindParam(':gearbox', $gearbox);
        $stmt->bindParam(':age', $minAge);
        $stmt->bindParam(':drive', $drive);
        $stmt->bindParam(':airConditioning', $airConditioning);
        $stmt->bindParam(':gps', $gps);
        $stmt->bindParam(':price', $maxPrice);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        // Fetch the result
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Print the retrieved parameters and the result to the console
        echo "<script>";
        echo "console.log('Vehicle Type:', '" . $location . "');";
        echo "console.log('Cars:', " . json_encode($result) . ");";
        echo "</script>";
        return $result;
}

function displayProductCards($result) {
    $numCars = count($result);
    $numRows = ceil($numCars / 5);

    for ($i = 0; $i < $numRows; $i++) {
        echo '<div class="overview-row">';
        for ($j = $i * 5; $j < min(($i + 1) * 5, $numCars); $j++) {
            echo '<div class="car-card" onclick="openCarDetails(' . $j . ')">';
            echo '<div class="car-image-container">';
            echo '<img class="car-image" src="Images/Product_Img/vorne-' . $result[$j]['img_file_name'] . '" alt="Car Image">';
            echo '</div>';
            echo '<div class="car-details-container">';
            echo '<div class="car-details">';
            echo '<div class="car-name">' . $result[$j]['vendor_name'] . ' ' . $result[$j]['type_name'] . '</div>';
            echo '<div class="car-cat">Kategorie: ' . $result[$j]['category_type'] . '</div>';
            $transmission = '';
            if ($result[$j]['gear'] == 'automatic') {
                $transmission = 'Automatik';
            } elseif ($result[$j]['gear'] == 'manually') {
                $transmission = 'Handschalter';
            }
            echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';
            echo '<div class="Location">Standort: ' . $result[$j]['location_name'] . '</div>';
            $features = [];
            if ($result[$j]['gps'] == 1) {
                $features[] = '<i class="fa-solid fa-map-location-dot"></i>';
            }
            else
                $features[] = '<span class="durchgestrichen">
                <i class="fa-solid fa-map-location-dot"></i>
              </span>';
            if ($result[$j]['air_conditioning'] == 1) {
                $features[] = '<i class="fa-solid fa-fan"></i>';
            }
            else
                $features[] = '<span class="durchgestrichen">
                <i class="fa-solid fa-fan"></i>
              </span>';
            echo '<div class="car-features">Features: ' . implode(" ", $features) . '</div>';
            echo '</div>';
            echo '<div class="car-prize">Preis: ' . $result[$j]['vehicle_price'] . '€</div>';
            echo '<form id="rent-form-' . $result[$j]['vehicle_id'] . '" action="booking.php" method="post">';
            echo '<input type="hidden" name="vehicle_id" value="' . $result[$j]['vehicle_id'] . '">';
            echo '<input type="hidden" name="vendor_name" value="' . $result[$j]['vendor_name'] . '">';
            echo '<input type="hidden" name="type_name" value="' . $result[$j]['type_name'] . '">';

            // Check if the user is logged in (if $_SESSION["user_id"] exists)
            if (isset($_SESSION["user_id"])) {
                // Check if start and end date are set
                if (isset($_SESSION['start_date']) && isset($_SESSION['end_date']) &&
                    $_SESSION['start_date'] !== '' && $_SESSION['end_date'] !== '') {
                    echo '<button type="submit" name="rent-button" class="rent-button">Rent Now</button>';
                } else {
                    echo '<span class="date-required-msg">Zum Mieten Datum eingeben</span>';
                }
            } else {
                echo '<span class="date-required-msg">Zum Buchen Anmelden</span>';
            }

            echo '</form>';
            echo '</div></div>';
        }
        echo '</div>';
    }

    for ($i = 0; $i < $numRows; $i++) {
        for ($j = $i * 5; $j < min(($i + 1) * 5, $numCars); $j++) {
            echo '<div class="car-details-overlay" id="carDetailsOverlay_' . $j . '">';
            echo '<div class="car-details-popup" id="carDetailsPopup_' . $j . '">';
            echo '<span class="close-button" onclick="closeCarDetails()">&times;</span>';
            echo '<div class="popup-content">';
            echo '<div class="popup-image-container">' .
    '<img class="car-image" src="Images/Product_Img/vorne-' . $result[$j]['img_file_name'] . '" alt="Car Image">' .
    '<img class="car-image" src="Images/Product_Img/vorne-' . $result[$j]['img_file_name'] . '" alt="Car Image">' .
'</div>';
            echo '<div class="car-details-popup-content">';
            echo '<div class="car-details-popup-content">';
            echo '<div class="car-name">' . $result[$j]['vendor_name'] . ' ' . $result[$j]['type_name'] . '</div>';
            echo '<div class="car-cat">Kategorie: ' . $result[$j]['category_type'] . '</div>';
            echo '<div class="car-cat">Sitzanzahl: ' . $result[$j]['seats'] . '</div>';
            echo '<div class="car-cat">Türen: ' . $result[$j]['doors'] . '</div>';
            echo '<div class="car-cat">Kofferraum: ' . $result[$j]['trunk'] . '</div>';
            $transmission ='';
            if ($result[$j]['gear'] == 'automatic') {
                $transmission = 'Automatik';
            } elseif ($result[$j]['gear'] == 'manually') {
                $transmission = 'Handschalter';
            }
            echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';
            echo '<div class="Location">Standort: ' . $result[$j]['location_name'] . '</div>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}

function fetchAllCars($conn, $page, $perPage) {
    $_SESSION['location'] =  $_SESSION['location'] ?? '';
    $_SESSION['vehicle_type'] = $_SESSION['vehicle_type'] ?? '';
    $_SESSION['start_date'] = $_SESSION['start_date'] ?? '';
    $_SESSION['end_date'] = $_SESSION['end_date'] ?? '';
    $_SESSION['start_date'] = $_SESSION['start_date'] ?? '';
    $_SESSION['end_date'] = $_SESSION['end_date'] ?? '';
    $_SESSION['manufacturer'] = $_SESSION['manufacturer'] ?? '';
    $_SESSION['seats'] = $_SESSION['seats'] ?? '';
    $_SESSION['doors'] = $_SESSION['doors'] ?? '';
    $_SESSION['gearbox'] = $_SESSION['gearbox'] ?? '';
    $_SESSION['minAge'] = $_SESSION['minAge'] ?? '';
    $_SESSION['drive'] = $_SESSION['drive'] ?? '';
    $_SESSION['air_conditioning'] = $_SESSION['air_conditioning'] ?? '';
    $_SESSION['gps'] = $_SESSION['gps'] ?? '';
    $_SESSION['max_price'] = $_SESSION['max_price'] ?? '';
    
    $start = ($page - 1) * $perPage;
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];

    $sql = "SELECT * 
            FROM cartablesview
            WHERE (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
            AND (cartablesview.seats = :seats OR :seats = '')
            AND (cartablesview.doors = :doors OR :doors = '')
            AND (cartablesview.gear = :gearbox OR :gearbox = '')
            AND (cartablesview.min_age = :age OR :age = '')
            AND (cartablesview.category_drive = :drive OR :drive = '')
            AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
            AND (cartablesview.gps = :gps OR :gps = '')
            AND (cartablesview.vehicle_price <= :price OR :price = '')
            AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)
            LIMIT :start, :perPage";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<script>";
    echo "console.log('Cars:', " . json_encode($result) . ");";
    echo "</script>";
    return $result;
    return $result;
}


function countAllCars($conn) {
    $_SESSION['start_date'] = $_SESSION['start_date'] ?? '';
    $_SESSION['end_date'] = $_SESSION['end_date'] ?? '';
    $_SESSION['manufacturer'] = $_SESSION['manufacturer'] ?? '';
    $_SESSION['seats'] = $_SESSION['seats'] ?? '';
    $_SESSION['doors'] = $_SESSION['doors'] ?? '';
    $_SESSION['gearbox'] = $_SESSION['gearbox'] ?? '';
    $_SESSION['minAge'] = $_SESSION['minAge'] ?? '';
    $_SESSION['drive'] = $_SESSION['drive'] ?? '';
    $_SESSION['air_conditioning'] = $_SESSION['air_conditioning'] ?? '';
    $_SESSION['gps'] = $_SESSION['gps'] ?? '';
    $_SESSION['max_price'] = $_SESSION['max_price'] ?? '';
    
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];
    $sql = "SELECT COUNT(*) as total FROM cartablesview
            WHERE (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
            AND (cartablesview.seats = :seats OR :seats = '')
            AND (cartablesview.doors = :doors OR :doors = '')
            AND (cartablesview.gear = :gearbox OR :gearbox = '')
            AND (cartablesview.min_age = :age OR :age = '')
            AND (cartablesview.category_drive = :drive OR :drive = '')
            AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
            AND (cartablesview.gps = :gps OR :gps = '')
            AND (cartablesview.vehicle_price <= :price OR :price = '')
            AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function countLocAndTypeCars($conn) {
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $location = $_SESSION['location'];
    $vehicleType = $_SESSION['vehicle_type'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];

    $sql = "SELECT COUNT(*) as total FROM cartablesview 
    WHERE location_name = :location 
    AND category_type = :vehicleType
    AND cartablesview.category_type = :vehicleType
    AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
    AND (cartablesview.seats = :seats OR :seats = '')
    AND (cartablesview.doors = :doors OR :doors = '')
    AND (cartablesview.gear = :gearbox OR :gearbox = '')
    AND (cartablesview.min_age = :age OR :age = '')
    AND (cartablesview.category_drive = :drive OR :drive = '')
    AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
    AND (cartablesview.gps = :gps OR :gps = '')
    AND (cartablesview.vehicle_price <= :price OR :price = '')
    AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function countTypeCars($conn) {
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $vehicleType = $_SESSION['vehicle_type'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];
    $sql = "SELECT COUNT(*) as total FROM cartablesview 
    WHERE category_type = :vehicleType
    AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
    AND (cartablesview.seats = :seats OR :seats = '')
    AND (cartablesview.doors = :doors OR :doors = '')
    AND (cartablesview.gear = :gearbox OR :gearbox = '')
    AND (cartablesview.min_age = :age OR :age = '')
    AND (cartablesview.category_drive = :drive OR :drive = '')
    AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
    AND (cartablesview.gps = :gps OR :gps = '')
    AND (cartablesview.vehicle_price <= :price OR :price = '')
    AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];

}


function countLocCars($conn) {
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $location = $_SESSION['location'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];
    $sql = "SELECT COUNT(*) as total FROM cartablesview 
    WHERE location_name = :location
    AND (cartablesview.vendor_name = :manufacturer OR :manufacturer = '')
    AND (cartablesview.seats = :seats OR :seats = '')
    AND (cartablesview.doors = :doors OR :doors = '')
    AND (cartablesview.gear = :gearbox OR :gearbox = '')
    AND (cartablesview.min_age = :age OR :age = '')
    AND (cartablesview.category_drive = :drive OR :drive = '')
    AND (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '')
    AND (cartablesview.gps = :gps OR :gps = '')
    AND (cartablesview.vehicle_price <= :price OR :price = '')
    AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :end_date   
                AND booking.end_date >= :start_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function displayNoResultsMessage($result) {
    if (empty($result)) {
        echo '<div class="no-results">Für Ihre Suche konnten wir keine Treffer finden.</div>';
    }
}

// this function can execute all searches, we should take this instead of 4 different search functions
// WILL IMPLEMENT THIS LATER
function fetchCombinedCars($conn, $page, $perPage) {
    $_SESSION['location'] = $_SESSION['location'] ?? '';
    $_SESSION['vehicle_type'] = $_SESSION['vehicle_type'] ?? '';
    $_SESSION['start_date'] = $_SESSION['start_date'] ?? '';
    $_SESSION['end_date'] = $_SESSION['end_date'] ?? '';
    $_SESSION['manufacturer'] = $_SESSION['manufacturer'] ?? '';
    $_SESSION['seats'] = $_SESSION['seats'] ?? '';
    $_SESSION['doors'] = $_SESSION['doors'] ?? '';
    $_SESSION['gearbox'] = $_SESSION['gearbox'] ?? '';
    $_SESSION['minAge'] = $_SESSION['minAge'] ?? '';
    $_SESSION['drive'] = $_SESSION['drive'] ?? '';
    $_SESSION['air_conditioning'] = $_SESSION['air_conditioning'] ?? '';
    $_SESSION['gps'] = $_SESSION['gps'] ?? '';
    $_SESSION['max_price'] = $_SESSION['max_price'] ?? '';

    $start = ($page - 1) * $perPage;
    $location = $_SESSION['location'];
    $vehicleType = $_SESSION['vehicle_type'];
    $startDate = $_SESSION['start_date'];
    $endDate = $_SESSION['end_date'];
    $vendorName = $_SESSION['manufacturer'];
    $seats = $_SESSION['seats'];
    $doors = $_SESSION['doors'];
    $gearbox = $_SESSION['gearbox'];
    $minAge = $_SESSION['minAge'];
    $drive = $_SESSION['drive'];
    $airConditioning = $_SESSION['air_conditioning'];
    $gps = $_SESSION['gps'];
    $maxPrice = $_SESSION['max_price'];

    $sql = "SELECT * 
            FROM cartablesview 
            WHERE (1) ";

    $conditions = [];
    $bindings = [];

    if ($location !== '') {
        $conditions[] = "location_name = :location";
        $bindings[':location'] = $location;
    }
    if ($vehicleType !== '') {
        $conditions[] = "category_type = :vehicleType";
        $bindings[':vehicleType'] = $vehicleType;
    }

    if ($vendorName !== '') {
        $conditions[] = "(cartablesview.vendor_name = :manufacturer OR :manufacturer = '')";
        $bindings[':manufacturer'] = $vendorName;
    }

    if ($seats !== '') {
        $conditions[] = "(cartablesview.seats = :seats OR :seats = '')";
        $bindings[':seats'] = $seats;
    }

    if ($doors !== '') {
        $conditions[] = "(cartablesview.doors = :doors OR :doors = '')";
        $bindings[':doors'] = $doors;
    }

    // Add other conditions based on session variables

    if (!empty($conditions)) {
        $sql .= "AND " . implode(" AND ", $conditions);
    }

    $sql .= " AND cartablesview.vehicle_id NOT IN (
                SELECT booking.vehicle_id        
                FROM booking
                WHERE booking.start_date <= :startDate
                AND booking.end_date >= :endDate)
                LIMIT :start, :perPage";

    $stmt = $conn->prepare($sql);

    $bindParams = array_merge(
        $bindings,
        [':startDate' => $startDate, ':endDate' => $endDate, ':start' => $start, ':perPage' => $perPage]
    );

    $stmt->execute($bindParams);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<script>";
    echo "console.log('Location:', '" . $location . "');";
    echo "console.log('Vehicle Type:', '" . $vehicleType . "');";
    echo "console.log('Cars:', " . json_encode($result) . ");";
    echo "</script>";

    return $result;
}

// This is similiar to what i did to clean up the redundancy in the search function, will also implement this later to clean up and only have 1 function instead of 4 
function countCars($conn, $location = null, $vehicleType = null) {
    $startDate = $_SESSION['start_date'] ?? '';
    $endDate = $_SESSION['end_date'] ?? '';
    $location = $location ?? $_SESSION['location'] ?? '';
    $vehicleType = $vehicleType ?? $_SESSION['vehicle_type'] ?? '';
    // ... (rest of the session variable assignments)

    $sql = "SELECT COUNT(*) as total FROM cartablesview 
            WHERE 1 "; // Placeholder for WHERE clause

    $conditions = [];
    if (!empty($location)) {
        $conditions[] = "location_name = :location";
    }
    if (!empty($vehicleType)) {
        $conditions[] = "category_type = :vehicleType";
    }
    // ... (other conditions based on session variables)

    if (!empty($conditions)) {
        $sql .= "AND " . implode(" AND ", $conditions);
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    // ... (other bindParam calls)

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

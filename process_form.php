<?php
// process_form.php

// function which stores user inputs for searched in session variables 
//NOTE: DONT KNOW IF THIS CAN CAUSE CONFLICTS WHEN WE HAVE A LOGIN BECAUSE LOGIN CREATES A NEW SESSION
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
        $allowedManufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-Benz", "Mercedes-AMG", "Opel", "Range Rover", "Skoda", "Volkswagen"];
        $allowedSeats = ["2", "4", "5", "7", "8", "9"];
        $allowedDoors = ["2", "3", "4", "5"];
        $allowedGearboxes = ["Manual", "Automatic"];
        $allowedDrives = ["Verbrenner", "Elektrisch"];
        
        $manufacturer = in_array($_POST['Hersteller'], $allowedManufacturers) ? $_POST['Hersteller'] : '';
        $seats = in_array($_POST['Sitze'], $allowedSeats) ? $_POST['Sitze'] : '';
        $doors = in_array($_POST['Türen'], $allowedDoors) ? $_POST['Türen'] : '';
        $gearbox = in_array($_POST['Getriebe'], $allowedGearboxes) ? $_POST['Getriebe'] : '';
        $age = $_POST['Baujahr']; // No array validation for text inputs
        $drive = in_array($_POST['Antrieb'], $allowedDrives) ? $_POST['Antrieb'] : '';
        $airConditioning = isset($_POST['Klima']) ? 1 : 0; // Checkbox values as boolean or integer
        $gps = isset($_POST['GPS']) ? 1 : 0; // Checkbox values as boolean or integer
        $maxPrice = $_POST['Preis']; // No array validation for text inputs

        // Store filter inputs in session variables
        $_SESSION['manufacturer'] = $manufacturer;
        $_SESSION['seats'] = $seats;
        $_SESSION['doors'] = $doors;
        $_SESSION['gearbox'] = $gearbox;
        $_SESSION['Baujahr'] = $age;
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
    if(isset($_SESSION['location']) && isset($_SESSION['vehicle_type'])) {
        $location = $_SESSION['location'];
        $vehicleType = $_SESSION['vehicle_type'];
        $startDate = $_SESSION['start_date'];
        $endDate = $_SESSION['end_date'];
        $start = ($page - 1) * $perPage;
        // Prepare the SQL statement with necessary joins
        $sql = "SELECT * 
        FROM cartablesview 
        WHERE location_name = :location
        AND cartablesview.category_type = :vehicleType
	    AND cartablesview.vehicle_id NOT IN (
    	SELECT booking.vehicle_id        
    	FROM booking
    	WHERE booking.start_date <= :start_date   
    	AND booking.end_date >= :end_date)
        LIMIT :start, :perPage";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':vehicleType', $vehicleType);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        // Fetch the result
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Print the retrieved parameters and the result to the console
        echo "<script>";
        echo "console.log('Location:', '" . $location . "');";
        echo "console.log('Vehicle Type:', '" . $vehicleType . "');";
        echo "console.log('Cars:', " . json_encode($result) . ");";
        echo "</script>";
        return $result;
    }
}

function fetchCarsType($conn, $page, $perPage) {
    if(isset($_SESSION['vehicle_type'])) {
        $vehicleType = $_SESSION['vehicle_type'];
        $start = ($page - 1) * $perPage;
        // Prepare the SQL statement with necessary joins
        $sql = "SELECT * 
        FROM cartablesview 
        WHERE category_type = :vehicleType
        AND vehicle_availability = 1
        LIMIT :start, :perPage";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':vehicleType', $vehicleType);
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
}

function displayProductCards($result) {
    $numCars = count($result);
    $numRows = ceil($numCars / 5);

    for ($i = 0; $i < $numRows; $i++) {
        echo '<div class="overview-row">';
        for ($j = $i * 5; $j < min(($i + 1) * 5, $numCars); $j++) {
            echo '<div class="car-card">';
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
                $features[] = '<img src="path/to/gps-icon.svg" alt="GPS">';
            }
            if ($result[$j]['trunk'] > 0) {
                $features[] = '<img src="path/to/trunk-icon.svg" alt="Trunk">';
            }
            if ($result[$j]['air_conditioning'] == 1) {
                $features[] = '<img src="path/to/ac-icon.svg" alt="AC">';
            }
            echo '<div class="car-features">Features: ' . implode(" ", $features) . '</div>';
            echo '</div>';
            echo '<div class="car-prize">Preis: ' . $result[$j]['vehicle_price'] . '€</div>';
            echo '<button class="rent-button">Rent Now</button>';
            echo '</div></div>';
        }
        echo '</div>';
    }
}

function fetchAllCars($conn, $page, $perPage) {
    $start = ($page - 1) * $perPage;

    $sql = "SELECT *
            FROM cartablesview
            WHERE vehicle_availability = 1
            LIMIT :start, :perPage";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function countAllCars($conn) {
    $sql = "SELECT COUNT(*) as total FROM vehicles";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function countLocAndTypeCars($conn) {
    if(isset($_SESSION['location']) && isset($_SESSION['vehicle_type'])) {
        $location = $_SESSION['location'];
        $vehicleType = $_SESSION['vehicle_type'];
    $sql = "SELECT COUNT(*) as total FROM cartablesview 
    WHERE location_name = :location 
    AND category_type = :vehicleType
    AND vehicle_availability = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
    }
}

function countTypeCars($conn) {
    $vehicleType = $_SESSION['vehicle_type'];
    $sql = "SELECT COUNT(*) as total FROM cartablesview 
    WHERE category_type = :vehicleType
    AND vehicle_availability = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];

}





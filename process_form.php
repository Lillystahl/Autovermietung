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

        // Check if at least one of location or vehicle type is provided and valid
        if ((!empty($loc) && ctype_alpha($loc)) || (!empty($vehicleType) && ctype_alpha($vehicleType))) {
            // Store inputs in session variables
            $_SESSION['location'] = $loc;
            $_SESSION['vehicle_type'] = $vehicleType;
            $_SESSION['start_date'] = $startDate;
            $_SESSION['end_date'] = $endDate;
            
            // Redirect to the next page
            header("Location: Produktübersicht.php");
            exit();
        } else {
            // Invalid input for location or vehicle type
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
        }
    }
}

// debug function to see session variables
function debugSession() {
    echo '<script>';
    echo 'console.log("Session Variables: ", ' . json_encode($_SESSION) . ');';
    echo '</script>';
}

function fetchCarsFromSession($conn) {
    if(isset($_SESSION['location']) && isset($_SESSION['vehicle_type'])) {
        $location = $_SESSION['location'];
        $vehicleType = $_SESSION['vehicle_type'];
        // Prepare the SQL statement with necessary joins
        $sql = "SELECT * 
        FROM cartablesview 
        WHERE location_name = :location 
        AND category_type = :vehicleType";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':vehicleType', $vehicleType);
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
            echo '<div class="car-prize">Preis: ' . $result[$j]['vehicle_price'] . '</div>';
            echo '<button class="rent-button">Rent Now</button>';
            echo '</div></div>';
        }
        echo '</div>';
    }
}

function countAllCars($conn) {
    $sql = "SELECT COUNT(*) as total FROM vehicles";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


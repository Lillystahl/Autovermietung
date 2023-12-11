<?php
// process_form.php

function processSearchForm() {
    if (isset($_POST['filterbar-submit'])) {
        $loc = filter_input(INPUT_POST, 'standort-location', FILTER_SANITIZE_SPECIAL_CHARS);
        $vehicleType = filter_input(INPUT_POST, 'vehicle-type', FILTER_SANITIZE_SPECIAL_CHARS);
        $startDate = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $endDate = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);

        // Check if at least one of location or vehicle type is provided and valid
        if ((!empty($loc) && ctype_alpha($loc)) || (!empty($vehicleType) && ctype_alpha($vehicleType))) {
            // Build the query string with the search parameters
            $queryString = http_build_query([
                'location' => $loc,
                'vehicle-type' => $vehicleType,
                'start-date' => $startDate,
                'end-date' => $endDate
                // Add other parameters...
            ]);

            // Redirect to Produktübersicht.php with the assembled query string
            header("Location: Produktübersicht.php?" . $queryString);
            exit();
        } else {
            // Invalid input for location or vehicle type
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
        }
    }
}

function fetchCarsFromURLParams($conn) {
    if(isset($_GET['location']) && isset($_GET['vehicle-type'])) {
        $location = $_GET['location'];
        $vehicleType = $_GET['vehicle-type'];

        // Prepare the SQL statement with necessary joins
        $sql = "SELECT vehicles.*, types.*, location.*, categories.type AS vehicle_type, categories.drive, vendors.vendor_name
                FROM vehicles
                JOIN types ON vehicles.type_id = types.type_id
                JOIN location ON vehicles.location_id = location.location_id
                JOIN categories ON types.category_id = categories.category_id
                JOIN vendors ON types.vendor_id = vendors.vendor_id
                WHERE categories.category_id = :vehicleType
                AND location.loc_name = :location";


        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':vehicleType', $vehicleType, PDO::PARAM_INT); // Der Parameter ist ein Integer
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
            echo '<div class="car-name">' . $result[$j]['vendor_name'] . ' ' . $result[$j]['name'] . '</div>';
            echo '<div class="car-cat">Kategorie: hier steht die kategorie</div>';
            $transmission = '';
            if ($result[$j]['gear'] == 'automatic') {
                $transmission = 'Automatik';
            } elseif ($result[$j]['gear'] == 'manually') {
                $transmission = 'Handschalter';
            }
            echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';
            echo '<div class="Location">Standort: ' . $result[$j]['loc_name'] . '</div>';
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
            echo '<div class="car-prize">Preis: ' . $result[$j]['price'] . '</div>';
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

function fetchAllCars($conn, $page, $perPage) {
    $start = ($page - 1) * $perPage;

    $sql = "SELECT vehicles.*, types.*, location.*, categories.drive, vendors.vendor_name
            FROM vehicles
            JOIN types ON vehicles.type_id = types.type_id
            JOIN location ON vehicles.location_id = location.location_id
            JOIN categories ON types.category_id = categories.category_id
            JOIN vendors ON types.vendor_id = vendors.vendor_id
            LIMIT :start, :perPage";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
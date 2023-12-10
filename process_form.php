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
        $sql = "SELECT vehicles.*, types.*, location.*
                FROM vehicles
                JOIN types ON vehicles.type_id = types.type_id
                JOIN location ON vehicles.location_id = location.location_id
                JOIN categories ON types.category_id = categories.category_id
                WHERE categories.type = :vehicleType
                AND location.loc_name = :location";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':vehicleType', $vehicleType, PDO::PARAM_STR);
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
            echo '<img class="car-image" src="' . $result[$j]['img_file_name'] . '" alt="Car Image">';
            echo '</div>';
            echo '<div class="car-details-container">';
            echo '<div class="car-details">';
            echo '<div class="Car Name">Modell: ' . $result[$j]['name'] . '</div>';
            echo '<div class="Location">Standort: ' . $result[$j]['loc_name'] . '</div>';
            echo '<div class="Preis">Preis: ' . $result[$j]['price'] . '</div>';
            echo '<div class="Sitze-">Sitze: ' . $result[$j]['seats'] . '</div>';
            echo '<div class="key-facts">Antrieb: ' . $result[$j]['drive'] . '</div>';
            echo '</div>';
            echo '<button class="rent-button">Rent Now</button>';
            echo '</div></div>';
        }
        echo '</div>';
    }
}
<?php

// function which stores user inputs for searched in session variables 
//NOTE: DONT KNOW IF THIS CAN CAUSE CONFLICTS WHEN WE HAVE A LOGIN BECAUSE LOGIN CREATES A NEW SESSION (does not seem to be the case)
//This function checks if a user input is submitted via the post form on the homepage
//It valiadates it via the allowed array so that a user cannot change it in html(dont know if this is necceasrry but better save then sorry)
function inputToSession($submitButton) {
    if (isset($_POST[$submitButton])) {
        // allowed dropdown values
        //if this was larger sclae projekt we need to do this dynamically via db access but dont think we need this here
        //hence this is not easy to scale!
        $allowedLocations = ["Berlin", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock", "''"];
        $allowedCategories = ["Cabrio", "SUV", "Limousine", "Combi", "Mehrsitzer", "Coupe", "''"];

        //create function variables, if a validation fails it simply ""
        // this way we dont break the function and can still use it 
        $loc = in_array($_POST['standort-location'], $allowedLocations) ? $_POST['standort-location'] : '';
        $vehicleType = in_array($_POST['Fahrzeugtyp'], $allowedCategories) ? $_POST['Fahrzeugtyp'] : '';
        $startDate = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $endDate = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);

        //get todays date for date validation for php
        $currentDate = date("Y-m-d");

        //if block which checks our user input possibilities we allow
        if ((empty($loc) && empty($vehicleType)) || (!empty($loc) && !empty($vehicleType)) || (empty($loc) && !empty($vehicleType)) || (!empty($loc) && empty($vehicleType))) {
            //if to  validate date so you cannot boock in the past bla bla
            if ((empty($startDate) && empty($endDate)) || ((!empty($startDate) && !empty($endDate)) && (strtotime($startDate) >= strtotime($currentDate) && strtotime($endDate) >= strtotime($startDate)))) {
                //set session variables (also empty ones for later used)
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
                $_SESSION['Sortierung'] = '';

                header("Location: Produktübersicht.php");
                echo '<script>';
                echo 'console.log(" Searched on ' . ($submitButton === 'filterbar-submit' ? "Produktübersicht" : "Another Page") . '! ");';
                echo '</script>';
                exit();
            } else {
                // Fehlermeldung Datum
                echo "<script>alert('Ungültiger Datumsbereich. Das Startdatum darf nicht älter als das aktuelle Datum sein, das Enddatum darf nicht vor dem Startdatum liegen und beide Daten müssen angegeben werden, wenn eines eingegeben wird.');</script>";
            }
        } else {
            //error message input validation failed
            /// maybe this is obsolete because we set it to "" if validation fails
            echo "<script>alert('Ungültige Eingabe für Standort oder Fahrzeugtyp.');</script>";
        }
    }
}

//function which passes the users filter inputs to the session so other functions can access it 
function FilterToSession(){
    if (isset($_POST['applyFilter-submit'])) {
        //create arrays for allowed inputs as we saw above
        //if this was larger sclae projekt we need to do this dynamically via db access but dont think we need this here
        //hence this is not easy to scale!
        $allowedManufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-Benz", "Mercedes-AMG", "Opel", "Range Rover", "Skoda", "Volkswagen",''];
        $allowedSeats = ["2", "4", "5", "7", "8", "9",''];
        $allowedDoors = ["2", "3", "4", "5",''];
        $allowedGearboxes = ["manually", "automatic",''];
        $allowedDrives = ["combuster", "electric",''];
        $allowedAirConditioning = ["0", "1",''];
        $allowedGPS = ["0", "1",''];
            
        //create function variables, if a validation fails it simply ""
        // this way we dont break the function and can still use it 
        $manufacturer = in_array($_POST['Hersteller'], $allowedManufacturers) ? $_POST['Hersteller'] : '';
        $seats = in_array($_POST['Sitze'], $allowedSeats) ? $_POST['Sitze'] : '';
        $doors = in_array($_POST['Türen'], $allowedDoors) ? $_POST['Türen'] : '';
        $gearbox = in_array($_POST['Getriebe'], $allowedGearboxes) ? $_POST['Getriebe'] : '';
        $age = $_POST['MindestAlter']; // No array validation for text inputs
        $drive = in_array($_POST['Antrieb'], $allowedDrives) ? $_POST['Antrieb'] : '';
        $airConditioning = in_array($_POST['Klima'], $allowedAirConditioning) ? $_POST['Klima'] : '';
        $gps = in_array($_POST['GPS'], $allowedGPS) ? $_POST['GPS'] : '';
        $maxPrice = $_POST['Preis'];
        $sortierung = ($_POST['Sortierung'] === 'PriceAsc' || $_POST['Sortierung'] === 'PriceDesc') ? $_POST['Sortierung'] : ''; // No array validation for text inputs

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
        $_SESSION['Sortierung'] = $sortierung;

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
// we absolutely did not need this ;)
function debugSession() {
    echo '<script>';
    echo 'console.log("Session Variables: ", ' . json_encode($_SESSION) . ');';
    echo '</script>';
}

// very nice function to dynamically produce our product cards and the onclick detail cards
// we essentially access the result array to loop through it and "collect" certain information for each car
// The result array is 2 dimensional array which has a main key (the car) and its attributes stored in it
// we get this from the function which fetches db and returns it
//hence we can pass it to this function
//very nice!
function displayProductCards($result) {
           // Calculate the number of cars and the number of rows needed to display them in groups of 5
    $numCars = count($result);
    $numRows = ceil($numCars / 5);
    $carCounter = 0;

    // Group cars by type and location
    $consolidatedCars = [];
    foreach ($result as $car) {
        $typeLocation = $car['type_name'] . '_' . $car['location_name'] . '_' . $car['gear'] . '_' . $car['gps'] . '_' . $car['trunk'] . '_' . $car['vehicle_price'] . '_' . $car['vendor_name']. '_' . $car['min_age'];
        if (!isset($consolidatedCars[$typeLocation])) {
            $consolidatedCars[$typeLocation] = [
                'count' => 0,
                'cars' => [],
            ];
        }
        $consolidatedCars[$typeLocation]['count']++;
        $consolidatedCars[$typeLocation]['cars'][] = $car;
    }
   
           // Loop through each row
    for ($i = 0; $i < $numRows; $i++) {
        echo '<div class="overview-row">';
        $cardsDisplayed = 0; // Counter for displayed cards in a row
        // Display up to 5 cards in each row
        foreach ($consolidatedCars as $typeLocation => $data) {
            if ($cardsDisplayed >= 5) {
                break; // Move to the next row if 5 cards are already displayed
            }
            $car = $data['cars'][0]; // Get details of one car for display

            // Show consolidated card for multiple cars at one location
            echo '<div class="car-card" onclick="openCarDetails(' . $car['vehicle_id'] . ')">';
            echo '<div class="car-image-container">';
            echo '<img class="car-image" src="Images/Product_Img/vorne-' . $car['img_file_name'] . '" alt="Car Image">';
            echo '</div>';
            echo '<div class="car-details-container">';
            echo '<div class="car-name">' . $car['vendor_name'] . ' ' . $car['type_name'] . '</div>';
            echo '<div class="Location">' . $car['location_name'] . '</div>';
            echo '<div class="available-cars-count">' . $data['count'] . ' ' . ($data['count'] === 1 ? 'Fahrzeug' : 'Fahrzeuge') . ' verfügbar</div>'; // Display count of available cars

            // Transmission
            $transmission = '';
            if ($car['gear'] == 'automatic') {
                $transmission = 'Automatik';
            } elseif ($car['gear'] == 'manually') {
                $transmission = 'Handschalter';
            }
            echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';

            // Features
            $features = [];
            if ($car['gps'] == 1) {
                $features[] = '<i class="fa-solid fa-map-location-dot"></i>';
            } else {
                $features[] = '<span class="durchgestrichen"><i class="fa-solid fa-map-location-dot"></i></span>';
            }
            if ($car['air_conditioning'] == 1) {
                $features[] = '<i class="fa-solid fa-fan"></i>';
            } else {
                $features[] = '<span class="durchgestrichen"><i class="fa-solid fa-fan"></i></span>';
            }
            echo '<div class="car-features">Features: ' . implode(" ", $features) . '</div>';

            // Price
            echo '<div class="car-prize">Preis/Tag: ' . $car['vehicle_price'] . '€</div>';

            // Display the form to rent the car
            echo '<form id="rent-form-' . $car['vehicle_id'] . '" action="booking.php" method="post">';
            echo '<input type="hidden" name="vehicle_id" value="' . $car['vehicle_id'] . '">';
            echo '<input type="hidden" name="vendor_name" value="' . $car['vendor_name'] . '">';
            echo '<input type="hidden" name="type_name" value="' . $car['type_name'] . '">';
            echo '<input type="hidden" name="vehicle_price" value="' . $car['vehicle_price'] . '">';
            echo '<input type="hidden" name="min_age" value="' . $car['min_age'] . '">';

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
            echo '</div>';
            echo '</div>';
            $carCounter++;
            $cardsDisplayed++;
            unset($consolidatedCars[$typeLocation]); // Remove displayed card from the consolidated list
        }
        echo '</div>';
    }

    // Loop through each row for displaying car details overlay
    foreach ($result as $key => $car) {
        echo '<div class="car-details-overlay" id="carDetailsOverlay_' . $car['vehicle_id'] . '">';
        echo '<div class="car-details-popup" id="carDetailsPopup_' . $car['vehicle_id'] . '">';
        echo '<span class="close-button" onclick="closeCarDetails()">&times;</span>';
        echo '<div class="popup-content">';
        echo '<div class="popup-image-container">' .
                '<img class="car-image" src="Images/Product_Img/vorne-' . $car['img_file_name'] . '" alt="Car Image">' .
            '</div>';
        echo '<div class="car-details-popup-content">';
        $name_extension ='';
        if ($car['type_name_extension'] == '0') {
            $name_extension = ' ';
        } else {
            $name_extension = $car['type_name_extension'];
        }
        echo '<div class="car-name">' . $car['vendor_name'] . ' ' . $car['type_name'] . ' ' . $name_extension . '</div>';
        echo '<div class="car-cat">Kategorie: ' . $car['category_type'] . '</div>';
        echo '<div class="car-cat">Sitzanzahl: ' . $car['seats'] . '</div>';
        echo '<div class="car-cat">Türen: ' . $car['doors'] . '</div>';
        $trunk ='';
        if ($car['trunk'] == '0') {
            $trunk = 'Nein';
        } elseif ($car['trunk'] > '0') {
            $trunk = 'Ja';
        }
        echo '<div class="car-cat">Kofferraum: ' . $trunk . '</div>';
        $gps ='';
        if ($car['gps'] == '0') {
            $gps = 'Nein';
        } elseif ($car['gps'] > '0') {
            $gps = 'Ja';
        }
        echo '<div class="car-cat">Navigationssystem: ' . $gps . '</div>';
        $ac ='';
        if ($car['air_conditioning'] == '0') {
            $ac = 'Nein';
        } elseif ($car['air_conditioning'] > '0') {
            $ac = 'Ja';
        }
        echo '<div class="car-cat">Klimaanlage: ' . $ac . '</div>';
        $drive_type ='';
        if ($car['category_drive'] == 'Combuster') {
            $drive_type = 'Verbrennungsmotor';
        } elseif ($car['category_drive'] == 'Electric') {
            $drive_type = 'Elektromotor';
        }
        echo '<div class="car-cat">Antrieb: ' . $drive_type . '</div>';
        $transmission ='';
        if ($car['gear'] == 'automatic') {
            $transmission = 'Automatik';
        } elseif ($car['gear'] == 'manually') {
            $transmission = 'Handschalter';
        }
        echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';
        echo '<div class="Location">Standort: ' . $car['location_name'] . '</div>';
        echo '<div class="Min Age">Mindest Alter: ' . $car['min_age'] . '</div>';
        echo '<div class="car-prize">Preis pro Tag: ' . $car['vehicle_price'] . '€</div>';
    
        echo '<form id="rent-form-' . $car['vehicle_id'] . '" action="booking.php" method="post">';
        echo '<input type="hidden" name="vehicle_id" value="' . $car['vehicle_id'] . '">';
        echo '<input type="hidden" name="vendor_name" value="' . $car['vendor_name'] . '">';
        echo '<input type="hidden" name="type_name" value="' . $car['type_name'] . '">';
        echo '<input type="hidden" name="vehicle_price" value="' . $car['vehicle_price'] . '">';
        echo '<input type="hidden" name="min_age" value="' . $car['min_age'] . '">';
    
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
    
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo "<script>";
    echo "console.log('Cards displayed:', " . json_encode($carCounter) . ");";
    echo "</script>";
    return $carCounter;
}


//so this just checks if result is empty which means we did not find any cars for the users search
// you can put this in the function above but i think its nicer if this in one function (this is just me)
function displayNoResultsMessage($result) {
    if (empty($result)) {
        echo '<div class="no-results">Für Ihre Suche konnten wir keine Treffer finden.</div>';
    }
}

// this function can execute all searches, we should take this instead of 4 different search functions (we never had 4 searches which were really redundant! ;))
function fetchCombinedCars($conn) {
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
    $_SESSION['Sortierung'] = $_SESSION['Sortierung'] ?? '';

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
    $sortierung= $_SESSION['Sortierung'];

    // or statement in sql seperates the querry and the "and" statement will only be executed when the or block is called so we need it in both or it is not called
    $sql = "SELECT * 
    FROM cartablesview 
    WHERE 
    (
        (cartablesview.vendor_name = :manufacturer OR :manufacturer = '') AND
        (cartablesview.seats = :seats OR :seats = '') AND
        (cartablesview.doors = :doors OR :doors = '') AND
        (cartablesview.gear = :gearbox OR :gearbox = '') AND
        (cartablesview.min_age <= :age OR :age = '') AND
        (cartablesview.category_drive = :drive OR :drive = '') AND
        (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '') AND
        (cartablesview.gps = :gps OR :gps = '') AND
        (cartablesview.vehicle_price <= :price OR :price = '')
    )
    AND (
        (cartablesview.location_name = :location AND cartablesview.category_type = :vehicleType) OR
        (cartablesview.location_name = :location OR cartablesview.category_type = :vehicleType) OR
        (:location = '' AND :vehicleType = '') 
    )
    AND cartablesview.vehicle_id NOT IN (
        SELECT booking.vehicle_id
        FROM booking
        WHERE 
            booking.vehicle_id = cartablesview.vehicle_id AND
            (
                (booking.start_date <= :endDate AND booking.end_date >= :startDate) OR
                (booking.start_date >= :startDate AND booking.end_date <= :endDate) OR
                (booking.start_date <= :startDate AND booking.end_date >= :endDate)
            )
    )
    ORDER BY 
        CASE WHEN :sortierung = 'PriceAsc' THEN cartablesview.vehicle_price END ASC,
        CASE WHEN :sortierung = 'PriceDesc' THEN cartablesview.vehicle_price END DESC";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':manufacturer', $vendorName);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':doors', $doors);
    $stmt->bindParam(':gearbox', $gearbox);
    $stmt->bindParam(':age', $minAge);
    $stmt->bindParam(':drive', $drive);
    $stmt->bindParam(':airConditioning', $airConditioning);
    $stmt->bindParam(':gps', $gps);
    $stmt->bindParam(':price', $maxPrice);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':sortierung', $sortierung);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<script>";
    echo "console.log('fetchCombinedCars was called wiht the cars:', " . json_encode($result) . ");";
    echo "</script>";


    return $result;

}

//⊂(◉‿◉)つ
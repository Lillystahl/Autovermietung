<?php
// process_form.php

// function which stores user inputs for searched in session variables 
//NOTE: DONT KNOW IF THIS CAN CAUSE CONFLICTS WHEN WE HAVE A LOGIN BECAUSE LOGIN CREATES A NEW SESSION (does not seem to be the case)
//This function checks if a user input is submitted via the post form on the homepage
//It valiadates it via the allowed array so that a user cannot change it in html(dont know if this is necceasrry but better save then sorry)
function homeInpuToSession() {
    if (isset($_POST['filterbar-submit'])) {
        // allowed dropdown values
        //if this was larger sclae projekt we need to do this dynamically via db access but dont think we need this here
        //hence this is not easy to scale!
        $allowedLocations = ["Berlin", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnbeg", "Paderborn", "Rostock", "''"];
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

                header("Location: Produktübersicht.php");
                echo '<script>';
                echo 'console.log(" Searched on Produktübersicht! ");';
                echo '</script>';
                exit();
            } else {
                //error message date
                echo "<script>alert('Invalid date range. Start date cannot be older than the current date, end date cannot be before start date, and both dates must be provided if one is entered.');</script>";
            }
        } else {
            //error message input validation failed
            /// maybe this is obsolete because we set it to "" if validation fails so yeah 
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
        }
    }
}

//essentially does the same as function above only on the Produktübersich seite
function ProduktübersichtInputToSession() {
    if (isset($_POST['filterbar1-submit'])) {
        $allowedLocations = ["Berlin", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnbeg", "Paderborn", "Rostock", "''"];
        $allowedCategories = ["Cabrio", "SUV", "Limousine", "Combi", "Mehrsitzer", "Coupe", "''"];

        $loc = in_array($_POST['standort-location'], $allowedLocations) ? $_POST['standort-location'] : '';
        $vehicleType = in_array($_POST['Fahrzeugtyp'], $allowedCategories) ? $_POST['Fahrzeugtyp'] : '';
        $startDate = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $endDate = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);

        $currentDate = date("Y-m-d");

        if ((empty($loc) && empty($vehicleType)) || (!empty($loc) && !empty($vehicleType)) || (empty($loc) && !empty($vehicleType)) || (!empty($loc) && empty($vehicleType))) {
            if ((empty($startDate) && empty($endDate)) || ((!empty($startDate) && !empty($endDate)) && (strtotime($startDate) >= strtotime($currentDate) && strtotime($endDate) >= strtotime($startDate)))) {
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
                exit();
            } else {
                echo "<script>alert('Invalid date range. Start date cannot be older than the current date, end date cannot be before start date, and both dates must be provided if one is entered.');</script>";
            }
        } else {
            echo "<script>alert('Invalid input for location or vehicle type.');</script>";
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
// we absolutely did not need this ;)
function debugSession() {
    echo '<script>';
    echo 'console.log("Session Variables: ", ' . json_encode($_SESSION) . ');';
    echo '</script>';
}

// very nice function to dynamically produce our product cards and the onclick detail cards
// this looks complicated but is acutally reall trivial 
// we essentially access the result array to loop through it and "collect" certain information for each car
// The result array is 2 dimensional array which has a main key (the car) and its attributes stored in it
// we get this from the function which fetches db and returns it
//hence we can pass it to this function
//very nice!
function displayProductCards($result) {
    // Calculate the number of cars and the number of rows needed to display them in groups of 5
    $numCars = count($result);
    $numRows = ceil($numCars / 5);

    // Loop through each row
    for ($i = 0; $i < $numRows; $i++) {
        // Display each car card
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
            // Display the form to rent the car
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

    // Loop through each row for displaying car details overlay
    for ($i = 0; $i < $numRows; $i++) {
        // Loop through each car in the row
        for ($j = $i * 5; $j < min(($i + 1) * 5, $numCars); $j++) {
            // Display car details overlay for each car
            echo '<div class="car-details-overlay" id="carDetailsOverlay_' . $j . '">';
            echo '<div class="car-details-popup" id="carDetailsPopup_' . $j . '">';
            echo '<span class="close-button" onclick="closeCarDetails()">&times;</span>';
            echo '<div class="popup-content">';
            echo '<div class="popup-image-container">' .
                    '<img class="car-image" src="Images/Product_Img/vorne-' . $result[$j]['img_file_name'] . '" alt="Car Image">' .
                    '<img class="car-image" src="Images/Product_Img/vorne-' . $result[$j]['img_file_name'] . '" alt="Car Image">' .
                '</div>';
            echo '<div class="car-details-popup-content">';
            $name_extension ='';
            if ($result[$j]['type_name_extension'] == '0') {
                $name_extension = ' ';
            } else {
                $name_extension = $result[$j]['type_name_extension'];
            }
            echo '<div class="car-name">' . $result[$j]['vendor_name'] . ' ' . $result[$j]['type_name'] . ' ' . $name_extension . '</div>';
            echo '<div class="car-cat">Kategorie: ' . $result[$j]['category_type'] . '</div>';
            echo '<div class="car-cat">Sitzanzahl: ' . $result[$j]['seats'] . '</div>';
            echo '<div class="car-cat">Türen: ' . $result[$j]['doors'] . '</div>';
            $trunk ='';
            if ($result[$j]['trunk'] == '0') {
                $trunk = 'Nein';
            } elseif ($result[$j]['trunk'] > '0') {
                $trunk = 'Ja';
            }
            echo '<div class="car-cat">Kofferraum: ' . $trunk . '</div>';
            $drive_type ='';
            if ($result[$j]['category_drive'] == 'Combuster') {
                $drive_type = 'Verbrennungsmotor';
            } elseif ($result[$j]['category_drive'] == 'Electric') {
                $drive_type = 'Elektromotor';
            }
            echo '<div class="car-cat">Antrieb: ' . $drive_type . '</div>';
            $transmission ='';
            if ($result[$j]['gear'] == 'automatic') {
                $transmission = 'Automatik';
            } elseif ($result[$j]['gear'] == 'manually') {
                $transmission = 'Handschalter';
            }
            echo '<div class="car-transmission">Getriebe: ' . $transmission . '</div>';
            echo '<div class="Location">Standort: ' . $result[$j]['location_name'] . '</div>';
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

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}

//so this just checks if result is empty which means we did not find any cars for the users search
// you can put this in the function above but i think its nicer if this in one function (this is just me)
function displayNoResultsMessage($result) {
    if (empty($result)) {
        echo '<div class="no-results">Für Ihre Suche konnten wir keine Treffer finden.</div>';
    }
}

// this function can execute all searches, we should take this instead of 4 different search functions (we never had 4 searches which were really redundant! ;))
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

    // or statement in sql seperates the querry and the "and" statement will only be executed when the or block is called so we need it in both or it is not called
    $sql = "SELECT * 
    FROM cartablesview 
    WHERE 
    (
        (cartablesview.vendor_name = :manufacturer OR :manufacturer = '') AND
        (cartablesview.seats = :seats OR :seats = '') AND
        (cartablesview.doors = :doors OR :doors = '') AND
        (cartablesview.gear = :gearbox OR :gearbox = '') AND
        (cartablesview.min_age = :age OR :age = '') AND
        (cartablesview.category_drive = :drive OR :drive = '') AND
        (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '') AND
        (cartablesview.gps = :gps OR :gps = '') AND
        (cartablesview.vehicle_price <= :price OR :price = '') AND
        (cartablesview.location_name = :location OR :location = '') AND
        (cartablesview.category_type = :vehicleType OR :vehicleType = '')
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
    OR
    (
        :location = '' AND :vehicleType = ''
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
    LIMIT :start, :perPage";

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
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

 return $result;
    echo "<script>";
    echo "console.log('fetchCombinedCars was called wiht the cars:', " . json_encode($result) . ");";
    echo "</script>";

    
}


// This is similiar to what i did to clean up the redundancy in the search function, will also implement this later to clean up and only have 1 function instead of 4(which again never happened)
// We need to do this because of the limit we use above, it might not always be possible to just count out our result array 
function countCars($conn) {
    // Assuming $_SESSION variables are properly set
    $location = $_SESSION['location'] ?? '';
    $vehicleType = $_SESSION['vehicle_type'] ?? '';
    $startDate = $_SESSION['start_date'] ?? '';
    $endDate = $_SESSION['end_date'] ?? '';
    $vendorName = $_SESSION['manufacturer'] ?? '';
    $seats = $_SESSION['seats'] ?? '';
    $doors = $_SESSION['doors'] ?? '';
    $gearbox = $_SESSION['gearbox'] ?? '';
    $minAge = $_SESSION['minAge'] ?? '';
    $drive = $_SESSION['drive'] ?? '';
    $airConditioning = $_SESSION['air_conditioning'] ?? '';
    $gps = $_SESSION['gps'] ?? '';
    $maxPrice = $_SESSION['max_price'] ?? '';

    $sql = "SELECT COUNT(*) as total 
            FROM cartablesview 
            WHERE     
    (
        (cartablesview.vendor_name = :manufacturer OR :manufacturer = '') AND
        (cartablesview.seats = :seats OR :seats = '') AND
        (cartablesview.doors = :doors OR :doors = '') AND
        (cartablesview.gear = :gearbox OR :gearbox = '') AND
        (cartablesview.min_age = :age OR :age = '') AND
        (cartablesview.category_drive = :drive OR :drive = '') AND
        (cartablesview.air_conditioning = :airConditioning OR :airConditioning = '') AND
        (cartablesview.gps = :gps OR :gps = '') AND
        (cartablesview.vehicle_price <= :price OR :price = '') AND
        (cartablesview.location_name = :location OR :location = '') AND
        (cartablesview.category_type = :vehicleType OR :vehicleType = '')
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
    OR
    (
        :location = '' AND :vehicleType = ''
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
    )";

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

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

//⊂(◉‿◉)つ
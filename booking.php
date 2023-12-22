<?php
    require_once('db_connect.php');
    require_once('process_form.php');
    require_once('config_session.inc.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['vehicle_id'])) {
            $vehicle_id = $_POST['vehicle_id'];
            $vendor_name = $_POST['vendor_name'];
            $type_name = $_POST['type_name'];
            $vehicle_price = $_POST['vehicle_price'];
            $min_age = $_POST['min_age'];
        


            echo "<script>";
            echo "console.log('ID:', " . json_encode($vehicle_id) . ");";
            echo "</script>";
            header("Location: booking.php");
            // Verwende $vehicle_id in der weiteren Verarbeitung oder speichere es in einer Session
            // Beispiel für das Speichern in einer Session:
            $_SESSION['vehicle_id'] = $vehicle_id;
            $_SESSION['vehicle_vendor_name'] = $vendor_name;
            $_SESSION['vehicle_type_name'] = $type_name;
            $_SESSION['Price'] =  $vehicle_price;
            $_SESSION['minAge'] =  $min_age;
        }
    }
    
    $start_date_english = $_SESSION["start_date"];
    $end_date_english = $_SESSION["end_date"];

    $start_date_german = date("d.m.Y", strtotime($start_date_english));
    $end_date_german = date("d.m.Y", strtotime($end_date_english));

    function calculateBookingDuration($start_date, $end_date) {
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $interval = $start->diff($end);
        return $interval->days; // Get the interval in days
    }

    $durationInDays = calculateBookingDuration($_SESSION["start_date"], $_SESSION["end_date"]);
    $totalPrice = $durationInDays * $_SESSION['Price'];
    
    function getUserData($conn){
        if (isset($_SESSION["user_username"])) {
            // Retrieve the username from the session
            $username = $_SESSION["user_username"];
    
            // SQL query to retrieve user data based on username
            $query = "SELECT user_id, firstname, lastname, email_address, date_of_birth, straße, hausnummer, postleitzahl, username
                      FROM user
                      WHERE username = :username"; // Replace 'your_table_name' with your actual table name
    
            // Prepare the statement
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch the user data
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Log user data to the console
            echo "<script>";
            echo "console.log('User Data:', " . json_encode($userData) . ");";
            echo "</script>";
    
            return $userData;
        } else {
            // No user logged in
            return null;
        }
    }

    function confirmBooking($conn) {
        if (isset($_POST['booking_submit'])) {
            $userID = $_SESSION["user_id"];
            $startDate = $_SESSION['start_date'];
            $endDate = $_SESSION['end_date'];
            $vehicleID = $_SESSION['vehicle_id'];

            
            // Calculate the booking duration in days
            $durationInDays = calculateBookingDuration($startDate, $endDate);
            
            // Assuming you have retrieved the price per day from somewhere
            // For example, you might fetch it from the vehicle details
            $pricePerDay = $_SESSION['Price']; // Adjust this accordingly
            
            // Calculate the total price for the booking
            $totalPrice = $durationInDays * $pricePerDay;
            
            // Check if the booking already exists for this user and vehicle
            $query = "SELECT COUNT(*) as count FROM booking 
                      WHERE user_id = :userID 
                      AND vehicle_id = :vehicleID 
                      AND start_date = :startDate 
                      AND end_date = :endDate";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':vehicleID', $vehicleID);
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // If the booking already exists, prevent insertion and handle accordingly
            if ($result['count'] > 0) {
                echo "<script>alert('Booking already exists for this car and time period.');</script>";
                // You might want to redirect or display a message to the user
            } else {
                // Capture today's date
                $todayDate = date("Y-m-d H:i:s");
                $bookingStmt = $conn->prepare("INSERT INTO booking (user_id, date_booking, vehicle_id, start_date, end_date, price) VALUES (:user_id, :date_booking, :vehicle_id, :start_date, :end_date, :price)");
        
                // Bind parameters including the price
                $bookingStmt->bindParam(':user_id', $userID);
                $bookingStmt->bindParam(':date_booking', $todayDate);
                $bookingStmt->bindParam(':vehicle_id', $vehicleID);
                $bookingStmt->bindParam(':start_date', $startDate);
                $bookingStmt->bindParam(':end_date', $endDate);
                $bookingStmt->bindParam(':price', $totalPrice); // Bind the total price
        
                // Execute the statement
                $result = $bookingStmt->execute();
        
                // Check if the statement executed successfully
                if ($result) {
                    echo "<script>console.log('Booking confirmed and added to database');</script>";
                } else {
                    echo "<script>console.log('Error adding booking to database');</script>";
                }
                header("Location: confirmation.php");
            }
        } else {
            // The form was not submitted
        }
    }
    
    confirmBooking($conn);
    $userData = getUserData($conn);

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase Bestätigung</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="bookingstyle.css">
    <link rel="stylesheet" href="homeStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
    <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                        <a href="home.php" class="logo" id="logoLink"> <img src="Images/ImageRE.png" alt="Company Logo" /> </a>
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

    <?php
    if (isset($_SESSION["user_id"])){
        echo' <div class="booking-container">
                <div class="element" id="datum">
                    <h3>Datum<span class="indicator" id="indicator"></span></h3>
                    <div class="date-inputs">
                        ' . $start_date_german . '
                        <p> bis </p>
                        ' . $end_date_german  . '
                    </div>
                    <button class="confirm-button" id="confirm-date-button">Bestätigen</button>
                </div>            
                        
                <div class="element" id="modell">
                    <!-- Element für Modell und Sonderwunsch -->
                    <h3>Auswahl bestätigen<span class="indicator" id="confirm-indicator"></span></h3>
                    <p>Ausgewähltes Modell: ' . $_SESSION['vehicle_vendor_name'] . ' ' . $_SESSION['vehicle_type_name'] . '</p>
                    <p>Preis: ' . $totalPrice . '€</p>
                    <textarea class="additional-request" placeholder="Sonderwunsch"></textarea>
                    <button class="confirm-button" id="confirm-button">Bestätigen</button>
                </div>

                <div class="element" id="login-daten">
                <!-- Element for Login-Daten -->
                    <div class="login-data">
                        <h3>Rechnungsadresse<span class="indicator" id="rechnungsadresse-indicator"></span></h3>
                        <p>' . $userData["firstname"] . ' ' . $userData["lastname"] . '</p>
                        <p>' . $userData["straße"] . ' ' . $userData["hausnummer"] .' ' . $userData["postleitzahl"] . '</p>
                        <p>' . $userData["username"] . '</p>
                        <button class="confirm-button" onclick="toggleIndicator()">Bestätigen</button>
                        <!-- Other content -->
                    </div>
                </div>

                <div class="element" id="zahlungsmethode">
                    <!-- Element für Zahlungsmethode -->
                    <h3>Zahlungsmethode wählen<span class="indicator" id="zahlungsmethode-indicator"></span></h3>
                    <div class="payment-options">
                        <input type="radio" id="paypal" name="payment" value="paypal" onclick="togglePaymentIndicator()">
                        <label for="paypal">PayPal</label><br>
                        <input type="radio" id="kreditkarte" name="payment" value="kreditkarte" onclick="togglePaymentIndicator()">
                        <label for="kreditkarte">Kreditkarte</label><br>
                        <input type="radio" id="Gpay" name="payment" value="Gpay" onclick="togglePaymentIndicator()">
                        <label for="klarna">G-Pay</label><br>
                        <input type="radio" id="Amex" name="payment" value="Amex" onclick="togglePaymentIndicator()">
                        <label for="sepa">Amex</label><br>
                        <input type="radio" id="Apple-Pay" name="payment" value="Apple-Pay" onclick="togglePaymentIndicator()">
                        <label for="sepa">Apple Pay</label><br>
                    </div>
                </div>';

                if ($userData !== null && isset($userData['date_of_birth'])) {
                    $dateOfBirth = new DateTime($userData['date_of_birth']);
                    $today = new DateTime();
                    
                    // Calculate the difference in years
                    $age = $today->diff($dateOfBirth)->y;
                
                    // Check if the user's age meets the requirement
                    if ($_SESSION['minAge'] <= $age) {
                        // Display the booking form if the user's age meets the requirement
                        echo '<div class="b-button-container">
                            <p class="error-message" style="color: red; text-align: center; display: none;">Bitte füllen Sie alle erforderlichen Felder aus.</p>
                            <form action="" method="post">
                                <button class="buchungs-button" type="submit" name="booking_submit">Jetzt buchen</button>
                            </form>
                        </div>';
                    } else {
                        // Display a message indicating that the user does not meet the minimum age requirement
                        echo '<p>Sie erfüllen nicht das Mindestalter für dieses Auto. <a href="Produktübersicht.php" style="text-decoration: underline; color: blue;">Zurück zu Produktübersicht</a></p>';
                    }
                } else {
                    // Handle case where date of birth is missing or invalid
                    echo '<p>Birthdate information missing or invalid. <a href="Produktübersicht.php" style="text-decoration: underline; color: blue;">Zurück zu Produktübersicht</a></p>';
                }

            echo'
            </div>
            <script src="booking.js"></script>

            </div>
            <script src="booking.js"></script>';
    }else{

       echo' <div class="booking-container">
                <div class="element" id="datum">
                    <h3>Datum<span class="indicator" id="indicator"></span></h3>
                    <div class="date-inputs">
                        <label for="from-date">Von:</label>
                        <div class="input-container">
                            <input type="date" id="from-date" name="from-date">
                        </div>
                        <label for="to-date">Bis:</label>
                        <div class="input-container">
                            <input type="date" id="to-date" name="to-date">
                        </div>
                    </div>
                </div>            
                        
                <div class="element" id="modell">
                    <!-- Element für Modell und Sonderwunsch -->
                    <h3>Auswahl bestätigen<span class="indicator" id="confirm-indicator"></span></h3>
                    <p>Ausgewähltes Modell: [Hier Modell anzeigen]</p>
                    <textarea class="additional-request" placeholder="Sonderwunsch"></textarea>
                    <button class="confirm-button" id="confirm-button">Bestätigen</button>
                </div>

                <div class="element" id="login-daten">
                    <!-- Element für Login-Daten -->
                    <div class="login-data">
                        <h3>Rechnungsadresse<span class="indicator" id="rechnungsadresse-indicator"></span></h3>
                        <p>Max Mustermann</p>
                        <p>Adresse blabla 56789 Hamburg</p>
                        <p>mustermax@gmail.com</p>
                        <button class="confirm-button" onclick="toggleIndicator()">Login-Daten verwenden</button>
                        <!-- Andere Inhalte -->
                    </div>
                </div>

                <div class="element" id="zahlungsmethode">
                    <!-- Element für Zahlungsmethode -->
                    <h3>Zahlungsmethode wählen<span class="indicator" id="zahlungsmethode-indicator"></span></h3>
                    <div class="payment-options">
                        <input type="radio" id="paypal" name="payment" value="paypal" onclick="togglePaymentIndicator()">
                        <label for="paypal">PayPal</label><br>
                        <input type="radio" id="kreditkarte" name="payment" value="kreditkarte" onclick="togglePaymentIndicator()">
                        <label for="kreditkarte">Kreditkarte</label><br>
                        <input type="radio" id="klarna" name="payment" value="klarna" onclick="togglePaymentIndicator()">
                        <label for="klarna">Klarna</label><br>
                        <input type="radio" id="sepa" name="payment" value="sepa" onclick="togglePaymentIndicator()">
                        <label for="sepa">SEPA-Lastschrift</label><br>
                    </div>
                </div>
                <div class="b-button-container">
                    <p class="error-message" style="color: red; text-align: center; display: none;">Bitte füllen Sie alle erforderlichen Felder aus.</p>
                    <form action="" method="post">
                        <button class="buchungs-button" type="submit" name="booking_submit">Jetzt buchen</button>
                    </form>
                </div>

            </div>
            <script src="booking.js"></script>';
    }
    ?>

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
        <script src="booking.js"></script>';
    </div>
</body>
</html>
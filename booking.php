<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('process_form.php');
    require_once('config_session.inc.php');
    require_once('process_form.php');    
    debugSession();
    print_r($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['vehicle_id'])) {
            $vehicle_id = $_POST['vehicle_id'];

            echo "<script>";
            echo "console.log('ID:', " . json_encode($vehicle_id) . ");";
            echo "</script>";
            header("Location: booking.php");
            // Verwende $vehicle_id in der weiteren Verarbeitung oder speichere es in einer Session
            // Beispiel für das Speichern in einer Session:
            $_SESSION['vehicle_id'] = $vehicle_id;
        }
    }
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

?>

<?php
    $userData = getUserData($conn);
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
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

    <?php
    if (isset($_SESSION["user_id"])){
        echo' <div class="booking-container">
                <div class="element" id="datum">
                    <h3>Datum<span class="indicator" id="indicator"></span></h3>
                    <div class="date-inputs">
                        ' . $_SESSION["start_date"] . '
                        <p> bis </p>
                        ' . $_SESSION["end_date"] . '
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
                <!-- Element for Login-Daten -->
                    <div class="login-data">
                        <h3>Rechnungsadresse<span class="indicator" id="rechnungsadresse-indicator"></span></h3>
                        <p>' . $userData["firstname"] . ' ' . $userData["lastname"] . '</p>
                        <p>' . $userData["straße"] . ' ' . $userData["hausnummer"] . '</p>
                        <p>' . $userData["postleitzahl"] . ' ' . $userData["username"] . '</p>
                        <button class="confirm-button" onclick="toggleIndicator()">Login-Daten verwenden</button>
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
</body>
</html>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('phpIndexFiles/db_connect.php');
    require_once('phpIndexFiles/config_session.inc.php');
    require_once('phpIndexFiles/signup_view.inc.php');
    require_once('phpIndexFiles/login_view.inc.php');
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">
    <title>RentEasee Anmeldung</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <!--FIXED:Font awesome link anpassen dieser geht nicht mehr-->
    <!--Das hier ist der neue Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="jsAndStyles/RegistrierungStyle.css"/>
</head>
<body>
    <header>
        <div class="header">
            <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
            <div class="separator"></div>
            <p>Willkommen bei RentEase!</p>
        </div>
    </header>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="phpIndexFiles/signup.inc.php" method="post">
                <h1>Konto Erstellen</h1>
                <!-- Anpassen and die Anforderung aus dem Arbeitsauftrage. Neue felder dafür hinzufügen-->
                <!-- Last name, Firstname, Adress(split? Straße, HN, Plz, Ort?), Date of Birth, Email, Password-->
                <div style="display: flex; justify-content: space-between;">
                    <input type="text" placeholder="Vorname" style="width: 48%;" name="First Name"/> <!-- Added field for Postleitzahl -->
                    <input type="text" placeholder="Nachname" style="width: 48%;" name="Last Name"/> <!-- Added field for Hausnummer -->
                </div>
                <input type="text" placeholder="Username" name="Username"/>
                <input type="text" placeholder="Straße" name="Straße"/>
                <div style="display: flex; justify-content: space-between;">
                    <input type="text" placeholder="Plz, Ort" name="Postleitzahl" style="width: 54%;"/> <!-- Added field for Postleitzahl -->
                    <input type="text" placeholder="Hausnummer" name="Hausnummer" style="width: 44%;"/> <!-- Added field for Hausnummer -->
                </div>
                <input type="date" placeholder="Geburtsdatum" name="Date"/>
                <input type="email" placeholder="Email" name="Email"/>
                <input type="password" placeholder="Password" name="Password"/>
                <button>Sign Up</button>
            </form>
            <div class="singup-errors">
                <?php
                    check_singup_errors();
                ?>
            </div>
        </div>
        <div class="form-container sign-in-container">
            <form action="phpIndexFiles/login.inc.php" method="post">
                <h1>Sign in</h1>
                <input type="text" placeholder="Username" name="User" />
                <input type="password" placeholder="Password" name="Password" />
                <a href="#">Passowrd Vergessen?</a>
                <button>Sign In</button>
            </form>
            <div class="login-errors">
                <?php
                        check_login_errors();
                ?>
            </div>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Willkommen Zurück!</h1>
                    <p>Falls Sie bereits einen Account haben, melden Sie sich hier an</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Herzlich Willkommen!</h1>
                    <p>Erstelle ein Konto bei uns, um deine RentEase Experience zu starten</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-container">
        <div class="footer">
        <div class="footer-heading footer-1">
            <h2>Über Uns</h2>
            <a href="AGB.php">AGB</a>
            <a href="#">Blog</a>
            <a href="#">Kunden</a>
            <a href="Datenschutz.php">Datenschutz</a>
        </div>

        <div class="footer-heading footer-2">
            <h2>Kontaktiere Uns</h2>
            <a href="#">Jobs</a>
            <a href="mailto:Contact@rentease.de">Kontakt</a>
            <a href="Impressum.php">Impressum</a>
            <a href="#">Kundenservice</a>
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
            <h2>Bleibe auf dem Laufenden!</h2>
            <form>
                <div class="input-container">
                <input
                    type="email"
                    placeholder="Deine E-Mail"
                    id="footer-email"
                />
                <input type="submit" value="Bestätigen" id="footer-email-button" />
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
        <script src="jsAndStyles/Registrierung.js"></script>
    </div>
</body>
</html>
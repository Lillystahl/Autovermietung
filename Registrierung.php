<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="Style_Registrierung.css">
    <link rel="stylesheet" href="Templates/HeaderAndFooterStyles.css">


</head>
<body>
    <header>
        <div class="header">
            <a href="#" class="logo"><img src="Images/logo-white.png"></a>
            <div class="header-right">
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search..." name="search">
                    </form>
                </div>
                <button class="Buchung-button">Meine Buchungen</button>
                <button class="Login-button">LogIn</button>
            </div>
        </div>
        <!-- Die Class "main Heading" nutzen um ein Menü für den User zu erstellen mit bspw. buttons Ein Auto Mieten, Einen Transporter mieten, Firmenkunden, Standorte, Aktionen,...." -->
        <!-- Christian: maybe can man die navbar reactiv machen mit einem dropdown sodass die dann ausfährt von  oben-->
        <!--
            <div class="navbar">
                <h1><span id="header1">Standorte</span></h1>
                <h1><span id="header2">Fahrzeuge</span></h1>
                <h1><span id="header3">Top-Deals</span></h1>
                <h1><span id="header4">Geschäftskunden</span></h1>
            </div>-->
    </header>
    <!DOCTYPE html>
<html lang="de">

<body>
  <div class= background-img>
    <img src="images/Audi.jpg" alt="Beamer" >
    <div class="registration-container">
      <h2>Registrierung</h2>
        <form method="post">
            <label for="first_name">Vorname:</label>
            <input type="text" id="name" name="first_name" required><br>

            <label for="last_name">Nachname:</label>
            <input type="text" id="name" name="last_name" required><br>

            <label for="email">E-Mail:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="birthdate">Geburtsdatum:</label>
            <input type="date" id="birthdate" name="birthdate" required><br>

            <label for="address">Anschrift:</label>
            <textarea id="address" name="address" rows="4" required></textarea><br>

            <label for="postal_code">Postleitzahl:</label>
            <input type="text" id="postal_code" name="postal_code" required><br>

            <label for="Agreement">I agree with the terms</label>
            <input type="checkbox" class="toggle" id="Agreement" name="postal_code" required><br>

            <input type="submit" value="Registrieren">
        </form>
    </div>
  </div>
</body>

</html>

    <div class="footer-container";>
        <div class="footer";>
            <div class="footer-heading footer-1">
                <h2>About Us</h2>
                <a href="#">Blog</a>
                <a href="#">Demo</a>
                <a href="#">Customers</a>
                <a href="#">Investors</a>
                <a href="#">Terms of Service</a>
                <a href="#">Projects</a>
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
                <a href="#">Instagram</a>
                <a href="#">FaceBook</a>
                <a href="#">Twitter</a>
                <a href="#">LinkedIn</a>
            </div>
            <div class="footer-email-form">
                <h2>Join our Newsletter</h2>
                <input type="email" placeholer="Enter your E-Mail adress" id="footer-email">
                <input type="submit" value="Sign Up" id="footer-email-button">
            </div>
        </div>
    </div>
</body>
</html>

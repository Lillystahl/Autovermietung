<?php
    require_once('db_connect.php');
    require_once('config_session.inc.php');
    require_once('process_form.php');
    inputToSession('filterbar-submit');
    debugSession();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to RentEase</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <link rel="stylesheet" href="jsAndStyles/homeStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>

<body>
    
    <!-- im header php function if block, der die session checkt und header anpasst
    block 1: header if session
    blokc 2: default header -->
    <header>
    <?php
        if(isset($_SESSION["user_id"])){
            echo '<div class="header">
                        <div class="header-left">
                            <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                            <h1><a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a></h1>
                            <h1><a id="header2">Standorte</a></h1>
                            <h1><a id="header3">Über uns</a></h1>
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
                                    <li><a href="logout.inc.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
        }else{
            echo'<div class="header">
            <div class="header-left">
                <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                <h1>
                    <a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a>
                </h1>
                <h1><a id="header2">Standorte</a></h1>
                <h1><a id="header3">Über uns</a></h1>
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

    <!-- Hier müsste noch das video rein @Leon -->
    <div class="slideContainer">
        <div class="slide">
            <div class="item" style="background-image: url(Images/mb-e300-home.png)">
                <div class="content">
                    <div class="name">Unser Service</div>
                    <div class="des">
                        Unser Service, deine Mobilität. Losfahren, wohin du willst.
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/bmw-i8-home.png)">
                <div class="content">
                    <div class="name">Fuhrpark</div>
                    <div class="des">
                        Entdecken Sie unsere vielseitige Flotte.
                    </div>
                    <a href="Produktübersicht.php"><button>Entdecken</button></a>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/maserati-home.png)">
                <div class="content">
                    <div class="name">Standorte</div>
                    <div class="des">
                        Finde deinen passenden Standort!
                    </div>
                </div>
            </div>
        </div>
        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

        <div class="barcontainer">
            <div class="search-bar">
                <h2>Fahrzeug mieten</h2>
                <form action="" method="POST"> <!-- Sends data to 'process_form.php' via POST method -->
                    <div class="searchbar-inner">
                        <div class="standort-filter-item">
                            <label for="standortDropdown" class="filter-label">Standort:</label>
                            <select id="standortDropdown" name="standort-location" class="input-long standort-input-long">
                                <option value="" selected disabled hidden>Standort</option>
                                <option value="" <?php echo ($_SESSION['location'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                                <?php
                                    $locations = [
                                        "Berlin", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg",
                                        "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"
                                    ];
                                    foreach ($locations as $location) {
                                        $selected = ($_SESSION['location'] ?? '') === $location ? 'selected' : '';
                                        echo "<option value='$location' $selected>$location</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="vehicle-type-filter-item">
                            <label for="vehicleTypeDropdown" class="filter-label">Fahrzeugtyp:</label>
                            <select id="vehicleTypeDropdown" name="Fahrzeugtyp" class="input-long vehicle-type-dropdown">
                                <option value="" selected disabled hidden>Fahrzeugtyp</option>
                                <option value="" <?php echo ($_SESSION['vehicle_type'] ?? '') === '' ? 'selected' : ''; ?>>----</option>
                                <?php
                                    $vehicleTypeOptions = [
                                        "Cabrio", "SUV", "Limousine", "Combi", "Mehrsitzer", "Coupe"
                                    ]; // Adjust this array to contain your desired vehicle types

                                    foreach ($vehicleTypeOptions as $vehicleType) {
                                        $selected = ($_SESSION['vehicle_type'] ?? '') === $vehicleType ? 'selected' : '';
                                        echo "<option value='$vehicleType' $selected>$vehicleType</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="date" placeholder="Start-Datum" name="start-date" />
                        <input type="date" placeholder="End-Datum" name="end-date" />
                        <button type="submit" name="filterbar-submit">Suchen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h1 class="headline">Finde deinen Favoriten</h1>
    <div class="card-container">
        <div class="card-wrapper">
            <div class="card-product">
                <a href="Produktübersicht.php?category=Cabrio">
                    <img src="Images/cabrio.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Cabrio</h2>
                        <p>
                            <strong>Freiheit</strong> auf vier Rädern mit offenem Himmel.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php?category=SUV">
                    <img src="Images/SUV.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>SUV</h2>
                        <p>
                            Robust, geräumig und bereit für jedes <strong>Abenteuer</strong>.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php?category=Limousine">
                    <img src="Images/Limo.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Limousine</h2>
                        <p>
                            <strong>Eleganz und Komfort</strong> für jede Fahrt.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php?category=Combi">
                    <img src="Images/combi.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Combi</h2>
                        <p>
                            <strong>Flexibel</strong> und geräumig für jede Ladung.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php?category=Mehrsitzer">
                    <img src="Images/mehrsitzer.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Mehrsitzer</h2>
                        <p>
                            <strong>Platz für alle</strong>, ohne Einschränkungen.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php?category=Coupe">
                    <img src="Images/coupe.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Coupé</h2>
                        <p>
                            Stilvolle <strong>Leistung</strong> und sportliches Flair.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <h1 id="standorte" class="headline">Standorte</h1>
    <div class="map-container">
        <div class="map-inside">
            <div class="map-notext">
                <div class="map-marker berlin-marker hover-effect"></div>
                <div class="map-marker bochum-marker hover-effect"></div>
                <div class="map-marker bremen-marker hover-effect"></div>
                <div class="map-marker Dortmund-marker hover-effect"></div>
                <div class="map-marker Dresden-marker hover-effect"></div>
                <div class="map-marker Freiburg-marker hover-effect"></div>
                <div class="map-marker Hamburg-marker hover-effect"></div>
                <div class="map-marker Köln-marker hover-effect"></div>
                <div class="map-marker Leipzig-marker hover-effect"></div>
                <div class="map-marker München-marker hover-effect"></div>
                <div class="map-marker Nürnberg-marker hover-effect"></div>
                <div class="map-marker Paderborn-marker hover-effect"></div>
                <div class="map-marker Rostock-marker hover-effect"></div>
                <div class="map">
                    <img src="Images/blank-map.png" alt="map" />
                </div>
            </div>
            <div class="map-text">
                <h1 class="headline">Unsere Standorte</h1>
                <ul>
                    <li class="city" data-marker="berlin">Berlin</li>
                    <li class="city" data-marker="bochum">Bochum</li>
                    <li class="city" data-marker="bremen">Bremen</li>
                    <li class="city" data-marker="Dortmund">Dortmund</li>
                    <li class="city" data-marker="Dresden">Dresden</li>
                    <li class="city" data-marker="Freiburg">Freiburg</li>
                    <li class="city" data-marker="Hamburg">Hamburg</li>
                    <li class="city" data-marker="Köln">Köln</li>
                    <li class="city" data-marker="Leipzig">Leipzig</li>
                    <li class="city" data-marker="München">München</li>
                    <li class="city" data-marker="Nürnberg">Nürnberg</li>
                    <li class="city" data-marker="Paderborn">Paderborn</li>
                    <li class="city" data-marker="Rostock">Rostock</li>
                </ul>
            </div>
        </div>
    </div>

    <h1 class="headline">Kundenrezensionen</h1>
    <div class="customer-reviews">
        <p class="section-subtitle">Sieh, was unsere Kunden zu uns sagen:</p>
        <div class="review-container">
            <div class="review-card">
                <div class="review-info">
                    <div class="review-details">
                        <div class="name-rating">
                            <img src="Images/CustomerReviews/karanikas.png" alt="Profilbild" class="profile-pic" />
                            <h3 class="customer-name">Linus Karanikas</h3>
                            <div class="rating">
                                <span class="stars" data-rating="5">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                        </div>
                        <p class="review-text">
                           "Großartige Autovermietung! Vielfältige Auswahl, problemlose Abwicklung bei Abholung und Rückgabe. Sehr empfehlenswert für alle!"
                        </p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <div class="review-info">
                    <div class="review-details">
                        <div class="name-rating">
                            <img src="Images/CustomerReviews/kruschke.png" alt="Profilbild" class="profile-pic" />
                            <h3 class="customer-name">Brianna Kruschke</h3>
                            <div class="rating">
                                <span class="stars" data-rating="5">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                        </div>
                        <p class="review-text">
                            "Mein Mietwagen war erstklassig! Hervorragender Service und einwandfreies Fahrzeug. Total zufrieden!"
                        </p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <div class="review-info">
                    <div class="review-details">
                        <div class="name-rating">
                            <img src="Images/CustomerReviews/spiegel.jpg" alt="Profilbild" class="profile-pic" />
                            <h3 class="customer-name">Joshi Spiegel</h3>
                            <div class="rating">
                                <span class="stars" data-rating="4">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                        </div>
                        <p class="review-text">
                        "Sehr gute Autovermietung! Breite Auswahl, reibungsloser Ablauf. Empfehlenswert!"
                        </p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <div class="review-info">
                    <div class="review-details">
                        <div class="name-rating">
                            <img src="Images/CustomerReviews/musk.jpg" alt="Profilbild" class="profile-pic" />
                            <h3 class="customer-name">Elon Musk</h3>
                            <div class="rating">
                                <span class="stars" data-rating="5">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                        </div>
                        <p class="review-text">
                            "Fantastische Erfahrung gemacht! Schnelle Abwicklung, perfektes Auto. Ich komme definitiv wieder zurück!"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h1 id="unternehmen" class="headline">Unser Unternehmen</h1>
    <div class="aboutUs-container">
      <div class="aboutUs">
        <div
          id="map"
          style="width: 30%; height: 400px; border-radius: 5px 0px 5px 0px"
        ></div>
        <script>
          // Creating map options
          var mapOptions = {
            center: [53.547425386544006, 9.987030559633626],
            zoom: 17,
            scrollWheelZoom: false,
          };

          // Creating a map object
          var map = new L.map("map", mapOptions);

          // Creating a Layer object
          var layer = new L.TileLayer(
            "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          );
          // Create a custom icon with a larger size
          var customIcon = L.icon({
            iconUrl: "Images/663342.png", // Replace with your icon image URL
            iconSize: [80, 80], // Adjust the size here, [width, height]
            iconAnchor: [50, 70], // The anchor point of the icon (usually half of the size)
          });

          // Create a marker using the custom icon and add it to the map
          var marker = L.marker([53.547425386544006, 9.987030559633626], {
            icon: customIcon,
          }).addTo(map);

          // Adding layer to the map
          map.addLayer(layer);
        </script>

        <div class="content-box">
        <div class="image-container">
            <img src="Images/Us/leon.png" alt="Bild 1" />
            <img src="Images/Us/christian.jpg" alt="Bild 2" />
            <img src="Images/Us/caro.png" alt="Bild 3" />
            <img src="bild4.jpg" alt="Bild 4" />
            <img src="bild5.jpg" alt="Bild 5" />
        </div>
          <div class="text-content">
            <h2>Das sind wir!</h2>
            <p>
              Willkommen bei RentEase! Wir, fünf engagierte Studierende aus
              Hamburg, haben RentEase als unser Uni-Projekt gestartet. Unsere
              Autovermietung bietet maßgeschneiderte Lösungen für Ihre
              Mobilitätsanforderungen. Von Stadtfahrten bis hin zu
              Familienausflügen und Geschäftsreisen oder Umzügen – wir haben das
              passende Fahrzeug für Sie..
            </p>
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
            <script src="jsAndStyles/home.js"></script>
        </div>
    </div>
</body>
</html>
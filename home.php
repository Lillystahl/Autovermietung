
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('process_form.php');

    processSearchForm($conn); // Make sure this function call is before any HTML content is output
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Website</title>
    <link rel="stylesheet" href="homeStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>

<body>
    <header>
        <div class="header">
            <div class="header-left">
                <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
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
        </div>
    </header>

    <!-- Hier müsste noch das video rein @Leon -->
    <div class="slideContainer">
        <div class="slide">
            <div class="item" style="background-image: url(Images/Mercedes.jpg)">
                <div class="content">
                    <div class="name">Content</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!
                    </div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/lambo.jpg)">
                <div class="content">
                    <div class="name">Content</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!
                    </div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/amgatnight.jpg)">
                <div class="content">
                    <div class="name">Content</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!
                    </div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/bmw\ racing.jpg)">
                <div class="content">
                    <div class="name">Content</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!
                    </div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(Images/sexybmw.jpg)">
                <div class="content">
                    <div class="name">Content</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!
                    </div>
                    <button>See More</button>
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
                        <input type="text" placeholder="Location" name="standort-location" />
                        <input type="text" placeholder="Fahrzeugart" name="vehicle-type" />
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
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Kleinwagen</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Limousinen</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Transporter</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Cabrios</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>Sportwagen</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
            <div class="card-product">
                <a href="Produktübersicht.php">
                    <img src="Images/Ferarri Roma.jpg" alt="Auto" />
                    <div class="card-product-infos">
                        <h2>E-Fahrzeuge</h2>
                        <p>
                            Product description with <strong>relevant info</strong> only.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <h1 class="headline">Standorte</h1>
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
                <h2>Unsere Standorte</h2>
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
                            <img src="Images/customer1.jpg" alt="Profilbild" class="profile-pic" />
                            <h3 class="customer-name">Max Mustermann</h3>
                            <div class="rating">
                                <span class="stars" data-rating="5">&#9733;&#9733;&#9733;&#9733;&#9733;</span
                  >
                </div>
              </div>
              <p class="review-text">
                "Tolle Auswahl an Fahrzeugen und exzellenter Service! Ich bin
                sehr zufrieden."
              </p>
            </div>
          </div>
        </div>
        <div class="review-card">
          <div class="review-info">
            <div class="review-details">
              <div class="name-rating">
                <img
                  src="Images/customer1.jpg"
                  alt="Profilbild"
                  class="profile-pic"
                />
                <h3 class="customer-name">Max Mustermann</h3>
                <div class="rating">
                  <span class="stars" data-rating="5"
                    >&#9733;&#9733;&#9733;&#9733;&#9733;</span
                  >
                </div>
              </div>
              <p class="review-text">
                "Tolle Auswahl an Fahrzeugen und exzellenter Service! Ich bin
                sehr zufrieden."
              </p>
            </div>
          </div>
        </div>
        <div class="review-card">
          <div class="review-info">
            <div class="review-details">
              <div class="name-rating">
                <img
                  src="Images/customer1.jpg"
                  alt="Profilbild"
                  class="profile-pic"
                />
                <h3 class="customer-name">Max Mustermann</h3>
                <div class="rating">
                  <span class="stars" data-rating="5"
                    >&#9733;&#9733;&#9733;&#9733;&#9733;</span
                  >
                </div>
              </div>
              <p class="review-text">
                "Tolle Auswahl an Fahrzeugen und exzellenter Service! Ich bin
                sehr zufrieden."
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h1 class="headline">Unser Unternehmen</h1>
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
            "http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png"
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
            <img src="Images/Mercedes.jpg" alt="Image" class="box-image" />
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
            <script src="home.js"></script>
        </div>
    </div>
</body>
</html>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('config_session.inc.php');
?>

<!DOCTYPE html>
<html lang="de">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website</title>
  <link rel="stylesheet" href="homeStyle.css">
  <link rel="stylesheet" href="MyBookingsStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <script type="text/javascript">
    function showHideRow(row) {
      $("#" + row).toggle();
    }
  </script>
</head>

<body>
  <header>
  <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                        <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
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
        </div>';
    }
    ?>
  </header>

  <div class="img-container">
      <div class="content">

    <div class="booking-container">
      <h1>My Bookings</h1>
      <table>
        <thead>
          <tr id="header_first_row">
            <th>Startdatum</th>
            <th>Enddatum</th>
            <th>Gebuchtes Auto</th>
            <th>Datum der Buchung</th>
          </tr>
        </thead>
        <tbody>
          <tr onclick="showHideRow('hidden_row1');">
            <td>2024-02-15</td>
            <td>2024-02-20</td>
            <td>BMW X3</td>
            <td>2024-01-25</td>
          </tr>

          <tr id="hidden_row1" class="hidden_row">
            <td class="tableDateFull" colspan="6">
              <div class="further_Infos">

                <!-- <div class="paket">
                  <div class="more_Info"> Weitere Informationen</div>
                </div> -->

                <div class="paket">
                  <div class="details"><strong>Buchungsnummer:</strong></div>
                  <div class="details"> 12345 </div>
                </div>
                <div class="paket">
                  <div class="details"><strong>Standort:</strong> </div>
                  <div class="details"> Hamburg</div>
                </div>
                <div class="paket">
                  <div class="details"><strong> Baujahr: </strong> </div>
                  <div class="details"> 2018 </div>
                </div>
                <div class="paket">
                  <div class="details"><strong> Preis:</strong></div>
                  <div class="details"> 300€ </div>
                </div>
              </div>
            </td>
          </tr>

          <tr onclick="showHideRow('hidden_row2');">
            <td>2024-02-15</td>
            <td>2024-02-20</td>
            <td>BMW X3</td>
            <td>2024-01-25</td>
          </tr>

          <tr id="hidden_row2" class="hidden_row">
            <td class="tableDateFull" colspan="6">
              <div class="further_Infos">

                <!--<div class="paket">
                  <div class="more_Info"> Weitere Informationen</div>
                </div> -->

                <div class="paket">
                  <div class="details"><strong>Buchungsnummer:</strong></div>
                  <div class="details"> 12345 </div>
                </div>

                <div class="paket">
                  <div class="details"><strong>Standort:</strong> </div>
                  <div class="details"> Hamburg</div>
                </div>

                <div class="paket">
                  <div class="details"><strong> Baujahr: </strong> </div>
                  <div class="details"> 2018 </div>
                </div>

                <div class="paket">
                  <div class="details"><strong> Preis:</strong></div>
                  <div class="details"> 300€ </div>
                </div>
              </div>
            </td>
          </tr>


          <tr onclick="showHideRow('hidden_row3');">
            <td>2024-02-15</td>
            <td>2024-02-20</td>
            <td>BMW X3</td>
            <td>2024-01-25</td>
          </tr>

          <tr id="hidden_row3" class="hidden_row">
            <td class="tableDateFull" colspan="6">
              <div class="further_Infos">

                <!-- <div class="paket">
                  <div class="more_Info"> Weitere Informationen</div>
                </div> -->

                <div class="paket">
                  <div class="details"><strong>Buchungsnummer:</strong></div>
                  <div class="details"> 12345 </div>
                </div>

                <div class="paket">
                  <div class="details"><strong>Standort:</strong> </div>
                  <div class="details"> Hamburg</div>
                </div>

                <div class="paket">
                  <div class="details"><strong> Baujahr: </strong> </div>
                  <div class="details"> 2018 </div>
                </div>

                <div class="paket">
                  <div class="details"><strong> Preis:</strong></div>
                  <div class="details"> 300€ </div>
                </div>
              </div>
            </td>
          </tr>
          <!-- Weitere Buchungen können hier hinzugefügt werden -->
        </tbody>
      </table>
    </div>
  </div>

</div>


<div class="footer-container">
  <div class="footer">
  <div class="footer-heading footer-1">
      <h2>About Us</h2>
      <a href="#">Blog</a>
      <a href="#">Kunden</a>
      <a href="Datenschutz.php">Datenschutz</a>
      <a href="AGB.php">AGB</a>
      <a href="Impressum.php">Impressum</a>
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
<body>
</html>

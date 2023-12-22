<?php
    require_once('db_connect.php');
    require_once('config_session.inc.php');

    function getUserBookings($conn, $page, $perPage) {
      // Start and limit calculation for pagination
      $start = ($page - 1) * $perPage;
      $userID = $_SESSION["user_id"];

      // SQL statement to fetch user bookings with pagination
      $sql = "SELECT booking_id, date_booking, start_date, end_date, location_name, vehicle_price, type_name, vendor_name_abbr, img_file_name 
              FROM booking 
              LEFT JOIN cartablesview ON booking.vehicle_id = cartablesview.vehicle_id
              WHERE user_id = :user_id 
              ORDER BY date_booking DESC 
              LIMIT :start, :perPage";
  
      // Prepare the statement
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':user_id', $userID);
      $stmt->bindParam(':start', $start, PDO::PARAM_INT);
      $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
      
      // Execute the statement
      $stmt->execute();
  
      // Fetch all rows as an associative array
      $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      return $bookings;
  }

  function countUserBookings($conn) {
    $userID = $_SESSION["user_id"];
    
    // SQL statement to count user bookings
    $sql = "SELECT COUNT(*) 
            FROM booking 
            WHERE user_id = :user_id";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userID);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the count
    $count = $stmt->fetchColumn();
    
    return $count;
}

  function displayBookings($bookings) {
    foreach ($bookings as $booking) {
        // Convert English date format to German date format
        $start_date = date("d.m.Y", strtotime($booking['start_date']));
        $end_date = date("d.m.Y", strtotime($booking['end_date']));
        $date_booking = date("d.m.Y", strtotime($booking['date_booking']));

        echo "<tr onclick=\"showHideRow('hidden_row{$booking['booking_id']}');\">";
        echo "<td>{$start_date}</td>";
        echo "<td>{$end_date}</td>";
        echo "<td>{$booking['vendor_name_abbr']} {$booking['type_name']}</td>";
        echo "<td>{$date_booking}</td>";
        echo "</tr>";

        // Hidden rows for detailed information
        echo "<tr id='hidden_row{$booking['booking_id']}' class='hidden_row'>";
        echo "<td class='tableDateFull' colspan='6'>";
        echo "<div class='further_Infos'>";
        // Display more details here
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ihre Buchungen</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="MyBookingsStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="confirmation.js"></script>
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
              <!-- Add more headers if needed -->
            </tr>
          </thead>
          <tbody>
            <?php
              // Loop through the fetched bookings and display them in the table rows
              $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $bookingsPerPage = 7;
              $result = getUserBookings($conn, $currentPage, $bookingsPerPage);
              $totalBookings = countUserBookings($conn);
              displayBookings($result);

              echo '<div class="pagination">';
              for ($i = 1; $i <= ceil($totalBookings / $bookingsPerPage); $i++) {
                  $activeClass = ($currentPage == $i) ? 'active' : '';
                  echo '<a href="MyBookings.php?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
              }
              echo '</div>';
            ?>
            <!-- More bookings can be added here -->
          </tbody>
        </table>
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

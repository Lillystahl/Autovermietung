<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('db_connect.php');
    require_once('process_form.php');
    require_once('config_session.inc.php');
    debugSession();
    var_dump($_POST);

    // Assuming 'fetchCarsFromSession' returns the array of cars fetched from the session
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="ProduktübersichtStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Produktübersicht.js" defer></script>
</head>

<body>
<header>
    <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                    <a  href="home.php" class="logo" id="logoLink"> <img src="Images/ImageRE.png" alt="Company Logo" /> </a>
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

    <div class="product-barcontainer">
        <div class="advanced-search-bar-top">
            <h2>Fahrzeug mieten</h2>
            <form action="" method="POST">
                <div class="searchbar-inner">
                    <input type="text" placeholder="<?php echo isset($_SESSION['location']) ? $_SESSION['location'] : 'Standort'; ?>" name="location" value="<?php echo isset($_SESSION['location']) ? $_SESSION['location'] : ''; ?>">
                    <input type="text" placeholder="<?php echo isset($_SESSION['vehicle_type']) ? $_SESSION['vehicle_type'] : 'Kategorie'; ?>" name="vehicle-type" value="<?php echo isset($_SESSION['vehicle_type']) ? $_SESSION['vehicle_type'] : ''; ?>">
                    <input type="date" placeholder="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : 'start-date'; ?>" name="start-date" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>">
                    <input type="date" placeholder="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : 'end-date'; ?>" name="end-date" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>">
                    <button type="submit" name="filterbar1-submit">Suchen</button>
                    <button type="submit" id="resetSearchButton">Suche zurücksetzen</button>
                </div>
            </form>
        </div>
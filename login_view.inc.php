<?php

declare(strict_types=1);

function check_login_errors()
{
    if(isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo"<br>";

        foreach($errors as $error){
            echo'<p class="error">' . $error . '</php>';
        }



        unset($_SESSION["errors_login"]);
    }else if(isset($_GET['login']) && $_GET['login'] === "success"){

    }
}

function output_username(){
    if(isset($_SESSION["user_id"])){
        echo "You are logged in as" .$_SESSION["user_username"];
    }else{
        $timestamp = $_SESSION["last_regeneration"];
        $current_time = time(); // Current UNIX timestamp
        $time_difference = $current_time - $timestamp;
        // Convert the difference into days, hours, minutes, etc.
        $days = floor($time_difference / (60 * 60 * 24));
        $hours = floor(($time_difference % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($time_difference % (60 * 60)) / 60);
        $seconds = $time_difference % 60;

        echo "Last regeneration was $days days, $hours hours, $minutes minutes, and $seconds seconds ago.";
        echo '<script> console.log("Last regeneration was '.$days.' days, '.$hours.' hours, '.$minutes.' minutes, and '.$seconds.' seconds ago."); </script>';
        echo '<script> console.log("This:'.$_SESSION["user_id"].'"); </script>';
        echo '<script> console.log("This:'.$_SESSION["user_username"].'"); </script>';
        echo "you are not logged in";

    }
}


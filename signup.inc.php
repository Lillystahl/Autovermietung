<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["Username"];
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $straße = $_POST["Straße"];
    $postleitzahl = $_POST["Postleitzahl"];
    $hausnummer = $_POST["Hausnummer"];
    $date = $_POST["Date"];
    $email = $_POST["Email"]; 
    $pwd = $_POST["Password"];

    try {
    
        require_once ('db_connect.php');
        require_once ('signup_model.inc.php');
        require_once ('signup_contr.inc.php');

        // Error handling 
        $errors = [];

        if(is_input_empty($username, $firstName, $lastName,  $straße, $postleitzahl, $hausnummer, $date, $email, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }
        
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email";    
        }

        if(is_username_taken($conn, $username)){
            $errors["username_exists"] = "Username already exists";    
        }

        if(is_email_registered($conn,$email)){ 
            $errors["email_duplicate"] = "Email already exists";   
        }

        require_once ('config_session.inc.php');

        if ($errors) {
            $_SESSION["errors_singup"] = $errors;
            header("Location: Registrierung.php");
            die();
        }

        create_user($conn, $username, $firstName, $lastName, $straße, $postleitzahl, $hausnummer, $date, $email, $pwd);

        header("Location: Registrierung.php?signup=success");
        die();
        
        $conn = null;
        $stmt = null;

    } catch (PDOException $e) {
        // Outputting error information for debugging purposes
        echo "Query failed: " . $e->getMessage(); // The error message itself
        echo "Error code: " . $e->getCode(); // The error code
        echo "Trace: " . $e->getTraceAsString(); // The trace of the error
    }
}else{
    header("Location: Registrierung.php");
    die();
}

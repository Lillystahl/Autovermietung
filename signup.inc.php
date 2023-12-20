<?php

// set method to handle user inputs
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["Username"];
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $straße = $_POST["Straße"];
    $postleitzahlOrt = $_POST["Postleitzahl"]; // Get the combined value
    $hausnummer = intval($_POST['Hausnummer']); //html treats all form inputs as string, hence string to int conversion is needed
    $date = $_POST["Date"];
    $email = $_POST["Email"]; 
    $pwd = $_POST["Password"];

    // Separate Postleitzahl and Ort
    list($postleitzahl, $ort) = preg_split('/,\s*/', $postleitzahlOrt, 2);

    // Trim whitespace from the separated values
    $postleitzahl = intval(trim($postleitzahl));
    $ort = trim($ort);

    try {
        // access our vmc files and db connect to get functions or objects we build there
        require_once ('db_connect.php');
        require_once ('signup_model.inc.php');
        require_once ('signup_contr.inc.php');

        // Error handling 
        $errors = [];
        //empty fields
        if(is_input_empty($username, $firstName, $lastName, $straße, $postleitzahl, $hausnummer, $date, $email, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }
        //email invalid input, for example no @sign
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email";    
        }
        //username is already in use with other account
        if(is_username_taken($conn, $username)){
            $errors["username_exists"] = "Username already exists";    
        }
        //email is already in use with other account
        if(is_email_registered($conn,$email)){ 
            $errors["email_duplicate"] = "Email already exists";   
        }
        // access our sesssion config 
        require_once ('config_session.inc.php');
        // redirect if errors array elemts exist 
        if ($errors) {
            $_SESSION["errors_singup"] = $errors;
            header("Location: Registrierung.php");
            die();
        }
        // create useer if no error handling
        create_user($conn, $username, $firstName, $lastName, $straße, $postleitzahl, $hausnummer, $date, $email, $pwd);
        // reedirect to page we want the user to start at, idealy home
        header("Location: Registrierung.php?signup=success");

        // empty conn and stmt manually for good measures
        $conn = null;
        $stmt = null;
        //kill the try block
        die();
        
    } catch (PDOException $e) {
        // Outputting error information for debugging purposes
        echo "Query failed: " . $e->getMessage(); // The error message itself
        echo "Error code: " . $e->getCode(); // The error code
        echo "Trace: " . $e->getTraceAsString(); // The trace of the error
    }
}else{
    //if the input was not give via post we redirect here
    header("Location: Registrierung.php");
    die();
}

<?php
// need to start session so that all session variables are set
    session_start();

    // retrieve user login info via post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["User"];
    $pwd = $_POST["Password"];

    try{
        // access our vmc files and db connect to get functions or objects we build there
        require_once ('db_connect.php');
        require_once ('login_model.inc.php');
        require_once ('login_contr.inc.php');

        // Error handling 
        $errors = []; 
        // empty inputs by the user
        if(is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }
        // get the result array for the user
        // get it here because when input empty is not called need to check for other stuff below
        $result = get_user($conn, $username);

        // check for incorrect username
        // Note: We do not tell user which of the parameters were incorrect for security reasons!
        // for example if we give clue for if the password or user is incorrect brute forcing gets easier!
        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        //checks if the username is correct but the password is wrong 
        // we turn around the userfunction wiht ! is not and then check for the password
        if(!is_username_wrong($result) &&  is_password_wrong($pwd, $result["password"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        // access session config 
        require_once ('config_session.inc.php');
        // check for elemts in errors array and redirect
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: Registrierung.php");
            die();
        }

        // create a session based on the user that logged in
        $newSessionId = session_create_id();
        // create a session id for the user bny appending the user id to the sessionid
        $sessionId = $newSessionId. "_" .$result["user_id"];
        // pass the variable to the session_id function
        session_id($sessionId);

        // set session variables for the session based on the user
        // we get this from the reuslt array
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]); //prevent crosssitescripting
        $_SESSION["last_regeneration"] = time();
     
        // redirect to start page we want the user to land at after login
       header("Location: Registrierung.php?login=success");
        
       // empty conn and stmt for good measures (this is done by the programm but good practice to do it here)
        $conn = null;
        $stmt = null;

        // KILL THE FUNCTION
        die();

    }catch (PDOException $e) {
        // Outputting error information for debugging purposes
         die("Query failed: " . $e->getMessage());
         die("Error code: " . $e->getCode()); // The error code
         die("Trace: " . $e->getTraceAsString()); // The trace of the error
    }
}else{
    //if the input was not give via post we redirect here
    header("Location: Registrierung.php");
    die();
}

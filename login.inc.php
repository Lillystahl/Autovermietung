<?php
    session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["User"];
    $pwd = $_POST["Password"];

    try{
        require_once ('db_connect.php');
        require_once ('login_model.inc.php');
        require_once ('login_contr.inc.php');

        // Error handling 
        $errors = []; 

        if(is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }

        $result = get_user($conn, $username);


        // Output the content of $result
        echo "<pre>";
        var_dump($result); // or print_r($result);
        echo "</pre>";

        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Login info is incorrect!";
        }

        if(is_username_wrong($result) &&  is_password_wrong($pwd, $result["password"]))

        require_once ('config_session.inc.php');

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: Registrierung.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId. "_" .$result["user_id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]); //prevent crosssitescripting
        $_SESSION["last_regeneration"] = time();
     
        header("Location: Registrierung.php?login=success");
        
        $conn = null;
        $stmt = null;

        die();

    }catch (PDOException $e) {
        // Outputting error information for debugging purposes
         die("Query failed: " . $e->getMessage());
         die("Error code: " . $e->getCode()); // The error code
         die("Trace: " . $e->getTraceAsString()); // The trace of the error
    }
}else{
    header("Location: Registrierung.php");
    die();
}

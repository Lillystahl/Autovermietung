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
        // Leere Eingaben des Benutzers
        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fülle alle Felder aus";
        }
        // Ergebnis-Array für den Benutzer abrufen
        // Hier abrufen, da wir andere Überprüfungen durchführen müssen, wenn 'is_input_empty' nicht aufgerufen wird
        $result = get_user($conn, $username);

        // Überprüfung auf falschen Benutzernamen
        // Hinweis: Wir geben dem Benutzer aus Sicherheitsgründen keine Hinweise darauf, welche Parameter falsch sind!
        // Wenn wir Hinweise darauf geben würden, ob das Passwort oder der Benutzername falsch ist, würde das Brute-Force-Angriffe erleichtern!
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Falsche Anmeldedaten";
        }
        // Überprüft, ob der Benutzername korrekt ist, aber das Passwort falsch ist
        // Wir verwenden !is_username_wrong($result), um zu prüfen, ob der Benutzername nicht falsch ist, und überprüfen dann das Passwort
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["password"])) {
            $errors["login_incorrect"] = "Falsche Anmeldedaten";
        }
        // Zugriff auf die Session-Konfiguration
        require_once('config_session.inc.php');
        // Überprüfen, ob Elemente im Fehler-Array vorhanden sind und umleiten
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../Registrierung.php");
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
     
        // redirect to page we want the user to land at after login (homepage)
        //send info to url which indicates a successfull login
       header("Location: ../home.php?login=success");
        
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
    header("Location: ../Registrierung.php");
    die();
}

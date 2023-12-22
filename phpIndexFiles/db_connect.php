<?php
    $servername = "localhost";
    $user = "admin";
    $password = "password";
    $dbname = "autovermietung";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $password);
        // set the PDO error mode to exception (see https://www.php.net/manual/de/pdo.setattribute.php)
        //attributes (several possible) define how database connection behaves; here: in case of error throw an exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //give feedback of successful connection
        // echo "<br>" . "Connected successfully" . "<br>";
        echo '<script> console.log("Connected successfully"); </script>';
    } catch(PDOException $e) {
        echo '<script> console.log("Error: ' . $e->getMessage() . '"); </script>';
    }
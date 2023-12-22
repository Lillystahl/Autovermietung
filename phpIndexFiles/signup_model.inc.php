<?php

declare(strict_types=1);

function get_username(object $conn, string $username)
{
    $query = "SELECT username FROM user WHERE username =:username;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;


}

function get_email(object $conn, string $email)
{
    $query = "SELECT username FROM user WHERE email_address =:email;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;


}

function set_user(object $conn, string $username, string $firstName, string $lastName, string $straße, int $postleitzahl, string $ort, int $hausnummer, string $date, string $email, string $pwd) {
    // Fetch plz_id based on plz and ort
    $plzQuery = "SELECT plz_id FROM postleitzahlen WHERE plz = :plz AND ort = :ort";
    $plzStmt = $conn->prepare($plzQuery);
    $plzStmt->bindParam(":plz", $postleitzahl);
    $plzStmt->bindParam(":ort", $ort);
    $plzStmt->execute();
    $plzResult = $plzStmt->fetch(PDO::FETCH_ASSOC);

    // Get the plz_id
    $plzId = $plzResult['plz_id'];

    // Your existing insert query
    $query = "INSERT INTO user (firstname, lastname, email_address, date_of_birth, straße, hausnummer, postleitzahl, username, password)
              VALUES (:firstname, :lastname, :email_address, :date_of_birth, :strasse, :hausnummer, :plz_id, :username, :password)";
    $stmt = $conn->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":firstname", $firstName);
    $stmt->bindParam(":lastname", $lastName);
    $stmt->bindParam(":email_address", $email);
    $stmt->bindParam(":date_of_birth", $date);
    $stmt->bindParam(":strasse", $straße);
    $stmt->bindParam(":hausnummer", $hausnummer);
    $stmt->bindParam(":plz_id", $plzId); // Binding the retrieved plz_id
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashedPassword);

    $stmt->execute();
}
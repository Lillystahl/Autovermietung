<?php

declare(strict_types=1);

function get_user(object $conn, string $username){
    $query = "SELECT * FROM user WHERE username =:username;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}
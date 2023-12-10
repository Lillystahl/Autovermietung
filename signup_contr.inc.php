<?php

declare(strict_types=1);

function is_input_empty(string $username,string $firstName,string $lastName,string $straße,?int $postleitzahl,?int $hausnummer, string $date, string $email, string $pwd){
    if(empty($username) || empty($firstName) || empty($lastName) || empty($straße) || empty($postleitzahl) || empty($hausnummer) || empty($date) || empty($email)  || empty($pwd)) {
        return true;
    } else{
        return false;
    }
}

function is_email_invalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else{
        return false;
    }
}

function is_username_taken(object $conn, string $username){
    if(get_username($conn, $username)) {
        return true;
    } else{
        return false;
    }
}

function is_email_registered(object $conn, string $email){
    if(get_email($conn,$email)) {
        return true;
    } else{
        return false;
    }
}


function create_user(object $conn, string $username,string $firstName,string $lastName,string $straße,int $postleitzahl, int $hausnummer, string $date, string $email,string $pwd){
    set_user($conn, $username, $firstName, $lastName,  $straße, $postleitzahl, $hausnummer, $date, $email, $pwd);
}
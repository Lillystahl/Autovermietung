<?php

declare(strict_types=1);

function check_singup_errors()
{
    if (isset($_SESSION["errors_singup"])) {
        $errors = $_SESSION["errors_singup"];

        echo "<br>";

        foreach ($errors as $error)
        echo '<p class="form-error">' . $error . '</p>';       

        unset($_SESSION["errors_singup"]);
    }else if(isset($_GET["singup"]) && $_GET["signup"] === "success" ){

    }
}
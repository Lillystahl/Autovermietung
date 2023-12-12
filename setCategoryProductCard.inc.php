<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category'])) {
        // serverside validation to prevent malicious inserts on the product car by the user
        // checks the post Category against the array which is allowed as inputs.
        $allowedCategories = array('Cabrio', 'SUV', 'Combi', 'Mehrsitzer', 'Coupe', 'Limousine');
        $category = $_POST['category'];

        if (in_array($category, $allowedCategories)) {
            $_SESSION['vehicle_type'] = $category;
            // Further actions if necessary
            header("Location: Produktübersicht.php");
        } else {
            // Invalid category received
            echo "<script>";
            echo "console.log('Invalid category received: " . $category . "');";
            echo "alert('Uh uh uh not today');"; //if you try something funny u get this funny message :]
            echo "</script>";
        }
    } else {
        // No category received
        echo "<script>";
        echo "console.log('No category entered');";
        echo "alert('No category entered');"; // Optional: Alert the user about the error
        echo "</script>";
    }
}
?>
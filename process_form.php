<?php
// function to read user inputs from the homepage filter bar and process it to the database
function processSearchForm($conn) {
    if(isset($_POST['filterbar-submit'])) { // Check if the form for search was submitted

        // Collect form data
        $loc = $_POST['standort-location'];

        // Process and sanitize the data as needed before using in SQL query
        // For example, using prepared statements to prevent SQL injection:
        $stmt = $conn->prepare("SELECT * FROM location WHERE loc_name = :loc");
        $stmt->bindParam(':loc', $loc);
        
        // Execute the SQL query to fetch data from the database
        $stmt->execute();
        
        // Fetch all rows of the result as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Display success message with fetched data in the browser's console
            echo "<script>";
            echo "console.log('Data fetched successfully: ', " . json_encode($result) . ");";
            echo "</script>";
        } else {
            // Display error message if no data is fetched
            echo "<script>";
            echo "console.log('No data found for location: $loc');";
            echo "</script>";
        }
    }
}
?>

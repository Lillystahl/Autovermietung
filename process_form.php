<?php
// function to read user inputs from the homepage filter bar and process it to the database
// Die function akzeptiert den parameter conn
function processSearchForm($conn) {
    if(isset($_POST['filterbar-submit'])) {

        //Validiert den User input (kann nicht leer sein, muss alphabetische Zeichen haben)
        $loc = filter_input(INPUT_POST, 'standort-location', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($loc) && ctype_alpha($loc)) {
            // Process and sanitize the data as needed before using in SQL query
            $stmt = $conn->prepare("SELECT * FROM location WHERE loc_name = :loc");
            $stmt->bindParam(':loc', $loc);
            
            $stmt->execute();

            //Packt die Outputs in einen arry
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // debug für geht, keine daten für input oder Invalid input (Number, Special Char)
            if ($result) {
                echo "<script>";
                echo "console.log('Data fetched successfully: ', " . json_encode($result) . ");";
                echo "</script>";
            } else {
                echo "<script>";
                echo "console.log('No data found for location: $loc');";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "console.log('Invalid input for location.');";
            echo "</script>";
        }
    }
}


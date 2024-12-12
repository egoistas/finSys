<?php
require_once('../config/DB_connection.php');

// Check if DATE is set in the POST request
if(isset($_POST['date'])) {
    // Sanitize the input
    $date = mysqli_real_escape_string($dbc, $_POST['date']);

    // Query to fetch messages for the given date
    $query = "SELECT MESSAGE FROM deadlines WHERE DATE = '$date';";

    // Perform the query
    $result = mysqli_query($dbc, $query);

    if($result) {
        $options = [];
        // Fetch results
        while ($row = mysqli_fetch_assoc($result)) {
            $options[] = $row['MESSAGE'];
        }
        // Close the database connection
        mysqli_close($dbc);

        // Return the options as JSON
        header('Content-Type: application/json');
        echo json_encode($options);
    } else {
        // Handle query error
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Error executing database query"]);
    }
} else {
    // DATE is not set in the POST request
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "DATE parameter is missing"]);
}
?>

<?php
/// AUTO EINAI TO SOSTOOOOOO


// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php"); 
//     exit();
// }

// Include database connection
require_once('../config/DB_connection.php');

// Query database
$queryAwardingContractor = "SELECT * FROM framework_agreement";
$findAwardingContractorstmt = mysqli_prepare($dbc, $queryAwardingContractor);

// Execute query
if (mysqli_stmt_execute($findAwardingContractorstmt)) {
    $result = mysqli_stmt_get_result($findAwardingContractorstmt);

    if ($result) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Send JSON response to the frontend
        header('Content-Type: application/json');
        echo json_encode($rows);
    } else {
        // Send error message in JSON format
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error fetching results.'));
    }
} else {
    // Send error message in JSON format
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Error executing query: ' . mysqli_error($dbc)));
}

// Close statement and database connection
mysqli_stmt_close($findAwardingContractorstmt);
mysqli_close($dbc);
?>

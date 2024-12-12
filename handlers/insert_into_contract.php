<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idAwardingDecision = $_POST['AWARDING_DECISION'];
    

    $q = "select aw.idPINAKA_AWARDING_CONTRACTOR from awarding_contractor aw
    left join contract c  on aw.idPINAKA_AWARDING_CONTRACTOR = c.idPINAKA_AWARDING_CONTRACTOR
    where c.idPINAKA_AWARDING_CONTRACTOR is null and aw.AWARDING_DECISION = ?;";
    $stmt = mysqli_prepare($dbc, $q);

// Check if preparation succeeded
if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 's', $idAwardingDecision);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Bind result variables
    mysqli_stmt_bind_result($stmt, $stored_id_pinaka);
    
    // Fetch the result
    mysqli_stmt_fetch($stmt);
    
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle preparation failure
    die("Error: " . mysqli_error($dbc));
}
    // var_dump($stored_id_pinaka);

    $idContract = $_POST['idCONTRACT'];
    $idPinakaAwardingContractor = $stored_id_pinaka;
    $signDate = $_POST['SIGN_DATE'];
    $dateOfDelivery = $_POST['DATE_OF_DELIVERY'];


    $response = array();

    $queryInsertPublicTender = "INSERT INTO `procurement`.`contract` (
     `idCONTRACT`, 
     `idPINAKA_AWARDING_CONTRACTOR`, 
     `SIGN_DATE`,
     `DATE_OF_DELIVERY`)
      VALUES (?, ?, ?, ?);";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'siss', $idContract, $idPinakaAwardingContractor, $signDate, $dateOfDelivery);
    
    if (mysqli_stmt_execute($stmtInsertPublicTender)) {
       
        $response['success'] = true;
        $response['message'] = "Η καταχώρηση ήταν επιτυχής!";
    } else {
        
        $response['success'] = false;
        $response['message'] = "Σφάλμα εισαγωγής στη ΒΔ: " . mysqli_error($dbc);
    }

    
    mysqli_stmt_close($stmtInsertPublicTender);
    mysqli_close($dbc);

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    // Not an AJAX request, handle accordingly or provide an error response
    echo "This endpoint only accepts AJAX requests!";
    exit();
} 
?>
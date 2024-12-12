<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idAwardingDecision = $_POST['AWARDING_DECISION'];
    

    $q = "select aw.idPINAKA_AWARDING_CONTRACTOR from awarding_contractor aw
    left join framework_agreement fa  on aw.idPINAKA_AWARDING_CONTRACTOR = fa.idPINAKA_AWARDING_CONTRACTOR
    where fa.idPINAKA_AWARDING_CONTRACTOR is null and aw.AWARDING_DECISION = ? ;";
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

    $idFrameWorkAgreement = $_POST['idFRAMEWORK_AGREEMENT'];
    $idPinakaAwardingContractor = $stored_id_pinaka; 
    $signDate = $_POST['SIGN_DATE'];
    $years = $_POST['YEARS'];


    $response = array();

    $queryInsertPublicTender = "INSERT INTO `procurement`.`framework_agreement` (
     `idFRAMEWORK_AGREEMENT`, 
     `idPINAKA_AWARDING_CONTRACTOR`, 
     `SIGN_DATE`,
     `YEARS`) 
      VALUES (?, ?, ?, ?);";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'sisi', $idFrameWorkAgreement, $idAwardingDecision, $signDate, $years);
    
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
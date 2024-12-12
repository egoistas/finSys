<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idPOST = $_POST['idPUBLIC_TENDER'];
    $afm = $_POST['AFM_SUPPLIER'];
    

    $q = "SELECT idPINAKA_TEMPORARY_CONTRACTOR          
    FROM public_tender pt inner join temp_contractor tc on pt.idPINAKA_PUBLIC_TENDER=tc.idPINAKA_PUBLIC_TENDER
    WHERE pt.idPUBLIC_TENDER = ? and tc.AFM_SUPPLIER = ?;";
    $stmt = mysqli_prepare($dbc, $q);

// Check if preparation succeeded
if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ss', $idPOST, $afm);
    
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


    $idAwardingDecision = $_POST['AWARDING_DECISION'];
    $idPinakaTemp  = $stored_id_pinaka;
    $signDate = $_POST['SIGN_DATE'];
    $publicationDate = $_POST['PUBLICATION_DATE'];
    $numOfAppealDays = $_POST['NUM_OF_APPEAL_DAYS'];
    $precontractualCheck = $_POST['PRECONTRACTUAL_CHECK'];
    $dateSendCourtOfAuditors = $_POST['DATE_SEND_COURT_OF_AUDITORS'];
   
    $response = array();

    $queryInsertPublicTender = "INSERT INTO `procurement`.`awarding_contractor` (
     `AWARDING_DECISION`, 
     `idPINAKA_TEMPORARY_CONTRACTOR`, 
     `SIGN_DATE`,
     `PUBLICATION_DATE`, 
      `NUM_OF_APPEAL_DAYS`, 
      `PRECONTRACTUAL_CHECK`, 
      `DATE_SEND_COURT_OF_AUDITORS`) 
      VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'sissiis', $idAwardingDecision, $idPinakaTemp, $signDate, 
    $publicationDate, $numOfAppealDays, $precontractualCheck, $dateSendCourtOfAuditors);
    
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
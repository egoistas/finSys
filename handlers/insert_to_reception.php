<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idPinakaContract = $_POST['idCONTRACT'];
    
    $q = "select c.idPINAKA_CONTRACT from contract c left join permanent_reception pr on 
    c.idPINAKA_CONTRACT = pr.idPINAKA_CONTRACT 
    where idCONTRACT = ?;";
    $stmt = mysqli_prepare($dbc, $q);

// Check if preparation succeeded
if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 's', $idPinakaContract);
    
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
     

    $idReceptDecision = $_POST['idRECEIPT_DECISION'];
    $idPinakaContract = $stored_id_pinaka;
    $receiptQuantiy = $_POST['RECEIPT_QUANTITY'];
    $receptionDate = $_POST['RECEPTION_DATE'];
    $signDate = $_POST['SIGN_DATE'];
    $fine = $_POST['FINE'];

       
    $response = array();

    $queryInsertPublicTender = "INSERT INTO `procurement`.`permanent_reception` 
    (`idRECEIPT_DECISION`, 
    `idPINAKA_CONTRACT`,
     `RECEIPT_QUANTITY`,
      `RECEPTION_DATE`,
       `SIGN_DATE`,
        `FINE`)
     VALUES (?,?,?,?,?,?);";

     
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'siissi', $idReceptDecision, $idPinakaContract, $receiptQuantiy,
     $receptionDate, $signDate, $fine);
    
    if (mysqli_stmt_execute($stmtInsertPublicTender)) {
       
        $response['success'] = true;
        $response['message'] = "Data inserted successfully!";
    } else {
        
        $response['success'] = false;
        $response['message'] = "Error inserting data: " . mysqli_error($dbc);
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
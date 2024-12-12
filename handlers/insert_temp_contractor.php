<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idPOST = $_POST['idPUBLIC_TENDER'];
    $afm = $_POST['AFM_SUPPLIER'];
    

    $q = "SELECT pt.idPINAKA_PUBLIC_TENDER 
    FROM public_tender pt 
    JOIN supplier_public_tender spt ON pt.idPINAKA_PUBLIC_TENDER = spt.idPINAKA_PUBLIC_TENDER
    JOIN supplier s ON s.AFM_SUPPLIER = spt.AFM_SUPPLIER
    WHERE pt.idPUBLIC_TENDER = ? AND spt.AFM_SUPPLIER = ?";
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

    $idTempDes = $_POST['idTEMPORARY_CONTRACTOR_DECISION'];
    $afmSupplier = $_POST['AFM_SUPPLIER'];
    $cpv = $_POST['CPV'];
    $quantity = $_POST['QUANTITY'];
    $totalValue = $_POST['TOTAL_VALUE'];
    $signDate = $_POST['SIGN_DATE'];
    $publicationDate = $_POST['PUBLICATION_DATE'];
    $numOfDays = $_POST['NUM_OF_APPEAL_DAYS'];
       
    $response = array();

    $queryInsertPublicTender = "INSERT INTO `procurement`.`temp_contractor` (
     `idTEMPORARY_CONTRACTOR_DECISION`, 
     `idPINAKA_PUBLIC_TENDER`, 
     `AFM_SUPPLIER`,
     `CPV`, 
      `QUANTITY`, 
      `TOTAL_VALUE`, 
      `SIGN_DATE`, 
      `PUBLICATION_DATE`,
       `NUM_OF_APPEAL_DAYS`
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'sissiissi', $idTempDes, $stored_id_pinaka, $afmSupplier, $cpv, $quantity, 
    $totalValue, $signDate, $publicationDate, $numOfDays);
    
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
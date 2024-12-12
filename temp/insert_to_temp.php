<?php



require_once('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idPOST = $_POST['idPUBLIC_TENDER'];
    $afm = $_POST['AFM_SUPPLIER'];

    $q = "SELECT pt.idPINAKA_PUBLIC_TENDER 
    FROM public_tender pt 
    JOIN supplier_public_tender spt ON pt.idPINAKA_PUBLIC_TENDER = spt.idPINAKA_PUBLIC_TENDER
    JOIN supplier s ON s.AFM_SUPPLIER = spt.AFM_SUPPLIER
    WHERE pt.idPUBLIC_TENDER = "$idPOST" AND spt.AFM_SUPPLIER = $afm;";
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 'ss', $id, $afm);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_id_pinaka);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $idTempDes = $_POST['idTEMPORARY_CONTRACTOR_DECISION'];
    $afm = $_POST['AFM_SUPPLIER'];
    $cpv = $_POST['CPV'];
    $quantity = $_POST['QUANTITY'];
    $totalValue = $_POST['TOTAL_VALUE'];
    $signDate = $_POST['SIGN_DATE'];
    $publicationDate = $_POST['PUBLICATION_DATE'];
    $numOfDays = $_POST['NUM_OF_APPEL_DAYS'];
       
    $response = array();

    $queryInsertPublicTender = "INSERT INTO temp_contractor (idTEMPORARY_CONTRACTOR_DECISION,
    idPINAKA_PUBLIC_TENDER, 
    AFM_SUPPLIER, 
    CPV, 
    QUANTITY, 
    TOTAL_VALUE, 
    SIGN_DATE,
    PUBLICATION_DATE, 
    NUM_OF_APPEL_DAYS) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'sississsi', $idTempDes, $stored_id_pinaka, $afm, $cpv, $quantity, 
    $totalValue, $signDate, $publicationDate, $numOfDays);
    
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

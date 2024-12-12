<?php
require_once('../config/DB_connection.php');

var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);
    $response = array();
    $id = $_POST['idPUBLIC_TENDER'];
    $afm = $_POST['AFM_SUPPLIER'];
    $name = $_POST['NAME'];
    $telephone = $_POST['TELEPHONE'];
    $email = $_POST['EMAIL'];
    $headquarters = $_POST['HEADQUARTERS'];
    $vat = $_POST['VAT'];
    $cpv = $_POST['CPV'];
    $quantity = $_POST['QUANTITY'];
    $priceperUnit = $_POST['PRICE_PER_UNIT'];

    
    $q = "SELECT idPINAKA_PUBLIC_TENDER from public_tender
    where idPUBLIC_TENDER = ? ";
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt,'s', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_id_pinaka);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    var_dump($stored_id_pinaka);


    // Insert data into supply_public_tender table
    $queryInsertPublicTender = "INSERT INTO supplier_public_tender (AFM_SUPPLIER, idPINAKA_PUBLIC_TENDER, CPV, QUANTITY
    , PRICE_PER_UNIT, VAT) VALUES (?,?,?,?,?,?)";
    $stmtInsertPublicTender = mysqli_prepare($dbc, $queryInsertPublicTender);
    mysqli_stmt_bind_param($stmtInsertPublicTender, 'sssiii', $afm, $stored_id_pinaka, $cpv, $quantity, $priceperUnit, $vat);
    mysqli_stmt_execute($stmtInsertPublicTender);
    $supply_insert_success = mysqli_stmt_affected_rows($stmtInsertPublicTender) == 1;
    mysqli_stmt_close($stmtInsertPublicTender);

    // Insert data into supplier table
    $queryInsertSupplier = "INSERT INTO supplier(AFM_SUPPLIER, NAME, TELEPHONE, EMAIL, HEADQUARTERS) 
                        VALUES (?,?,?,?,?)";
    $stmtInsertSupplier = mysqli_prepare($dbc, $queryInsertSupplier);
    mysqli_stmt_bind_param($stmtInsertSupplier, 'sssss', $afm, $name, $telephone, $email, $headquarters);
    $supplier_insert_success = mysqli_stmt_execute($stmtInsertSupplier);
    mysqli_stmt_close($stmtInsertSupplier);


    // Prepare response
    if ($supply_insert_success && $supplier_insert_success) {
        $response['success'] = true;
        $response['message'] = "Data inserted successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Error inserting data.";
    }

    var_dump($response);

    // Close database connection
    mysqli_close($dbc);

    // Send response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    
    http_response_code(400); // Bad Request
    exit();
}
?>

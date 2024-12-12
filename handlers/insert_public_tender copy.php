<?php
require_once('../config/DB_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();

    
    $idPUBLIC_TENDER = $_POST['idPUBLIC_TENDER'];
    $WRIT = $_POST['WRIT'];
    $TYPE = $_POST['TYPE'];
    //$DEPARTMENT = $_SESSION['department'];
    $DEPARTMENT = "2Α";

    $CPV = $_POST['CPV'];
    $QUANTITY = $_POST['QUANTITY'];
    $BUDGET = $_POST['BUDGET'];
    $TECHNICAL_SPECIFICATION = $_POST['TECHNICAL_SPECIFICATION'];
    $UNIT_OF_DELIVERY = $_POST['UNIT_OF_DELIVERY'];
    $DIVIDABILITY_BY_CPV = $_POST['DIVIDABILITY_BY_CPV'];
    $DIVIDABILITY_BY_QUANTITY = $_POST['DIVIDABILITY_BY_QUANTITY'];
    $PERFORMANCE_BONDS = $_POST['PERFORMANCE_BONDS'];
    $ADA = $_POST['ADA'];
    $ADAM = $_POST['ADAM'];
    $SIGN_DATE = $_POST['SIGN_DATE'];
    $PUBLICATION_DATE = $_POST['PUBLICATION_DATE'];
    $OFFER_LAST_DATE = $_POST['OFFER_LAST_DATE'];

    
    $query = "INSERT INTO public_tender (idPUBLIC_TENDER, WRIT, TYPE, DEPARTMENT, CPV, QUANTITY, BUDGET, TECHNICAL_SPECIFICATION, UNIT_OF_DELIVERY, DIVIDABILITY_BY_CPV, DIVIDABILITY_BY_QUANTITY, PERFORMANCE_BONDS, ADA, ADAM, SIGN_DATE, PUBLICATION_DATE, OFFER_LAST_DATE) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'ssisiiiiiiissssss', $idPUBLIC_TENDER, $WRIT, $TYPE, $DEPARTMENT, $CPV, $QUANTITY, $BUDGET, $TECHNICAL_SPECIFICATION, $UNIT_OF_DELIVERY, $DIVIDABILITY_BY_CPV, $DIVIDABILITY_BY_QUANTITY, $PERFORMANCE_BONDS, $ADA, $ADAM, $SIGN_DATE, $PUBLICATION_DATE, $OFFER_LAST_DATE);
    $success = mysqli_stmt_execute($stmt);
    
    
    if ($success) {
        $response['success'] = true;
        $response['message'] = "Data inserted successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Error inserting data: " . mysqli_error($dbc);
    }

    
    mysqli_stmt_close($stmt);

    
    mysqli_close($dbc);

    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    echo "This endpoint only accepts POST requests!";
    exit();
}
?>

<?php
require_once('../config/DB_connection.php');

$id = $_POST['id'];

$queryAwardingContractor = "select s.AFM_SUPPLIER from public_tender pt join supplier_public_tender 
spt on pt.idPINAKA_PUBLIC_TENDER = spt.idPINAKA_PUBLIC_TENDER
join supplier s on s.AFM_SUPPLIER = spt.AFM_SUPPLIER 
where pt.idPUBLIC_TENDER = '$id';";


$result = mysqli_query($dbc, $queryAwardingContractor);

$options = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $options[] = $row['AFM_SUPPLIER'];
    }
}

mysqli_close($dbc);

// Return the options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>

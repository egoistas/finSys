<?php
require_once('../config/DB_connection.php');

// show 2nd dropdown for insert to temp
$id = $_POST['id'];

$queryAwardingContractor = "SELECT tc.AFM_SUPPLIER          
FROM public_tender pt inner join temp_contractor tc on pt.idPINAKA_PUBLIC_TENDER=tc.idPINAKA_PUBLIC_TENDER
WHERE pt.idPUBLIC_TENDER = '$id'";


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
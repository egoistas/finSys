<?php
require_once('../config/DB_connection.php');

// show 2nd dropdown for insert to temp
$id = $_POST['tender_progress'];

$queryAwardingContractor = "SELECT TENDER_PROGRESS, STAGE
 FROM public_tender pt JOIN progress p ON pt.idPINAKA_PUBLIC_TENDER = 
 p.idPINAKA_PUBLIC_TENDER
WHERE pt.idPUBLIC_TENDER = '$id';";

$result = mysqli_query($dbc, $queryAwardingContractor);

$options = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Include both columns in the options array
        $option = [
            'TENDER_PROGRESS' => $row['TENDER_PROGRESS'],
            'STAGE' => $row['STAGE']
        ];
        $options[] = $option;
    }
}

mysqli_close($dbc);

// Return the options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>

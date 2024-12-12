<?php
require_once('../config/DB_connection.php');
// polulate progress dropdown
$queryAwardingContractor = "select pt.idPUBLIC_TENDER from public_tender
pt join progress p on pt.idPINAKA_PUBLIC_TENDER = p.idPINAKA_PUBLIC_TENDER;";

$result = mysqli_query($dbc, $queryAwardingContractor);

$options = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $options[] = $row['idPUBLIC_TENDER'];
    }
}

mysqli_close($dbc);

// Return the options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>


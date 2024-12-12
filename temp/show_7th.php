<?php
require_once('../config/DB_connection.php');

$queryAwardingContractor = "SELECT pt.idPUBLIC_TENDER FROM public_tender pt LEFT JOIN 
supplier_public_tender spt ON pt.idPINAKA_PUBLIC_TENDER = spt.idPINAKA_PUBLIC_TENDER WHERE
 spt.idPINAKA_PUBLIC_TENDER IS NOT NULL;";

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



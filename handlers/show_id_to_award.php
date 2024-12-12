<?php
require_once('../config/DB_connection.php');
// polulate menu on 7th insert 
$queryAwardingContractor = "SELECT pt.idPUBLIC_TENDER          
FROM public_tender pt inner join temp_contractor tc on pt.idPINAKA_PUBLIC_TENDER=tc.idPINAKA_PUBLIC_TENDER
WHERE tc.idPINAKA_TEMPORARY_CONTRACTOR NOT IN (SELECT idPINAKA_TEMPORARY_CONTRACTOR FROM awarding_contractor);";

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

<?php
require_once('../config/DB_connection.php');
// polulate menu on 7th insert 
$queryAwardingContractor = "SELECT distinct idPUBLIC_TENDER from public_tender";

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

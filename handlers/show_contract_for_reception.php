<?php
require_once('../config/DB_connection.php');
// polulate the reception 
$queryAwardingContractor = "select c.idCONTRACT from contract c left join permanent_reception 
pr on c.idPINAKA_CONTRACT = pr.idPINAKA_CONTRACT
where pr.idPINAKA_CONTRACT is null;";

$result = mysqli_query($dbc, $queryAwardingContractor);

$options = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $options[] = $row['idCONTRACT'];
    }
}

mysqli_close($dbc);

// Return the options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>
<?php
require_once('../config/DB_connection.php');
// polulate the contract drop down 
$queryAwardingContractor = "select awarding_decision from awarding_contractor aw
left join contract c  on aw.idPINAKA_AWARDING_CONTRACTOR = c.idPINAKA_AWARDING_CONTRACTOR
where c.idPINAKA_AWARDING_CONTRACTOR is null;";

$result = mysqli_query($dbc, $queryAwardingContractor);

$options = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $options[] = $row['awarding_decision'];
    }
}

mysqli_close($dbc);

// Return the options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>
<?php
require_once('mysqli_connect.php');



$queryAwardingContractor = "SELECT distinct pt.idPUBLIC_TENDER
FROM public_tender pt INNER JOIN supplier_public_tender spt ON pt.idPINAKA_PUBLIC_TENDER=spt.idPINAKA_PUBLIC_TENDER
WHERE EXISTS (SELECT idPINAKA_PUBLIC_TENDER FROM supplier_public_tender);";


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

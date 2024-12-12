<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_database = 'procurement';

$dbc = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if (!$dbc) {
    die('Σφάλμα σύνδεσης στη ΒΔ: ' . mysqli_connect_error());
}
/*array για τα μηνύματα σε κάθε ενέργεια στη βάση. Για να τα πετάω 
στο alert div όποτε θέλω. Δεν εξυπηρετεί ένα απλό echo παρά μονο
για debugging*/
$dbc_log = array();?> 

                  
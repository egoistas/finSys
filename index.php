<?php

session_start();
$_SESSION = array();
session_destroy();
header("Location: views/login.php");
exit();
date_default_timezone_set('Europe/Athens');
require_once('includes/helper_functions.inc.php');

$isLoggedIn = is_loggedin(); // Ορίζουμε τη μεταβλητή $isLoggedIn με βάση το αν είναι συνδεδεμένος ο χρήστης
    if (!$isLoggedIn) {       // Αν ο χρήστης δεν είναι συνδεδεμένος, ανακατεύθυνση στη σελίδα λάθους
       header("Location: views/public_tender_view.php");
        exit();
    } else {
        header("Location: views/public_tender_view.php");
        exit();
    }
?>
<?php
//Include necessary files and start the session
session_start();
require_once('../includes/helper_functions.inc.php');

$isLoggedIn = is_loggedin('username');// ότι χρησιμοποιείς

// If not logged in, redirect to login
if (!$isLoggedIn) {
    header('Location: error_403.php');
    exit;
}

// Αν ο χρήστης επιβεβαιώσει: τέλος session αλλιώς επιστροφή home
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout Confirmation</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/svg+xml" href="../custom/auction-law-svgrepo-com.svg">
    <!--STYLE-->    
    <style>body{position:relative}body::after{content:"";position:fixed;top:2%;left:0;width:100%;height:100%;background-image:url("../custom/asdys_Inscapet_.png");background-size:contain;background-repeat:no-repeat;background-position:center center;opacity:.2;z-index:-1000}</style>
    <!--STYLE-->  
</head>
<body class="d-flex flex-column min-vh-100">

<main class="flex-grow-1">
    <div class="container mt-5 text-center font-monospace">
        <!-- Content for logged-in users -->
        <h1>Αποσύνδεση</h1>
        <p class="fw-semibold fs-5">Εχετε αποσυνδεθεί</p>
        <form method="post">
            <button type="submit" name="logout" class="btn btn-danger">Επανασύνδεση</button>
            
        </form>
    </div>
</main>

<?php include('../templates/footer.php'); ?>

<script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
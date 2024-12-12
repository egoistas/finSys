<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Athens');
require_once('includes/helper_functions.inc.php');
$isLoggedIn = is_loggedin(); // Check if the user is logged in
if (!$isLoggedIn) {
    // Redirect non-logged-in users to the login page
    redirect('error_403',PATH_VIEWS);
    //var_dump($_SESSION);
    exit(); // Ensure script stops here to prevent further output
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? $title: "Rating System";?></title>
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8iNl4DkYR9QJQBE5Q1GZF0k7" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="public/icons/favicon.svg">
</head>
<style>
    .logout-text{
        font-family: monospace, 'Courier New', Courier;
        font-weight: bold; font-size: large;
        color: yellow;
    }
</style>
<body class="d-flex flex-column min-vh-100">

<nav class="pb-1 px-5 navbar navbar-expand-lg navbar-light bg-light sticky-top shadow fw-semibold fs-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="public/icons/favicon.svg" width="32" height="me-auto" alt="Admin" srcset="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <?php if (isset($_SESSION['type']) && ($_SESSION['type']=="A")) { // Check if user is logged in ?>
                <!-- Navigation Bar για χρήστες τύπου Α - ΔΙΑΧΕΙΡΙΣΤΕΣ -->
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">

                <li class="nav-item">
                        <a class="nav-link active" href="error_503.php">Πληροφορίες</a>
                </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Στατιστικά</a>
                        <div class="dropdown-menu bg-body-tertiary" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="show_class_stats.php">Στατιστικά Τμήματος</a>
                            <a class="dropdown-item" href="show_teacher_stats.php">Στατιστικά Καθηγητή</a>
                            <div class="dropdown-divider"></div> <!-- Διαχωριστική γραμμή -->   
                            <a class="dropdown-item" href="show_teacher_class_stats.php">Στατιστικά καθηγητή ανά τμήμα</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Ενέργειες</a>
                        <div class="dropdown-menu bg-body-tertiary" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="register_class.php">Καταχώρηση τμήματος</a>
                            <a class="dropdown-item" href="register_teacher.php">Καταχώρηση εκπαιδευτή</a>
                            <a class="dropdown-item" href="register_course.php">Καταχώρηση μαθήματος</a>
                            <a class="dropdown-item" href="register_teaching.php">Καταχώρηση Διδασκαλίας & Δημιουργία URLs</a>
                            <div class="dropdown-divider"></div> <!-- Διαχωριστική γραμμή -->    
                            <a class="dropdown-item" href="show_url.php">Προβολή URL αξιολόγησης</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Διαχείριση Χρηστών</a>
                        <div class="dropdown-menu bg-body-tertiary" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="register_user.php">Εισαγωγή χρήστη</a>
                            <a class="dropdown-item" href="error_503.php">Διαγραφή χρήστη</a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>
                <!-- Navigation Bar για χρήστες τύπου B - Γραφείο Εκπαιδεύσεως -->
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="error_503.php">Πληροφορίες</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Στατιστικά</a>
                        <div class="dropdown-menu bg-body-tertiary" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="show_class_stats.php">Στατιστικά Τμήματος</a>
                            <a class="dropdown-item" href="show_teacher_stats.php">Στατιστικά Καθηγητή</a>
                            <div class="dropdown-divider"></div> <!-- Διαχωριστική γραμμή -->   
                            <a class="dropdown-item" href="show_teacher_class_stats.php">Στατιστικά καθηγητή ανά τμήμα</a>
                        </div>
                    </li>

                </ul>
            <?php } ?>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php if (isset($_SESSION['username'])) { // Αν ο χρήστης είναι συνδεδεμένος ?>
                        <!-- Εμφάνιση του ονομόματος -->
                        <span class="fw-semibold fs-5">
                            <?php echo $_SESSION['username']." | "."role: ".$_SESSION['type']; ?>
                        </span>
                        <a href="logout_confirmation.php" class="logout-text nav-link text-warning fs-5 fw-semibold">
                            Αποσύνδεση <img src="public/icons/logout-2.svg" width="24" height="24"
                                alt="Logout Icon">
                        </a>
                </li>        
            </ul>            
            <?php } else { ?>
                <!-- -->
            <?php } ?>
    </div>
    </li>
    </ul>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<body>    
<main class="flex-grow-1">


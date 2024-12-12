<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/index.php"); 
    exit();
}
ob_start();
date_default_timezone_set('Europe/Athens');
/*require_once('includes/helper_functions.inc.php');
$isLoggedIn = is_loggedin(); // Check if the user is logged in
if (!$isLoggedIn) {
    // Redirect non-logged-in users to the login page
    redirect('error_403',PATH_VIEWS);   //ΔΕΝ ΤΟ ΧΡΗΣΙΜΟΠΟΙΩ>ΚΑΝΕ ΤΟ ΚΑΝΟΝΙΚΑ ΜΕ ΤΟ HEADER lOCATION
    //var_dump($_SESSION);
    exit(); // Ensure script stops here to prevent further output
}*/
?>
<!DOCTYPE html>
<html data-bs-theme="bd-dark">
<head>
    <title><?php echo (isset($title) ? $title : "Δνση Προμηθειών ΑΣΔΥΣ"); ?></title>
    <link rel="shortcut icon" href="../custom/auction-law-svgrepo-com.svg" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap-5 -->
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css_custom/calendar.css">
    <script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Datatables -->
    <link rel="stylesheet" href="../public/DATATABLES/datatables.min.css">
    <script src="../public/DATATABLES/datatables.min.js"></script>
    <link rel="stylesheet" href="../public/css_custom/home.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!--<body class="d-flex flex-column min-vh-100">-->
        <nav class="bg-body-tertiary px-4 py-2 mb-4 mx-0 navbar navbar-expand-xl sticky-top shadow-sm fw-semibold fs-5">
            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand fs-4">
                    <sup>Δνση Προμηθειών</sup><br>ΑΣΔΥΣ
                    <img class="p-1" src="../custom/auction3.svg" height="50"  alt="" srcset="">
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="home.php" class="nav-item nav-link <?php echo ($currentPage == 'home.php') ? 'active' : ''; ?>" disabled style="display: none">Αρχική</a>
                        <a href="public_tender_view.php" class="nav-item nav-link <?php echo ($currentPage == 'public_tender_view.php') ? 'active' : ''; ?>">Διαγωνισμοί</a>
                        <a href="contract_view.php" class="nav-item nav-link <?php echo ($currentPage == 'contract_view.php') ? 'active' : ''; ?>">Συμβάσεις</a>
                        <a href="framework_agreement_view.php" class="nav-item nav-link <?php echo ($currentPage == 'framework_agreement_view.php') ? 'active' : ''; ?>">Συμφωνίες-Πλαίσιο</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo in_array($currentPage, ['awarding_contractor_view.php', 'temp_contractor_view.php', 'permanent_reception_view.php']) ? 'active' : ''; ?>" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Αποφάσεις
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item <?php echo ($currentPage == 'awarding_contractor_view.php') ? 'active' : ''; ?>" href="awarding_contractor_view.php">Κατακυρωτική Απόφαση</a></li>
                                <li><a class="dropdown-item <?php echo ($currentPage == 'temp_contractor_view.php') ? 'active' : ''; ?>" href="temp_contractor_view.php">Απόφαση Προσωρινού Αναδόχου</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php echo ($currentPage == 'permanent_reception_view.php') ? 'active' : ''; ?>" href="permanent_reception_view.php">Απόφαση Παραλαβής</a></li>
                            </ul>
                        </li>
                        <?php 
                        if ($_SESSION['department'] == 7){ ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo in_array($currentPage, ['insert_supplier.php']) ? 'active' : ''; ?>" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Προσφορά
                            </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item <?php echo ($currentPage == 'insert_supplier.php') ? 'active' : ''; ?>" href="insert_supplier.php">Εισαγωγή Προσφοράς Προμηθευτή</a></li>
                                </ul>
                        </li>
                        <?php } ?>
                     
                    </div>
                    <div class="navbar-nav ms-auto">
                        <a href="logout_confirmation.php" class="nav-item nav-link">Αποσύνδεση</a>
                    </div>
                </div>
            </div>
        </nav>
         <!-- Εδώ τοποθετήστε τον κώδικα για το sidebar -->
         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header text-center font-monospace">
                        <h6 id="offcanvasRightLabel text-center font-monospace">Ημερολόγιο Προθεσμιών</h6>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                            <?php include('calendar.php'); ?>
                    </div>
                </div>
        <!-- Εδώ τοποθετήστε τον κώδικα για το sidebar -->
        <button style="z-index:0; position: fixed; top: 50%; transform: translateY(-50%); right: 10px;" class="m-0 btn bg-secondary-subtle btn-md rounded-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Ημερολόγιο</button>
<main class="vh-100">

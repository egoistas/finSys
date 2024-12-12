
<!DOCTYPE html>
<html data-bs-theme="bd-dark">
<head>
    <title>Σύνδεση</title>
    <link rel="shortcut icon" href="../custom/auction-law-svgrepo-com.svg" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap-5 -->
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--custom css-->
    <link rel="stylesheet" href="../public/css_custom/login.css">
</head>
<main>
<body class="text-center pt-5">
    <div class="kbd vh-100 pt-5">
        <div class = "border rounded-4">
            <div class="form-signin shadow rounded-4 min-vh-75  py-2">
                <form action="../handlers/login_logic.php" method="post" >
                    <img class="m-4" src="../custom/asdys_Inscapet_.png" alt="" width="60%" height="auto" opacity="30%">
                    <p class="mb-3 fw-normal font-monospace fs-6">
                        *Για εγγραφή επικοινωνήστε με τον διαχειριστή του συστήματος*
                    </p>

                    <div class="form-floating">
                        <input type="text" name="username"class="form-control" id="username" placeholder="Όνομα χρήστη">
                        <label for="floatingInput">Όνομα χρήστη</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Συνθηματικό">
                        <label for="floatingPassword">Κωδικός</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-success" type="submit">Σύνδεση</button>
                    <p class="mt-5 mb-3 text-muted">&copy; ΣΠΗΥ142 2023-24 <br>Λαδόπουλος-Πασσάς-Χρηστίδης</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/bootstrap-5.3.2-dist/js/bootstrap.bundle.js">
    </script>

    <?php
            include "../templates/footer.php"; // Include the footer
    ?>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php"); 
    exit();
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>403 Error Page</title>
  <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>

<body>
	<div class="d-flex align-items-center justify-content-center vh-100 section-notfound">
		<div class="text-center">
			<p class="fs-3">
			<img src="../custom/asdys_Inscapet.png" width="25%" class="img-fluid" alt="image">
			</p>
			<h1 class="display-1 fw-bold">403</h1>
			<p class="fs-3"> <span class="text-danger">Oops!</span> Access denied! </p>
			<p class="lead">
				Δεν έχετε δικαίωμα πρόσβασης σε αυτήν τη σελίδα.
			</p>
			<a href="<?php echo (isset($_SESSION['username']) && is_loggedin($_SESSION['username'])) ? 'home.php' : '../index.php';?>" class="btn btn-success">Επιστροφή</a>
		</div>
	</div>
</body>

</html>
<?php
$title = "Σύνδεση";
session_start(); // Session initialization

require_once('../config/DB_connection.php');

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$loginSuccess = false; 
$errors = array(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Validate username and password inputs (you may have omitted this part)

    if (empty($errors)) {
        $q = "SELECT idUSER, PASSWORK, DEPARTMENT FROM users WHERE idUSER = ? ;";
        
        $stmt = mysqli_prepare($dbc, $q);
        
        mysqli_stmt_bind_param($stmt, 's', $username);
        
        mysqli_stmt_execute($stmt);
       
        mysqli_stmt_store_result($stmt);
        
        // Check if username exists in database
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $usernameResult, $passwordResult, $department);
            mysqli_stmt_fetch($stmt);

            // Verify password
            if (password_verify($password, $passwordResult)) {
                // Successful login
                $_SESSION['username'] = $usernameResult;
                $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);
                $_SESSION['department'] = $department;
                $_SESSION['time'] = time();

                $loginSuccess = true;

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

                // Redirect after successful login
                header("Location: ../views/public_tender_view.php");
                exit; // Ensure script stops execution after redirection
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Username not found.";
        }
    }
}

// Redirect to login.php on error
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../views/public_tender_view.php");
    exit;
}
?>

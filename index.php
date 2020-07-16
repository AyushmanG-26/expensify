<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    $sql = "SELECT ID FROM users WHERE Email=? AND Password=?";
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $_SESSION['uid'] = $row['ID'];
            header("location: dashboard.php");
        }
        else {
            $msg = "Invalid details.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Expensify - The Expense Manager</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <!-- <h2 align="center">Expensify</h2> -->

        <div class="container">
            <div class="login-box">
                <p class="title">Expensify</p>
                <form role="form" name="login" method="POST">
                <p class="error"> <?php if($msg){ echo $msg; }  ?> </p>
                    <div class="textbox">
                        <input type="email" name="email" autocomplete="email" placeholder="Email address">
                    </div>
                    <div class="textbox">
                        <input type="password" name="pass" placeholder="Password">
                    </div>
                    <div class="forgot">
                        <a href="forgot_password.php"><p>Forgot Password?</p></a> 
                    </div>
                    <input type="submit" name="submit" class="button" value="Login">
                    <div class="register">
                        <p>Don't have an account? <span><a href="register.php">Register</a></span></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
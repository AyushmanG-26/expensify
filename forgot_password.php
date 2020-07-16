<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

if(isset($_POST['submit']))
{
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

    echo $contactno;

    $query=mysqli_query($conn,"select ID from users where Email = '$email' AND PhoneNum = '$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0) {
        $_SESSION['mobno']=$contactno;
        $_SESSION['email']=$email;
        header('location:reset_password.php');
    }
    else{
        $msg="Invalid Details. Please try again.";
    }
    echo $msg;

    // if($stmt = mysqli_prepare($conn, $sql)) {
    //     mysqli_stmt_bind_param($stmt, "ss", $email, $contactno);

    //     if(mysqli_stmt_execute($stmt)) {
    //         echo "COOCLCLCCOCL";
    //         header("location: reset_password.php");
    //     }
    //     else {
    //         echo "<br>Error. Something went wrong. Please try again later." . $stmt->error;
    //     }
    // }
    // Close statement
    // mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Expensify - The Expense Manager</title>
        <link href="css/main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    </head>

    <body>
        <!-- <h2 align="center">Expensify</h2> -->

        <div class="container">
            <div class="login-box">
                <p class="title">Forgot Password</p>
                <form role="form" name="forgotpass" method="post">

                    <div><label class = "label" for="user-email">Email ID</label></div>
                    <div class="emailfptextbox">
                        <input type="email" name="email" id="user-email" autocomplete="email" required="true" oninvalid="alert('Invalid Email ID!')">
                    </div>
                    <div><label class = "label" for="user-number">Mobile Number</label></div>
                    <div class="fptextbox">
                        <input type="contactno" name="contactno" id="user-number" maxlength="10" pattern="[0-9]{10}" required="true" oninvalid="alert('Invalid Mobile Number!')">
                    </div>
                    <input type="submit" name="submit" class="resetbutton" value="Reset Password">
                </form>
            </div>
        </div>

        <!-- <div class="form-container">
            <form>
                <ul class="list">
                    <li><input type="email" name="userEmail" required="true"></li>
                    <li><input type="password" name="userPass" required="true"></li>
                    <li><input type="submit" value="Log In"></li>
                    <li>Forgot Password?</li>
                </ul>
            </form>
        </div> -->

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
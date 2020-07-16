<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
error_reporting(0);

if(isset($_SESSION['mobno']) && isset($_SESSION['email'])) {
    if(isset($_POST['submit']))
{
    $contactno=$_SESSION['mobno'];
    $email=$_SESSION['email'];
    $password=md5($_POST['newpassword']);
    $query=mysqli_query($conn,"update users set Password='$password'  where  Email='$email' && PhoneNum='$contactno' ");
    
    if($query)
    {
        // echo $password;
        header('location: index.php');
        echo "<script> alert('Password Changed Successfully'); </script>";
        session_destroy();
    }
}
} else {
    header('location: forgot_password.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Expensify - The Expense Manager</title>
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
        <script>
        function checkpass()
        {
            if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
            {
                alert('New Password and Confirm Password field does not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
        return true;
        }
        </script>
        
    </head>
    <body>
        <!-- <h2 align="center">Expensify</h2> -->

        <div class="container">
            <div class="login-box">
                <p class="title">Reset Password</p>
                <form role="form" method="post" name="changepassword" onsubmit="return checkpass()">

                    <div id="validation-message" class="error">
                    <?php if(!empty($error_message)) { ?>
                    <?php echo $error_message; ?>
                    <?php } ?>
                    </div>

                    <div class="fptextbox">
                        <input type="password" name="newpassword" id="user-pwd" required="true" placeholder="Enter New Password">
                    </div>
                    <div class="fptextbox">
                        <input type="password" name="confirmpassword" id="user-con-pwd" required="true" placeholder="Confirm New Password">
                    </div>
                    <input type="submit" name="submit" class="resetbutton" value="Reset">
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
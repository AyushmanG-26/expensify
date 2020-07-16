<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

if(isset($_POST['submit'])) 
{
    $name = $_POST['name'];
    $mobno = $_POST['mobileno'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    $ret = mysqli_query($conn, "SELECT Email FROM users WHERE Email='$email'");
    $result = mysqli_fetch_array($ret);

    echo $name;
    echo $mobno;
    echo $email;
    echo $pass;

    if($result>0) {
        $msg = "You are already registered!";
        echo($msg);
    } else {
        $sql = "INSERT INTO users (FullName, Email, PhoneNum, Password) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_mob, $param_pass);
            
            // set statements 
            $param_name = $name;
            $param_email = $email;
            $param_mob = $mobno;
            $param_pass = $pass;

            if(mysqli_stmt_execute($stmt)) {
                header("location: dashboard.php");
            }
            else {
                echo "<br>Error. Something went wrong. Please try again later." . $stmt->error;
            }
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
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
        <script type="text/javascript">
        function checkpass()
        {
            if(document.signup.pass.value!=document.signup.confirmpass.value)
            {
                alert('Passwords must match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        } 
        </script>
    </head>
    <body>
        <div class="container">
            <div class="login-box">
                <p class="title">Expensify</p>
                <form role="form" action="" name="signup" method="POST" onsubmit="return checkpass();">
                <p style="font-size:16px; color:white" align="center"> <?php if($msg){
                    echo $msg;
                    }  
                    ?> </p>
                    <div class="textbox">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="textbox">
                        <input type="email" name="email" autocomplete="email" placeholder="Email address" required="true">
                    </div>
                    <div class="textbox">
                        <input type="text" name="mobileno" placeholder="Mobile number" maxlength="10" pattern="[0-9]{10}" required="true">
                    </div>
                    <div class="textbox">
                        <input type="password" name="pass" id="pass" placeholder="Password" required="true">
                    </div>
                    <div class="textbox">
                        <input type="password" name="confirmpass" id="confirmpass" placeholder="Repeat Password" required="true">
                    </div>
                    <input type="submit" name="submit" class="button" value="Register">
                    <div class="register">
                        <p>Already have an account? <span><a href="index.php">Log In</a></span></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
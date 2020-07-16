<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if (strlen($_SESSION['uid']==0)) {
    header('location:logout.php');
    } else{
      if(isset($_POST['submit']))
    {
      $uid=$_SESSION['uid'];
      $pass_old = md5($_POST['currentpass']);
      $pass_new = md5($_POST['newpass']);
      $query=mysqli_query($conn, "select ID from users where ID='$uid' and Password='$pass_old'");
      $row = mysqli_fetch_array($query);
      if($row > 0){
          $sql = "UPDATE users SET Password=? where ID=?";
          if($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_bind_param($stmt, "ss", $pass_new, $uid);

              if(mysqli_stmt_execute($stmt)) {
                $msg= "Password successfully changed!"; 
            }
            else {
                echo "Incorrect password entered!";
            }
          }
      }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expensify - The Expense Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script type="text/javascript">
        function checkpass() {
            if(document.changepassword.newpass.value!=document.changepassword.confirmpass.value) {
                alert("Passwords do not match!");
                document.changepassword.confirmpass.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <em class="fa fa-home"></em>
                    </a>
                </li>
                <li class="active">Change Password</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                        <p style="font-size:16px; color:blue" align="center"> <?php if($msg){ echo $msg;
                        }  ?> </p>
                        <div class="col-md-12">
                            <?php
                                $uid = $_SESSION['uid'];
                                $ret = mysqli_query($conn, "SELECT * FROM users WHERE ID = '$uid'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {

                            ?>
                            <form role="form" method="POST" action="" name="changepassword" onsubmit="return checkpass();">
                                <div class="form-group">
                                    <label>Current Password</label>
									<input type="password" name="currentpass" class=" form-control" required="true" value="">
                                </div>
                                <div class="form-group">
									<label>New Password</label>
									<input type="password" name="newpass" class="form-control" value="" required="true">
								</div>
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirmpass" class="form-control" value="" required="true">
                                </div>			
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Change Password</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
<?php } ?>
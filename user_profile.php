<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if (strlen($_SESSION['uid']==0)) {
    header('location:logout.php');
    } else{
      if(isset($_POST['submit']))
    {
      $userid=$_SESSION['uid'];
      $fullname=$_POST['fullname'];
      $mobno=$_POST['phonenum'];
  
    $query=mysqli_query($conn, "update users set FullName ='$fullname', PhoneNum='$mobno' where ID='$userid'");
    if ($query) {
      $msg="User profile has been successfully updated.";
    }
    else
      {
        $msg="Something went wrong. Please try again.";
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
                <li class="active">Profile</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
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
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Name</label>
									<input class="form-control" type="text" value="<?php echo $row['FullName'];?>" name="fullname" required="true">
                                </div>
                                <div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" value="<?php echo $row['Email'];?>" required="true" readonly="true">
								</div>
								<div class="form-group">
									<label>Mobile Number</label>
									<input class="form-control" type="text" value="<?php echo $row['PhoneNum'];?>" required="true" name="phonenum" maxlength="10">
                                </div>	
                                <div class="form-group">
									<label>Registration Date</label>
									<input class="form-control" type="text" value="<?php echo $row['RegDate'];?>" name="regdate" readonly="true">
								</div>						
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Update</button>
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
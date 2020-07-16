<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if(strlen($_SESSION['uid'] == 0)) {
    header('location: logout.php');
} else {
    if(isset($_POST['submit']))
    {
        $uid = $_SESSION['uid'];
        $date = $_POST['date_expense'];
        $item = $_POST['item'];
        $cost = $_POST['costitem'];

        $query = "INSERT INTO expsenses(UserID, ExpenseDate, ExpenseItem, ExpenseCost) VALUES('$uid', '$date', '$item', '$cost')";
        if($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssss", $uid, $date, $item, $cost);

            if(mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Expense has been added!');</script>";
                echo "<script>window.location.href='manage_expense.php'</script>";
            }
            else {
                echo "<br>Error. Something went wrong. Please try again later." . $stmt->error;
            }
        }
        // if($query) {
        //     echo "<script>alert('Expense has been added!');</script>";
        //     echo "<script>window.location.href='manage_expense.php'</script>";
        // } else {
        //     echo "<br>Error. Something went wrong. Please try again later.";
        // }
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
                <li class="active">Add Expenses</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expense</div>
                    <div class="panel-body">
                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg;
                        }  ?> </p>
                        <div class="col-md-12">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="date_expense" required="true">
                                </div>
                                <div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" value="" required="true">
								</div>
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>						
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div>
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
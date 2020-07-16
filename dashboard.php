<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
  } else{
      $msg = $_SESSION['uid'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
    <title>Expensify - The Expense Manager</title>
</head>
<body>

    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Expense</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <?php
                            $uid = $_SESSION['uid'];
                            $tdate = date('Y-m-d');
                            $query = mysqli_query($conn,"select sum(ExpenseCost)  as todaysexpense from expsenses where (ExpenseDate)='$tdate' && (UserID='$uid');");
                            $result = mysqli_fetch_array($query);
                            $sum_today_expense = $result['todaysexpense'];
                        ?>
                        <h4>Today's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_expense; ?>"><span class="percent"><?php if($sum_today_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_today_expense;
                        }
                        ?>
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                        // Yesterdays expenses
                        $uid = $_SESSION['uid'];
                        $ydate = date('Y-m-d', strtotime("-1 days"));
                        $query1 = mysqli_query($conn,"select sum(ExpenseCost) as yesterdayexpense from expsenses where (ExpenseDate)='$ydate' && (UserID='$uid');");
                        $result1 = mysqli_fetch_array($query1);
                        $sum_yesterday_expense = $result1['yesterdayexpense'];
                    ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Yesterday's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_expense; ?>"><span class="percent"><?php if($sum_yesterday_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_yesterday_expense;
                        }
                        ?>
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                        <?php
                            // Weekly expenses
                            $uid = $_SESSION['uid'];
                            $pastdate = date('Y-m-d', strtotime("-1 week"));
                            $currentdate = date('Y-m-d');
                            $query2 = mysqli_query($conn,"select sum(ExpenseCost) as weekexpense from expsenses where ((ExpenseDate) between '$pastdate' and '$currentdate') && (UserID='$uid');");
                            $result2 = mysqli_fetch_array($query2);
                            $sum_week_expense = $result2['weekexpense'];
                        ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Week's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_week_expense; ?>"><span class="percent"><?php if($sum_week_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_week_expense;
                        }
                        ?>
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                        <?php
                            // Monthly expenses
                            $uid = $_SESSION['uid'];
                            $monthdate = date('Y-m-d', strtotime("-1 month"));
                            $currentdate = date('Y-m-d');
                            $query3 = mysqli_query($conn,"select sum(ExpenseCost) as monthexpense from expsenses where ((ExpenseDate) between '$monthdate' and '$currentdate') && (UserID='$uid');");
                            $result3 = mysqli_fetch_array($query3);
                            $sum_month_expense = $result3['monthexpense'];
                        ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Month's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_month_expense; ?>"><span class="percent"><?php if($sum_month_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_month_expense;
                        }
                        ?>
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-6">
                <div class="panel panel-default">
                        <?php
                            // Yearly expenses
                            $uid = $_SESSION['uid'];
                            $currentyear = date('Y');
                            $query4 = mysqli_query($conn,"select sum(ExpenseCost) as yearexpense from expsenses where (year(ExpenseDate)='$currentyear') && (UserID='$uid');");
                            $result4 = mysqli_fetch_array($query4);
                            $sum_year_expense = $result4['yearexpense'];
                        ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Year's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_year_expense; ?>"><span class="percent"><?php if($sum_year_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_year_expense;
                        }
                        ?>
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-6">
                <div class="panel panel-default">
                        <?php
                            // Total expenses
                            $uid = $_SESSION['uid'];
                            $query5 = mysqli_query($conn,"select sum(ExpenseCost) as totalexpense from expsenses where UserID='$uid';");
                            $result5 = mysqli_fetch_array($query5);
                            $sum_total_expense = $result5['totalexpense'];
                        ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Total Expenses</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_total_expense; ?>"><span class="percent"><?php if($sum_total_expense == "") {
                            echo "0";
                        } else {
                            echo $sum_total_expense;
                        }
                        ?>
                        </span></div>
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
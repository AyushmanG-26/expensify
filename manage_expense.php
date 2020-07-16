  <?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($conn,"delete from expsenses where ID='$rowid'");
if($query){
echo "<script>alert('Expense successfully deleted');</script>";
echo "<script>window.location.href='manage_expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker || Manage Expense</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php');?>
    <?php include_once('includes/sidebar.php');?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="dashboard.php">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Manage Expenses</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">Expense</div>
        <div class="panel-body">
        <p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}?> </p>
        <div class="col-md-12">
        <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
        <thead>
          <tr>
            <th>S.NO</th>
            <th>Expense Item</th>
            <th>Expense Cost</th>
            <th>Expense Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php
          $userid=$_SESSION['uid'];
          $ret = mysqli_query($conn, "select * from expsenses where UserID='$userid'");
          $cnt=1;
          while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td><?php  echo $row['ExpenseCost'];?></td>
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><a href="manage_expense.php?delid=<?php echo $row['ID'];?>">Delete</a>
                </tr>
                <?php
                  $cnt=$cnt+1;
                }?>

              </tbody>
            </table>
          </div>
          </div>
          </div>
          </div><!-- /.panel-->
          </div><!-- /.col-->
          <?php include_once('includes/footer.php');?>
        </div><!-- /.row -->
    </div><!--/.main-->

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
<?php }  ?>
<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <?php
            $uid = $_SESSION['uid'];
            $ret = mysqli_query($conn, "select FullName from users where ID='$uid'");
            $row = mysqli_fetch_array($ret);
            $name = $row['FullName'];
            ?>
            <div class="profile-usertitle-name"><?php echo $name; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="active"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

        <li class="parent"><a data-toggle="collapse" href="#sub-item-1">
            <em class="fa fa-navicon">&nbsp;</em> Expenses<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="add_expense.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Add Expenses
                </a></li>
                <li><a class="" href="manage_expense.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses
                </a></li>
            </ul>
        </li>

        <li class="parent"><a data-toggle="collapse" href="#sub-item-2">
            <em class="fa fa-navicon">&nbsp;</em> Expense Report <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a class="" href="expense_datewise.php"><span class="fa fa-arrow-right">&nbsp;</span> Datewise Expenses</a></li>
                <li><a class="" href="expense_monthwise.php"><span class="fa fa-arrow-right">&nbsp;</span> Monthwise Expenses</a></li>
                <li><a class="" href="expense_yearwise.php"><span class="fa fa-arrow-right">&nbsp;</span> Yearwise Expenses</a></li>
            </ul>
        </li>

        <li><a href="user_profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
        <li><a href="change_password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
        <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div>
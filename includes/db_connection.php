<?php
$conn = mysqli_connect("localhost", "root", "Batman2513@", "expenses_db");

if (mysqli_connect_errno()) {
    echo "Connection failed: " .mysqli_connect_error();
}
?>
<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');
$current_date = date('d-m-Y');

$connection = mysqli_connect('localhost', 'root', '', 'estore');

if(!$connection){
    echo "<script>alert('Database Not Connected');</script>";
}

?>
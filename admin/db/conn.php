<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');
$current_date = date('d-m-Y');
$current_time = date('H:i:s');
$connection = mysqli_connect('localhost', 'root', '', 'estore');

if(!$connection){
    echo "<script>alert('Database Not Connected');</script>";
}else{
    if(!isset($_SESSION['login_admin'])){
        header("location: login.php");
    }
}

function alertBox($msg){
    echo "<script>alert('$msg');</script>";
}

?>
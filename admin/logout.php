<?php
ob_start();
session_start();
unset($_SESSION['login_admin']);
header("location: login.php");
?>
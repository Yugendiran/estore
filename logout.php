<?php
ob_start();
session_start();
unset($_SESSION['login_user_id']);
setcookie("estore_u_c_id", "", time()-3600, "/");
setcookie("estore_u_c_email", "", time()-3600, "/");
setcookie("estore_u_c_pass", "", time()-3600, "/");
unset($_COOKIE['estore_u_c_id']);
unset($_COOKIE['estore_u_c_email']);
unset($_COOKIE['estore_u_c_pass']);
header("location: account.php");
?>
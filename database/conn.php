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
    
    if(isset($_COOKIE['estore_u_c_id']) && isset($_COOKIE['estore_u_c_email']) && isset($_COOKIE['estore_u_c_pass'])){
        if(isset($_COOKIE['estore_u_c_id']) && isset($_COOKIE['estore_u_c_email']) && isset($_COOKIE['estore_u_c_pass'])){
            $user_cookie_id = $_COOKIE['estore_u_c_id'];
            $user_cookie_email = $_COOKIE['estore_u_c_email'];
            $user_cookie_pass = $_COOKIE['estore_u_c_pass'];
        
            $user_cookie_id = mysqli_real_escape_string($connection, $user_cookie_id);
            $user_cookie_email = mysqli_real_escape_string($connection, $user_cookie_email);
            $user_cookie_pass = mysqli_real_escape_string($connection, $user_cookie_pass);
          
            $check_user_query = "SELECT * FROM users WHERE user_email = '$user_cookie_email'";
            $check_user_result = mysqli_query($connection, $check_user_query);
            $check_user_count = mysqli_num_rows($check_user_result);
            if($check_user_count >= 1){
                while($row = mysqli_fetch_assoc($check_user_result)){
                    $db_user_id = $row['user_id'];
                    $db_user_name = $row['user_name'];
                    $db_user_email = $row['user_email'];
                    $db_user_pass = $row['user_pass'];
                
                    if($db_user_email == $user_cookie_email && $db_user_pass == $user_cookie_pass){
                        $_SESSION['login_user_id'] = $db_user_id;
                    }else{
                        echo "<script>alert('Incorrect password in cookie. You may changed your password. Please try again with new password.');</script>";
                        setcookie("estore_u_c_id", "", time()-3600, "/");
                        setcookie("estore_u_c_email", "", time()-3600, "/");
                        setcookie("estore_u_c_pass", "", time()-3600, "/");
                        unset($_COOKIE['estore_u_c_id']);
                        unset($_COOKIE['estore_u_c_email']);
                        unset($_COOKIE['estore_u_c_pass']);
                    }
                }
            }else{
                echo "<script>alert('There is no user with $user_cookie_email');</script>";
                setcookie("estore_u_c_id", "", time()-3600, "/");
                setcookie("estore_u_c_email", "", time()-3600, "/");
                setcookie("estore_u_c_pass", "", time()-3600, "/");
                unset($_COOKIE['estore_u_c_id']);
                unset($_COOKIE['estore_u_c_email']);
                unset($_COOKIE['estore_u_c_pass']);
            }
        }
      }
      if(isset($_SESSION['login_user_id'])){
        $db_user_id = $_SESSION['login_user_id'];
    }
}

function alertBox($msg){
    echo "<script>alert('$msg');</script>";
}

?>
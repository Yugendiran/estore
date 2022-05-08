<?php
include 'database/conn.php';

if(isset($_GET['logout'])){
  unset($_SESSION['login_user_id']);
  setcookie("estore_u_c_id", "", time()-3600, "/");
  setcookie("estore_u_c_email", "", time()-3600, "/");
  setcookie("estore_u_c_pass", "", time()-3600, "/");
  unset($_COOKIE['estore_u_c_id']);
  unset($_COOKIE['estore_u_c_email']);
  unset($_COOKIE['estore_u_c_pass']);
  header("location: index.php");
}

if(isset($_SESSION['login_user_id'])){
  header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Account Page</title>
    
    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">
    <!-- Top Slider CSS -->
    <link href="css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
  
   <?php
include "includes/header.php";
include "includes/nav.php";
   ?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                <?php
if(isset($_POST['login'])){
  $login_email = $_POST['email'];
  $login_password = $_POST['password'];

  $login_email = mysqli_real_escape_string($connection, $login_email);
  $login_password = mysqli_real_escape_string($connection, $login_password);

  $check_user_query = "SELECT * FROM users WHERE user_email = '$login_email'";
  $check_user_result = mysqli_query($connection, $check_user_query);
  $check_user_count = mysqli_num_rows($check_user_result);

  if($check_user_count >= 1){
    while($row = mysqli_fetch_assoc($check_user_result)){
      $db_user_id = $row['user_id'];
      $db_user_name = $row['user_name'];
      $db_user_email = $row['user_email'];
      $db_user_phone = $row['user_phone'];
      $db_user_pass = $row['user_pass'];
      $db_user_status = $row['user_status'];

      if($db_user_status == 'activated'){
        if($db_user_email == $login_email && $db_user_pass == md5($login_password)){
          if(isset($_POST['remember'])){
            setcookie("estore_u_c_id", $db_user_id, time() + (86400 * 30), "/");
            setcookie("estore_u_c_email", $db_user_email, time() + (86400 * 30), "/");
            setcookie("estore_u_c_pass", $db_user_pass, time() + (86400 * 30), "/");
          }
          $_SESSION['login_user_id'] = $db_user_id;
  
          header("location: index.php");
        }else{
          echo "<p class='form_msg red'>&#9888; Incorrect password. Please try again.</p>";
        }
      }else{
        $to_email = $db_user_email;
        $subject = 'Account Verification - EStore';
        $from = 'golspoh1828@gmail.com';
        $token = date('his') . md5(random_bytes(64));
        $link = "localhost/estore/account.php?verification=true&auth=".$db_user_email."&token=".$token;

        $year = date('Y');

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $headers .= 'From: '.$from."\r\n".
          'Reply-To: '.$from."\r\n" .
          'X-Mailer: PHP/' . phpversion();

        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<div style="height:500px; width:100%; background:#d8232a;"><br><p style="color:#fff; margin-left:10px; font-size:20px; font-style:italic;">EStore</p>';
        $message .= '<div style="height:300px; width:80%; background:#fff;margin-top:35px; margin-left: auto;margin-right: auto;">';
        $message .= '<br><p style="font-size:15px; font-weight:bold; color:#d8232a; text-align:center;">Account Verification!</p>';
        $message .= '<p style="color:#595959; text-align:center;">Hi ' . $db_user_email . ', Your account was created successfully. Please Click the button below to verify your account.</p><br>';
        $message .= '<center><a href="' . $link . '" target="_blank"><button style="height:50px; width:120px; color:#fff; background:#d8232a; border:none;">Verify</button></a></center></div></div><br><br>';
        $message .= '<center>&#169; Copy Right ' . $year . ' EStore. All rights reserved.</center>';
        // $message .= '';
        $message .= '</body></html>';

        // Sending email
        if(mail($to_email, $subject, $message, $headers)){
          echo "<p class='form_msg red'>&#9888; Please Verify your account. An another verification mail has sent to your Email.</p>";
        } else{
          echo "<p class='form_msg red'>&#9888;&nbsp;Something went wrong. Please try again.</p>";
        }
      }
    }
  }else{
    echo "<p class='form_msg red'>&#9888; There is no user with '". $login_email ."'</p>";
  }
}
                ?>
                 <form action="account.php" method="post" class="aa-login-form">
                  <label for="">Email address<span>*</span></label>
                   <input type="email" name="email" placeholder="Enter your email" required>
                   <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" name="remember" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <?php
if(isset($_POST['register'])){
  $reg_user_name = $_POST['username'];
  $reg_user_email = $_POST['email'];
  $reg_user_phone = $_POST['phone'];
  $reg_user_password = $_POST['password'];
  $reg_user_confirm_password = $_POST['confirm_password'];

  $reg_user_name = mysqli_real_escape_string($connection, $reg_user_name);
  $reg_user_email = mysqli_real_escape_string($connection, $reg_user_email);
  $reg_user_phone = mysqli_real_escape_string($connection, $reg_user_phone);
  $reg_user_password = mysqli_real_escape_string($connection, $reg_user_password);
  $reg_user_confirm_password = mysqli_real_escape_string($connection, $reg_user_confirm_password);

  $check_user_query = "SELECT * FROM users WHERE user_email = '$reg_user_email'";
  $check_user_result = mysqli_query($connection, $check_user_query);
  $check_user_count = mysqli_num_rows($check_user_result);

  if($check_user_count >= 1){
    echo "<p class='form_msg red'>&#9888; This email is already registered.</p>";
  }else{
    if(strlen($reg_user_phone) == 10){
      $uppercase = preg_match('@[A-Z]@', $reg_user_password);
			$lowercase = preg_match('@[a-z]@', $reg_user_password);
			$number    = preg_match('@[0-9]@', $reg_user_password);
			$specialChars = preg_match('@[^\w]@', $reg_user_password);

			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($reg_user_password) < 8) {
				echo "<p class='form_msg red'>&#9888; Password should be at least 8 characters in length and should include at least one upper case letter, one lower case letter, one number, and one special character.</p><hr>";
			}else{
        if($reg_user_password == $reg_user_confirm_password){
          $to_email = $reg_user_email;
          $subject = 'Account Verification - EStore';
          $from = 'golspoh1828@gmail.com';
          $token = date('his') . md5(random_bytes(64));
          $link = "localhost/estore/account.php?verification=true&auth=".$reg_user_email."&token=".$token;

          $year = date('Y');

          // To send HTML mail, the Content-type header must be set
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

          // Create email headers
          $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

          // Compose a simple HTML email message
          $message = '<html><body>';
          $message .= '<div style="height:500px; width:100%; background:#d8232a;"><br><p style="color:#fff; margin-left:10px; font-size:20px; font-style:italic;">EStore</p>';
          $message .= '<div style="height:300px; width:80%; background:#fff;margin-top:35px; margin-left: auto;margin-right: auto;">';
          $message .= '<br><p style="font-size:15px; font-weight:bold; color:#d8232a; text-align:center;">Account Verification!</p>';
          $message .= '<p style="color:#595959; text-align:center;">Hi ' . $reg_user_name . ', Your account was created successfully. Please Click the button below to verify your account.</p><br>';
          $message .= '<center><a href="' . $link . '" target="_blank"><button style="height:50px; width:120px; color:#fff; background:#d8232a; border:none;">Verify</button></a></center></div></div><br><br>';
          $message .= '<center>&#169; Copy Right ' . $year . ' EStore. All rights reserved.</center>';
          // $message .= '';
          $message .= '</body></html>';

          // Sending email
          if(mail($to_email, $subject, $message, $headers)){
            $enc_phone = base64_encode($reg_user_phone);
            $enc_pass = md5($reg_user_password);
            $endTime = strtotime("+30 minutes", strtotime($current_date.' '.$current_time));
		        $endTime = date('d-m-Y H:i:s', $endTime);

            $add_user_query = "INSERT INTO users(user_name, user_email, user_phone, user_pass, user_status) VALUES('$reg_user_name', '$reg_user_email', '$enc_phone', '$enc_pass', 'pending')";
            $add_user_result = mysqli_query($connection, $add_user_query);

            $add_token_query = "INSERT INTO users_link(users_link_email, users_link_token, users_link_status, users_link_dt, users_link_exp_dt, users_link_module) VALUES('$reg_user_email', '$token', 'pending', '$current_date $current_time', '$endTime', 'registration')";
            $add_token_result = mysqli_query($connection, $add_token_query);
            
            if(!$add_user_result && !$add_token_result){
              echo "<p class='form_msg red'>&#9888;&nbsp;User Registration Failed. Please try again.</p>";
            }else{
              echo "<p class='form_msg green'>&#10003;&nbsp;Resigtration successful. Please check your email for verification code.</p>";
            }
          } else{
            echo "<p class='form_msg red'>&#9888;&nbsp;Something went wrong. Please try again.</p>";
          }
        }else{
          echo "<p class='form_msg red'>&#9888; Password and Confirm password not matching.</p>";
        }
      }
    }else{
      echo "<p class='form_msg red'>&#9888; Phone Number should be only 10 digits.</p>";
    }
  }
}

if(isset($_GET['verification'])){
  $verify_email = $_GET['auth'];
  $verify_token = $_GET['token'];

  $verify_email = mysqli_real_escape_string($connection, $verify_email);
  $verify_token = mysqli_real_escape_string($connection, $verify_token);

  $select_token_details_query = "SELECT * FROM users_link WHERE users_link_email = '$verify_email' AND users_link_token = '$verify_token' AND users_link_status = 'pending' AND users_link_module = 'registration'";
  $select_token_details_result = mysqli_query($connection, $select_token_details_query);
  $link_count = mysqli_num_rows($select_token_details_result);
  while($row = mysqli_fetch_assoc($select_token_details_result)){
    $users_link_id = $row['users_link_id'];
    $users_link_status = $row['users_link_status'];
    $users_link_dt = $row['users_link_dt'];
    $users_link_exp_dt = $row['users_link_exp_dt'];
    $users_link_module = $row['users_link_module'];
  }

  if($link_count >= 1){
    if(strtotime($current_date.' '.$current_time) < strtotime($users_link_exp_dt)){
      if($users_link_status == 'expired'){
        echo "<p class='form_msg red'>&#9888; Invalid Verification Link.</p>";
      }else{
        $update_user_status_query = "UPDATE users SET user_status = 'activated' WHERE user_email = '$verify_email'";
        $update_user_status_result = mysqli_query($connection, $update_user_status_query);
        $update_link_query = "UPDATE users_link SET users_link_status = 'expired' WHERE users_link_id = $users_link_id";
        $update_link_result = mysqli_query($connection, $update_link_query);

        if(!$update_user_status_result){
          echo "<p class='form_msg red'>&#9888; Something went wrong.</p>";
        }else{
          echo "<p class='form_msg green'>&#9888; Account verified successfully. Login to your account.</p>";
        }
      }
    }else{
      $to_email = $verify_email;
      $subject = 'Account Verification - EStore';
      $from = 'golspoh1828@gmail.com';
      $token = date('his') . md5(random_bytes(64));
      $link = "localhost/estore/account.php?verification=true&auth=".$verify_email."&token=".$token;

      $year = date('Y');

      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      // Create email headers
      $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

      // Compose a simple HTML email message
      $message = '<html><body>';
      $message .= '<div style="height:500px; width:100%; background:#d8232a;"><br><p style="color:#fff; margin-left:10px; font-size:20px; font-style:italic;">EStore</p>';
      $message .= '<div style="height:300px; width:80%; background:#fff;margin-top:35px; margin-left: auto;margin-right: auto;">';
      $message .= '<br><p style="font-size:15px; font-weight:bold; color:#d8232a; text-align:center;">Account Verification!</p>';
      $message .= '<p style="color:#595959; text-align:center;">Hi ' . $verify_email . ', Your account was created successfully. Please Click the button below to verify your account.</p><br>';
      $message .= '<center><a href="' . $link . '" target="_blank"><button style="height:50px; width:120px; color:#fff; background:#d8232a; border:none;">Verify</button></a></center></div></div><br><br>';
      $message .= '<center>&#169; Copy Right ' . $year . ' EStore. All rights reserved.</center>';
      // $message .= '';
      $message .= '</body></html>';

      // Sending email
      if(!mail($to_email, $subject, $message, $headers)){
        echo "<p class='form_msg red'>&#9888; Something Went Wrong.</p>";
      }else{
        echo "<p class='form_msg red'>&#9888; Your Link Expired Another Verifiction mail has been sent to your Email.</p>";
      }
    }
  }else{
    echo "<p class='form_msg red'>&#9888; Invalid Verification Link.</p>";
  }
}
                 ?>
                 <form action="account.php" method="post" class="aa-login-form">
                    <label for="">Username<span>*</span></label>
                    <input type="text" name="username" placeholder="Enter your Username" required>
                    <label for="">Email address<span>*</span></label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                    <label for="">Phone Number<span>*</span></label>
                    <input type="number" name="phone" placeholder="Enter your phone number" required>
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <label for="">Confirm Password<span>*</span></label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" name="register" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<?php
include "includes/footer.php";
?>
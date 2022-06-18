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

// if(isset($_SESSION['login_user_id'])){
//   header("location: index.php");
// }



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
<style>
  .account_items{
    height: auto; 
    width: 350px;
    margin: 10px; 
    border-radius: 15px; 
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .order_item{
    min-height: 300px;
    width: 100%;
    display: flex;
    /* grid-template-columns: auto auto auto; */
    padding: 20px;
    justify-content: space-between;
  }

  .order_item .ship{
    max-width: 100%;
    text-wrap: break-word;
    padding: 10px;
  }

  .order_item .summary{
    width: 45%;
    padding: 10px;
  }
  .order_item .summary table{
    width: 100%;
  }

  .cart_item{
    min-height: 150px;
    width: 95%;
    margin: 10px auto;
    border-radius: 15px;
    border: 1px solid #aaa;
    overflow: hidden;
  }

  .cart_item .header{
    height: 75px;
    width: 100%;
    background: #aaa;
    display: flex;
    align-items: center;
    overflow: auto;
  }
  .cart_item .header div{
    margin: 0 20px;
  }

  .cart_item button{
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    margin: 25px 0;
  }


  @media only screen and (max-width: 560px){
    .account_items{
      width: 100%;
      margin: 0;
    }

    .order_item{
      flex-direction: column;
    }
    .order_item .summary{
    width: 100%;
    padding: 10px;
  }
  }
</style>
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

  <?php
if(!isset($_SESSION['login_user_id'])){
  ?>
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
  
          if(isset($_GET['redirect'])){
            $redirect = substr($_GET['redirect'], 1, -1);
            header("location: ".$redirect);
          }else{
            header("location: index.php");
          }
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
                <?php
if(isset($_GET['redirect'])){
  ?>
<form action="account.php?redirect=<?php echo $_GET['redirect']; ?>" method="post" class="aa-login-form">
  <?php
}else{
  ?>
  <form action="account.php" method="post" class="aa-login-form">
    <?php
}
                ?>
                 
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
}else{
  ?>
<!-- 404 error section -->
<section id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area" style="display: flex; flex-direction: column; flex-wrap: wrap; align-items: center; padding: 10px;">
            <a href="account.php?page=orders"><div class="account_items">
              <h1>Your Orders</h1>
              <p>Track, Return, Or buy things again.</p>
            </div></a>
            <a href="account.php?page=address"><div class="account_items">
              <h1>Address</h1>
              <p>Add/ Edit address for Delivery.</p>
            </div></a>
          </div>
        </div>
      </div>
    </div>
    
<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = "";
}

switch($page){
  case "orders":
    ?>
<h1>Your orders:</h1>
    <div class="cart_container">
      <?php
$select_all_orders_query = "SELECT * FROM order_details WHERE order_details_uid = $db_user_id";
$select_all_orders_result = mysqli_query($connection, $select_all_orders_query);
while($row = mysqli_fetch_assoc($select_all_orders_result)){
  $order_details_id = $row['order_details_id'];
  $order_details_rq_id = $row['order_details_rq_id'];
  $order_details_pay_id = $row['order_details_pay_id'];
  $order_details_uid = $row['order_details_uid'];
  $order_details_token = $row['order_details_token'];
  $order_details_pm = $row['order_details_pm'];
  $order_details_bill = $row['order_details_bill'];
  $order_details_ship = $row['order_details_ship'];
  $order_details_status = $row['order_details_status'];
  $order_details_date = $row['order_details_date'];
  $order_details_ship_status = $row['order_details_ship_status'];
      ?>
      <div class="cart_item">
        <div class="header">
          <div>
            <h6>Payment Status</h6>
            <?php
if($order_details_status == "Pending"){
  echo "<p style='color: orange;'>Pending</p>";
}elseif($order_details_status == "Credit"){
  echo "<p style='color: green;'>Success</p>";
}else{
  echo "<p style='color: red;'>Failed</p>";
}
            ?>
          </div>
          <div>
            <h6>Order Placed</h6>
            <?php echo $order_details_date; ?>
          </div>
          <div>
            <h6>Order Status</h6>
            <?php echo $order_details_ship_status; ?>
          </div>
          <div>
            <h6>Total</h6>
            <?php
$total_sum = 0;
$select_order_product_query = "SELECT * FROM order_products WHERE order_products_uid = $db_user_id AND order_products_token = '$order_details_token'";
$select_order_product_result = mysqli_query($connection, $select_order_product_query);
while($row = mysqli_fetch_assoc($select_order_product_result)){
  $order_products_pid = $row['order_products_pid'];
  $order_products_qty = $row['order_products_qty'];
  $order_products_price = $row['order_products_price'];

  $sub_total = $order_products_price * $order_products_qty;

  $total_sum += $sub_total;
}
echo $total_sum + 50;
            ?>
          </div>
          <div>
            <h6>Ship To</h6>
            <?php
$select_ship_name = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = $db_user_id AND address_id = $order_details_ship AND address_mode = 'shipping'");
$ship_row = mysqli_fetch_assoc($select_ship_name);
echo $ship_row['address_name'];

            ?>
          </div>
          <div>
            <h6>Bill To</h6>
            <?php
$select_bill_name = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = $db_user_id AND address_id = $order_details_bill AND address_mode = 'billing'");
$bill_row = mysqli_fetch_assoc($select_bill_name);
echo $bill_row['address_name'];

            ?>
          </div>
          <div>
            <h6>Order ID</h6>
            <?php echo $order_details_token; ?>
          </div>
        </div>
        <a href="account.php?page=order_detail&order_id=<?php echo $order_details_token; ?>"><button>Order Details</button></a>
      </div>
      <?php
}
      ?>
    </div>
    <?php
  break;
  case "order_detail":
    $order_id = $_GET['order_id'];
    $select_all_orders_query = "SELECT * FROM order_details WHERE order_details_uid = $db_user_id AND order_details_token = '$order_id'";
    $select_all_orders_result = mysqli_query($connection, $select_all_orders_query);
    while($row = mysqli_fetch_assoc($select_all_orders_result)){
      $order_details_id = $row['order_details_id'];
      $order_details_rq_id = $row['order_details_rq_id'];
      $order_details_pay_id = $row['order_details_pay_id'];
      $order_details_uid = $row['order_details_uid'];
      $order_details_token = $row['order_details_token'];
      $order_details_pm = $row['order_details_pm'];
      $order_details_bill = $row['order_details_bill'];
      $order_details_ship = $row['order_details_ship'];
      $order_details_status = $row['order_details_status'];
      $order_details_date = $row['order_details_date'];
      $order_details_ship_status = $row['order_details_ship_status'];
}    
  ?>
  <div class="cart_container">
      <?php
$select_all_orders_query = "SELECT * FROM order_details WHERE order_details_uid = $db_user_id AND order_details_token = '$order_id'";
$select_all_orders_result = mysqli_query($connection, $select_all_orders_query);
while($row = mysqli_fetch_assoc($select_all_orders_result)){
  $order_details_id = $row['order_details_id'];
  $order_details_rq_id = $row['order_details_rq_id'];
  $order_details_pay_id = $row['order_details_pay_id'];
  $order_details_uid = $row['order_details_uid'];
  $order_details_token = $row['order_details_token'];
  $order_details_pm = $row['order_details_pm'];
  $order_details_bill = $row['order_details_bill'];
  $order_details_ship = $row['order_details_ship'];
  $order_details_status = $row['order_details_status'];
  $order_details_date = $row['order_details_date'];

      ?>
      <div class="cart_item">
        <div class="header">
          <div>
            <h6>Payment Status</h6>
            <?php
if($order_details_status == "Pending"){
  echo "<p style='color: orange;'>Pending</p>";
}elseif($order_details_status == "Credit"){
  echo "<p style='color: green;'>Success</p>";
}else{
  echo "<p style='color: red;'>Failed</p>";
}
            ?>
          </div>
          <div>
            <h6>Order Placed</h6>
            <?php echo $order_details_date; ?>
          </div>
          <div>
            <h6>Order Status</h6>
            <?php echo $order_details_ship_status; ?>
          </div>
          <div>
            <h6>Total</h6>
            <?php
$total_sum = 0;
$select_order_product_query = "SELECT * FROM order_products WHERE order_products_uid = $db_user_id AND order_products_token = '$order_details_token'";
$select_order_product_result = mysqli_query($connection, $select_order_product_query);
while($row = mysqli_fetch_assoc($select_order_product_result)){
  $order_products_pid = $row['order_products_pid'];
  $order_products_qty = $row['order_products_qty'];
  $order_products_price = $row['order_products_price'];

  $sub_total = $order_products_price * $order_products_qty;

  $total_sum += $sub_total;
}
echo $total_sum + 50;
            ?>
          </div>
          <div>
            <h6>Ship To</h6>
            <?php
$select_ship_name = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = $db_user_id AND address_id = $order_details_ship AND address_mode = 'shipping'");
$ship_row = mysqli_fetch_assoc($select_ship_name);
echo $ship_row['address_name'];

            ?>
          </div>
          <div>
            <h6>Bill To</h6>
            <?php
$select_bill_name = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = $db_user_id AND address_id = $order_details_bill AND address_mode = 'billing'");
$bill_row = mysqli_fetch_assoc($select_bill_name);
echo $bill_row['address_name'];

            ?>
          </div>
          <div>
            <h6>Order ID</h6>
            <?php echo $order_details_token; ?>
          </div>
        </div>
        <h3>Track Package:</h3>
        <?php
        $select_all_order_track_query = "SELECT * FROM order_track WHERE order_track_token = '$order_details_token' GROUP BY order_track_date";
        $select_all_order_track_result = mysqli_query($connection, $select_all_order_track_query);
        while($row = mysqli_fetch_assoc($select_all_order_track_result)){
          $order_track_date = $row['order_track_date'];
?>
        <p style="padding-left: 20px;"><b><?php echo $order_track_date; ?></b>
          
<?php
          $track_date_query = "SELECT * FROM order_track WHERE order_track_token = '$order_details_token' AND order_track_date = '$order_track_date'";
          $track_date_result = mysqli_query($connection, $track_date_query);
          while($row2 = mysqli_fetch_assoc($track_date_result)){
            $order_track_time = $row2['order_track_time'];
            $order_track_contant = $row2['order_track_contant'];

?>
          <ul style="padding-left: 20px;">
            <li style="padding-left: 30px;"><b><?php echo date("g:i A", strtotime($order_track_time)); ?>: </b><?php echo $order_track_contant; ?></li>
          </ul>
        </p>
<?php
          }
        }
        ?>
        
      </div>
      <?php
}
      ?>
    </div>
  <div class="cart_container">
<h1>Order Details</h1>
    <div class="order_item">
      <div class="ship">
        <h4><b>Shipping Address:</b></h4>
        <p><?php 
        $ship_address = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = '$db_user_id' AND address_id = '$order_details_ship' AND address_mode = 'shipping'");
        while($row = mysqli_fetch_assoc($ship_address)){
          $saddress_name = $row['address_name'];
          $saddress_email = $row['address_email'];
          $saddress_phone = $row['address_phone'];
          $saddress_address = $row['address_address'];
          $saddress_bname = $row['address_bname'];
          $saddress_ct = $row['address_ct'];
          $saddress_dis = $row['address_dis'];
          $saddress_pincode = $row['address_pincode'];
        }
        echo $saddress_name .'<br>'. $saddress_bname .'<br>'. $saddress_address .'<br>'. $saddress_ct .'<br>'. $saddress_dis . ' <br> ' . $saddress_pincode .'<br>'. $saddress_email .'<br>'. $saddress_phone;
        ?></p>
    <hr>
    <h4><b>Billing Address:</b></h4>
        <p><?php
        $bill_address = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = '$db_user_id' AND address_id = '$order_details_bill' AND address_mode = 'billing'");
        while($row = mysqli_fetch_assoc($bill_address)){
          $baddress_name = $row['address_name'];
          $baddress_email = $row['address_email'];
          $baddress_phone = $row['address_phone'];
          $baddress_address = $row['address_address'];
          $baddress_bname = $row['address_bname'];
          $baddress_ct = $row['address_ct'];
          $baddress_dis = $row['address_dis'];
          $baddress_pincode = $row['address_pincode'];
        }
        echo $baddress_name .'<br>'. $baddress_bname .'<br>'. $baddress_address .'<br>'. $baddress_ct .'<br>'. $baddress_dis . ' <br> ' . $baddress_pincode .'<br>'. $baddress_email .'<br>'. $baddress_phone;
        ?></p>
      </div>
      <div class="mode">
        <h4><b>Payment Method:</b></h4>
        <p><?php echo $order_details_pm; ?></p>
      </div>
      <div class="summary">
        <h4><b>Order Summary</b></h4>
        <?php
$total_sum = 0;
$select_order_product_query = "SELECT * FROM order_products WHERE order_products_uid = $db_user_id AND order_products_token = '$order_details_token'";
$select_order_product_result = mysqli_query($connection, $select_order_product_query);
while($row = mysqli_fetch_assoc($select_order_product_result)){
  $order_products_pid = $row['order_products_pid'];
  $order_products_qty = $row['order_products_qty'];
  $order_products_price = $row['order_products_price'];

  $sub_total = $order_products_price * $order_products_qty;

  $total_sum += $sub_total;
}
            ?>
        <table>
          <tr>
            <td>Item(s) Subtotal: </td>
            <td><?php echo $total_sum; ?></td>
          </tr>
          <tr>
            <td>Shipping: </td>
            <td>50</td>
          </tr>
          <tr>
            <td>Grand Total: </td>
            <td><?php echo 50 + $total_sum; ?></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
$sno = 1;
$select_car_query = "SELECT * FROM order_products WHERE order_products_uid = $db_user_id AND order_products_token = '$order_id'";
$select_car_result = mysqli_query($connection, $select_car_query);
while($row = mysqli_fetch_assoc($select_car_result)){
  $order_products_id = $row['order_products_id'];
  $order_products_pid = $row['order_products_pid'];
  $order_products_price = $row['order_products_price'];
  $order_products_qty = $row['order_products_qty'];
  $order_products_size = $row['order_products_size'];

  $select_product_details_query = "SELECT * FROM product_details WHERE product_id = $order_products_pid";
  $select_product_details_result = mysqli_query($connection, $select_product_details_query);
  $product_count = mysqli_num_rows($select_product_details_result);
  if($product_count >= 1){
    while($row = mysqli_fetch_assoc($select_product_details_result)){
      $product_id = $row['product_id'];
      $product_name = $row['product_name'];
    }

                      ?>
                      <tr>
                        <td> <?php
$select_pd_pht_query1 = "SELECT * FROM product_img WHERE product_img_pid = $product_id ORDER BY product_img_id DESC";
$select_pd_pht_result1 = mysqli_query($connection, $select_pd_pht_query1);
while($row = mysqli_fetch_assoc($select_pd_pht_result1)){
  $pd_pht_name = $row['product_img_name'];
}

                  ?>
                  <img src="img/pd/<?php echo $pd_pht_name; ?>" style="height: 100px;">                            
                </td>
                        <td><a class="aa-cart-title" href="product-detail.php?pid=1"><?php echo $product_name; ?></a></td>
                        <td>Rs: <?php echo $order_products_price; ?></td>
                        <td><?php echo $order_products_qty; ?></td>
                        <td><?php echo $order_products_size; ?></td>
                        <td>Rs: <?php echo $order_products_price * $order_products_qty; ?></td>
                      </tr>

<?php
  }
  $sno++;
}
?>
                      
                      </tbody>
                  </table>
                </div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
  <?php
  break;
  case "address":
    if(isset($_GET['did'])){
      $delete_add_id = $_GET['did'];
    
      $delete_query = "DELETE FROM address WHERE address_id = $delete_add_id AND address_uid = $db_user_id";
      $delete_result = mysqli_query($connection, $delete_query);
    
      header("location: account.php?page=address");
    }
    if(isset($_POST['s_submit'])){
      $s_name = $_POST['s_name'];
      $s_email = $_POST['s_email'];
      $s_phone = $_POST['s_phone'];
      $s_address = $_POST['s_address'];
      $s_app = $_POST['s_app'];
      $s_city = $_POST['s_city'];
      $s_dis = $_POST['s_dis'];
      $s_pincode = $_POST['s_pincode'];
      
      if(isset($_POST['s_default'])){
        $s_default = $_POST['s_default'];
      }else{
        $s_default = "";
      }
      $sinsert_new_address_query = "INSERT INTO address(address_uid, address_name, address_email, address_phone, address_address, address_bname, address_ct, address_dis, address_pincode, address_mode) VALUES($db_user_id, '$s_name', '$s_email', '$s_phone', '$s_address', '$s_app', '$s_city', '$s_dis', '$s_pincode', 'shipping')";
      $sinsert_new_address_result = mysqli_query($connection, $sinsert_new_address_query);
      if(!$sinsert_new_address_result){
        alertBox("Something went wrong");
      }else{
        header("location: account.php?page=address");
      }
    }

    if(isset($_POST['b_submit'])){
      $b_name = $_POST['b_name'];
      $b_email = $_POST['b_email'];
      $b_phone = $_POST['b_phone'];
      $b_address = $_POST['b_address'];
      $b_app = $_POST['b_app'];
      $b_city = $_POST['b_city'];
      $b_dis = $_POST['b_dis'];
      $b_pincode = $_POST['b_pincode'];
      
      if(isset($_POST['b_default'])){
        $b_default = $_POST['b_default'];
      }else{
        $b_default = "";
      }

      $binsert_new_address_query = "INSERT INTO address(address_uid, address_name, address_email, address_phone, address_address, address_bname, address_ct, address_dis, address_pincode, address_mode) VALUES($db_user_id, '$b_name', '$b_email', '$b_phone', '$b_address', '$b_app', '$b_city', '$b_dis', '$b_pincode', 'billing')";
      $binsert_new_address_result = mysqli_query($connection, $binsert_new_address_query);
      if(!$binsert_new_address_result){
        alertBox("Something went wrong");
      }else{
        header("location: account.php?page=address");
      }
    }
?>
<!-- Cart view section -->
<section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="account.php?page=address" method="post">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          Shipping Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <!-- <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="First Name*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Last Name*">
                              </div>
                            </div>
                          </div>  -->
                          <div class="current_add_container">
                            <?php
$select_address_query = "SELECT * FROM address WHERE address_uid = $db_user_id AND address_mode = 'shipping'";
$select_address_result = mysqli_query($connection, $select_address_query);
while($row = mysqli_fetch_assoc($select_address_result)){
  $address_id = $row['address_id'];
  $address_name = $row['address_name'];
  $address_email = $row['address_email'];
  $address_phone = $row['address_phone'];
  $address_address = $row['address_address'];
  $address_bname = $row['address_bname'];
  $address_ct = $row['address_ct'];
  $address_dis = $row['address_dis'];
  $address_pincode = $row['address_pincode'];
  $address_mode = $row['address_mode'];
                            ?>
                              <div class="current_add_item">
                                <h4><b><?php echo $address_name; ?></b></h4>
                                <p><?php echo $address_email; ?></p>
                                <p><?php echo $address_phone; ?></p>
                                <p><?php echo $address_address; ?></p>
                                <p><?php echo $address_bname; ?></p>
                                <p><?php echo $address_ct; ?></p>
                                <p><?php echo $address_dis; ?></p>
                                <p><?php echo $address_pincode; ?></p>
                                <a href="account.php?page=address&did=<?php echo $address_id; ?>"><p style="color: red;">Delete address</p></a>
                              </div>
                              <?php
}
                              ?>
                              
                          </div>
                          <hr>
                          <h3>Add new address:</h3>
                          <!-- <div class="aa-browse-btn" style="cursor:pointer;" onclick="showBillingForm();">Add new billing Address</div><br><br> -->
                          <div id="billing_form_container">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="s_name" placeholder="Name">
                              </div>                             
                            </div>                            
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="s_email" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="s_phone" placeholder="Phone*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" name="s_address" rows="3" placeholder="Address*"></textarea>
                              </div>                             
                            </div>                            
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="s_app" placeholder="Appartment, Suite etc.">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="s_city" placeholder="City / Town*">
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="s_dis" placeholder="District*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="number" name="s_pincode" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <input type="checkbox" value="default"> Set this as default Shipping address.
                          </div><br> -->
                          <button type="submit" name="s_submit" class="aa-browse-btn">Add Shipping Address</button>
                          </div>                                    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="account.php?page=address" method="post">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                          <a>
                            Choose Billing Address
                          </a>
                        </h4>
                    </div>
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Billing Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <!-- <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="First Name*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Last Name*">
                              </div>
                            </div>
                          </div>  -->
                          <div class="current_add_container">
                            <?php
$select_address_query = "SELECT * FROM address WHERE address_uid = $db_user_id AND address_mode = 'billing'";
$select_address_result = mysqli_query($connection, $select_address_query);
while($row = mysqli_fetch_assoc($select_address_result)){
  $address_id = $row['address_id'];
  $address_name = $row['address_name'];
  $address_email = $row['address_email'];
  $address_phone = $row['address_phone'];
  $address_address = $row['address_address'];
  $address_bname = $row['address_bname'];
  $address_ct = $row['address_ct'];
  $address_dis = $row['address_dis'];
  $address_pincode = $row['address_pincode'];
  $address_mode = $row['address_mode'];
                            ?>
                              <div class="current_add_item">
                                <h4><b><?php echo $address_name; ?></b></h4>
                                <p><?php echo $address_email; ?></p>
                                <p><?php echo $address_phone; ?></p>
                                <p><?php echo $address_address; ?></p>
                                <p><?php echo $address_bname; ?></p>
                                <p><?php echo $address_ct; ?></p>
                                <p><?php echo $address_dis; ?></p>
                                <p><?php echo $address_pincode; ?></p>
                                <a href="account.php?page=address&did=<?php echo $address_id; ?>"><p style="color: red;">Delete address</p></a>
                              </div>
                              <?php
}
                              ?>
                              
                          </div>
                          <hr>
                          <h3>Add new address:</h3>
                          <!-- <div class="aa-browse-btn" style="cursor:pointer;" onclick="showBillingForm();">Add new billing Address</div><br><br> -->
                          <div id="billing_form_container">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="b_name" placeholder="Name">
                              </div>                             
                            </div>                            
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="b_email" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="b_phone" placeholder="Phone*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" name="b_address" rows="3" placeholder="Address*"></textarea>
                              </div>                             
                            </div>                            
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="b_app" placeholder="Appartment, Suite etc.">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="b_city" placeholder="City / Town*">
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="b_dis" placeholder="District*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="number" name="b_pincode" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <input type="checkbox" value="default"> Set this as default billing address.
                          </div><br> -->
                          <button type="submit" name="b_submit" class="aa-browse-btn">Add Billing Address</button>
                          </div>                                    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<?php
break;
}
?>
    
  </section>
  <!-- / 404 error section -->
  <?php
}
 ?>
<?php
include "includes/footer.php";
?>
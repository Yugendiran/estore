<?php
include "database/conn.php";

if(!isset($_SESSION['login_user_id'])){
  header("location: account.php?redirect=checkout.php");
}

if(isset($_GET['page'])){
  $cur_checkout_page = $_GET['page'];
  if($cur_checkout_page == "billing" || $cur_checkout_page == "shipping"){
    
  }else{
    header("location: checkout.php?page=billing");
  }
}else{
    header("location: checkout.php?page=billing");
}

if(isset($_GET['didb']) && isset($_GET['section'])){
  $delete_add_id = $_GET['didb'];

  $delete_query = "DELETE FROM address WHERE address_id = $delete_add_id AND address_uid = $db_user_id";
  $delete_result = mysqli_query($connection, $delete_query);

  header("location: checkout.php?page=". $_GET['section']);
}

if(isset($_GET['dids']) && isset($_GET['section']) && isset($_GET['bid'])){
  $delete_add_id = $_GET['dids'];

  $delete_query = "DELETE FROM address WHERE address_id = $delete_add_id AND address_uid = $db_user_id";
  $delete_result = mysqli_query($connection, $delete_query);

  header("location: checkout.php?page=". $_GET['section'] ."&bid=".$_GET['bid']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Checkout Page</title>
    
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

   <?php
switch($cur_checkout_page){
  case "billing":
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

      $insert_new_address_query = "INSERT INTO address(address_uid, address_name, address_email, address_phone, address_address, address_bname, address_ct, address_dis, address_pincode, address_mode) VALUES($db_user_id, '$b_name', '$b_email', '$b_phone', '$b_address', '$b_app', '$b_city', '$b_dis', '$b_pincode', 'billing')";
      $insert_new_address_result = mysqli_query($connection, $insert_new_address_query);
      if(!$insert_new_address_result){
        alertBox("Something went wrong");
      }else{
        header("location: checkout.php?page=billing");
      }
    }
  ?>
 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="checkout.php?page=billing" method="post">
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
                                <a href="checkout.php?page=shipping&bid=<?php echo $address_id; ?>"><button type="button" class="add_confirm_btn">Bill from this address</button></a>
                                <!-- <a class="add_confirm_btn" href="checkout.php?page=shipping&bid=<?php echo $address_id; ?>">Bill from this address</a> -->
                                <a href="checkout.php?didb=<?php echo $address_id; ?>&section=billing"><p style="color: red;">Delete address</p></a>
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
case "shipping":
  if(isset($_GET['bid'])){
    $billing_address = $_GET['bid'];

    $select_billing_address_query = "SELECT * FROM address WHERE address_id = $billing_address AND address_uid = $db_user_id AND address_mode = 'billing'";
    $select_billing_address_result = mysqli_query($connection, $select_billing_address_query);
    $select_billing_address_rows = mysqli_num_rows($select_billing_address_result);
    if($select_billing_address_rows < 1){
      header("location: checkout.php?page=billing");
    }
  }else{
    header("location: checkout.php?page=billing");
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
    $insert_new_address_query = "INSERT INTO address(address_uid, address_name, address_email, address_phone, address_address, address_bname, address_ct, address_dis, address_pincode, address_mode) VALUES($db_user_id, '$s_name', '$s_email', '$s_phone', '$s_address', '$s_app', '$s_city', '$s_dis', '$s_pincode', 'shipping')";
    $insert_new_address_result = mysqli_query($connection, $insert_new_address_query);
    if(!$insert_new_address_result){
      alertBox("Something went wrong");
    }else{
      header("location: checkout.php?page=shipping&bid=$billing_address");
    }
  }
?>
<!-- Cart view section -->
<section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="checkout.php?page=shipping&bid=<?php echo $billing_address; ?>" method="post">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                          <a>
                            Choose Shipping Address
                          </a>
                        </h4>
                    </div>
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
                                <a href="ocheckout.php?bid=<?php echo $address_id; ?>&sid=<?php echo $address_id; ?>"><button type="button" class="add_confirm_btn">Ship to this address</button></a>
                                <a href="checkout.php?dids=<?php echo $address_id; ?>&section=shipping&bid=<?php echo $billing_address; ?>"><p style="color: red;">Delete address</p></a>
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
<?php
break;
}
?>
 
  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Our Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> 25 Astor Pl, NY 10003, USA</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <script>
    // document.getElementById("billing_form_container").style.display = "none";
    // function showBillingForm(){
    //   var billingFormDialog = document.getElementById("billing_form_container");

    //   if (billingFormDialog.style.display == 'none') { 
    //     billingFormDialog.style.display = "block";
    //   }else{
    //     billingFormDialog.style.display = "none";
    //   }
    // }
  </script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>  
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
    <!-- To Slider JS -->
    <script src="js/sequence.js"></script>
    <script src="js/sequence-theme.modern-slide-in.js"></script>  
    <!-- Product view slider -->
    <script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="js/jquery.simpleLens.js"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="js/slick.js"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="js/nouislider.js"></script>
    <!-- Custom js -->
    <script src="js/custom.js"></script> 
    
  </body>
</html>
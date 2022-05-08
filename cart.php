<?php
include "database/conn.php";

if(!isset($_SESSION['login_user_id'])){
  header("location: account.php?redirect=cart.php");
}

if(isset($_POST['cart_id']) && isset($_POST['cartPqty'])){
  $cartuid = $_POST['cart_id'];
  $cartPqty = $_POST['cartPqty'];

  $update_product_qty_query = "UPDATE cart SET cart_qty = $cartPqty WHERE cart_id = $cartuid AND cart_uid = $db_user_id";
  $update_product_qty_result = mysqli_query($connection, $update_product_qty_query);
}

if(isset($_GET['did'])){
  $did = $_GET['did'];

  $delete_cart_query = "DELETE FROM cart WHERE cart_id = $did";
  $delete_cart_result = mysqli_query($connection, $delete_cart_query);

  if(!$delete_cart_result){
    alertBox("Something went wrong. Please try again");
  }else{
    alertBox("Product successfully removed from your cart");
    header('location: cart.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Cart Page</title>
    
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
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

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
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
$sno = 1;
$select_car_query = "SELECT * FROM cart WHERE cart_uid = $db_user_id";
$select_car_result = mysqli_query($connection, $select_car_query);
while($row = mysqli_fetch_assoc($select_car_result)){
  $cart_id = $row['cart_id'];
  $cart_pid = $row['cart_pid'];
  $cart_qty = $row['cart_qty'];

  $select_product_details_query = "SELECT * FROM product_details WHERE product_id = $cart_pid";
  $select_product_details_result = mysqli_query($connection, $select_product_details_query);
  $product_count = mysqli_num_rows($select_product_details_result);
  if($product_count >= 1){
    while($row = mysqli_fetch_assoc($select_product_details_result)){
      $product_name = $row['product_name'];
      $product_price = $row['product_price'];
    }

    $function_call = "calcSubPrice$sno()";
                      ?>
                      <tr>
                        <td><a class="remove" href="cart.php?did=<?php echo $cart_id; ?>"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="img/man/polo-shirt-1.png" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="product-detail.php?pid=1"><?php echo $product_name; ?></a></td>
                        <td id="subProductPrice">Rs:<?php echo $product_price; ?></td>
                        <td><input class="aa-cart-quantity" id="subPqty<?php echo $sno; ?>" value="<?php echo $cart_qty; ?>" min="1" onchange="<?php echo $function_call; ?>" type="number" value="1"></td>
                        <td id="subPTotal<?php echo $sno; ?>">Rs: <?php echo $product_price; ?></td>
                      </tr>
<script>
  calcSubPrice<?php echo $sno; ?>();
  function calcSubPrice<?php echo $sno; ?>(){
    var subPqty = document.getElementById("subPqty<?php echo $sno; ?>").value;
    calcProductTotal = <?php echo $product_price; ?> * subPqty;

    document.getElementById("subPTotal<?php echo $sno; ?>").innerHTML = "Rs: " + calcProductTotal;

    calcTotal();

    var actionId = <?php echo $cart_id; ?>;

    $.ajax({
      'url': 'cart.php', 
      'type': 'POST',
      'data': {
        cart_id: actionId,
        cartPqty: subPqty
      }, 
      'success': function(data) {
        // alert("Done");
      },
      'error': function(data) {
        // alert("Failed");
      }
    });
  }
</script>
<?php
  }
  $sno++;
}
?>
                      <!-- <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                        </td>
                      </tr> -->
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <!-- <tr>
                     <th>Subtotal</th>
                     <td id="subTotalCart">Rs:200</td>
                   </tr> -->
                   
                   <tr>
                     <th>Total</th>
                     <td id="totalCart">Rs: 200</td>
                   </tr>
                   <script>
                     var sumTotalProduct = 0;
                     calcTotal();
                     function calcTotal(){
                        for(var i = 1; i < <?php echo $sno; ?>; i++){
                          var alterTotalName = "subPTotal" + i;
                          var singleProductTotal = parseInt(document.getElementById(alterTotalName).innerHTML.slice(4));
                          // console.log(singleProductTotal);
                          sumTotalProduct += singleProductTotal;
                        }
                        var finalTotal = document.getElementById("totalCart").innerHTML = "Rs: " + sumTotalProduct;
                        sumTotalProduct = 0;
                     }
                   </script>
                 </tbody>
               </table>

               <a href="checkout.php?billing" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->
  
<?php
include "includes/footer.php";
?>
<?php

include "database/conn.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Home</title>
    
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
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
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
  
  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <?php
$select_all_slider_query = "SELECT * FROM slider";
$select_all_slider_result = mysqli_query($connection, $select_all_slider_query);
while($row = mysqli_fetch_assoc($select_all_slider_result)){
  $slider_id = $row['slider_id'];
  $slider_img = $row['slider_img'];
  $slider_tag = $row['slider_tag'];
  $slider_title = $row['slider_title'];
  $slider_description = $row['slider_description'];
  $slider_link = $row['slider_link'];
            ?>
            <!-- single slide item -->
            <li>
              <div class="seq-model">
                <img data-seq src="img/slider/<?php echo $slider_img; ?>" alt="<?php echo $slider_title; ?>" />
              </div>
              <div class="seq-title">
               <span data-seq><?php echo $slider_tag; ?></span>                
                <h2 data-seq><?php echo $slider_title; ?></h2>                
                <p data-seq><?php echo $slider_description; ?></p>
                <a data-seq href="<?php echo $slider_link; ?>" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
<?php
}
?>
            <!-- single slide item -->
            
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <?php
$select_all_left_promos_query = "SELECT * FROM promo WHERE promo_position = 'left'";
$select_all_left_promos_result = mysqli_query($connection, $select_all_left_promos_query);
while($row = mysqli_fetch_assoc($select_all_left_promos_result)){
  $promo_id = $row['promo_id'];
  $promo_img = $row['promo_img'];
  $promo_tag = $row['promo_tag'];
  $promo_title = $row['promo_title'];
  $promo_link = $row['promo_link'];
              ?>
              <!-- promo left -->
              <div class="col-md-5 no-padding">                
                <div class="aa-promo-left">
                  <div class="aa-promo-banner">                    
                    <img src="img/promo/<?php echo $promo_img; ?>" alt="<?php echo $promo_tag; ?>">                    
                    <div class="aa-prom-content">
                      <span><?php echo $promo_tag; ?></span>
                      <h4><a href="<?php echo $promo_link; ?>"><?php echo $promo_title; ?></a></h4>                      
                    </div>
                  </div>
                </div>
              </div>
              <?php
}
              ?>
              <!-- promo right -->
              <div class="col-md-7 no-padding">
                <div class="aa-promo-right">
                  <?php
$select_all_right_promos_query = "SELECT * FROM promo WHERE promo_position = 'right'";
$select_all_right_promos_result = mysqli_query($connection, $select_all_right_promos_query);
while($row = mysqli_fetch_assoc($select_all_right_promos_result)){
  $promo_id = $row['promo_id'];
  $promo_img = $row['promo_img'];
  $promo_tag = $row['promo_tag'];
  $promo_title = $row['promo_title'];
  $promo_link = $row['promo_link'];
                  ?>
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="img/promo/<?php echo $promo_img; ?>" alt="<?php echo $promo_tag; ?>">                      
                      <div class="aa-prom-content">
                        <span><?php echo $promo_tag; ?></span>
                        <h4><a href="<?php echo $promo_link; ?>"><?php echo $promo_title; ?></a></h4>                        
                      </div>
                    </div>
                  </div>
<?php
}
?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <?php
$select_search_result_query = "SELECT * FROM product_details";
$select_search_result_result = mysqli_query($connection, $select_search_result_query);
while($row = mysqli_fetch_assoc($select_search_result_result)){
  $product_id = $row['product_id'];
  $product_name = $row['product_name'];
  $product_price = $row['product_price'];
  $product_short_desc = $row['product_short_desc'];
  $product_brief_desc = $row['product_brief_desc'];
  $product_category_id = $row['product_category_id'];
                ?>
                <li>
                  <figure>
                    <a class="aa-product-img" href="product-detail.php?pid=<?php echo $product_id; ?>">
                    <?php
$select_pd_pht_query1 = "SELECT * FROM product_img WHERE product_img_pid = $product_id ORDER BY product_img_id DESC";
$select_pd_pht_result1 = mysqli_query($connection, $select_pd_pht_query1);
while($row = mysqli_fetch_assoc($select_pd_pht_result1)){
  $pd_pht_name = $row['product_img_name'];
}

                  ?>
                  <img src="img/pd/<?php echo $pd_pht_name; ?>" style="width: 300px;"></a>
                    <a class="aa-add-card-btn"href="product-detail.php?pid=<?php echo $product_id; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="product-detail.php?pid=<?php echo $product_id; ?>"><?php echo $product_name; ?></a></h4>
                      <span class="aa-product-price">Rs: <?php echo $product_price; ?></span>
                      <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                    </figcaption>
                  </figure>                         
                  <div class="aa-product-hvr-content">
                    <a href="product-detail.php?pid=<?php echo $product_id; ?>&wishlistid=<?php echo $product_id; ?>" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                  </div>
                  <!-- product badge -->
                  <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                </li>
                <?php
}
                ?>
              </ul>
              <!-- / quick view modal -->   
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->
  
  
  <?php
include "includes/features.php";
  ?>
  
  <?php
include "includes/testimonial.php";
  ?>

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              <?php
$select_all_brands_query = "SELECT * FROM brand";
$select_all_brands_result = mysqli_query($connection, $select_all_brands_query);
while($row = mysqli_fetch_assoc($select_all_brands_result)){
  $brand_img = $row['brand_img'];
  $brand_name = $row['brand_name'];
              ?>
              <li><a><img src="img/brand/<?php echo $brand_img; ?>" alt="<?php echo $brand_name; ?>"></a></li>
              <?php
}
$select_all_brands_query = "SELECT * FROM brand";
$select_all_brands_result = mysqli_query($connection, $select_all_brands_query);
while($row = mysqli_fetch_assoc($select_all_brands_result)){
  $brand_img = $row['brand_img'];
  $brand_name = $row['brand_name'];
              ?>
              <li><a><img src="img/brand/<?php echo $brand_img; ?>" alt="<?php echo $brand_name; ?>"></a></li>
              <?php
}
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

  <!-- Subscribe section -->
  <section id="aa-subscribe" id="newsletter_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Get interesting offers and news up-to-date!</p>
            <?php
if(isset($_POST['newsletter_submit'])){
  $newsletter_email = $_POST['newsletter_email'];
  $newsletter_email = mysqli_real_escape_string($connection, $newsletter_email);

  $insert_newsletter_query = "INSERT INTO newsletter(newsletter_email, newsletter_date) VALUES('$newsletter_email', '$current_date')";
  $insert_newsletter_result = mysqli_query($connection, $insert_newsletter_query);
  if(!$insert_newsletter_result){
    echo "<script>alert('Failed to subscribe. Try again');</script>";
  }else{
    echo "<script>alert('Successfully subscribed.');</script>";
  }
}
            ?>
            <form action="index.php" method="post" class="aa-subscribe-form">
              <input type="email" name="newsletter_email" required placeholder="Enter your Email">
              <input type="submit" name="newsletter_submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

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
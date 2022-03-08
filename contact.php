<?php

include "database/conn.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Contact</title>
    
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
        <h2>Contact</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>         
          <li class="active">Contact</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->
<!-- start contact section -->
 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="aa-contact-area">
           <div class="aa-contact-top">
             <h2>We are wating to assist you..</h2>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, quos.</p>
           </div>
           <!-- contact map -->
           <div class="aa-contact-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31089.161526033942!2d80.19007688117163!3d13.089983360510002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5264078822719b%3A0xbda01077b89581e2!2sAnna%20Nagar%2C%20Chennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1646477889631!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>
           <!-- Contact address -->
           <div class="aa-contact-address">
             <div class="row">
               <div class="col-md-8">
                 <div class="aa-contact-address-left">
                   <?php
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $description = $_POST['description'];

  $name = mysqli_real_escape_string($connection, $name);
  $email = mysqli_real_escape_string($connection, $email);
  $description = mysqli_real_escape_string($connection, $description);

  $insert_contact_query = "INSERT INTO contact(contact_name, contact_email, contact_description, contact_date, contact_status) VALUES('$name', '$email', '$description', '$current_date', 'pending')";
  $insert_contact_result = mysqli_query($connection, $insert_contact_query);

  if(!$insert_contact_result){
    echo "<script>alert('Failed to Submit. Try again');</script>";
  }else{
    echo "<script>alert('Success. We will get back to you soon.');</script>";
  }
}
                   ?>
                   <form class="comments-form contact-form" action="contact.php" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="text" name="name" placeholder="Your Name" required class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="email" name="email" placeholder="Email" required class="form-control">
                        </div>
                      </div>
                    </div>
                     <!-- <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="text" name="subject" placeholder="Subject*" required class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="text" name="company" placeholder="Company" class="form-control">
                        </div>
                      </div>
                    </div>-->
                    <div class="form-group">                        
                      <textarea class="form-control" name="description" required style="width: 100%;" rows="3" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" name="submit" class="aa-secondary-btn">Send</button>
                  </form>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="aa-contact-address-right">
                   <address>
                     <h4>DailyShop</h4>
                     <p>Your Shopping Partner.</p>
                     <p><span class="fa fa-home"></span>Anna Nagar, Chennai</p>
                     <p><span class="fa fa-phone"></span><a href="tel:+919112233449">+919112233449</a></p>
                     <p><span class="fa fa-envelope"></span>Email: <a href="mailto:dailyshop@gmail.com">dailyshop@gmail.com</a></p>
                   </address>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

  <!-- Subscribe section -->
  <section id="aa-subscribe">
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
            <form action="contact.php" method="post" class="aa-subscribe-form">
              <input type="email" name="newsletter_email" required placeholder="Enter your Email">
              <input type="submit" name="newsletter_submit" value="Subscribe">
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
  


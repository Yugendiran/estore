<!-- Testimonial -->
<section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
                <?php
$select_all_testimonial_query = "SELECT * FROM testimonial";
$select_all_testimonial_result = mysqli_query($connection, $select_all_testimonial_query);
while($row = mysqli_fetch_assoc($select_all_testimonial_result)){
    $testimonial_img = $row['testimonial_img'];
    $testimonial_content = $row['testimonial_content'];
    $testimonial_autor = $row['testimonial_autor'];
    $testimonial_role = $row['testimonial_role'];
                ?>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/testimonial/<?php echo $testimonial_img; ?>" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p><?php echo $testimonial_content; ?></p>
                  <div class="aa-testimonial-info">
                    <p><?php echo $testimonial_autor; ?></p>
                    <span><?php echo $testimonial_role; ?></span>
                  </div>
                </div>
              </li>
              <!-- single slide -->
<?php
}
?>
<?php
$select_all_testimonial_query = "SELECT * FROM testimonial";
$select_all_testimonial_result = mysqli_query($connection, $select_all_testimonial_query);
while($row = mysqli_fetch_assoc($select_all_testimonial_result)){
    $testimonial_img = $row['testimonial_img'];
    $testimonial_content = $row['testimonial_content'];
    $testimonial_autor = $row['testimonial_autor'];
    $testimonial_role = $row['testimonial_role'];
                ?>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/testimonial/<?php echo $testimonial_img; ?>" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p><?php echo $testimonial_content; ?></p>
                  <div class="aa-testimonial-info">
                    <p><?php echo $testimonial_autor; ?></p>
                    <span><?php echo $testimonial_role; ?></span>
                  </div>
                </div>
              </li>
              <!-- single slide -->
<?php
}
?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->
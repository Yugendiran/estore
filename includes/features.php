  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
              <?php
$select_all_features_query = "SELECT * FROM features";
$select_all_features_result = mysqli_query($connection, $select_all_features_query);
while($row = mysqli_fetch_assoc($select_all_features_result)){
    $features_id = $row['features_id'];
    $features_icon = $row['features_icon'];
    $features_title = $row['features_title'];
    $features_description = $row['features_description'];

              ?>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="<?php echo $features_icon; ?>"></span>
                <h4><?php echo $features_title; ?></h4>
                <P><?php echo $features_description; ?></P>
              </div>
            </div>
<?php
}
?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
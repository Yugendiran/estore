<?php

if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $select_edit_query = "SELECT * FROM features WHERE features_id = $edit_id";
    $select_edit_result = mysqli_query($connection, $select_edit_query);
    while($row = mysqli_fetch_assoc($select_edit_result)){
        $features_icon = $row['features_icon'];
        $features_title = $row['features_title'];
        $features_description = $row['features_description'];
    }

    if(isset($_POST['edit'])){
        $eicon = $_POST['eicon'];
        $etitle = $_POST['etitle'];
        $edescription = $_POST['edescription'];

        $eicon = mysqli_real_escape_string($connection, $eicon);
        $etitle = mysqli_real_escape_string($connection, $etitle);
        $edescription = mysqli_real_escape_string($connection, $edescription);

        $update_features_query = "UPDATE features SET features_icon = '$eicon', features_title = '$etitle', features_description = '$edescription' WHERE features_id = $edit_id";
        $update_features_result = mysqli_query($connection, $update_features_query);

        if(!$update_features_result){
            alertBox("Features not updated. Try again");
        }else{
            header('location: landing_page.php?page=features');
        }
    }

    ?>

    <div class="row">
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                </div>
                <div class="card-body">
                    <form action="landing_page.php?page=features&edit_id=<?php echo $edit_id; ?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tag</label>
                            <input type="text" name="eicon" value="<?php echo $features_icon; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Icon Class">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="etitle" value="<?php echo $features_title; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Link</label>
                            <input type="text" name="edescription" value="<?php echo $features_description; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Description">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputPassword1">Background</label>
                            <input type="file" class="form-control" id="exampleInputPassword1">
                        </div> -->
                        <button type="submit" class="btn btn-primary" name="edit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Features</h1>
</div>
<div class="row">
    <?php
$select_all_lists_query = "SELECT * FROM features";
$select_all_lists_result = mysqli_query($connection, $select_all_lists_query);
while($row = mysqli_fetch_assoc($select_all_lists_result)){
    $features_id = $row['features_id'];
    $features_icon = $row['features_icon'];
    $features_title = $row['features_title'];
    $features_description = $row['features_description'];

    ?>
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Id: <?php echo $features_id; ?></h6>
            </div>
            <div class="card-body">
                <i class="<?php echo $features_icon; ?>" style="font-size: 25px;"></i>
                <h3><?php echo $features_title; ?></h3>
                <p><?php echo $features_description; ?></p>
                <hr>
                <a href="landing_page.php?page=features&edit_id=<?php echo $features_id; ?>"><p><i class="fa fa-pencil" style="font-size: 18px;"></i> Edit</p></a>
            </div>
        </div>
    </div>
    <?php
}
    ?>
</div>
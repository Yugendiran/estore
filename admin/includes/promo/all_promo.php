<?php

if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $select_promo_query = "SELECT * FROM promo WHERE promo_id = $edit_id";
    $select_promo_result = mysqli_query($connection, $select_promo_query);
    while($row = mysqli_fetch_assoc($select_promo_result)){
        $promo_id = $row['promo_id'];
        $promo_img = $row['promo_img'];
        $promo_tag = $row['promo_tag'];
        $promo_title = $row['promo_title'];
        $promo_link = $row['promo_link'];
    }

    if(isset($_POST['edit'])){
        $etag = $_POST['etag'];
        $etitle = $_POST['etitle'];
        $elink = $_POST['elink'];

        $etag = mysqli_real_escape_string($connection, $etag);
        $etitle = mysqli_real_escape_string($connection, $etitle);
        $elink = mysqli_real_escape_string($connection, $elink);

        if(empty($_FILES['eimg']['name'])){
            $update_promo_query = "UPDATE promo SET promo_tag = '$etag', promo_title = '$etitle', promo_link = '$elink' WHERE promo_id = $edit_id";
            $update_promo_result = mysqli_query($connection, $update_promo_query);

            if(!$update_promo_result){
                alertBox("Promo not updated. Try again");
            }else{
                header('location: landing_page.php?page=all_promo');
            }
        }else{
            $filename = $_FILES['eimg']['name'];
            $mod_filename = $db_user_id. date('YmdHis') . '-' . $filename;
            $destination = '../img/promo/' . $mod_filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['eimg']['tmp_name'];
            $size = $_FILES['eimg']['size'];

            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                alertBox("You file extension must be .png, .jpg or .jpeg");
            }elseif ($_FILES['eimg']['size'] > 5000000){
                alertBox("File too large! Try uploading below 5MB.");
            }else {
                $update_promo_query = "UPDATE promo SET promo_img = '$mod_filename', promo_tag = '$etag', promo_title = '$etitle', promo_link = '$elink' WHERE promo_id = $edit_id";
                $update_promo_result = mysqli_query($connection, $update_promo_query);

                if(!$update_promo_result){
                    alertBox("Promo not updated. Try again");
                }else{
                    move_uploaded_file($file, $destination);
                    header('location: landing_page.php?page=all_promo');
                }
            }
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
                    <form action="landing_page.php?page=all_promo&edit_id=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tag</label>
                            <input type="text" name="etag" value="<?php echo $promo_tag; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Tag">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="etitle" value="<?php echo $promo_title; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Link</label>
                            <input type="text" name="elink" value="<?php echo $promo_link; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Link">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Background</label>
                            <input type="file" name="eimg" class="form-control" id="exampleInputPassword1">
                        </div>
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
    <h1 class="h3 mb-0 text-gray-800">Promos</h1>
</div>
<div class="row">
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Left</h6>
            </div>
            <div class="card-body">
                <?php
$select_left_promo_query = "SELECT * FROM promo WHERE promo_position = 'left'";
$select_left_promo_result = mysqli_query($connection, $select_left_promo_query);
while($row = mysqli_fetch_assoc($select_left_promo_result)){
    $promo_id = $row['promo_id'];
    $promo_img = $row['promo_img'];
    $promo_tag = $row['promo_tag'];
    $promo_title = $row['promo_title'];
    $promo_link = $row['promo_link'];

    ?>
<a href="<?php echo $promo_link; ?>" target="_blank"><img src="../img/promo/<?php echo $promo_img; ?>" width="100%"></a>
<br>
<br>
<a href="landing_page.php?page=all_promo&edit_id=<?php echo $promo_id; ?>"><p>Edit</p></a>
    <?php
}
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Right</h6>
            </div>
            <div class="card-body">
                <?php
$select_left_promo_query = "SELECT * FROM promo WHERE promo_position = 'right'";
$select_left_promo_result = mysqli_query($connection, $select_left_promo_query);
while($row = mysqli_fetch_assoc($select_left_promo_result)){
    $promo_id = $row['promo_id'];
    $promo_img = $row['promo_img'];
    $promo_tag = $row['promo_tag'];
    $promo_title = $row['promo_title'];
    $promo_link = $row['promo_link'];

    ?>
<a href="<?php echo $promo_link; ?>" target="_blank"><img src="../img/promo/<?php echo $promo_img; ?>" width="100%"></a>
<br>
<br>
<a href="landing_page.php?page=all_promo&edit_id=<?php echo $promo_id; ?>"><p>Edit</p></a>
<hr>
    <?php
}
                ?>
            </div>
        </div>
    </div>
</div>
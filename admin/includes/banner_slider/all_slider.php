<?php
if(isset($_GET['add_slider'])){
    if(isset($_POST['add_slide'])){
        $slider_tag = $_POST['slider_tag'];
        $slider_title = $_POST['slider_title'];
        $slider_link = $_POST['slider_link'];
        $slider_desc = $_POST['slider_desc'];

        $slider_tag = mysqli_real_escape_string($connection, $slider_tag);
        $slider_title = mysqli_real_escape_string($connection, $slider_title);
        $slider_link = mysqli_real_escape_string($connection, $slider_link);
        $slider_desc = mysqli_real_escape_string($connection, $slider_desc);

        $filename = $_FILES['aslider_img']['name'];
        $mod_filename = $db_user_id. date('YmdHis') . '-' .$filename;
        $destination = '../img/slider/' . $mod_filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['aslider_img']['tmp_name'];
        $size = $_FILES['aslider_img']['size'];

        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
            alertBox("You file extension must be .png, .jpg or .jpeg");
        }elseif ($_FILES['aslider_img']['size'] > 5000000){
            alertBox("File too large! Try uploading below 5MB.");
        }else {
            $add_slider_query = "INSERT INTO slider(slider_img, slider_tag, slider_title, slider_description, slider_link) VALUES('$mod_filename' ,'$slider_tag', '$slider_title', '$slider_desc', '$slider_link')";
            $add_slider_result = mysqli_query($connection, $add_slider_query);

            if(!$add_slider_result){
                alertBox("Oops... Something went wrong. Please Try Again.");
            }else{
                move_uploaded_file($file, $destination);
                header("location: landing_page.php?page=all_banner_slider");
            }
        }
    }
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Slide</h6>
            </div>
            <div class="card-body">
                <form action="landing_page.php?page=all_banner_slider&add_slider=true" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tag</label>
                        <input type="text" name="slider_tag" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter tag" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input type="text" name="slider_title" class="form-control" id="exampleInputPassword1" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Banner link</label>
                        <input type="text" name="slider_link" class="form-control" id="exampleInputPassword1" placeholder="URL" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" name="slider_desc" rows="5" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Banner Image</label>
                        <input type="file" class="form-control" name="aslider_img" required>
                    </div>
                    <button type="submit" name="add_slide" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><hr><br>
<?php
}
?>

<?php
if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $select_slider_info_query = "SELECT * FROM slider WHERE slider_id = $edit_id";
    $select_slider_info_result = mysqli_query($connection, $select_slider_info_query);
    $slider_count = mysqli_num_rows($select_slider_info_result);
    if($slider_count < 1){
        header("location: landing_page.php?page=all_banner_slider");
    }else{
        $slider_rows = mysqli_fetch_assoc($select_slider_info_result);
    }

    if(isset($_POST['edit_slide'])){
        $slider_tag = $_POST['slider_tag'];
        $slider_title = $_POST['slider_title'];
        $slider_link = $_POST['slider_link'];
        $slider_desc = $_POST['slider_desc'];

        $slider_tag = mysqli_real_escape_string($connection, $slider_tag);
        $slider_title = mysqli_real_escape_string($connection, $slider_title);
        $slider_link = mysqli_real_escape_string($connection, $slider_link);
        $slider_desc = mysqli_real_escape_string($connection, $slider_desc);

        if(empty($_FILES['eslider_img']['name'])){
            $edit_slider_query = "UPDATE slider SET slider_tag = '$slider_tag', slider_title = '$slider_title', slider_description = '$slider_desc', slider_link = '$slider_link' WHERE slider_id = $edit_id";
            $edit_slider_result = mysqli_query($connection, $edit_slider_query);

            if(!$edit_slider_result){
                alertBox("Oops... Something went wrong. Please Try Again.");
            }else{
                header("location: landing_page.php?page=all_banner_slider");
            }
        }else{
            $filename = $_FILES['eslider_img']['name'];
            $mod_filename = $db_user_id. date('YmdHis') . '-' .$filename;
            $destination = '../img/slider/' . $mod_filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['eslider_img']['tmp_name'];
            $size = $_FILES['eslider_img']['size'];

            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                alertBox("You file extension must be .png, .jpg or .jpeg");
            }elseif ($_FILES['eslider_img']['size'] > 5000000){
                alertBox("File too large! Try uploading below 5MB.");
            }else {
                $edit_slider_query = "UPDATE slider SET slider_img = '$mod_filename', slider_tag = '$slider_tag', slider_title = '$slider_title', slider_description = '$slider_desc', slider_link = '$slider_link' WHERE slider_id = $edit_id";
                $edit_slider_result = mysqli_query($connection, $edit_slider_query);

                if(!$edit_slider_result){
                    alertBox("Oops... Something went wrong. Please Try Again.");
                }else{
                    move_uploaded_file($file, $destination);
                    header("location: landing_page.php?page=all_banner_slider");
                }
            }
        }
    }
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Slide</h6>
            </div>
            <div class="card-body">
                <form action="landing_page.php?page=all_banner_slider&edit_id=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tag</label>
                        <input type="text" name="slider_tag" value="<?php echo $slider_rows['slider_tag']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter tag" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input type="text" name="slider_title" value="<?php echo $slider_rows['slider_title']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Banner link</label>
                        <input type="text" name="slider_link" value="<?php echo $slider_rows['slider_link']; ?>" class="form-control" id="exampleInputPassword1" placeholder="URL" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" name="slider_desc" rows="5" placeholder="Description" required><?php echo $slider_rows['slider_description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Banner Image</label>
                        <input type="file" class="form-control" name="eslider_img">
                    </div>
                    <button type="submit" name="edit_slide" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><hr><br>
<?php
}
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Banner Slides</h1>
    <a href="landing_page.php?page=all_banner_slider&add_slider=true" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Slider</a>
</div>


<?php
if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_slider_query = "DELETE FROM slider WHERE slider_id = $del_id";
    $delete_slider_result = mysqli_query($connection, $delete_slider_query);
    
    if(!$delete_slider_result){
        alertBox("Oops... Something went wrong. Please Try again.");
    }else{
        header("location: landing_page.php?page=all_banner_slider");
    }
}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Slides</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Tag</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Tag</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_all_slides_query = "SELECT * FROM slider";
$select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
while($row = mysqli_fetch_assoc($select_all_slides_result)){
    $slider_id = $row['slider_id'];
    $slider_img = $row['slider_img'];
    $slider_tag = $row['slider_tag'];
    $slider_title = $row['slider_title'];
    $slider_description = $row['slider_description'];
    $slider_link = $row['slider_link'];
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><img width="200px" src="../img/slider/<?php echo $slider_img; ?>"></th>
                        <th><?php echo $slider_tag; ?></th>
                        <th><?php echo $slider_title; ?></th>
                        <th><?php echo $slider_description; ?></th>
                        <th><a href="landing_page.php?page=all_banner_slider&edit_id=<?php echo $slider_id; ?>">Edit</a></th>
                        <th><a href="landing_page.php?page=all_banner_slider&del_id=<?php echo $slider_id; ?>">Delete</a></th>
                    </tr>
<?php
$sno++;
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
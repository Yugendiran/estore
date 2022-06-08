<?php

if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_query = "DELETE FROM brand WHERE brand_id = $del_id";
    $delete_result = mysqli_query($connection, $delete_query);
    header("location: landing_page.php?page=brand");
}

if(isset($_GET['add_brand'])){
    if(isset($_POST['add'])){
        $aname = $_POST['aname'];

        $aname = mysqli_real_escape_string($connection, $aname);

        if(empty($_FILES['alogo']['name'])){
            alertBox("Image Required");
        }else{
            $filename = $_FILES['alogo']['name'];
            $mod_filename = $db_user_id. date('YmdHis') . '-' .$filename;
            $destination = '../img/brand/' . $mod_filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['alogo']['tmp_name'];
            $size = $_FILES['alogo']['size'];

            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                alertBox("You file extension must be .png, .jpg or .jpeg");
            }elseif ($_FILES['alogo']['size'] > 5000000){
                alertBox("File too large! Try uploading below 5MB.");
            }else {
                $add_query = "INSERT INTO brand(brand_img, brand_name) VALUES('$mod_filename', '$aname')";
                $add_result = mysqli_query($connection, $add_query);
                if(!$add_result){
                    alertBox("Oops! Something went wrong. Try again.");
                }
                else{
                    move_uploaded_file($file, $destination);
                    header("location: landing_page.php?page=brand");
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
                    <form action="landing_page.php?page=brand&add_brand=true" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="aname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Logo</label>
                            <input type="file" name="alogo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $select_edit_query = "SELECT * FROM brand WHERE brand_id = $edit_id";
    $select_edit_result = mysqli_query($connection, $select_edit_query);
    while($row = mysqli_fetch_assoc($select_edit_result)){
        $brand_id = $row['brand_id'];
        $brand_img = $row['brand_img'];
        $brand_name = $row['brand_name'];
    }

    if(isset($_POST['edit'])){
        $ename = $_POST['ename'];

        $ename = mysqli_real_escape_string($connection, $ename);

        if(empty($_FILES['elogo']['name'])){
            $update_brand_query = "UPDATE brand SET brand_name = '$ename' WHERE brand_id = $edit_id";
            $update_brand_result = mysqli_query($connection, $update_brand_query);

            if(!$update_brand_result){
                alertBox("Brand not updated. Try again");
            }else{
                header('location: landing_page.php?page=brand');
            }
        }else{
            $filename = $_FILES['elogo']['name'];
            $mod_filename = $db_user_id. date('YmdHis') . '-' . $filename;
            $destination = '../img/brand/' . $mod_filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['elogo']['tmp_name'];
            $size = $_FILES['elogo']['size'];

            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                alertBox("You file extension must be .png, .jpg or .jpeg");
            }elseif ($_FILES['elogo']['size'] > 5000000){
                alertBox("File too large! Try uploading below 5MB.");
            }else {
                $update_brand_query = "UPDATE brand SET brand_img = '$mod_filename', brand_name = '$ename' WHERE brand_id = $edit_id";
                $update_brand_result = mysqli_query($connection, $update_brand_query);

                if(!$update_brand_result){
                    alertBox("Brand not updated. Try again");
                }else{
                    move_uploaded_file($file, $destination);
                    header('location: landing_page.php?page=brand');
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
                    <form action="landing_page.php?page=brand&edit_id=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" value="<?php echo $brand_name; ?>" name="ename" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Logo</label>
                            <input type="file" name="elogo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
    <h1 class="h3 mb-0 text-gray-800">Brands</h1>
    <a href="landing_page.php?page=brand&add_brand=true" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Brand</a>
</div>
<div class="row">
    <?php
    $sno = 1;
$select_all_lists_query = "SELECT * FROM brand";
$select_all_lists_result = mysqli_query($connection, $select_all_lists_query);
while($row = mysqli_fetch_assoc($select_all_lists_result)){
    $brand_id = $row['brand_id'];
    $brand_img = $row['brand_img'];
    $brand_name = $row['brand_name'];

    ?>
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sno: <?php echo $sno; ?></h6>
            </div>
            <div class="card-body">
                <img src="../img/brand/<?php echo $brand_img; ?>" height="50px"><br><br>
                <h3><?php echo $brand_name; ?></h3>
                <hr>
                <a href="landing_page.php?page=brand&edit_id=<?php echo $brand_id; ?>"><p><i class="fa fa-pencil" style="font-size: 18px;"></i> Edit</p></a>
                <a href="landing_page.php?page=brand&del_id=<?php echo $brand_id; ?>"><p><i class="fa fa-trash" style="font-size: 18px;"></i> Delete</p></a>
            </div>
        </div>
    </div>
    <?php
    $sno++;
}
    ?>
</div>
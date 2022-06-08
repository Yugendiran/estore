<?php

if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_query = "DELETE FROM testimonial WHERE testimonial_id = $del_id";
    $delete_result = mysqli_query($connection, $delete_query);
    header("location: landing_page.php?page=testimonial");
}

if(isset($_GET['add_testimonial'])){
    if(isset($_POST['add'])){
        $aname = $_POST['aname'];
        $arole = $_POST['arole'];
        $adescription = $_POST['adescription'];

        $aname = mysqli_real_escape_string($connection, $aname);
        $arole = mysqli_real_escape_string($connection, $arole);
        $adescription = mysqli_real_escape_string($connection, $adescription);

        $filename = $_FILES['aimg']['name'];
        $mod_filename = $db_user_id. date('YmdHis') . '-' . $filename;
        $destination = '../img/testimonial/' . $mod_filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['aimg']['tmp_name'];
        $size = $_FILES['aimg']['size'];

        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
            alertBox("You file extension must be .png, .jpg or .jpeg");
        }elseif ($_FILES['aimg']['size'] > 5000000){
            alertBox("File too large! Try uploading below 5MB.");
        }else {
            $add_query = "INSERT INTO testimonial(testimonial_img, testimonial_content, testimonial_autor, testimonial_role) VALUES('$mod_filename', '$adescription', '$aname', '$arole')";
            $add_result = mysqli_query($connection, $add_query);
            move_uploaded_file($file, $destination);
            header("location: landing_page.php?page=testimonial");
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
                    <form action="landing_page.php?page=testimonial&add_testimonial=true" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="aname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" name="arole" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Role" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Link</label>
                            <input type="text" name="adescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Description" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Background</label>
                            <input type="file" class="form-control" name="aimg" id="exampleInputPassword1" required>
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

    $select_edit_query = "SELECT * FROM testimonial WHERE testimonial_id = $edit_id";
    $select_edit_result = mysqli_query($connection, $select_edit_query);
    while($row = mysqli_fetch_assoc($select_edit_result)){
        $testimonial_id = $row['testimonial_id'];
        $testimonial_img = $row['testimonial_img'];
        $testimonial_content = $row['testimonial_content'];
        $testimonial_autor = $row['testimonial_autor'];
        $testimonial_role = $row['testimonial_role'];
    }

    if(isset($_POST['edit'])){
        $ename = $_POST['ename'];
        $erole = $_POST['erole'];
        $edescription = $_POST['edescription'];

        $ename = mysqli_real_escape_string($connection, $ename);
        $erole = mysqli_real_escape_string($connection, $erole);
        $edescription = mysqli_real_escape_string($connection, $edescription);

        if(empty($_FILES['eimg']['name'])){
            $update_testimonial_query = "UPDATE testimonial SET testimonial_autor = '$ename', testimonial_role = '$erole', testimonial_content = '$edescription' WHERE testimonial_id = $edit_id";
            $update_testimonial_result = mysqli_query($connection, $update_testimonial_query);

            if(!$update_testimonial_result){
                alertBox("Features not updated. Try again");
            }else{
                header('location: landing_page.php?page=testimonial');
            }
        }else{
            $filename = $_FILES['eimg']['name'];
            $mod_filename = $db_user_id. date('YmdHis') . '-' . $filename;
            $destination = '../img/testimonial/' . $mod_filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['eimg']['tmp_name'];
            $size = $_FILES['eimg']['size'];

            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                alertBox("You file extension must be .png, .jpg or .jpeg");
            }elseif ($_FILES['eimg']['size'] > 5000000){
                alertBox("File too large! Try uploading below 5MB.");
            }else {
                $update_testimonial_query = "UPDATE testimonial SET testimonial_img = '$mod_filename', testimonial_autor = '$ename', testimonial_role = '$erole', testimonial_content = '$edescription' WHERE testimonial_id = $edit_id";
                $update_testimonial_result = mysqli_query($connection, $update_testimonial_query);

                if(!$update_testimonial_result){
                    alertBox("Features not updated. Try again");
                }else{
                    move_uploaded_file($file, $destination);
                    header('location: landing_page.php?page=testimonial');
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
                    <form action="landing_page.php?page=testimonial&edit_id=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="ename" value="<?php echo $testimonial_autor; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" name="erole" value="<?php echo $testimonial_role; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Role">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Link</label>
                            <input type="text" name="edescription" value="<?php echo $testimonial_content; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Background</label>
                            <input type="file" class="form-control" name="eimg" id="exampleInputPassword1">
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
    <h1 class="h3 mb-0 text-gray-800">Testimonial</h1>
    <a href="landing_page.php?page=testimonial&add_testimonial=true" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Testimonial</a>
</div>
<div class="row">
    <?php
    $sno = 1;
$select_all_lists_query = "SELECT * FROM testimonial";
$select_all_lists_result = mysqli_query($connection, $select_all_lists_query);
while($row = mysqli_fetch_assoc($select_all_lists_result)){
    $testimonial_id = $row['testimonial_id'];
    $testimonial_img = $row['testimonial_img'];
    $testimonial_content = $row['testimonial_content'];
    $testimonial_autor = $row['testimonial_autor'];
    $testimonial_role = $row['testimonial_role'];

    ?>
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sno: <?php echo $sno; ?></h6>
            </div>
            <div class="card-body">
                <img src="../img/testimonial/<?php echo $testimonial_img; ?>" height="150px"><br><br>
                <h3><?php echo $testimonial_autor; ?></h3>
                <h4><?php echo $testimonial_role; ?></h4>
                <p><?php echo $testimonial_content; ?></p>
                <hr>
                <a href="landing_page.php?page=testimonial&edit_id=<?php echo $testimonial_id; ?>"><p><i class="fa fa-pencil" style="font-size: 18px;"></i> Edit</p></a>
                <a href="landing_page.php?page=testimonial&del_id=<?php echo $testimonial_id; ?>"><p><i class="fa fa-trash" style="font-size: 18px;"></i> Delete</p></a>
            </div>
        </div>
    </div>
    <?php
    $sno++;
}
    ?>
</div>
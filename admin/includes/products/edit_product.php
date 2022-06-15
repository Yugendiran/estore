<?php

if(isset($_GET['edit_id'])){
    $pedit_id = $_GET['edit_id'];
    $select_product_query = "SELECT * FROM product_details WHERE product_id = $pedit_id";
    $select_product_result = mysqli_query($connection, $select_product_query);
    $product_count = mysqli_num_rows($select_product_result);

    if($product_count < 1){
        header("location: product.php");
    }else{
        while($row = mysqli_fetch_assoc($select_product_result)){
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_short_desc = $row['product_short_desc'];
            $product_brief_desc = $row['product_brief_desc'];
            $dbproduct_category_id = $row['product_category_id'];
        }

        if(isset($_GET['pd_del_id'])){
            $pd_del_id = $_GET['pd_del_id'];
        
            $delete_pht_query = "DELETE FROM product_img WHERE product_img_id = $pd_del_id AND product_img_pid = $product_id";
            $delete_pht_result = mysqli_query($connection, $delete_pht_query);
            header("location: product.php?page=edit_product&edit_id=" . $pedit_id);
        }
        
        $select_imgs_query = "SELECT * FROM product_img WHERE product_img_pid = $pedit_id";
        $select_imgs_result = mysqli_query($connection, $select_imgs_query);
        $count_imgs = mysqli_num_rows($select_imgs_result);
        $imgs_can_add = 5 - $count_imgs;

        if(isset($_POST['add_slide'])){
            $pname = $_POST['pname'];
            $pprice = $_POST['pprice'];
            $pshort = $_POST['pshort'];
            $pbrief = $_POST['pbrief'];
            
            $pname = mysqli_real_escape_string($connection, $pname);
            $pprice = mysqli_real_escape_string($connection, $pprice);
            $pshort = mysqli_real_escape_string($connection, $pshort);
            $pbrief = mysqli_real_escape_string($connection, $pbrief);
            
            if(isset($_POST['pcat'])){
                $pcat = $_POST['pcat'];
            }

            if(!empty($_POST['psize'])){
                $psize = $_POST['psize'];
            }

            if(!isset($pcat)){
                alertBox("Please choose any category");
            }elseif(empty($_POST['psize'])){
                alertBox("Please select atleast one size");
            }else{
                $update_prduct_details_query = "UPDATE product_details SET product_name = '$pname', product_price = '$pprice', product_short_desc = '$pshort', product_brief_desc = '$pbrief', product_category_id = '$pcat' WHERE product_id = $pedit_id";
                $update_prduct_details_result = mysqli_query($connection, $update_prduct_details_query);

                $delete_size_query = mysqli_query($connection, "DELETE FROM product_size WHERE product_size_pid = $pedit_id");

                foreach($psize as $size){
                    $insert_size_query = "INSERT INTO product_size(product_size_pid, product_size_name) VALUES($pedit_id, '$size')";
                    $insert_size_result = mysqli_query($connection, $insert_size_query);
                }

                $inserted_img_count = count($_FILES['pimg']['name']);
                if($imgs_can_add >= $inserted_img_count){
                    $countfiles = count($_FILES['pimg']['name']);
                    for($i=0; $i<$countfiles; $i++){
                        $filename = $_FILES['pimg']['name'][$i];
                        $mod_filename = $i . $pedit_id . date('YmdHis') .'-'. $filename;
                        $extension = pathinfo($filename, PATHINFO_EXTENSION);
                        $size = $_FILES['pimg']['size'][$i];
    
                        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                            alertBox($filename." Not uploaded because of wrong file formate. Only png, jpg, jpeg files are accepted.");
                        } elseif ($size > 5000000){
                            alertBox($filename." Not uploaded because of file size. File size must be below 5mb");
                        } else {
                            $insert_pimg_query = "INSERT INTO product_img(product_img_pid, product_img_name) VALUES($pedit_id, '$mod_filename')";
                            $insert_pimg_result = mysqli_query($connection, $insert_pimg_query);
                            if(!$insert_pimg_result){
                                alertBox($filename." Failed to upload.");
                            }else{
                                move_uploaded_file($_FILES['pimg']['tmp_name'][$i],'../img/pd/'.$mod_filename);
                            }
                        }
                    }
                }else{
                    alertBox("You are allowed to add only $imgs_can_add because this product has $count_imgs already. Max images is 5");
                }

                // header("location: product.php");
            }
        }
    }
}else{
    header("location: product.php");
}
?>

<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form action="product.php?page=edit_product&edit_id=<?php echo $pedit_id; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" value="<?php echo $product_name; ?>" name="pname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Price</label>
                        <input type="number" value="<?php echo $product_price; ?>" name="pprice" class="form-control" id="exampleInputPassword1" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Short Description</label>
                        <textarea class="form-control" name="pshort" rows="5" placeholder="Short Description" required><?php echo $product_short_desc; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Brief Description</label>
                        <textarea class="form-control" name="pbrief" rows="8" placeholder="Brief Description" required><?php echo $product_brief_desc; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select class="form-control" name="pcat" required>
                            <option selected disabled>Choose a category</option>
                        <?php
                            $select_all_category_query = "SELECT * FROM product_category";
                            $select_all_category_result = mysqli_query($connection, $select_all_category_query);
                            while($row = mysqli_fetch_assoc($select_all_category_result)){
                                $product_category_id = $row['product_category_id'];
                                $product_category_name = $row['product_category_name'];

                                if($product_category_id == $dbproduct_category_id){
                                ?>
                                <option selected value="<?php echo $product_category_id; ?>"><?php echo $product_category_name; ?></option>
                                <?php
                                }else{
                                ?>
                                <option value="<?php echo $product_category_id; ?>"><?php echo $product_category_name; ?></option>
                                <?php
                            }}
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Sizes</label><br>
                        <?php
$select_size = mysqli_query($connection, "SELECT * FROM product_size WHERE product_size_pid = $pedit_id AND product_size_name = 'XXL'");
$size_count = mysqli_num_rows($select_size);
if($size_count >= 1){
    echo '<input type="checkbox" name="psize[]" value="XXL" checked> XXL<br>';
}else{
    echo '<input type="checkbox" name="psize[]" value="XXL"> XXL<br>';
}

$select_size = mysqli_query($connection, "SELECT * FROM product_size WHERE product_size_pid = $pedit_id AND product_size_name = 'XL'");
$size_count = mysqli_num_rows($select_size);
if($size_count >= 1){
    echo '<input type="checkbox" name="psize[]" value="XL" checked> XL<br>';
}else{
    echo '<input type="checkbox" name="psize[]" value="XL"> XL<br>';
}

$select_size = mysqli_query($connection, "SELECT * FROM product_size WHERE product_size_pid = $pedit_id AND product_size_name = 'L'");
$size_count = mysqli_num_rows($select_size);
if($size_count >= 1){
    echo '<input type="checkbox" name="psize[]" value="L" checked> L<br>';
}else{
    echo '<input type="checkbox" name="psize[]" value="L"> L<br>';
}

$select_size = mysqli_query($connection, "SELECT * FROM product_size WHERE product_size_pid = $pedit_id AND product_size_name = 'M'");
$size_count = mysqli_num_rows($select_size);
if($size_count >= 1){
    echo '<input type="checkbox" name="psize[]" value="M" checked> M<br>';
}else{
    echo '<input type="checkbox" name="psize[]" value="M"> M<br>';
}

$select_size = mysqli_query($connection, "SELECT * FROM product_size WHERE product_size_pid = $pedit_id AND product_size_name = 'S'");
$size_count = mysqli_num_rows($select_size);
if($size_count >= 1){
    echo '<input type="checkbox" name="psize[]" value="S" checked> S<br>';
}else{
    echo '<input type="checkbox" name="psize[]" value="S"> S<br>';
}
                        ?>
         
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Images</label>
                        <input type="file" name="pimg[]" class="form-control" id="exampleInputPassword1" multiple>
                        <label for="exampleInputPassword1">Note: You can add <?php echo $imgs_can_add; ?> images.</label>
                    </div>
                    <button type="submit" name="add_slide" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Photos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Photo</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Photo</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_all_slides_query = "SELECT * FROM product_img WHERE product_img_pid = $pedit_id";
$select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
while($row = mysqli_fetch_assoc($select_all_slides_result)){
    $pd_pht_id = $row['product_img_id'];
    $pd_pht_name = $row['product_img_name'];
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><img src="../img/pd/<?php echo $pd_pht_name; ?>" height="100px"></th>
                        <th><a href="product.php?page=edit_product&edit_id=<?php echo $product_id; ?>&pd_del_id=<?php echo $pd_pht_id; ?>">Delete</a></th>
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
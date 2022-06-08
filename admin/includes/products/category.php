<?php

if(isset($_GET['cat_del_id'])){
    $cat_del_id = $_GET['cat_del_id'];

    $delete_cat_query = "DELETE FROM product_category WHERE product_category_id = $cat_del_id";
    $delete_cat_result = mysqli_query($connection, $delete_cat_query);
    header("location: product.php?page=category");
}

if(isset($_GET['add_category'])){
    if(isset($_POST['add_cat'])){
        $acat = strtolower($_POST['acat']);

        $acat = mysqli_real_escape_string($connection, $acat);

        $insert_cat_query = "INSERT INTO product_category(product_category_name) VALUES('$acat')";
        $insert_cat_result = mysqli_query($connection, $insert_cat_query);
        header("location: product.php?page=category");
    }
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form action="product.php?page=category&add_category=true" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="acat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category Name" required>
                    </div>
                    <button type="submit" name="add_cat" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}

if(isset($_GET['cat_edit_id'])){

    $cat_edit_id = $_GET['cat_edit_id'];

    $select_all_slides_query = "SELECT * FROM product_category WHERE product_category_id = $cat_edit_id";
    $select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
    while($row = mysqli_fetch_assoc($select_all_slides_result)){
        $dbproduct_category_name = $row['product_category_name']; 
    }

    if(isset($_POST['edit_cat'])){
        $ecat = strtolower($_POST['ecat']);

        $ecat = mysqli_real_escape_string($connection, $ecat);

        $update_cat_query = "UPDATE product_category SET product_category_name = '$ecat' WHERE product_category_id = $cat_edit_id";
        $update_cat_result = mysqli_query($connection, $update_cat_query);
        header("location: product.php?page=category");
    }
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form action="product.php?page=category&cat_edit_id=<?php echo $cat_edit_id; ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" value="<?php echo $dbproduct_category_name; ?>" name="ecat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category Name" required>
                    </div>
                    <button type="submit" name="edit_cat" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    <a href="product.php?page=category&add_category=true" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_all_slides_query = "SELECT * FROM product_category";
$select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
while($row = mysqli_fetch_assoc($select_all_slides_result)){
    $product_category_id = $row['product_category_id'];
    $product_category_name = $row['product_category_name'];
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php echo $product_category_name; ?></th>
                        <th>
                            <?php
$select_all_products_query = "SELECT * FROM product_details WHERE product_category_id = $product_category_id";
$select_all_products_result = mysqli_query($connection, $select_all_products_query);
$product_count = mysqli_num_rows($select_all_products_result);
echo $product_count;
                            ?>
                        </th>
                        <th><a href="product.php?page=category&cat_edit_id=<?php echo $product_category_id; ?>">Edit</a></th>
                        <th><a href="product.php?page=category&cat_del_id=<?php echo $product_category_id; ?>">Delete</a></th>
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
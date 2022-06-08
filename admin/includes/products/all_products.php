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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sizes</th>
                        <th>Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sizes</th>
                        <th>Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_all_slides_query = "SELECT * FROM product_details";
$select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
while($row = mysqli_fetch_assoc($select_all_slides_result)){
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $product_price = $row['product_price'];
    $product_short_desc = $row['product_short_desc'];
    $product_brief_desc = $row['product_brief_desc'];
    $product_category_id = $row['product_category_id'];
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php echo $product_name; ?></th>
                        <th><?php echo $product_price; ?></th>
                        <th>
                            <?php
                            $select_sizes_query = "SELECT * FROM product_size WHERE product_size_pid = $product_id";
                            $select_sizes_result = mysqli_query($connection, $select_sizes_query);
                            while($row = mysqli_fetch_assoc($select_sizes_result)){
                                echo $row['product_size_name'] . "<br>";
                            }
                            ?>
                        </th>
                        <th><a href="../product-detail.php?pid=<?php echo $product_id; ?>" target="_blank">View</a></th>
                        <th><a href="product.php?page=edit_product&edit_id=<?php echo $slider_id; ?>">Edit</a></th>
                        <th><a href="product.php?del_id=<?php echo $product_id; ?>">Delete</a></th>
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
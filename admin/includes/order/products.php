<?php
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
}else{
    header("location: orders.php");
}
?>
<?php
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'dispatch'){
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order ID - <?php echo $order_id; ?></h6>
            </div>
            <div class="card-body">
                <p>Confirm Dispatch?</p>
                <a href="orders.php?page=products&order_id=<?php echo $order_id; ?>&action=dispatch_confirm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check fa-sm text-white-50"></i> Dispatch</a>
            </div>
        </div>
        <?php
    }elseif($action == 'dispatch_confirm'){
        $update_order_status_query = "UPDATE order_details SET order_details_ship_status = 'Dispatched' WHERE order_details_token = '$order_id'";
        $update_order_status_result = mysqli_query($connection, $update_order_status_query);

        $insert_product_track_query = "INSERT INTO order_track(order_track_token, order_track_date, order_track_time, order_track_contant) VALUES('$order_id', '$current_date', '$current_time', 'Dispatched from the seller.')";
        $insert_product_track_result = mysqli_query($connection, $insert_product_track_query);

        header('location: delivery.php');
    }
}
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order ID - <?php echo $order_id; ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Sno</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_all_slides_query = "SELECT * FROM order_products WHERE order_products_token = '$order_id'";
$select_all_slides_result = mysqli_query($connection, $select_all_slides_query);
while($row = mysqli_fetch_assoc($select_all_slides_result)){
    $order_products_id = $row['order_products_id'];
    $order_products_uid = $row['order_products_uid'];
    $order_products_pid = $row['order_products_pid'];
    $order_products_price = $row['order_products_price'];
    $order_products_qty = $row['order_products_qty'];
    $order_products_size = $row['order_products_size'];
    $order_products_token = $row['order_products_token'];
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php 
                        $select_product_details_query = "SELECT * FROM product_details WHERE product_id = $order_products_pid";
                        $select_product_details_result = mysqli_query($connection, $select_product_details_query);
                        while($row = mysqli_fetch_assoc($select_product_details_result)){
                            $product_name = $row['product_name'];
                        }
                        echo $product_name;
                        ?></th>
                        <th><?php echo $order_products_price; ?></th>
                        <th><?php echo $order_products_qty; ?></th>
                        <th><?php echo $order_products_size; ?></th>
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
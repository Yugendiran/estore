<?php

if(isset($_GET['order_id'])){
    $order_id_token = $_GET['order_id'];
}else{
    header("location: delivery.php");
}

if(isset($_POST['add'])){
    $mess = $_POST['mess'];

    $insert_order_track_query = "INSERT INTO order_track(order_track_token, order_track_date, order_track_time, order_track_contant) VALUES('$order_id_token', '$current_date', '$current_time', '$mess')";
    $insert_order_track_result = mysqli_query($connection, $insert_order_track_query);

    $status = $_POST['status'];
    $update_order_status = "UPDATE order_details SET order_details_ship_status = '$status' WHERE order_details_token = '$order_id_token'";
    $update_order_result = mysqli_query($connection, $update_order_status);

    header("location: delivery.php");
}
?>
<div class="row">
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ship Record</h6>
            </div>
            <div class="card-body">
                <form action="delivery.php?page=ship&order_id=<?php echo $order_id_token; ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <input type="text" name="mess" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Message" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shipping Status</label>
                        <select name="status" class="form-control">
                            <option value="Order Placed">Order Placed</option>
                            <option value="Dispatched">Dispatched</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Out For Delivery">Out For Delivery</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
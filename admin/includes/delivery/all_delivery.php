<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Order ID</th>
                        <th>MOJO ID</th>
                        <th>User</th>
                        <th>Payment Mode</th>
                        <th>Billing Address</th>
                        <th>Shipping Address</th>
                        <th>Payment Status</th>
                        <th>Date</th>
                        <th>Products</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Order ID</th>
                        <th>MOJO ID</th>
                        <th>User</th>
                        <th>Payment Mode</th>
                        <th>Billing Address</th>
                        <th>Shipping Address</th>
                        <th>Payment Status</th>
                        <th>Date</th>
                        <th>Products</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_order_details_query = "SELECT * FROM order_details";
$select_order_details_result = mysqli_query($connection, $select_order_details_query);
while($row = mysqli_fetch_assoc($select_order_details_result)){
    $order_details_pay_id = $row['order_details_pay_id'];
    $order_details_token = $row['order_details_token'];
    $order_details_uid = $row['order_details_uid'];
    $order_details_pm = $row['order_details_pm'];
    $order_details_bill = $row['order_details_bill'];
    $order_details_ship = $row['order_details_ship'];
    $order_details_status = $row['order_details_status'];
    $order_details_date = $row['order_details_date'];
    $order_details_ship_status = $row['order_details_ship_status'];

    if($order_details_ship_status != "Delivered"){
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php echo $order_details_token; ?></th>
                        <th><?php echo $order_details_pay_id; ?></th>
                        <th><?php
                        $select_user_details_query = "SELECT * FROM users WHERE user_id = $order_details_uid";
                        $select_user_details_result = mysqli_query($connection, $select_user_details_query);
                        while($row = mysqli_fetch_assoc($select_user_details_result)){
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];
                            $user_email = $row['user_email'];
                            $user_phone = base64_decode($row['user_phone']);
                        }

                        echo "$user_id - $user_name <br> $user_email <br> $user_phone";
                        ?></th>
                        <th><?php echo $order_details_pm; ?></th>
                        <th>
                        <?php
                        $bill_address = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = '$user_id' AND address_id = '$order_details_bill' AND address_mode = 'billing'");
                        while($row = mysqli_fetch_assoc($bill_address)){
                        $baddress_name = $row['address_name'];
                        $baddress_email = $row['address_email'];
                        $baddress_phone = $row['address_phone'];
                        $baddress_address = $row['address_address'];
                        $baddress_bname = $row['address_bname'];
                        $baddress_ct = $row['address_ct'];
                        $baddress_dis = $row['address_dis'];
                        $baddress_pincode = $row['address_pincode'];
                        }
                        echo $baddress_name .'<br>'. $baddress_bname .'<br>'. $baddress_address .'<br>'. $baddress_ct .'<br>'. $baddress_dis . ' <br> ' . $baddress_pincode .'<br>'. $baddress_email .'<br>'. $baddress_phone;
                        ?>
                        </th>
                        <th><?php
                        $ship_address = mysqli_query($connection, "SELECT * FROM address WHERE address_uid = '$user_id' AND address_id = '$order_details_ship' AND address_mode = 'shipping'");
                        while($row = mysqli_fetch_assoc($ship_address)){
                          $saddress_name = $row['address_name'];
                          $saddress_email = $row['address_email'];
                          $saddress_phone = $row['address_phone'];
                          $saddress_address = $row['address_address'];
                          $saddress_bname = $row['address_bname'];
                          $saddress_ct = $row['address_ct'];
                          $saddress_dis = $row['address_dis'];
                          $saddress_pincode = $row['address_pincode'];
                        }
                        echo $saddress_name .'<br>'. $saddress_bname .'<br>'. $saddress_address .'<br>'. $saddress_ct .'<br>'. $saddress_dis . ' <br> ' . $saddress_pincode .'<br>'. $saddress_email .'<br>'. $saddress_phone;
                        ?></th>
                        <th><?php echo $order_details_status; ?></th>
                        <th><?php echo $order_details_date; ?></th>
                        <th><a href="orders.php?page=products&order_id=<?php echo $order_details_token; ?>">View Products</a><hr>
                        <a href="delivery.php?page=ship&order_id=<?php echo $order_details_token; ?>">Track Order</a></th>
                    </tr>
<?php
    }
$sno++;
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
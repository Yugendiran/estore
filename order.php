<?php
include "database/conn.php";
// http://localhost/estore/order.php?paym=online&bid=1&sid=2
if(!isset($_SESSION['login_user_id'])){
  header("location: account.php?redirect=checkout.php");
}

if(!isset($_GET['paym']) || !isset($_GET['bid']) || !isset($_GET['sid'])){
    header("checkout.php?page=billing");
}else{
    $payment_method = $_GET['paym'];
    $bill_add = $_GET['bid'];
    $ship_add = $_GET['sid'];
}

$token = $db_user_id . date('dmYHis') . md5(random_bytes(5));
$current_dt = date('d-m-y H:i');
$insert_order_query = "INSERT INTO order_details(order_details_uid, order_details_token, order_details_pm, order_details_bill, order_details_ship, order_details_status, order_details_date) VALUES($db_user_id, '$token', '$payment_method', '$bill_add', '$ship_add', 'Pending', '$current_dt')";
$insert_order_result = mysqli_query($connection, $insert_order_query);
if(!$insert_order_result){
    header("location: checkout.php");
}

$total_price = 0;
$select_all_products_query = "SELECT * FROM cart WHERE cart_uid = $db_user_id";
$select_all_products_result = mysqli_query($connection, $select_all_products_query);
while($row = mysqli_fetch_assoc($select_all_products_result)){
    $cart_pid = $row['cart_pid'];
    $cart_qty = $row['cart_qty'];

    $select_product_details_query = "SELECT * FROM product_details WHERE product_id = $cart_pid";
    $select_product_details_result = mysqli_query($connection, $select_product_details_query);
    while($row2 = mysqli_fetch_assoc($select_product_details_result)){
        $dbproduct_price = $row2['product_price'];
        $subtotal = $dbproduct_price * $cart_qty;
    }
    $total_price += $subtotal;

    $insert_order_product_query = "INSERT INTO order_products(order_products_uid, order_products_pid, order_products_qty, order_products_token, order_products_price) VALUES($db_user_id, $cart_pid, $cart_qty, '$token', '$dbproduct_price')";
    $insert_order_product_result = mysqli_query($connection, $insert_order_product_query);
}

$select_user_query = "SELECT * FROM users WHERE user_id = $db_user_id";
$select_user_result = mysqli_query($connection, $select_user_query);
while($row = mysqli_fetch_assoc($select_user_result)){
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_phone = base64_decode($row['user_phone']);
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_de77659a0ef167d8183e2182875",
                  "X-Auth-Token:test_f55aaa071063cd273a520ab0caa"));
$payload = Array(
    'purpose' => $token,
    'amount' => $total_price,
    'phone' => $user_phone,
    'buyer_name' => $user_name,
    'redirect_url' => 'http://localhost/estore/redirect.php?token='.$token,
    'send_email' => true,
    'send_sms' => true,
    'email' => $user_email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$response = json_decode($response);
// $_SESSION['TID'] = $response->payment_request->id;

header("location: " . $response->payment_request->longurl);
die();
?>
<?php
include  "db/conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/topbar.php";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "";
}

switch($page){
    case "products":
        include "includes/order/products.php";
        break;
    default:
        include "includes/order/all_orders.php";
}

include "includes/footer.php";
?>
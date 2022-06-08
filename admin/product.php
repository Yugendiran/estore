<?php
include  "db/conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/topbar.php";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '';
}

if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_query = "DELETE FROM product_details WHERE product_id = $del_id";
    $delete_result = mysqli_query($connection, $delete_query);
    
    $delete_query = "DELETE FROM product_size WHERE product_size_pid = $del_id";
    $delete_result = mysqli_query($connection, $delete_query);

    header("location: product.php?page=".$page);
}

switch($page){
    case "add_product":
        include "includes/products/add_product.php";
        break;
    case "category":
        include "includes/products/category.php";
        break;
    default:
        include "includes/products/all_products.php";
}

include "includes/footer.php";
?>
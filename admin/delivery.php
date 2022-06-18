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
    case "ship":
        include "includes/delivery/ship.php";
        break;
    default:
        include "includes/delivery/all_delivery.php";
}

include "includes/footer.php";
?>
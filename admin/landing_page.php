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
?>
<?php
switch($page){
    case "all_banner_slider":
        include "includes/banner_slider/all_slider.php";
        break;
    case "all_promo":
        include "includes/promo/all_promo.php";
        break;
    case "features":
        include "includes/features/all_features.php";
        break;
    case "testimonial":
        include "includes/testimonial/all_testimonial.php";
        break;
    case "brand":
        include "includes/brand/all_brand.php";
        break;
    default:
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cards</h1>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Home Slider</h6>
                </div>
                <div class="card-body">
                    <a href="landing_page.php?page=all_banner_slider" style="width: 100%;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Section</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Promos</h6>
                </div>
                <div class="card-body">
                    <a href="landing_page.php?page=all_promo" style="width: 100%;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Section</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Features</h6>
                </div>
                <div class="card-body">
                    <a href="landing_page.php?page=features" style="width: 100%;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Section</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Testimonial</h6>
                </div>
                <div class="card-body">
                    <a href="landing_page.php?page=testimonial" style="width: 100%;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Section</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Brands</h6>
                </div>
                <div class="card-body">
                    <a href="landing_page.php?page=brand" style="width: 100%;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Section</a>
                </div>
            </div>
        </div>
    </div>
<?php
    break;
}
?>
<?php
include "includes/footer.php";
?>
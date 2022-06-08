<?php
    if(isset($_POST['add_slide'])){
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pshort = $_POST['pshort'];
        $pbrief = $_POST['pbrief'];
        $pcat = $_POST['pcat'];

        $pname = mysqli_real_escape_string($connection, $pname);
        $pprice = mysqli_real_escape_string($connection, $pprice);
        $pshort = mysqli_real_escape_string($connection, $pshort);
        $pbrief = mysqli_real_escape_string($connection, $pbrief);
        $pcat = mysqli_real_escape_string($connection, $pcat);

        $add_slider_query = "INSERT INTO product_details(product_name, product_price, product_short_desc, product_brief_desc, product_category_id) VALUES('$pname', '$pprice', '$pshort', '$pbrief', '$pcat')";
        $add_slider_result = mysqli_query($connection, $add_slider_query);

        $psize = $_POST['psize'];
        if(empty($psize)){
            alertBox("Choose available product sizes");
        }else{
            $select_id_query = "SELECT product_id FROM product_details";
            $select_id_result = mysqli_query($connection, $select_id_query);
            while($row = mysqli_fetch_assoc($select_id_result)){
                $pid = $row['product_id'];
            }

            foreach($psize as $size){
                $insert_size_query = "INSERT INTO product_size(product_size_pid, product_size_name) VALUES($pid, '$size')";
                $insert_size_result = mysqli_query($connection, $insert_size_query);
            }
        }
        
        if(!$add_slider_result){
            alertBox("Oops... Something went wrong. Please Try Again.");
        }else{
            header("location: product.php");
        }
    }
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form action="product.php?page=add_product" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="pname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Price</label>
                        <input type="number" name="pprice" class="form-control" id="exampleInputPassword1" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Short Description</label>
                        <textarea class="form-control" name="pshort" rows="5" placeholder="Short Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Brief Description</label>
                        <textarea class="form-control" name="pbrief" rows="8" placeholder="Brief Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Banner Image</label>
                        <select class="form-control" name="pcat" required>
                            <option selected disabled>Choose a category</option>
                        <?php
                            $select_all_category_query = "SELECT * FROM product_category";
                            $select_all_category_result = mysqli_query($connection, $select_all_category_query);
                            while($row = mysqli_fetch_assoc($select_all_category_result)){
                                $product_category_id = $row['product_category_id'];
                                $product_category_name = $row['product_category_name'];
                                ?>
                                <option value="<?php echo $product_category_id; ?>"><?php echo $product_category_name; ?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Sizes</label><br>
                        <input type="checkbox" name="psize[]" value="XXL"> XXL<br>
                        <input type="checkbox" name="psize[]" value="XL"> XL<br>
                        <input type="checkbox" name="psize[]" value="L"> L<br>
                        <input type="checkbox" name="psize[]" value="M"> M<br> 
                        <input type="checkbox" name="psize[]" value="S"> S<br>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputPassword1">Product Brief Description</label>
                        <input type="file" name="pimg[]" class="form-control" id="exampleInputPassword1" placeholder="Enter Product Price" required>
                    </div> -->
                    <button type="submit" name="add_slide" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
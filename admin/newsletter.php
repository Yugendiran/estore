<?php
include  "db/conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/topbar.php";

if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_newsletter_query = "DELETE FROM newsletter WHERE newsletter_id = $del_id";
    $delete_newsletter_result = mysqli_query($connection, $delete_newsletter_query);
    
    if(!$delete_newsletter_result){
        alertBox("Oops... Something went wrong. Please Try again.");
    }else{
        header("location: newsletter.php");
    }
}
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Newsletter</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Newsletters</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_newsletter_query = "SELECT * FROM newsletter";
$select_newsletter_result = mysqli_query($connection, $select_newsletter_query);
while($row = mysqli_fetch_assoc($select_newsletter_result)){
    $newsletter_id = $row['newsletter_id'];
    $newsletter_email = $row['newsletter_email'];
    $newsletter_date = $row['newsletter_date'];

                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php echo $newsletter_email; ?></th>
                        <th><?php echo $newsletter_date; ?></th>
                        <th><a href="newsletter.php?del_id=<?php echo $newsletter_id; ?>">Delete</a></th>
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

<?php
include "includes/footer.php";
?>
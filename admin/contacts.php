<?php
include  "db/conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/topbar.php";

if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];

    $delete_contacts_query = "DELETE FROM contact WHERE contact_id = $del_id";
    $delete_contacts_result = mysqli_query($connection, $delete_contacts_query);
    
    if(!$delete_contacts_result){
        alertBox("Oops... Something went wrong. Please Try again.");
    }else{
        header("location: contacts.php");
    }
}

if(isset($_GET['action']) && isset($_GET['upd_id'])){
    $action = $_GET['action'];
    $upd_id = $_GET['upd_id'];

    if($action !== 'completed'){
        header('location: contacts.php');
    }

    $update_status_query = "UPDATE contact SET contact_status = 'Completed' WHERE contact_id = $upd_id";
    $update_status_result = mysqli_query($connection, $update_status_query);
    header('location: contacts.php');
}
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Contacts</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Contacts</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
$sno = 1;
$select_contact_query = "SELECT * FROM contact";
$select_contact_result = mysqli_query($connection, $select_contact_query);
while($row = mysqli_fetch_assoc($select_contact_result)){
    $contact_id = $row['contact_id'];
    $contact_name = $row['contact_name'];
    $contact_email = $row['contact_email'];
    $contact_description = $row['contact_description'];
    $contact_date = $row['contact_date'];
    $contact_status = $row['contact_status'];

                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <th><?php echo $contact_name; ?></th>
                        <th><?php echo $contact_email; ?></th>
                        <th><?php echo $contact_description; ?></th>
                        <th><?php echo $contact_date; ?></th>
                        <th><?php echo $contact_status; ?></th>
                        <th><a href="contacts.php?upd_id=<?php echo $contact_id; ?>&action=completed">Done</a></th>
                        <th><a href="contacts.php?del_id=<?php echo $contact_id; ?>">Delete</a></th>
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
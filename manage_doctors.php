<?php
session_start();
include('config.php'); // DB connection

// Handle Delete
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($con, "DELETE FROM doctors WHERE id='$id'");
    $_SESSION['msg'] = "<div class='alert alert-success'>Doctor deleted successfully!</div>";
    header("Location: manage_doctors.php");
    exit();
}

// Fetch all doctors
$doctors = mysqli_query($con, "SELECT * FROM doctors ORDER BY id ASC");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2>Admin | Manage Doctors</h2>

    <!-- Success/Error Message -->
    <?php 
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
    }
    ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SL</th>
                <th>ID</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            while ($row = mysqli_fetch_assoc($doctors)) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['doctorName']; ?></td>
                    <td><?php echo $row['specilization']; ?></td>
                    <td><?php echo $row['docEmail']; ?></td>
                    <td><?php echo $row['contactno']; ?></td>
                    <td>
                        <!-- Update button links to update_doctor.php -->
                        <a href="update_doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Update</a>

                        <!-- Delete button -->
                        <a href="manage_doctors.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this doctor?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

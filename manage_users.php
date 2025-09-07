<?php
session_start();
include('config.php'); // DB connection

// Handle Delete
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($con, "DELETE FROM user WHERE id='$id'");
    $_SESSION['msg'] = "<div class='alert alert-success'>User deleted successfully!</div>";
    header("Location: manage_users.php");
    exit();
}

// Fetch all users
$users = mysqli_query($con, "SELECT * FROM user ORDER BY id ASC");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2>Admin | Manage Users</h2>

    <!-- Success/Error Message -->
    <?php 
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
    }
    ?>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>SL</th>
                <th>ID</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            while ($row = mysqli_fetch_assoc($users)) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullName']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <!-- Update button -->
                        <a href="update_user.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-primary">Update</a>

                        <!-- Delete button -->
                        <a href="manage_users.php?delete_id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

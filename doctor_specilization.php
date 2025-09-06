<?php
session_start();
include('config.php');

//  Add New Specialization 
if (isset($_POST['add'])) {
    $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
    if (!empty($specialization)) {
        mysqli_query($con, "INSERT INTO doctorspecilization (specilization) VALUES ('$specialization')");
        $_SESSION['msg'] = "<div class='alert alert-success'>Specialization added successfully!</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Specialization cannot be empty!</div>";
    }
    header("Location: doctor_specilization.php"); 
    exit;
}

//  Delete Specialization 
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($con, "DELETE FROM doctorspecilization WHERE id=$id");
    $_SESSION['msg'] = "<div class='alert alert-success'>Specialization deleted successfully!</div>";
    header("Location: doctor_specilization.php");
    exit;
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2 class="mb-4">Admin | Doctor Specialization</h2>

    <!-- Display Messages -->
    <?php
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <!-- Add New Specialization -->
    <div class="card shadow-sm mb-4" style="max-width: 600px;">
        <div class="card-body">
            <h5 class="mb-3">Add Specialization</h5>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Specialization Name</label>
                    <input type="text" class="form-control form-control-sm" name="specialization" required>
                </div>
                <button type="submit" name="add" class="btn btn-primary btn-sm">Add Specialization</button>
            </form>
        </div>
    </div>

    <!-- Table for listing specializations -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Manage Specializations</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>SL No.</th>
                        <th>ID</th>
                        <th>Specialization</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM doctorspecilization ORDER BY id DESC");
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['specilization']; ?></td>
                            <td>
                                <!-- Update Button -->
                                <a href="update_doctor_specilization.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Update</a>

                                <!-- Delete Button -->
                                <a href="doctor_specilization.php?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this specialization?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

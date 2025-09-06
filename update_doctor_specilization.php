<?php
session_start();
include('config.php');

// Check if id is passed
if (!isset($_GET['id'])) {
    header("Location: doctor_specilization.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch specialization info
$result = mysqli_query($con, "SELECT * FROM doctorspecilization WHERE id='$id'");
if (mysqli_num_rows($result) == 0) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Specialization not found!</div>";
    header("Location: doctor_specilization.php");
    exit();
}

$specRow = mysqli_fetch_assoc($result);

// Handle form submission
if (isset($_POST['update'])) {
    $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
    if (!empty($specialization)) {
        mysqli_query($con, "UPDATE doctorspecilization SET specilization='$specialization' WHERE id='$id'");
        $_SESSION['msg'] = "<div class='alert alert-success'>Specialization updated successfully!</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Specialization cannot be empty!</div>";
    }
    header("Location: doctor_specilization.php");
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2 class="mb-4">Admin | Update Doctor Specialization</h2>

    <!-- Form directly under the heading -->
    <form method="POST" class="mb-4 w-50">
        <div class="mb-3">
            <label class="form-label fw-bold"> Update Specialization Name</label>
            <input type="text" name="specialization" class="form-control form-control-sm" value="<?php echo htmlspecialchars($specRow['specilization']); ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-sm btn-primary" style="width: 100px;">Update</button>
    </form>
</div>

<?php include('footer.php'); ?>

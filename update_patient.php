<?php
session_start();
include('config.php'); // DB connection

// Check if patient ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage_patient.php");
    exit();
}

$patientID = intval($_GET['id']);

// Handle form submission
if (isset($_POST['update'])) {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contactno = mysqli_real_escape_string($con, $_POST['contactno']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);

    $updateQuery = "UPDATE user SET 
        fullName='$fullName',
        email='$email',
        contactno='$contactno',
        gender='$gender',
        address='$address',
        city='$city'
        WHERE id='$patientID'";

    if (mysqli_query($con, $updateQuery)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Patient updated successfully!</div>";
        header("Location: manage_patient.php");
        exit();
    } else {
        $error = "Error updating patient: " . mysqli_error($con);
    }
}

// Fetch patient data to populate form
$result = mysqli_query($con, "SELECT * FROM user WHERE id='$patientID'");
$patient = mysqli_fetch_assoc($result);
if (!$patient) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Patient not found!</div>";
    header("Location: manage_patient.php");
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2 class="mb-4">Admin | Update Patient's Info</h2>

    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form method="POST" action="">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullName" class="form-control" value="<?php echo htmlentities($patient['fullName']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlentities($patient['email']); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Contact No</label>
                <input type="text" name="contactno" class="form-control" value="<?php echo htmlentities($patient['contactno']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="Male" <?php if($patient['gender']=='Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($patient['gender']=='Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if($patient['gender']=='Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3" required><?php echo htmlentities($patient['address']); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo htmlentities($patient['city']); ?>" required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" name="update" class="btn btn-success me-2"><i class="fa fa-save"></i> Update</button>
            <a href="manage_patient.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
        </div>
    </form>
</div>

<?php include('footer.php'); ?>

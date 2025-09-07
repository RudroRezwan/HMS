<?php
session_start();
include('config.php'); // DB connection

// Get user ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch existing user data
$user = mysqli_query($con, "SELECT * FROM user WHERE id='$id'");
if (mysqli_num_rows($user) == 0) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>User not found!</div>";
    header("Location: manage_users.php");
    exit();
}
$row = mysqli_fetch_assoc($user);

// Handle update form submission
if (isset($_POST['update'])) {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $address  = mysqli_real_escape_string($con, $_POST['address']);
    $city     = mysqli_real_escape_string($con, $_POST['city']);
    $gender   = mysqli_real_escape_string($con, $_POST['gender']);
    $email    = mysqli_real_escape_string($con, $_POST['email']);

    mysqli_query($con, "UPDATE user 
                        SET fullName='$fullName', address='$address', city='$city', gender='$gender', email='$email' 
                        WHERE id='$id'");

    $_SESSION['msg'] = "<div class='alert alert-success'>User updated successfully!</div>";
    header("Location: manage_users.php");
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<div class="col-md-10 p-4">
    <h2>Admin | Update User's Info</h2>
    <div class="col-md-10 p-4 d-flex justify-content-center">
    <div class="card shadow-sm w-75" style="max-width: 600px;">
        <div class="card-body">
            <h3 class="mb-4 text-center">Update User</h3>

            <form method="POST">
                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <input type="text" name="fullName" class="form-control form-control-sm" value="<?php echo $row['fullName']; ?>" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control form-control-sm" value="<?php echo $row['address']; ?>" required>
                </div>

                <!-- City -->
                <div class="mb-3">
                    <label class="form-label fw-bold">City</label>
                    <input type="text" name="city" class="form-control form-control-sm" value="<?php echo $row['city']; ?>" required>
                </div>

                <!-- Gender -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Gender</label>
                    <select name="gender" class="form-select form-control-sm" required>
                        <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email']; ?>" required>
                </div>

                <!-- Submit -->
                <div class="d-grid">
                    <button type="submit" name="update" class="btn btn-primary" style="max-width: 120px;">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

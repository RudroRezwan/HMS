<?php
session_start();
include('config.php'); // DB connection

// Get doctor id
if (!isset($_GET['id'])) {
    header("Location: manage_doctors.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch doctor info
$result = mysqli_query($con, "SELECT * FROM doctors WHERE id='$id'");
if (mysqli_num_rows($result) == 0) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Doctor not found!</div>";
    header("Location: manage_doctors.php");
    exit();
}
$doctor = mysqli_fetch_assoc($result);

// Fetch specializations for dropdown
$specializations = mysqli_query($con, "SELECT * FROM doctorspecilization ORDER BY specilization ASC");

// Handle form submission
if (isset($_POST['update'])) {
    $spec       = mysqli_real_escape_string($con, $_POST['spec']);
    $docname    = mysqli_real_escape_string($con, $_POST['docname']);
    $clinicaddr = mysqli_real_escape_string($con, $_POST['clinicaddress']);
    $fees       = mysqli_real_escape_string($con, $_POST['fees']);
    $contact    = mysqli_real_escape_string($con, $_POST['contact']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $password   = $_POST['password'];
    $cpassword  = $_POST['confirmpassword'];

    // Password validation and update only if provided
    if (!empty($password)) {
        if ($password !== $cpassword) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Password and Confirm Password do not match!</div>";
            header("Location: update_doctor.php?id=$id");
            exit();
        }
        $password_sql = ", password='$password'";
    } else {
        $password_sql = "";
    }

    // Update doctor info
    $sql = "UPDATE doctors SET 
                specilization='$spec',
                doctorName='$docname',
                address='$clinicaddr',
                docFees='$fees',
                contactno='$contact',
                docEmail='$email'
                $password_sql
            WHERE id='$id'";
    mysqli_query($con, $sql);

    // Success message and redirect
    $_SESSION['msg'] = "<div class='alert alert-success'>Doctor updated successfully!</div>";
    header("Location: manage_doctors.php");
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2>Admin | Update Doctor Info</h2>

    <div class="card shadow-sm w-75 mx-auto">
        <div class="card-body">
            <form method="POST" action="" onsubmit="return validatePassword()">
                
                <!-- Specialization -->
                <div class="mb-3">
                    <label>Doctor Specialization</label>
                    <select name="spec" class="form-select" required>
                        <?php
                        while ($row = mysqli_fetch_assoc($specializations)) {
                            $selected = ($row['specilization'] == $doctor['specilization']) ? "selected" : "";
                            echo "<option value='".$row['specilization']."' $selected>".$row['specilization']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Doctor Name -->
                <div class="mb-3">
                    <label>Doctor Name</label>
                    <input type="text" name="docname" class="form-control" value="<?php echo $doctor['doctorName']; ?>" required>
                </div>

                <!-- Clinic Address -->
                <div class="mb-3">
                    <label>Clinic Address</label>
                    <textarea name="clinicaddress" class="form-control" required><?php echo $doctor['address']; ?></textarea>
                </div>

                <!-- Fees -->
                <div class="mb-3">
                    <label>Consultancy Fees</label>
                    <input type="number" name="fees" class="form-control" value="<?php echo $doctor['docFees']; ?>" required>
                </div>

                <!-- Contact -->
                <div class="mb-3">
                    <label>Contact No</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $doctor['contactno']; ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $doctor['docEmail']; ?>" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm New Password">
                </div>

                <div class="d-grid">
                    <button type="submit" name="update" class="btn btn-primary"style="width: 100px;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
function validatePassword() {
    let password = document.getElementById("password").value;
    let confirmpassword = document.getElementById("confirmpassword").value;

    if(password !== "" && password.length < 6){
        alert("Password must be at least 6 characters long.");
        return false;
    }

    if(password !== confirmpassword){
        alert("Password and Confirm Password do not match!");
        return false;
    }

    return true;
}
</script>

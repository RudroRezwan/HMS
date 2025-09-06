<?php
session_start();
include('config.php'); // DB connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $spec       = mysqli_real_escape_string($con, $_POST['spec']);
    $docname    = mysqli_real_escape_string($con, $_POST['docname']);
    $clinicaddr = mysqli_real_escape_string($con, $_POST['clinicaddress']);
    $fees       = mysqli_real_escape_string($con, $_POST['fees']);
    $contact    = mysqli_real_escape_string($con, $_POST['contact']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $password   = $_POST['password'];
    $cpassword  = $_POST['confirmpassword'];

    // Validate password match
    if ($password !== $cpassword) {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Password and Confirm Password do not match!</div>";
    } else {
        // Insert directly (password stored as plain input)
        $sql = "INSERT INTO doctors (specilization, doctorName, address, docFees, contactno, docEmail, password)
                VALUES ('$spec', '$docname', '$clinicaddr', '$fees', '$contact', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Doctor added successfully!</div>";
            // Redirect to the same page to refresh
            header("Location: add_doctor.php");
            exit();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
        }
    }
}

// Fetch specializations for dropdown
$specializations = mysqli_query($con, "SELECT * FROM doctorspecilization ORDER BY specilization ASC");
?>

<?php include('header.php'); ?>

<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <div class="col-md-10 p-4">
      
      <!-- Page Heading -->
      <h2 class="mb-4">Admin | Add Doctor</h2>

      <!-- Success/Error Message -->
      <?php 
      if (!empty($_SESSION['msg'])) {
          echo $_SESSION['msg']; 
          unset($_SESSION['msg']); // remove message after displaying
      }
      ?>

      <!-- Form Card -->
      <div class="card shadow-sm w-75 mx-auto" style="max-width: 600px;">
        <div class="card-body">
          <h3 class="mb-4 text-center">Add Doctor</h3>

          <form onsubmit="return validatePassword()" method="POST" action="">
            
            <!-- Doctor Specialization (Dynamic) -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Specialization</label>
              <select name="spec" class="form-select form-control-sm" required>
                <option value="">Select Specialization</option>
                <?php 
                  while ($row = mysqli_fetch_assoc($specializations)) {
                      echo "<option value='".$row['specilization']."'>".$row['specilization']."</option>";
                  }
                ?>
              </select>
            </div>

            <!-- Doctor Name -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Name</label>
              <input type="text" name="docname" class="form-control form-control-sm" placeholder="Enter Doctor Name" required>
            </div>

            <!-- Clinic Address -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Clinic Address</label>
              <textarea name="clinicaddress" class="form-control form-control-sm" rows="2" placeholder="Enter Clinic Address" required></textarea>
            </div>

            <!-- Consultancy Fees -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Consultancy Fees</label>
              <input type="number" name="fees" class="form-control form-control-sm" placeholder="Enter Fees" required>
            </div>

            <!-- Contact No -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Contact No</label>
              <input type="text" name="contact" class="form-control form-control-sm" placeholder="Enter Contact No" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label fw-bold">Doctor Email</label>
              <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter Email ID" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label class="form-label fw-bold">Password</label>
              <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="New Password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label class="form-label fw-bold">Confirm Password</label>
              <input type="password" id="confirmpassword" name="confirmpassword" class="form-control form-control-sm" placeholder="Confirm Password" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary" style="max-width: 100px">Submit</button>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- End Main Content -->

  </div>
</div>

<?php include('footer.php'); ?>

<!-- JS Validation -->
<script>
function validatePassword() {
    let password = document.getElementById("password").value;
    let confirmpassword = document.getElementById("confirmpassword").value;

    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }
    if (password !== confirmpassword) {
        alert("Password and Confirm Password do not match!");
        return false;
    }
    return true;
}
</script>

<?php
session_start();
include('config.php');
error_reporting(0);

if(isset($_POST['submit'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $admin_id = $_SESSION['id']; // assuming you stored admin id in session

    // Check current password
    $check = mysqli_query($con, "SELECT password FROM admin WHERE id='$admin_id' AND password='$current_password'");
    if(mysqli_num_rows($check) > 0){
        if($new_password === $confirm_password){
            mysqli_query($con, "UPDATE admin SET password='$new_password' WHERE id='$admin_id'");
            $msg = "Password successfully changed!";
        } else {
            $error = "New Password and Confirm Password do not match!";
        }
    } else {
        $error = "Current Password is incorrect!";
    }
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Main Content -->
<div class="col-md-10 p-4">
  <h2 class="mb-4">Admin | Change Password</h2>

  <?php if(!empty($msg)){ ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
  <?php } ?>
  <?php if(!empty($error)){ ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php } ?>

  <form method="post" action="">
    <div class="mb-3">
      <label class="form-label">Current Password</label>
      <input type="password" name="current_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">New Password</label>
      <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<?php include('footer.php'); ?>

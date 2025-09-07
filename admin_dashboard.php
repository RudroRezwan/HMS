<?php
session_start();
include('config.php'); // DB connection

// Fetch counts
$totalUsers = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM user"))['cnt'];
$totalDoctors = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM doctors"))['cnt'];
$totalAppointments = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM appointment"))['cnt'];
$totalPatients = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(DISTINCT userId) AS cnt FROM appointment"))['cnt'];
$totalQueries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM tblcontactus"))['cnt'];
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- ================= MAIN CONTENT ================= -->
<div class="col-md-10 p-4">
  <h3 class="mb-4 fw-bold">ADMIN | DASHBOARD</h3>

  <div class="row g-4">
    <!-- Manage Users -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center p-3">
        <div class="card-body">
          <i class="bi bi-people fs-1 text-primary"></i>
          <h5 class="mt-3">Manage Users</h5>
          <p class="text-muted mb-2">Total Users: <span class="fw-bold"><?php echo $totalUsers; ?></span></p>
          <a href="manage_users.php" class="btn btn-outline-primary btn-sm">View</a>
        </div>
      </div>
    </div>

    <!-- Manage Doctors -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center p-3">
        <div class="card-body">
          <i class="bi bi-person-badge fs-1 text-success"></i>
          <h5 class="mt-3">Manage Doctors</h5>
          <p class="text-muted mb-2">Total Doctors: <span class="fw-bold"><?php echo $totalDoctors; ?></span></p>
          <a href="manage_doctors.php" class="btn btn-outline-success btn-sm">View</a>
        </div>
      </div>
    </div>

    <!-- Appointments -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center p-3">
        <div class="card-body">
          <i class="bi bi-calendar-check fs-1 text-info"></i>
          <h5 class="mt-3">Appointments</h5>
          <p class="text-muted mb-2">Total Appointments: <span class="fw-bold"><?php echo $totalAppointments; ?></span></p>
          <a href="appointment_history.php" class="btn btn-outline-info btn-sm">View</a>
        </div>
      </div>
    </div>

    <!-- Manage Patients -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center p-3">
        <div class="card-body">
          <i class="bi bi-hospital fs-1 text-danger"></i>
          <h5 class="mt-3">Manage Patients</h5>
          <p class="text-muted mb-2">Total Patients: <span class="fw-bold"><?php echo $totalPatients; ?></span></p>
          <a href="manage_patient.php" class="btn btn-outline-danger btn-sm">View</a>
        </div>
      </div>
    </div>

    <!-- New Queries -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center p-3">
        <div class="card-body">
          <i class="bi bi-envelope fs-1 text-warning"></i>
          <h5 class="mt-3">New Queries</h5>
          <p class="text-muted mb-2">Total New Queries: <span class="fw-bold"><?php echo $totalQueries; ?></span></p>
          <a href="contact_us.php" class="btn btn-outline-warning btn-sm">View</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

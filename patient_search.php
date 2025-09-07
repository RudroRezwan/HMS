<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('config.php'); ?>

<div class="col-md-10 p-4">
  <h2>Admin | Patient Search</h2>

  <!-- Search Form -->
  <form method="GET" action="patient_search.php" class="row g-3 mb-4">
    <div class="col-auto">
      <input type="number" name="patient_id" class="form-control" placeholder="Enter Patient ID"
             value="<?php echo isset($_GET['patient_id']) ? htmlspecialchars($_GET['patient_id']) : ''; ?>">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>

  <?php
  if (isset($_GET['patient_id']) && $_GET['patient_id'] != '') {
      $patient_id = intval($_GET['patient_id']);

      // Fetch patient info
      $patient_sql = "SELECT * FROM tblpatient WHERE ID='$patient_id'";
      $patient_res = mysqli_query($con, $patient_sql);

      if (mysqli_num_rows($patient_res) > 0) {
          $patient = mysqli_fetch_assoc($patient_res);

          // Fetch appointment history for this patient
          $appt_sql = "SELECT * FROM appointment WHERE userId='{$patient['ID']}' ORDER BY appointmentDate DESC";
          $appt_res = mysqli_query($con, $appt_sql);
  ?>

  <!-- ================= Patient Info Card ================= -->
  <div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
      <h5 class="m-0">Patient Information</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tbody>
          <tr><th>ID</th><td><?php echo $patient['ID']; ?></td></tr>
          <tr><th>Doctor ID</th><td><?php echo $patient['Docid']; ?></td></tr>
          <tr><th>Name</th><td><?php echo $patient['PatientName']; ?></td></tr>
          <tr><th>Contact No</th><td><?php echo $patient['PatientContno']; ?></td></tr>
          <tr><th>Email</th><td><?php echo $patient['PatientEmail']; ?></td></tr>
          <tr><th>Gender</th><td><?php echo $patient['PatientGender']; ?></td></tr>
          <tr><th>Address</th><td><?php echo $patient['PatientAdd']; ?></td></tr>
          <tr><th>Age</th><td><?php echo $patient['PatientAge']; ?></td></tr>
          <tr><th>Medical History</th><td><?php echo $patient['PatientMedhis']; ?></td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ================= Appointment History Card ================= -->
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h5 class="m-0">Appointment History</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Appointment ID</th>
            <th>Doctor Specialization</th>
            <th>Doctor ID</th>
            <th>User ID</th>
            <th>Consultancy Fees</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($appt_res) > 0) { ?>
            <?php while ($appt = mysqli_fetch_assoc($appt_res)) { ?>
              <tr>
                <td><?php echo $appt['id']; ?></td>
                <td><?php echo $appt['doctorSpecilization']; ?></td>
                <td><?php echo $appt['doctorId']; ?></td>
                <td><?php echo $appt['userId']; ?></td>
                <td><?php echo $appt['consultancyFees']; ?></td>
                <td><?php echo $appt['appointmentDate']; ?></td>
                <td><?php echo $appt['appointmentTime']; ?></td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr><td colspan="7" class="text-center text-muted">No appointments found</td></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php
      } else {
          echo "<div class='alert alert-danger'>❌ No patient found with the given ID.</div>";
      }
  }
  ?>
</div>

<?php include('footer.php'); ?>

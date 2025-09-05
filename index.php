<?php
session_start();
include('config.php');
error_reporting(0);
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Main content -->
<div class="col-md-10 p-4">
  <h2 class="mb-4">Admin Dashboard</h2>

  <!-- Stats Row -->
  <div class="row text-center mb-4">
    <div class="col-md-4">
      <div class="card bg-primary text-white mb-3">
        <div class="card-body">
          <?php $doctors = mysqli_num_rows(mysqli_query($con,"SELECT id FROM doctors")); ?>
          <h4><?php echo $doctors; ?> Doctors</h4>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success text-white mb-3">
        <div class="card-body">
          <?php $patients = mysqli_num_rows(mysqli_query($con,"SELECT id FROM users")); ?>
          <h4><?php echo $patients; ?> Patients</h4>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-dark mb-3">
        <div class="card-body">
          <?php $apps = mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment")); ?>
          <h4><?php echo $apps; ?> Appointments</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Appointments -->
  <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
      Recent Appointments
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Department</th>
            <th>Date / Time</th>
            <th>Created On</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($con,
          "SELECT appointment.*, users.fullName as pname,
          doctors.doctorName as dname, doctors.specilization as spec
          FROM appointment
          JOIN users ON users.id=appointment.userId
          JOIN doctors ON doctors.id=appointment.doctorId
          ORDER BY appointment.id DESC LIMIT 10");
          $cnt=1;
          while($row=mysqli_fetch_assoc($query)){
            echo "<tr>";
            echo "<td>".$cnt."</td>";
            echo "<td>".$row['pname']."</td>";
            echo "<td>".$row['dname']."</td>";
            echo "<td>".$row['spec']."</td>";
            echo "<td>".$row['appointmentDate']." / ".$row['appointmentTime']."</td>";
            echo "<td>".$row['postingDate']."</td>";
            echo "<td>";
            if($row['userStatus']==1 && $row['doctorStatus']==1) echo "Active";
            if($row['userStatus']==0 && $row['doctorStatus']==1) echo "Cancelled by Patient";
            if($row['userStatus']==1 && $row['doctorStatus']==0) echo "Cancelled by Doctor";
            echo "</td>";
            echo "</tr>";
            $cnt++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php include('footer.php'); ?>

<?php
session_start();
include('config.php');
error_reporting(0);
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Main Content -->
<div class="col-md-10 p-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Quick Access Cards -->
    <div class="row mb-4 text-center">
        <!-- Doctors Card -->
        <div class="col-md-4">
            <a href="manage_doctors.php" class="text-decoration-none">
                <div class="card bg-primary text-white mb-3 shadow-sm">
                    <div class="card-body">
                        <?php $doctors = mysqli_num_rows(mysqli_query($con,"SELECT id FROM doctors")); ?>
                        <h4><?php echo $doctors; ?></h4>
                        <p>Manage Doctors</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Patients Card -->
        <div class="col-md-4">
            <a href="manage_patients.php" class="text-decoration-none">
                <div class="card bg-success text-white mb-3 shadow-sm">
                    <div class="card-body">
                        <?php $patients = mysqli_num_rows(mysqli_query($con,"SELECT id FROM users")); ?>
                        <h4><?php echo $patients; ?></h4>
                        <p>Manage Patients</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Appointments Card -->
        <div class="col-md-4">
            <a href="manage_appointments.php" class="text-decoration-none">
                <div class="card bg-warning text-dark mb-3 shadow-sm">
                    <div class="card-body">
                        <?php $apps = mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment")); ?>
                        <h4><?php echo $apps; ?></h4>
                        <p>Manage Appointments</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Appointments Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span>Recent Appointments</span>
            <a href="manage_appointments.php" class="btn btn-sm btn-light">View All</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="serial-col">#</th>
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
                        "SELECT appointment.*, users.fullName AS pname,
                        doctors.doctorName AS dname, doctors.specilization AS spec
                        FROM appointment
                        JOIN users ON users.id = appointment.userId
                        JOIN doctors ON doctors.id = appointment.doctorId
                        ORDER BY appointment.id DESC LIMIT 10"
                    );

                    $cnt = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        // Status badge
                        if ($row['userStatus']==1 && $row['doctorStatus']==1) $status = "<span class='badge bg-success'>Active</span>";
                        if ($row['userStatus']==0 && $row['doctorStatus']==1) $status = "<span class='badge bg-danger'>Cancelled by Patient</span>";
                        if ($row['userStatus']==1 && $row['doctorStatus']==0) $status = "<span class='badge bg-warning text-dark'>Cancelled by Doctor</span>";

                        echo "<tr>";
                        echo "<td class='serial-col'>".$cnt."</td>";
                        echo "<td>".$row['pname']."</td>";
                        echo "<td>".$row['dname']."</td>";
                        echo "<td>".$row['spec']."</td>";
                        echo "<td>".$row['appointmentDate']." / ".$row['appointmentTime']."</td>";
                        echo "<td>".$row['postingDate']."</td>";
                        echo "<td>".$status."</td>";
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

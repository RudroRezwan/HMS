<?php
session_start();
include('config.php'); // DB connection

// Handle Delete
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($con, "DELETE FROM appointment WHERE id='$id'");
    $_SESSION['msg'] = "<div class='alert alert-success'>Appointment deleted successfully!</div>";
    header("Location: appointment_history.php");
    exit();
}

// Fetch all appointments with doctor and user info
$appointments = mysqli_query($con, "
    SELECT a.id, a.doctorId, a.userId, a.consultancyFees, a.appointmentDate, a.appointmentTime,
           d.doctorName, d.specilization AS doctorSpecilization,
           u.fullName AS userName, u.email AS userEmail
    FROM appointment a
    LEFT JOIN doctors d ON a.doctorId = d.id
    LEFT JOIN user u ON a.userId = u.id
    ORDER BY a.id ASC
");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2>Admin | Appointment History</h2>

    <!-- Success/Error Message -->
    <?php 
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
    }
    ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SL</th>
                <th>Appointment ID</th>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>User</th>
                <th>Consultancy Fees</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            while ($row = mysqli_fetch_assoc($appointments)) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <?php echo !empty($row['doctorName']) ? $row['doctorName'] : 'N/A'; ?>
                        (ID: <?php echo $row['doctorId']; ?>)
                    </td>
                    <td><?php echo !empty($row['doctorSpecilization']) ? $row['doctorSpecilization'] : 'N/A'; ?></td>
                    <td>
                        <?php echo !empty($row['userName']) ? $row['userName'] : 'N/A'; ?>
                        (ID: <?php echo $row['userId']; ?>)
                    </td>
                    <td><?php echo $row['consultancyFees']; ?></td>
                    <td><?php echo $row['appointmentDate']; ?></td>
                    <td><?php echo $row['appointmentTime']; ?></td>
                    <td>
                        <!-- Delete button -->
                        <a href="appointment_history.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this appointment?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

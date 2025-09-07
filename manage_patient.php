<?php
session_start();
include('config.php'); // DB connection

// Handle Delete
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($con, "DELETE FROM user WHERE id='$id'");
    $_SESSION['msg'] = "<div class='alert alert-success'>Patient deleted successfully!</div>";
    header("Location: manage_patient.php");
    exit();
}

// Fetch all patients with doctor info via appointments
$patients = mysqli_query($con, "
    SELECT u.id AS patientID, u.fullName AS patientName, u.email AS patientEmail,
           u.contactno AS patientContact, u.gender AS patientGender, u.address AS patientAddress,
           u.city AS patientCity,
           d.doctorName, d.docFees
    FROM user u
    LEFT JOIN appointment a ON a.userId = u.id
    LEFT JOIN doctors d ON a.doctorId = d.id
    GROUP BY u.id
    ORDER BY u.id ASC
");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
    <h2>Admin | Manage Patients</h2>

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
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Doctor</th>
                <th>Doctor Fees</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            while ($row = mysqli_fetch_assoc($patients)) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $row['patientID']; ?></td>
                    <td><?php echo $row['patientName']; ?></td>
                    <td>
                        <?php echo !empty($row['doctorName']) ? $row['doctorName'] : 'N/A'; ?>
                    </td>
                    <td><?php echo !empty($row['docFees']) ? $row['docFees'] : 'N/A'; ?></td>
                    <td><?php echo $row['patientEmail']; ?></td>
                    <td><?php echo $row['patientContact']; ?></td>
                    <td><?php echo $row['patientGender']; ?></td>
                    <td><?php echo $row['patientAddress']; ?></td>
                    <td><?php echo $row['patientCity']; ?></td>
                    <td>
                        <!-- Update button -->
                        <a href="update_patient.php?id=<?php echo $row['patientID']; ?>" class="btn btn-sm btn-primary">Update</a>

                        <!-- Delete button -->
                        <a href="manage_patient.php?delete_id=<?php echo $row['patientID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this patient?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

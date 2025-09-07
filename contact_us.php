<?php
session_start();
include('config.php'); // DB connection

// Handle status update
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = ($_GET['status'] == 'done') ? 'done' : 'notdone';

    mysqli_query($con, "UPDATE tblcontactus SET status='$status' WHERE id='$id'");
    $_SESSION['msg'] = "<div class='alert alert-success'>Query status updated successfully!</div>";
    header("Location: contact_us.php");
    exit();
}

// Handle filtering
$filter = "";
if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'done') {
        $filter = "WHERE status='done'";
    } elseif ($_GET['filter'] == 'notdone') {
        $filter = "WHERE status='notdone' OR status IS NULL";
    }
}

// Fetch filtered contact queries
$queries = mysqli_query($con, "
    SELECT id, fullname, email, contactno, message, date, 
           IFNULL(status,'notdone') AS status 
    FROM tblcontactus 
    $filter
    ORDER BY id DESC
");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
  <h2>Admin | Contact Queries</h2>

  <!-- Success Message -->
  <?php 
  if (!empty($_SESSION['msg'])) {
      echo $_SESSION['msg']; 
      unset($_SESSION['msg']);
  }
  ?>

  <!-- 🔹 Filter Forms -->
  <div class="mb-3 d-flex gap-2">
    <!-- Show All -->
    <form method="get" action="contact_us.php">
      <input type="hidden" name="filter" value="all">
      <button type="submit" class="btn btn-secondary">Show All</button>
    </form>

    <!-- Show Pending -->
    <form method="get" action="contact_us.php">
      <input type="hidden" name="filter" value="notdone">
      <button type="submit" class="btn btn-warning">Show Pending Queries</button>
    </form>

    <!-- Show Completed -->
    <form method="get" action="contact_us.php">
      <input type="hidden" name="filter" value="done">
      <button type="submit" class="btn btn-success">Show Completed Queries</button>
    </form>
  </div>

  <!-- Table -->
  <table class="table table-hover table-bordered align-middle">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Message</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($queries)) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['fullname']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['contactno']; ?></td>
          <td><?php echo $row['message']; ?></td>
          <td><?php echo $row['date']; ?></td>
          <td>
            <?php if ($row['status'] == 'done') { ?>
              <span class="badge bg-success">Done</span>
            <?php } else { ?>
              <span class="badge bg-warning text-dark">Pending</span>
            <?php } ?>
          </td>
          <td>
            <!-- ✅ Mark as Done -->
            <a href="contact_us.php?id=<?php echo $row['id']; ?>&status=done" 
               class="btn btn-sm <?php echo ($row['status'] == 'done') ? 'btn-success' : 'btn-outline-success'; ?>">
              <i class="bi bi-check-lg"></i>
            </a>

            <!-- ❌ Mark as Not Done -->
            <a href="contact_us.php?id=<?php echo $row['id']; ?>&status=notdone" 
               class="btn btn-sm <?php echo ($row['status'] == 'notdone') ? 'btn-danger' : 'btn-outline-danger'; ?>">
              <i class="bi bi-x-lg"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include('footer.php'); ?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
  <h2>Admin | Patient Search</h2>

  <!-- Search Form -->
  <form method="GET" action="patient_search.php" class="row g-3">
    <div class="col-auto">
      <input type="text" name="keyword" class="form-control" placeholder="Enter patient name or ID">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>

  <!-- Search Results -->
  <table class="table table-bordered mt-4">
    <thead>
      <tr>
        <th>ID</th>
        <th>Patient Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- PHP loop for results -->
    </tbody>
  </table>
</div>

<?php include('footer.php'); ?>

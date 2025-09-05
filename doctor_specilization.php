<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10 p-4">
  <h2> Admin | Doctor Specialization</h2>
  <form>
    <!-- Example form -->
    <div class="mb-3">
      <label class="form-label">Specialization Name</label>
      <input type="text" class="form-control" name="specialization" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Specialization</button>
  </form>

  <!-- Table for listing specializations -->
  <table class="table table-bordered mt-4">
    <thead>
      <tr>
        <th>ID</th>
        <th>Specialization</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- PHP loop for fetching from DB -->
    </tbody>
  </table>
</div>

<?php include('footer.php'); ?>

<!-- sidebar.php -->

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
  .sidebar {
    background: linear-gradient(180deg, #0d6efd, #0b5ed7);
    min-height: 100vh;
    box-shadow: 2px 0 10px rgba(0,0,0,0.15);
  }

  .sidebar h5 {
    font-weight: bold;
    margin-bottom: 20px;
    color: #fff;
  }

  .sidebar .nav-link {
    color: #e9ecef;
    font-size: 15px;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    padding-left: 20px;
  }

  .sidebar .nav-link.active {
    background-color: #fff;
    color: #0d6efd !important;
    font-weight: 600;
  }
</style>

<div class="col-md-2 sidebar d-flex flex-column p-3">
  <h5 class="text-center">Admin Menu</h5>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="admin_dashboard.php" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li class="nav-item"><a href="doctor_specilization.php" class="nav-link"><i class="bi bi-heart-pulse"></i>  Add Doctor Specialization</a></li>
    <li class="nav-item"><a href="add_doctor.php" class="nav-link"><i class="bi bi-person-plus"></i> Add Doctor</a></li>
    <li class="nav-item"><a href="manage_doctors.php" class="nav-link"><i class="bi bi-people"></i> Manage Doctors</a></li>
    <li class="nav-item"><a href="manage_users.php" class="nav-link"><i class="bi bi-person-badge"></i> Manage Users</a></li>
    <li class="nav-item"><a href="manage_patient.php" class="nav-link"><i class="bi bi-hospital"></i> Manage Patients</a></li>
    <li class="nav-item"><a href="appointment_history.php" class="nav-link"><i class="bi bi-calendar-check"></i> Appointment History</a></li>
    <li class="nav-item"><a href="contact_us.php" class="nav-link"><i class="bi bi-envelope"></i> Contact Queries</a></li>
    <li class="nav-item"><a href="patient_search.php" class="nav-link"><i class="bi bi-search"></i> Patient Search</a></li>
  </ul>
</div>



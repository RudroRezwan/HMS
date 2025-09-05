<?php
// session_start(); // Uncomment if you want sessions
// include("config.php"); // Uncomment if you need DB connection in header
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hospital Admin</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- ================= HEADER ================= -->
<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid">
    <!-- Left Side -->
    <a class="navbar-brand fw-bold text-dark" href="admin_dashboard.php">
      <i class="bi bi-hospital me-2 text-primary"></i>
      <span style="font-size:22px;">HMS</span>
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar"
      aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="topNavbar">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item me-3">
          <h6 class="m-0 fw-semibold">HDIMS</h6>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="images.jpg" class="rounded-circle me-2" width="35" height="35" alt="Admin">
            <span>Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="change-password.php"><i class="bi bi-key me-2"></i> Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</header>
<!-- ================= END HEADER ================= -->

<div class="container-fluid">
  <div class="row">


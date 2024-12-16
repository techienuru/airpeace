<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new dashboard($connect);

$object->collectUserID();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Air Peace</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/jquery-bar-rating/css-stars.css" />
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css" />
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
    }

    .welcome-container {
      margin: 50px auto;
      max-width: 900px;
      padding: 40px;
      background-color: #007bff;
      color: white;
      border-radius: 20px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .welcome-container:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
      opacity: 0.1;
      z-index: 1;
    }

    h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      z-index: 2;
      position: relative;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 20px;
      z-index: 2;
      position: relative;
    }

    .btn-primary {
      background-color: white;
      color: #007bff;
      border: none;
      font-size: 1rem;
      padding: 12px 25px;
      border-radius: 10px;
      transition: all 0.3s ease;
      z-index: 2;
      position: relative;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      color: white;
    }

    .stats-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 30px;
      z-index: 2;
      position: relative;
    }

    .stats-card {
      background-color: white;
      color: #007bff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 200px;
    }

    .stats-card h3 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .stats-card p {
      font-size: 1rem;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
          <a href="#" class="nav-link flex-column">
            <div class="nav-profile-image">
              <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
              <span class="font-weight-semibold mb-1 mt-2 text-center">Air Peace</span>
            </div>
          </a>
        </li>
        <li class="pt-2 pb-1">
          <span class="nav-item-head">Pages</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./dashboard.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_management.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">User Management</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="flight_management.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Flight Management</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="reservation_statistics.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">View reservations</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="reservation_hisotry.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Reservation History</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-default-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles default primary"></div>
          <div class="tiles success"></div>
          <div class="tiles warning"></div>
          <div class="tiles danger"></div>
          <div class="tiles info"></div>
          <div class="tiles dark"></div>
          <div class="tiles light"></div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-chevron-double-left"></span>
          </button>
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper pb-0">


          <div class="row">
            <div class="col-sm-12 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="container welcome-container">
                    <h1>Welcome, Admin!</h1>
                    <p>You're in full control. Monitor your platform, manage flights and reservations, and ensure smooth operations.</p>
                    <a href="#" class="btn btn-primary">Get Started</a>

                    <?php
                    $object->selectNoOfUsers();
                    $object->selectActiveFlights();
                    $object->selectNoOfReservations();
                    ?>
                    <!-- Admin Dashboard Stats -->
                    <div class="stats-container">
                      <div class="stats-card">
                        <h3><?php echo $object->noOfUsers; ?></h3>
                        <p>Registered Clients</p>
                      </div>
                      <div class="stats-card">
                        <h3><?php echo $object->noOfActiveFlights; ?></h3>
                        <p>Active Flights</p>
                      </div>
                      <div class="stats-card">
                        <h3><?php echo $object->noOfReservations; ?></h3>
                        <p>Total Reservations</p>
                      </div>
                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Air Reservation 2024</span>

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>
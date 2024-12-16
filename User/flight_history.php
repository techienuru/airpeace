<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/user.php";

$object = new flight_history($connect);

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
      background-color: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    h2 {
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
    }

    .history-card {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      transition: transform 0.3s ease;
    }

    .history-card:hover {
      transform: translateY(-5px);
    }

    .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .status {
      font-weight: bold;
      color: #28a745;
    }

    .status.canceled {
      color: #dc3545;
    }

    .badge {
      padding: 0.5em 1em;
      font-size: 0.9em;
      border-radius: 20px;
    }

    .completed-badge {
      background-color: #28a745;
      color: white;
    }

    .canceled-badge {
      background-color: #dc3545;
      color: white;
    }

    .card-body .details {
      display: flex;
      flex-direction: column;
    }

    .flight-info p {
      margin: 0;
    }

    /* Animation */
    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(10px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .history-card {
      animation: fadeIn 0.8s ease-in-out;
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
          <a class="nav-link" href="booking.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Flight Search and Booking</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="reservation_management.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Reservation Management</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="flight_history.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Flight Schedules</span>
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

                  <div class="container">
                    <h2>Your Flight History</h2>

                    <!-- Completed Flights Section -->
                    <h4 class="mb-4">Confirmed Flights</h4>
                    <?php
                    $sql = $object->selectConfirmedReservations();
                    while ($row = $sql->fetch_array()) {
                      $row["status"] = (!$row["status"]) ? "Pending" : $row["status"];
                    ?>
                      <!-- Completed Flight Card 2 -->
                      <div class="card history-card mb-3">
                        <div class="card-body">
                          <div class="details">
                            <h5 class="card-title"><?php echo $row["flight_id"]; ?></h5>
                            <p class="card-text flight-info">
                              From: <?php echo $row["depature_city"]; ?> - To: <?php echo $row["destination_city"]; ?>
                            </p>
                            <p class="card-text flight-info">
                              Departure: <?php echo $row["depature_time"]; ?>, <?php echo $row["depature_date"]; ?>
                            </p>
                          </div>
                          <span class="badge completed-badge">Confirmed</span>
                        </div>
                      </div>
                    <?php } ?>

                    <!-- Canceled Flights Section -->
                    <h4 class="mb-4">Canceled Flights</h4>

                    <?php
                    $sql = $object->selectCancelledReservations();
                    while ($row = $sql->fetch_array()) {
                      $row["status"] = ($row["cancelled_by"] === "admin") ? "Cancelled by Admin" : "Cancelled by User";
                    ?>
                      <!-- Canceled Flight Card 1 -->
                      <div class="card history-card mb-3">
                        <div class="card-body">
                          <div class="details">
                            <h5 class="card-title"><?php echo $row["flight_id"]; ?></h5>
                            <p class="card-text flight-info">
                              From: <?php echo $row["depature_city"]; ?> - To: <?php echo $row["destination_city"]; ?>
                            </p>
                            <p class="card-text flight-info">
                              Departure: <?php echo $row["depature_time"]; ?>, <?php echo $row["depature_date"]; ?>
                            </p>
                          </div>
                          <span class="badge canceled-badge">
                            <?php echo $row["status"]; ?>
                          </span>
                        </div>
                      </div>
                    <?php } ?>
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
<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/user.php";

$object = new reservation_management($connect);

$object->collectUserID();

if (isset($_POST["cancel_reservation"])) {
  $object->cancelFlight();
}
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

    .reservation-card {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      transition: transform 0.3s ease;
    }

    .reservation-card:hover {
      transform: translateY(-5px);
    }

    .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-update {
      background-color: #ffc107;
      color: white;
    }

    .btn-cancel {
      background-color: #dc3545;
      color: white;
    }

    .btn-update:hover {
      background-color: #e0a800;
    }

    .btn-cancel:hover {
      background-color: #c82333;
    }

    .status {
      font-weight: bold;
      color: #28a745;
    }

    .status.canceled {
      color: #dc3545;
    }

    /* Modal styling */
    .modal-content {
      border-radius: 20px;
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

    .reservation-card {
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
            <span class="menu-title">Flight History</span>
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
                    <h2 class="text-center mb-4">Manage Your Reservations</h2>
                    <?php
                    $sql = $object->selectUsersReservations();
                    while ($row = $sql->fetch_array()) {
                      $row["status"] = (!$row["status"]) ? "Pending" : $row["status"];
                    ?>
                      <!-- Reservation Card 1 -->
                      <div class="card reservation-card mb-3">
                        <div class="card-body">
                          <div>
                            <h5 class="card-title"><?php echo $row["flight_id"]; ?></h5>
                            <p class="card-text">From: <?php echo $row["depature_city"]; ?> - To: <?php echo $row["destination_city"]; ?></p>
                            <p class="card-text">Departure: <?php echo $row["depature_date"]; ?> <?php echo $row["depature_time"]; ?></p>
                            <p class="card-text status">Status: <?php echo $row["status"]; ?></p>
                          </div>
                          <div>
                            <button class="btn btn-cancel" data-toggle="modal" data-target="#cancelModal<?php echo $row["reservation_id"]; ?>">Cancel</button>
                          </div>
                        </div>
                      </div>

                      <!-- Cancel Modal 1 -->
                      <div class="modal fade" id="cancelModal<?php echo $row["reservation_id"]; ?>" tabindex="-1" aria-labelledby="cancelModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="cancelModalLabel1">Cancel Reservation: <?php echo $row["flight_id"]; ?></h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you want to cancel this reservation?</p>
                              <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <input type="hidden" name="reservation_id" value="<?php echo $row["reservation_id"]; ?>">
                                <button type="submit" name="cancel_reservation" class="btn btn-danger">Confirm Cancelation</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

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
<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new view_reservation($connect);

$object->collectUserID();

if (isset($_POST["cancel_reservation"])) {
  $object->cancelFlight();
}

if (isset($_POST["confirm_reservation"])) {
  $object->confirmFlight();
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
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
    }

    .reservation-container {
      margin: 50px auto;
      max-width: 1200px;
      padding: 30px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #007bff;
    }

    .btn-cancel,
    .btn-reschedule {
      padding: 8px 15px;
      border-radius: 5px;
      font-size: 14px;
      transition: 0.3s ease;
    }

    .btn-cancel {
      background-color: #dc3545;
      color: white;
    }

    .btn-cancel:hover {
      background-color: #c82333;
      transform: scale(1.05);
    }

    .btn-reschedule {
      background-color: #28a745;
      color: white;
    }

    .btn-reschedule:hover {
      background-color: #218838;
      transform: scale(1.05);
    }

    table {
      width: 100%;
      margin-top: 30px;
    }

    .table-hover tbody tr:hover {
      background-color: #f1f3f5;
    }

    .table th {
      background-color: #007bff;
      color: white;
      text-align: center;
    }

    .table td {
      text-align: center;
    }

    .modal-header {
      background-color: #007bff;
      color: white;
    }

    .form-control,
    .form-select {
      padding: 12px;
      border-radius: 10px;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
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

                  <body>

                    <div class="container reservation-container">
                      <h2 class="text-center">Reservation Management</h2>

                      <!-- Reservations Table -->
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Flight ID</th>
                              <th>Client Name</th>
                              <th>Flight</th>
                              <th>Departure Date</th>
                              <th>Departure Time</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = $object->selectReservations();
                            $number = 1;
                            while ($row = $sql->fetch_assoc()) {
                            ?>

                              <tr>
                                <th scope="row"><?php echo $number; ?></th>
                                <td><?php echo $row["flight_id"]; ?></td>
                                <td><?php echo $row["fullname"]; ?></td>
                                <td>
                                  <?php echo $row["depature_city"]; ?> to <?php echo $row["destination_city"]; ?>
                                </td>
                                <td><?php echo $row["depature_date"]; ?></td>
                                <td><?php echo $row["depature_time"]; ?></td>
                                <td class="d-flex">
                                  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                    <input type="hidden" name="reservation_id" value="<?php echo $row["reservation_id"]; ?>">
                                    <button type="submit" name="cancel_reservation" class="btn btn-cancel">Cancel</button>
                                  </form>
                                  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                    <input type="hidden" name="reservation_id" value="<?php echo $row["reservation_id"]; ?>">
                                    <button type="submit" name="confirm_reservation" class="btn btn-reschedule">Confirm</button>
                                  </form>
                                </td>
                              </tr>
                            <?php $number++;
                            } ?>
                          </tbody>
                        </table>
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
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>

  <!-- End custom js for this page -->
</body>

</html>
<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/user.php";

$object = new flight_booking($connect);

$object->collectUserID();

if (isset($_POST["book_flight"])) {
  $object->bookFlight();
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
    /* General Styling */
    body {
      background-color: #f7f9fc;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    .form-title {
      font-size: 30px;
      font-weight: bold;
      color: #0056b3;
      margin-bottom: 20px;
      text-align: center;
    }

    /* Flight Search Form Styling */
    .flight-search-form {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
      font-weight: bold;
    }

    /* Flight Results Styling */
    .flight-results {
      margin-top: 50px;
    }

    .flight-card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .flight-card:hover {
      transform: translateY(-10px);
    }

    .flight-card .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-book {
      background-color: #28a745;
      color: white;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-book:hover {
      background-color: #218838;
    }

    .price {
      font-size: 18px;
      font-weight: bold;
      color: #0056b3;
    }

    /* Animation */
    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .flight-card {
      animation: fadeIn 1s ease-in-out;
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
                    <!-- Flight Search Form -->
                    <div class="flight-search-form">
                      <h2 class="form-title">Search for Flights</h2>
                      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="departure">Departure City</label>
                              <input type="text" name="depature_city" class="form-control" id="departure" placeholder="Enter departure city">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="destination">Destination City</label>
                              <input type="text" name="destination_city" class="form-control" id="destination" placeholder="Enter destination city">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="departure-date">Departure Date</label>
                              <input type="date" name="depature_date" class="form-control" id="departure-date">
                            </div>
                          </div>
                        </div>

                        <div class="text-center mt-4">
                          <button type="submit" name="search" class="btn btn-primary btn-lg">Search Flights</button>
                        </div>
                      </form>
                    </div>

                    <!-- Flight Results Section -->
                    <div class="flight-results mt-5">
                      <h3 class="text-center mb-4">Available Flights</h3>

                      <?php
                      if (isset($_POST["search"])) {
                        $object->collectFormInputs();
                        if ($object->returnSearchResult()) {
                          $sql = $object->returnSearchResult();
                          while ($row = $sql->fetch_assoc()) {
                      ?>
                            <div class="card flight-card mb-3">
                              <div class="card-body">
                                <div>
                                  <h5 class="card-title"><?php echo $row["flight_id"]; ?></h5>
                                  <p class="card-text">From: <?php echo $row["depature_city"]; ?> - To: <?php echo $row["destination_city"]; ?></p>
                                  <p class="card-text">Departure Date: <?php echo $row["depature_date"]; ?> | <?php echo $row["depature_time"]; ?></p>
                                  <!-- <p class="card-text">Seats Available: 25</p> -->
                                </div>
                                <div>
                                  <p class="price">₦<?php echo $row["amount"]; ?></p>
                                  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                    <input type="hidden" name="flight_id" value="<?php echo $row["flight_id"]; ?>">
                                    <button type="submit" name="book_flight" class="btn btn-book">Book Now</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <?php  }
                        } else {
                          echo '
                            <div class="card flight-card mb-3">
                                  <div class="card-body">
                                      <h5 class="card-title">Your search returned no results. Please refine your search or try alternative dates</h5>
                                  </div>
                              </div>
                          ';
                        }
                      } else {

                        ?>
                        <?php
                        $sql = $object->selectFlights();
                        while ($row = $sql->fetch_assoc()) {
                        ?>
                          <div class="card flight-card mb-3">
                            <div class="card-body">
                              <div>
                                <h5 class="card-title"><?php echo $row["flight_id"]; ?></h5>
                                <p class="card-text">From: <?php echo $row["depature_city"]; ?> - To: <?php echo $row["destination_city"]; ?></p>
                                <p class="card-text">Departure Date: <?php echo $row["depature_date"]; ?> | <?php echo $row["depature_time"]; ?></p>
                                <!-- <p class="card-text">Seats Available: 25</p> -->
                              </div>
                              <div>
                                <p class="price">₦<?php echo $row["amount"]; ?></p>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                  <input type="hidden" name="flight_id" value="<?php echo $row["flight_id"]; ?>">
                                  <button type="submit" name="book_flight" class="btn btn-book">Book Now</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
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
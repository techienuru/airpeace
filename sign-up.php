<?php
include_once 'includes/connect.php';
include_once 'includes/classes/classes.php';

$object = new register($connect);

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $object->collectInputs();
  if (!$object->checkIfEmailExist()) {
    $object->insertIntoDB();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Air Peace</title>
  <!--     Fonts and icons     -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
    rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./css/nucleo-icons.css" rel="stylesheet" />
  <link href="./css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script
    src="https://kit.fontawesome.com/42d5adcbca.js"
    crossorigin="anonymous"></script>
  <link href="./css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link
    id="pagestyle"
    href="./css/soft-ui-dashboard.css?v=1.0.3"
    rel="stylesheet" />
</head>

<body class="">
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div
              class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">
                    Sign Up
                  </h3>
                </div>
                <div class="card-body">
                  <form role="form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <label>Full Name</label>
                    <div class="mb-3">
                      <input
                        type="text" name="fullname"
                        class="form-control"
                        placeholder="Fullname"
                        aria-label="Email"
                        aria-describedby="email-addon" />
                    </div>
                    <label>Email</label>
                    <div class="mb-3">
                      <input
                        type="email" name="email"
                        class="form-control"
                        placeholder="Email"
                        aria-label="Email"
                        aria-describedby="email-addon" />
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input
                        type="password" name="password"
                        class="form-control"
                        placeholder="Password"
                        aria-label="Password"
                        aria-describedby="password-addon" />
                    </div>

                    <div class="text-center">
                      <button
                        type="submit"
                        class="btn bg-gradient-info w-100 mt-4 mb-0">
                        Sign in
                      </button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a
                      href="./index.php"
                      class="text-info text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div
                class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div
                  class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                  style="
                      background-image: url('./img/aeroplane.webp');
                    "></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="./js/core/popper.min.js"></script>
  <script src="./js/core/bootstrap.min.js"></script>
  <script src="./js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf("Win") > -1;
    if (win && document.querySelector("#sidenav-scrollbar")) {
      var options = {
        damping: "0.5",
      };
      Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
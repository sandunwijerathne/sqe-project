<?php
session_start();
include '../conn.php';
if (isset($_POST['log'])) {
  $email = $_POST["email"];
  $pass = $_POST["pass"];
  if (empty($email)) {
    header("Location: sign-in.php?error=");
    exit();
  } else {
    $sql = "SELECT email,password,fname FROM cv WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $x = (mysqli_query($con, $sql));
    if (mysqli_num_rows($x) > 0) {
      if ($row["email"] == $email && $row["password"] == $pass) {

        $_SESSION["loggedin"] = true;
        $idd = $row['cusid'];
        $_SESSION["id"] = $row['idcv'];
        $_SESSION["email"] = $email;
        $_SESSION["status"] = "Welcome " . $row['fname'] . " Please update your profile details";
        $_SESSION["code"] = "warning";
        $_SESSION['type'] = "cus";
        header("location: profile.php");
        exit();
      } else {
        $_SESSION["status"] = "Invalid username or password";
        $_SESSION["code"] = "error";
        header("Location: sign-in.php");
        exit();
      }
    } else {
      $_SESSION["status"] = "Invalid username or password";
      $_SESSION["code"] = "error";
      header("Location: sign-in.php");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    JobSeeker Dashboard by JobSeeker Team
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/native-toast.css">
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <div class="col-12 text-center ms-auto">
                      <img class="logo" src="../images/abc banking loog png.png" width="auto">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST">
                  <div class="input-group input-group-outline my-3 is-focused">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Username" required autofocus class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-3 is-focused">
                    <label class="form-label">Password</label>
                    <input type="password" name="pass" placeholder="Password" required class="form-control">
                  </div>

                  <div class="text-center">
                    <button class="btn bg-gradient-primary w-100 my-4 mb-2" type="submit" name="log">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="../pages/sign-up.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                <strong><span>Sandun, Dilan, Raveen </span></strong>. All Rights Reserved
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="#" class="nav-link text-white" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
  <script src="../js/native-toast.min.js"></script>
  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>
    <script type="text/javascript">
      nativeToast({
        message: '<?php echo $_SESSION['status'] ?>',
        position: 'center',
        timeout: 4000,
        type: '<?php echo $_SESSION['code'] ?>',
        closeOnClick: true
      })
    </script>
  <?php
    unset($_SESSION['status']);
  }
  ?>
</body>

</html>
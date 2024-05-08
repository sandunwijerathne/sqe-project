<?php
session_start();
include '../conn.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $_SESSION["status"] = "Please login your account here";
  $_SESSION["code"] = "warning";
  header("location: login.php");
  exit;
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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />

  <style>
    @media(min-width:768px) {
      div.dt-container div.dt-layout-row {
        display: table;
        /* clear: both; */
        width: 98%;
        margin: 0 auto;
        overflow: hidden;
      }
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">JobSeeker Dashboard</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <?php
        if ($_SESSION['type'] == "admin") {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white active bg-gradient-primary" href="../pages/dashboard.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
        <?php
        }
        if ($_SESSION['type'] == "agency" || $_SESSION['type'] == "admin") {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white " href="../pages/searchcv.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Search CV</span>
            </a>
          </li>
        <?php
        }

        ?>
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/billing.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/notifications.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>-->
        <?php
        if ($_SESSION['type'] == "cus" || $_SESSION['type'] == "admin") {

        ?>
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="../pages/profile.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="../pages/cvtemplate.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">view_in_ar</i>
              </div>
              <span class="nav-link-text ms-1">CV Template</span>
            </a>
          </li>
        <?php
        }

        ?>

      </ul>
    </div>

  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>

            <li class="nav-item d-flex align-items-center">
              <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign Out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">CV generated</p>
                <h4 class="mb-0">
                  <?php // SQL query
                  $sql = "SELECT COUNT(idcv) AS total FROM cv";

                  // Execute query
                  $result = $con->query($sql);

                  // Check if query executed successfully
                  if ($result) {
                    // Fetch the result
                    $row = $result->fetch_assoc();
                    $total = $row['total'];
                    echo ($total * 3);
                  } else {
                    echo "Error executing query: " . $conn->error;
                  }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">

          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Agency</p>
                <h4 class="mb-0">
                  <?php // SQL query
                  $sql = "SELECT COUNT(role) AS total FROM user where role='agency'";

                  // Execute query
                  $result = $con->query($sql);

                  // Check if query executed successfully
                  if ($result) {
                    // Fetch the result
                    $row = $result->fetch_assoc();
                    $total = $row['total'];
                    echo $total;
                  } else {
                    echo "Error executing query: " . $conn->error;
                  }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">

          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Customers</p>
                <h4 class="mb-0">
                  <?php // SQL query
                  $sql = "SELECT COUNT(idcv) AS total FROM cv";

                  // Execute query
                  $result = $con->query($sql);

                  // Check if query executed successfully
                  if ($result) {
                    // Fetch the result
                    $row = $result->fetch_assoc();
                    $total = $row['total'];
                    echo $total;
                  } else {
                    echo "Error executing query: " . $conn->error;
                  }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">

          </div>
        </div>
      </div>

      <div class="row mt-4 mb-4">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Users</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone /Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Birth Day</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM cv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($qrow = mysqli_fetch_array($result)) {

                    ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="<?php echo $qrow['image'] ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $qrow['fname'] . " " . $qrow['lname'] ?>
                                  <p class="text-xs text-secondary mb-0"><?php echo $qrow['email'] ?></p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?php echo $qrow['phone'] ?></p>
                            <p class="text-xs text-secondary mb-0"><?php echo $qrow['address'] ?></p>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-success"><?php echo $qrow['gender'] ?></span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $qrow['dob'] ?></span>
                          </td>
                          <td class="align-middle">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              Edit
                            </a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4 mb-4">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All CVs</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qualification</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skils</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Experience</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Certificate</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Language</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM cv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                        $idcv = $row['idcv'];
                    ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $row['fname'] . " " . $row['lname'] ?>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="text-xs text-secondary mb-0"><?php echo $row['email'] ?>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?php echo $row['phone'] ?></p>
                          </td>
                          <td>
                            <?php

                            $sqlq = "SELECT * FROM qualification WHERE cv_idcv= $idcv";
                            $resulqt = mysqli_query($con, $sqlq);
                            $numq = (mysqli_query($con, $sqlq));

                            if (mysqli_num_rows($numq) > 0) {
                              while ($qrow = mysqli_fetch_array($resulqt)) {
                            ?>
                                <div class=" border-1 p-2 mb-2  bg-gray-100 border-radius-lg">
                                  <p class="text-xs font-weight-bold mb-0"><?php echo $qrow['qualificationname'] ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $qrow['institute'] ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $qrow['year'] ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $qrow['grade'] ?></p>
                                </div>
                            <?php
                              }
                            }
                            ?>
                          </td>
                          <td>
                            <?php

                            $sqls = "SELECT * FROM skill WHERE cv_idcv= $idcv";
                            $results = mysqli_query($con, $sqls);
                            $nums = (mysqli_query($con, $sqls));

                            if (mysqli_num_rows($nums) > 0) {
                              while ($srow = mysqli_fetch_array($results)) {
                            ?>
                                <p class=" badge badge-sm bg-gradient-success"><?php echo $srow['skillname']; ?></p>
                            <?php

                              }
                            }
                            ?>
                          </td>
                          <td>
                            <?php

                            $sqle = "SELECT * FROM experience WHERE cv_idcv= $idcv";
                            $resulte = mysqli_query($con, $sqle);
                            $nume = (mysqli_query($con, $sqle));

                            if (mysqli_num_rows($nume) > 0) {
                              while ($erow = mysqli_fetch_array($resulte)) {
                            ?>
                                <div class=" border-1 p-2 mb-2  bg-gray-100 border-radius-lg">
                                  <p class="text-xs font-weight-bold mb-0"><?php echo $erow['comapny']; ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $erow['startdate'] . " to " . $erow['enddate']; ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $erow['responsibilities']; ?></p>
                                </div>
                            <?php

                              }
                            }
                            ?>
                          </td>
                          <td>
                            <?php

                            $sqle = "SELECT * FROM certificate WHERE cv_idcv= $idcv";
                            $resulte = mysqli_query($con, $sqle);
                            $nume = (mysqli_query($con, $sqle));

                            if (mysqli_num_rows($nume) > 0) {
                              while ($crow = mysqli_fetch_array($resulte)) {
                            ?>
                                <div class=" border-1 p-2 mb-2  bg-gray-100 border-radius-lg">
                                  <p class="text-xs font-weight-bold mb-0"><?php echo $crow['certificatename']; ?></p>
                                  <p class="text-secondary text-xs font-weight-bold"><?php echo $crow['issueddate']; ?></p>
                                </div>
                            <?php

                              }
                            }
                            ?>
                          </td>

                          <td>
                            <?php

                            $sqls = "SELECT * FROM language WHERE cv_idcv= $idcv";
                            $results = mysqli_query($con, $sqls);
                            $nums = (mysqli_query($con, $sqls));

                            if (mysqli_num_rows($nums) > 0) {
                              while ($lrow = mysqli_fetch_array($results)) {
                            ?>
                                <p class=" badge badge-sm bg-gradient-secondary"><?php echo $lrow['language']; ?></p>
                            <?php

                              }
                            }
                            ?>
                          </td>
                          <td>
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              Edit
                            </a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <strong><span>Sandun, Dilan, Raveen </span></strong>. All Rights Reserved

              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted" target="_blank">Jobseeker Team</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>

      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

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
  <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
  <script>
    jQuery(document).ready(function($) {
      new DataTable('#myTable', {
        responsive: true
      });
    });
  </script>
  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>

    <script type="text/javascript">
      // alert();
      Swal.fire({
        position: 'top-center',
        icon: '<?php echo $_SESSION['code'] ?>',
        title: '<?php echo $_SESSION['status'] ?>',
        showConfirmButton: false,
        timer: 4000
      });
    </script>
  <?php
    unset($_SESSION['status']);
  }
  ?>
</body>

</html>
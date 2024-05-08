<?php
session_start();
include '../conn.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $_SESSION["status"] = "Please login your account here";
  $_SESSION["code"] = "warning";
  header("location: sign-in.php");
  exit;
}
if (!isset($_SESSION["email"]) || $_SESSION["email"] !== true) {
  // echo $_SESSION["email"];
  $email = $_SESSION["email"];
  $sql = "SELECT * FROM cv WHERE email ='" . $email . "' ";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $idcv = $row['idcv'];

  $firstname = $row['fname'];
  $lastname = $row['lname'];
  $email = $row['email'];
  $currentPosition = $row['currentosition'];
  $address = $row['address'];
  $dob = $row['dob'];
  $phone = $row['phone'];
  $gender =  $row['gender'];
  $bio = $row['bio'];
  $image = $row['image'];
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
  <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js">
      import axios from 'axios';
  </script>
  <style>
    .ski.active,
    .quli.active,
    .expe.active {
      background: #4d90fe !important;
      color: white !important;
    }
    a.btn.btn-lg.bg-gradient-primary.btn-lg.w-100.mt-4.mb-0.pdf-download-link {
    width: 300px !important;
    margin: 0 auto;
    margin-top: 0 !IMPORTANT;
    margin-bottom: 30px !important;
}
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200 ">
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
            <a class="nav-link text-white " href="../pages/dashboard.php">
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
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/profile.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/cvtemplate.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">CV Template</span>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Virtual Reality</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">CV Template</h6>
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
  
  <div class="border-radius-xl mx-2 mx-md-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg'); background-size: cover;">

    <main class="main-content border-radius-lg h-100">

      <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-1">
        <div class="container-fluid">
          <div class="row p-2">
            <div class="col-lg-12 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 mb-3">
              <div class="nav-wrapper position-relative end-0">
                <form method="POST">
                  <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                      <?php
                      $temp1 = "";
                      $temp2 = "";
                      $temp3 = "";
                      if (isset($_POST['temp1'])) {
                        $temp1 = "active";
                      } elseif (isset($_POST['temp2'])) {
                        $temp2 = "active";
                      } elseif (isset($_POST['temp3'])) {
                        $temp3 = "active";
                      } else {
                        $temp1 = "active";
                        $_POST['temp1'] = "temp1";
                      }
                      ?>
                      <button class="nav-link mb-0 px-0 py-1 <?php echo $temp1; ?> quli" data-bs-toggle="tab" role="tab" aria-selected="true" name="temp1">
                        <i class="material-icons text-lg position-relative">topic</i>
                        <span class="ms-1">Template 01</span>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link mb-0 px-0 py-1 <?php echo $temp2; ?> ski" data-bs-toggle="tab" role="tab" aria-selected="false" name="temp2">
                        <i class="material-icons text-lg position-relative">apps</i>
                        <span class="ms-1">Template 02</span>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link mb-0 px-0 py-1 <?php echo $temp3; ?> expe" data-bs-toggle="tab" role=" tab" aria-selected="false" name="temp3">
                        <i class="material-icons text-lg position-relative">settings</i>
                        <span class="ms-1">Template 03</span>
                      </button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
          <div class="row" id="jobseekerresume">
            <div class="col-lg-12 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 mb-3">
              <?php
              if (isset($_POST['temp1'])) {

              ?>
                <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <style>
                  .bold {
                    font-weight: 700;
                    font-size: 20px;
                    text-transform: uppercase;
                  }

                  .checked {
                    color: orange;
                  }

                  .semi-bold {
                    font-weight: 500;
                    font-size: 16px;
                  }

                  .resume {
                    width: 800px;
                    height: auto;
                    display: flex;
                    margin: 50px auto;
                  }

                  .resume .resume_left {
                    width: 280px;
                    background: #0bb5f4;
                  }

                  .resume .resume_left .resume_profile {
                    width: 100%;
                    height: 280px;
                  }

                  .resume .resume_left .resume_profile img {
                    width: 100%;
                    height: 100%;
                  }

                  .resume .resume_left .resume_content {
                    padding: 0 25px;
                  }

                  .resume .title {
                    margin-bottom: 20px;
                  }

                  .resume .resume_left .bold {
                    color: #fff;
                  }

                  .resume .resume_left .regular {
                    color: #b1eaff;
                  }

                  .resume .resume_item {
                    padding: 25px 0;
                    border-bottom: 2px solid #b1eaff;
                  }

                  .resume .resume_left .resume_item:last-child,
                  .resume .resume_right .resume_item:last-child {
                    border-bottom: 0px;
                  }

                  .resume .resume_left ul li {
                    display: flex;
                    margin-bottom: 10px;
                    align-items: center;
                  }

                  .resume .resume_left ul li:last-child {
                    margin-bottom: 0;
                  }

                  .resume .resume_left ul li .icon {
                    width: 35px;
                    height: 35px;
                    background: #fff;
                    color: #0bb5f4;
                    border-radius: 50%;
                    margin-right: 15px;
                    font-size: 16px;
                    position: relative;
                  }

                  .resume .icon i,
                  .resume .resume_right .resume_hobby ul li i {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                  }

                  .resume .resume_left ul li .data {
                    color: #b1eaff;
                  }

                  .resume .resume_left .resume_skills ul li {
                    display: flex;
                    margin-bottom: 10px;
                    color: #b1eaff;
                    justify-content: space-between;
                    align-items: center;
                  }

                  .resume .resume_left .resume_skills ul li .skill_name {
                    width: 25%;
                  }

                  .resume .resume_left .resume_skills ul li .skill_progress {
                    width: 60%;
                    margin: 0 5px;
                    height: 5px;
                    background: #009fd9;
                    position: relative;
                  }

                  .resume .resume_left .resume_skills ul li .skill_per {
                    width: 15%;
                  }

                  .resume .resume_left .resume_skills ul li .skill_progress span {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    background: #fff;
                  }

                  .resume .resume_left .resume_social .semi-bold {
                    color: #fff;
                    margin-bottom: 3px;
                  }

                  .resume .resume_right {
                    width: 520px;
                    background: #fff;
                    padding: 25px;
                  }

                  .resume .resume_right .bold {
                    color: #0bb5f4;
                  }

                  .resume .resume_right .resume_work ul,
                  .resume .resume_right .resume_education ul {
                    padding-left: 40px;
                    overflow: hidden;
                  }

                  .resume .resume_right ul li {
                    position: relative;
                  }

                  .resume .resume_right ul li .date {
                    font-size: 16px;
                    font-weight: 500;
                    margin-bottom: 15px;
                  }

                  .resume .resume_right ul li .info {
                    margin-bottom: 20px;
                  }

                  .resume .resume_right ul li:last-child .info {
                    margin-bottom: 0;
                  }

                  .resume .resume_right .resume_work ul li:before,
                  .resume .resume_right .resume_education ul li:before {
                    content: "";
                    position: absolute;
                    top: 5px;
                    left: -23px;
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    border: 2px solid #0bb5f4;
                  }

                  .resume .resume_right .resume_work ul li:after{
                    content: "";
                    position: absolute;
                    top: 14px;
                    left: -21px;
                    width: 2px;
                    height: 90px;
                    background: #0bb5f4;
                  }

                  .resume .resume_right .resume_education ul li:after {
                    content: "";
                    position: absolute;
                    top: 14px;
                    left: -21px;
                    width: 2px;
                    height: 130px;
                    background: #0bb5f4;
                  }
                    .resume .resume_right .resume_education.certificates ul li:after {
                    content: "";
                    position: absolute;
                    top: 14px;
                    left: -21px;
                    width: 2px;
                    height: 50px;
                    background: #0bb5f4;
                  }
                  .resume .resume_right .resume_hobby ul {
                    display: flex;
                    justify-content: space-between;
                  }

                  .resume .resume_right .resume_hobby ul li {
                    width: 80px;
                    height: 80px;
                    border: 2px solid #0bb5f4;
                    border-radius: 50%;
                    position: relative;
                    color: #0bb5f4;
                  }

                  .resume .resume_right .resume_hobby ul li i {
                    font-size: 30px;
                  }

                  .resume .resume_right .resume_hobby ul li:before {
                    content: "";
                    position: absolute;
                    top: 40px;
                    right: -52px;
                    width: 50px;
                    height: 2px;
                    background: #0bb5f4;
                  }

                  .resume .resume_right .resume_hobby ul li:last-child:before {
                    display: none;
                  }
                  .resume_item.resume_work li {
                     list-style: none;
                    }
                    .resume_item.resume_education li {
                         list-style: none;
                    }
                </style>
                <div class="resume">
                  <div class="resume_left">
                    <div class="resume_profile">
                      <img src="<?php 
                      $absoluteURL = "http://sqeassignment.space/" . ltrim($image, '/');
                      echo $absoluteURL;
                      ?>" alt="profile_pic">
                    </div>
                    <div class="resume_content">
                      <div class="resume_item resume_info">
                        <div class="title">
                          <p class="bold"><?php echo $firstname; ?> <?php echo $lastname; ?></p>
                          <p class="regular"><?php echo $currentPosition; ?></p>
                        </div>
                        <ul>
                          <li>
                            <div class="icon" style="padding: 17px;">
                              <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="data">
                              <?php echo $address; ?>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="data">
                              <?php echo $phone; ?>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fas fa-envelope"></i>
                            </div>
                            <div class="data">
                              <?php echo $email; ?>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                           <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div class="data">
                              <?php echo $dob; ?>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="resume_item resume_skills">
                        <div class="title">
                          <p class="bold">skill's</p>
                        </div>
                        <ul>
                          <?php

                          $sql = "SELECT * FROM skill WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($srow = mysqli_fetch_array($result)) {
                              $leveltoprecent = $srow['level'];
                              // echo $leveltoprecent;
                              $percentage = ($leveltoprecent) * 10;
                          ?>
                              <li>
                                <div class="skill_name">
                                  <?php echo $srow['skillname']; ?>
                                </div>
                                <div class="skill_progress">
                                  <span style="width: <?php echo $percentage; ?>%;"></span>
                                </div>
                                <div class="skill_per"><?php echo $percentage; ?>%</div>
                              </li>
                          <?php

                            }
                          } else {
                          }
                          ?>
                        </ul>
                      </div>
                      <div class="resume_item resume_social">
                        <div class="title">
                          <p class="bold">Languages</p>
                        </div>
                        <ul>
                          <?php

                          $sql = "SELECT * FROM language WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($lrow = mysqli_fetch_array($result)) {
                          ?>
                              <li>

                                <div class="data">
                                  <p class="semi-bold"><?php echo $lrow['language']; ?> :
                                    <?php if ($lrow['level']) {

                                      for ($x = 1; $x <= 5; $x++) {
                                        if ($x <= $lrow['level']) {
                                    ?>
                                          <span class="fa fa-star checked"></span>
                                        <?php
                                        } else {
                                        ?>
                                          <span class="fa fa-star"></span>
                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </p>
                                </div>
                              </li>
                          <?php

                            }
                          } else {
                          }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="resume_right">
                    <div class="resume_item resume_about">
                      <div class="title">
                        <p class="bold">About us</p>
                      </div>
                      <p><?php echo $bio; ?></p>
                    </div>
                    <div class="resume_item resume_work">
                      <div class="title">
                        <p class="bold">Work Experience</p>
                      </div>
                      <ul>
                        <?php

                        $sql = "SELECT * FROM experience WHERE cv_idcv= $idcv";
                        $result = mysqli_query($con, $sql);
                        $num = (mysqli_query($con, $sql));

                        if (mysqli_num_rows($num) > 0) {
                          while ($erow = mysqli_fetch_array($result)) {
                        ?>
                            <li>
                              <div class="date"><?php echo $erow['startdate']; ?> to <?php echo $erow['enddate']; ?></div>
                              <div class="info">
                                <p class="semi-bold"><?php echo $erow['comapny']; ?></p>
                                <p><?php echo $erow['responsibilities']; ?></p>
                              </div>
                            </li>
                        <?php

                          }
                        } else {
                        }
                        ?>
                      </ul>
                    </div>
                    <div class="resume_item resume_education">
                      <div class="title">
                        <p class="bold">Education</p>
                      </div>
                      <ul>
                        <?php

                        $sql = "SELECT * FROM qualification WHERE cv_idcv= $idcv";
                        $result = mysqli_query($con, $sql);
                        $num = (mysqli_query($con, $sql));

                        if (mysqli_num_rows($num) > 0) {
                          while ($qrow = mysqli_fetch_array($result)) {
                        ?>
                            <li>
                              <div class="date"><?php echo $qrow['year'] ?></div>
                              <div class="info">
                                <p><?php echo $qrow['qualificationname'] ?></p>
                                <p class="semi-bold"><?php echo $qrow['institute'] ?></p>
                                <p> Grade: <?php echo $qrow['grade'] ?></p>
                              </div>
                            </li>
                        <?php

                          }
                        } else {
                        }
                        ?>
                      </ul>
                    </div>
                    <div class="resume_item resume_education certificates">
                      <div class="title">
                        <p class="bold">Certificates</p>
                      </div>
                      <ul>
                        <?php

                        $sql = "SELECT * FROM certificate WHERE cv_idcv= $idcv";
                        $result = mysqli_query($con, $sql);
                        $num = (mysqli_query($con, $sql));

                        if (mysqli_num_rows($num) > 0) {
                          while ($crow = mysqli_fetch_array($result)) {
                        ?>
                            <li>
                              <div class="date"><?php echo $crow['issueddate']; ?></div>
                              <div class="info">
                                <p><?php echo $crow['certificatename']; ?></p>

                              </div>
                            </li>
                        <?php

                          }
                        } else {
                        }
                        ?>

                      </ul>
                    </div>
                  </div>
                </div>


              <?php

              } else if (isset($_POST['temp2'])) {
              ?>
                <style>
                  .resume {
                    width: 1027px;
                    height: auto;
                    /* display: flex; */
                    margin: 50px auto;
                  }

                  .checked {
                    color: orange;
                  }

                  .top {
                    height: 300px;
                    background-color: #24260f;
                  }

                  .top-content {
                    width: 1027px;
                    height: 300px;
                    background-color: white;
                    margin-right: auto;
                    margin-left: auto;
                    display: flex;
                    justify-content: center;
                  }

                  .photo {
                    width: 230px;
                    height: 275px;
                    display: inline-block;
                    margin-top: 20px;
                    margin: 20px;
                    background-color: white;
                  }

                  .photo h1 {
                    text-align: center;
                    font-weight: 500;
                    font-size: 30px;
                    position: relative;
                    bottom: 15px;
                    background-color: #24260f;
                    color: #f2f2e9;
                    margin-top: 30px;
                  }

                  

                  .info {
                    width: calc(100% - 230px);
                    margin: 20px;
                    background-color: #24260f;
                    padding: 20px;
                    border-radius: 10px;
                  }

                  .photo,
                  .info {
                    display: inline-block;
                  }

                  .title {
                    margin-left: 50px;
                    text-align: left;
                    font-size: 26px;
                    border-bottom: solid 3px #90a955;
                    background-color: #24260f;
                    color: #f2f2e9;
                  }

                  .contact {
                    display: inline-block;
                    margin-left: 50px;
                    margin-top: 20px;
                  }

                  .url {
                    padding-left: 10px;
                    padding-top: 10px;
                    background-color: #24260f;
                    color: #f2f2e9;
                  }

                  .url span {
                    line-height: 36px;
                    font-family: karla, sans-serif;
                    padding-left: 10px;
                    background-color: #24260f;
                    color: #f2f2e9;
                  }

                  .max-width {
                    width: 1027px;
                    margin-right: auto;
                    margin-left: auto;
                    background: white;
                    display: flex;
                    justify-content: space-around;
                  }

                  .ex-content {
                    display: flex;
                  }

                  .ed-content {
                    display: flex;
                  }

                  .left,
                  .right {
                    display: inline-block;
                    /* width: 49%; */
                    /* height: 700px; */
                  }

                  .con-title {
                    width: 450px;
                    height: 50px;
                    font-weight: 900;
                    font-size: 20px;
                    color: #90a955;
                    margin-left: 30px;
                    margin-top: 30px;
                    padding-top: 15px;
                    border-bottom: solid 1px #24260f;
                  }

                  .ex-con-left {
                    display: inline-block;
                    width: 50px;
                    height: auto;
                    margin-left: 30px;
                  }

                  .ex-con-left .dot {
                    width: 10px;
                    height: 10px;
                    border-radius: 100%;
                    background-color: #24260f;
                    margin-left: 20px;
                    margin-top: 30px;
                  }

                  .ex-con-left .vertical-line {
                     width: 3px;
                     height: 100%;
                    border-radius: 10%;
                    background-color: #90a955;
                    margin-left: 24px;
                     margin-top: 5px;
                     max-height: 90px;
                  }

                  .ex-con-right {
                    display: inline-block;
                    width: 400px;
                     height: 140px;
                     max-height: 150px;
                    }

                  .ex-con-right h3 {
                    margin: 10px;
                    margin-top: 30px;
                    font-size: 20px;
                    font-weight: bold;
                    line-height: 20px;
                  }

                  .ex-con-right h5 {
                    margin: 10px;
                    font-size: 20px;
                    font-weight: bold;
                    color: #90a955;
                  }

                  .ex-con-right span {
                    font-size: 16px;
                    color: #24260f;
                    margin: 10px 0;
                  }

                  .ex-con-right p {
                    margin: 10px 10px 0px 10px;
                    line-height: 20px;
                    font-size: 16px;
                  }

                  .ex-con-right br {
                    line-height: 26px;
                  }

                  .ed-con-left {
                    display: inline-block;
                    width: 50px;
                    height: auto;
                    margin-left: 30px;
                  }

                  .ed-con-left .dot {
                    width: 10px;
                    height: 10px;
                    border-radius: 100%;
                    background-color: #24260f;
                    margin-left: 20px;
                    margin-top: 30px;
                  }

                  .ed-con-left .vertical-line {
                    width: 3px;
                    height: 85px;
                    border-radius: 10%;
                    background-color: #90a955;
                    margin-left: 24px;
                    margin-top: 5px;
                  }

                  .ed-con-right {
                    display: inline-block;
                    width: 400px;
                    height: 250px;
                  }
                  .ed-content .ed-con-right {
                    display: inline-block;
                    width: 400px;
                    height: 160px;
                  }

                  .ed-con-right h3 {
                    margin: 10px;
                    margin-top: 30px;
                    font-size: 20px;
                    font-weight: bold;
                    line-height: 20px;
                  }

                  .ed-con-right h5 {
                    margin: 10px;
                    font-size: 20px;
                    font-weight: bold;
                    color: #90a955;
                  }

                  .ed-con-right span {
                    font-size: 16px;
                    color: #24260f;
                    margin: 10px;
                  }

                  .ed-con-right p {
                    margin: 10px 10px 0px 10px;
                    line-height: 20px;
                    font-size: 16px;
                  }

                  .ed-con-right br {
                    line-height: 26px;
                  }

                  .languages {
                    height: 250px;
                  }

                  .la-title {
                    margin-left: 10px;
                  }

                  .chinese {
                    width: 150px;
                    height: 150px;
                    display: inline-block;
                    border-radius: 100%;
                    overflow: hidden;
                    margin: 30px 15px 0px 10px;
                    border: solid 5px #90a955;
                    text-align: center;
                  }

                  .chinese h3 {
                    text-align: center;
                    margin-top: 40px;
                    font-weight: bold;
                    font-size: 16px;
                  }

                  .chinese h4 {
                    text-align: center;
                    margin-top: -20px;
                    color: #90a955;
                  }

                  .outer-jp {
                    width: 150px;
                    height: 150px;
                    display: inline-block;
                    background: #c1d7ae;
                    border-radius: 100%;
                    position: relative;
                    overflow: hidden;
                    margin-top: 30px;
                  }

                  .sq1-jp {
                    width: 150px;
                    height: 150px;
                    position: absolute;
                    left: 75px;
                    background-color: #90a955;
                  }

                  .sq2-jp {
                    width: 75px;
                    height: 75px;
                    position: absolute;
                    top: 75px;
                    background-color: #90a955;
                  }

                  .sq3-jp {
                    width: 75px;
                    height: 75px;
                    background-color: #90a955;
                    transform-origin: bottom;
                    transform: skewX(36deg);
                  }

                  .inner-jp {
                    width: 140px;
                    height: 140px;
                    position: absolute;
                    border-radius: 100%;
                    top: 5px;
                    left: 5px;
                    background-color: #f2f2e9;
                    overflow: hidden;
                  }

                  .inner-jp h3 {
                    text-align: center;
                    margin-top: 40px;
                    font-weight: bold;
                    font-size: 16px;
                  }

                  .inner-jp h4 {
                    text-align: center;
                    margin-top: -20px;
                    color: #90a955;
                  }

                  .outer-eng {
                    width: 150px;
                    height: 150px;
                    display: inline-block;
                    background: #c1d7ae;
                    border-radius: 100%;
                    position: relative;
                    overflow: hidden;
                    margin-top: 30px;
                    margin-left: 10px;
                  }

                  .sq1-eng {
                    width: 150px;
                    height: 150px;
                    position: absolute;
                    left: 75px;
                    background-color: #90a955;
                  }

                  .sq2-eng {
                    width: 75px;
                    height: 75px;
                    position: absolute;
                    top: 75px;
                    background-color: #90a955;
                  }

                  .inner-eng {
                    width: 140px;
                    height: 140px;
                    position: absolute;
                    border-radius: 100%;
                    top: 5px;
                    left: 5px;
                    background-color: #f2f2e9;
                    overflow: hidden;
                  }

                  .inner-eng h3 {
                    text-align: center;
                    margin-top: 40px;
                    font-weight: bold;
                    font-size: 16px;
                  }

                  .inner-eng h4 {
                    text-align: center;
                    margin-top: -20px;
                    color: #90a955;
                  }

                  .skills {
                    height: 200px;
                  }

                  .sk-title {
                    margin-left: 10px;
                    margin-top: 0px;
                  }

                  .skill-con-left,
                  .skill-con-right {
                    display: inline-block;
                    width: 230px;
                    height: 130px;
                    margin-top: 20px;
                  }

                  .skill-bar span {
                    display: inline-block;
                    font-weight: bold;
                    margin-left: 10px;
                    width: 90px;
                  }

                  .skill-level {
                    display: inline-block;
                    margin-left: 10px;
                  }

                  .yes {
                    display: inline-block;
                    width: 15px;
                    height: 15px;
                    border-radius: 100%;
                    background-color: #90a955;
                    margin-top: 10px;
                    margin-right: 2px;
                  }

                  .no {
                    display: inline-block;
                    width: 15px;
                    height: 15px;
                    border-radius: 100%;
                    background-color: #c1d7ae;
                    margin-top: 10px;
                    margin-right: 2px;
                  }

                  .portfolio {
                    height: 200px;
                  }

                  .po-con-right {
                    display: inline-block;
                    transition-duration: 0.5s;
                    width: 150px;
                    height: 160px;
                    margin-left: 10px;
                    padding-top: 10px;
                    opacity: 0.5;
                    position: relative;
                    top: 0px;
                  }

                  .po-con-right span {
                    display: inline-block;
                    font-weight: bold;
                    width: 100px;
                    text-align: center;
                  }

                  .po-con-right:hover {
                    opacity: 1;
                  }

                  .po-con-right:active {
                    top: 10px;
                  }

                  .po-con-middle {
                    display: inline-block;
                    width: 150px;
                    height: 160px;
                    margin-left: 10px;
                    padding-top: 10px;
                    opacity: 0.5;
                    position: relative;
                    top: 0px;
                  }

                  .po-con-middle span {
                    display: inline-block;
                    font-weight: bold;
                    width: 100px;
                    text-align: center;
                  }

                  .po-con-middle:hover {
                    opacity: 1;
                  }

                  .po-con-middle:active {
                    top: 10px;
                  }

                  .po-con-left {
                    display: inline-block;
                    width: 150px;
                    height: 160px;
                    margin-left: 10px;
                    padding-top: 10px;
                    opacity: 0.5;
                    position: relative;
                    top: 0px;
                  }

                  .po-con-left span {
                    display: inline-block;
                    font-weight: bold;
                    width: 100px;
                    text-align: center;
                    padding-right: 15px;
                  }

                  .po-con-left:hover {
                    opacity: 1;
                  }

                  .po-con-left:active {
                    top: 10px;
                  }
                  .top-content .url {
                     DISPLAY: FLEX;
                     MARGIN-BOTTOM: 10PX;
                    }
                    .certificateline .vertical-line {
                        height: 45px;
                    }
                    .certificateline .ed-con-right {
                        display: inline-block;
                         width: 400px;
                         height: 80px;
                    }
                    .w3-display-bottomleft.w3-container.w3-text-black.temp3title {
                            background: #009688;
                             width: 100%;
                             text-align: center;
                        }
                </style>
                <div class="resume">
                  <div class="top">
                    <div class="top-content">

                      <div class="photo"><img src="<?php 
                      $absoluteURL = "http://sqeassignment.space/" . ltrim($image, '/');
                      echo $absoluteURL;
                      ?>" alt="photo" />
                        <h1><?php echo $firstname; ?> <?php echo $lastname; ?></h1>
                      </div>
                      <!-- *照片結束-->
                      <!-- *聯絡資訊開始-->
                      <div class="info">
                        <div class="title"><?php echo $currentPosition; ?></div>
                        <div class="contact">
                          <div class="url"><i class="fas fa-envelope" style="font-size: 36px; color: #90A955;background-color: #24260f;"></i></a><span><?php echo $email; ?></span></div>
                          <div class="url"><i class="fas fa-map-marker-alt" style="font-size:36px;color:#90A955;background-color: #24260f;"></i><span><?php echo $address; ?></span></div>
                          <div class="url"><i class="fas fa-mobile-alt" style="font-size:36px;color:#90A955;background-color: #24260f;"></i><span><?php echo $phone; ?></span></div>
                        </div>
                      </div>
                      <!-- *聯絡資訊結束-->
                    </div>
                  </div>
                  <!-- *表頭結束-->
                  <!-- 內容開始-->
                  <div class="content">
                    <div class="max-width">
                      <!-- 左邊開始-->
                      <div class="left">
                        <!-- 工作經歷開始-->
                        <div class="experience">
                          <div class="con-title ex-title">EXPERIENCE</div>

                          <?php

                          $sql = "SELECT * FROM experience WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($erow = mysqli_fetch_array($result)) {
                          ?>

                              <div class="ex-content">
                                <div class="ex-con-left">
                                  <div class="dot"></div>
                                  <div class="vertical-line"></div>
                                </div>
                                <div class="ex-con-right">
                                  <h3><?php echo $erow['comapny']; ?></h3>
                                  <h5><span><?php echo $erow['startdate']; ?> to <?php echo $erow['enddate']; ?></span></h5>
                                  <p><?php echo $erow['responsibilities']; ?></p>
                                </div>
                              </div>
                          <?php

                            }
                          } else {
                          }
                          ?>
                        </div>
                        <!-- 工作經歷結束-->
                        <!-- 學歷開始-->
                        <div class="education">
                          <div class="con-title ed-title">EDUCATION</div>

                          <?php

                          $sql = "SELECT * FROM qualification WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($qrow = mysqli_fetch_array($result)) {
                          ?>
                              <div class="ed-content">
                                <div class="ed-con-left">
                                  <div class="dot"></div>
                                  <div class="vertical-line"></div>
                                </div>
                                <div class="ed-con-right">
                                  <h3><?php echo $qrow['qualificationname'] ?></h3>
                                  <h5><?php echo $qrow['institute'] ?> <span>｜ <?php echo $qrow['year'] ?></span></h5>
                                  <p>Grade: <?php echo $qrow['grade'] ?></p>
                                </div>
                              </div>
                          <?php

                            }
                          } else {
                          }
                          ?>
                        </div>
                      </div>
                      <div class="right">
                        <!-- 語言能力開始-->
                        <div class="languagues">
                          <div class="con-title la-title">LANGUAGES</div>
                          <div class="la-content">

                            <?php

                            $sql = "SELECT * FROM language WHERE cv_idcv= $idcv";
                            $result = mysqli_query($con, $sql);
                            $num = (mysqli_query($con, $sql));

                            if (mysqli_num_rows($num) > 0) {
                              while ($lrow = mysqli_fetch_array($result)) {
                            ?>
                                <div class="chinese">
                                  <h3><?php echo $lrow['language']; ?></h3>
                                  <h6><?php if ($lrow['level']) {

                                        for ($x = 0; $x < 5; $x++) {
                                          if ($x <= $lrow['level']) {
                                      ?>
                                          <span class="fa fa-star checked"></span>
                                        <?php
                                          } else {
                                        ?>
                                          <span class="fa fa-star"></span>
                                    <?php
                                          }
                                        }
                                      }


                                    ?>
                                  </h6>
                                </div>
                            <?php

                              }
                            } else {
                            }
                            ?>
                            <!-- <div class="outer-jp">
                              <div class="sq1-jp"></div>
                              <div class="sq2-jp"></div>
                              <div class="sq3-jp"></div>
                              <div class="inner-jp">
                                <h3>JAPANESE</h3>
                                <h4>JLPT N1</h4>
                              </div>
                            </div>
                            <div class="outer-eng">
                              <div class="sq1-eng"></div>
                              <div class="sq2-eng"></div>
                              <div class="inner-eng">
                                <h3>ENGLISH</h3>
                                <h4>TOEIC 830</h4>
                              </div>
                            </div> -->
                          </div>
                        </div>
                        <!-- 語言能力結束-->
                        <!--技能開始-->
                        <div class="skills">
                          <div class="con-title sk-title">SKILLS</div>
                          <div class="skill-content">


                            <?php

                            $sql = "SELECT * FROM skill WHERE cv_idcv= $idcv";
                            $result = mysqli_query($con, $sql);
                            $num = (mysqli_query($con, $sql));

                            if (mysqli_num_rows($num) > 0) {
                              while ($srow = mysqli_fetch_array($result)) {
                                $leveltoprecent = $srow['level'];
                                // echo $leveltoprecent;
                                $percentage = ($leveltoprecent) / 2;
                                //echo $percentage;
                            ?>
                                <div class="skill-bar"><span><?php echo $srow['skillname']; ?></span>
                                  <div class="skill-level">
                                    <?php if ($percentage) {

                                      for ($x = 0; $x <= 5; $x++) {
                                        if ($x <= $percentage) {
                                    ?>
                                          <div class="yes"></div>
                                        <?php
                                        } else {
                                        ?>
                                          <div class="no"></div>
                                    <?php
                                        }
                                      }
                                    }
                                    ?>
                                  </div>
                                </div>
                            <?php

                              }
                            } else {
                            }
                            ?>


                          </div>
                        </div>
                        <!-- 技能結束-->
                        <!-- 作品集開始-->
                        <div class="portfolio">
                          <div class="con-title sk-title">CERTIFICATES</div>
                          <div class="po-content">
                            <?php

                            $sql = "SELECT * FROM certificate WHERE cv_idcv= $idcv";
                            $result = mysqli_query($con, $sql);
                            $num = (mysqli_query($con, $sql));

                            if (mysqli_num_rows($num) > 0) {
                              while ($crow = mysqli_fetch_array($result)) {
                            ?>
                                <div class="certificateline ed-content">
                                  <div class="ed-con-left">
                                    <div class="dot"></div>
                                    <div class="vertical-line"></div>
                                  </div>
                                  <div class="ed-con-right">
                                    <h3><?php echo $crow['certificatename']; ?></h3>
                                    <h5><span> <?php echo $crow['issueddate']; ?></span></h5>
                                  </div>
                                </div>
                            <?php

                              }
                            } else {
                            }
                            ?>
                          </div>
                        </div>
                        <!-- 作品集結束-->
                        <!-- 右邊結束-->
                        <!-- 內容結束-->
                      </div>
                    </div>
                  </div>
                </div>


              <?php
              } elseif (isset($_POST['temp3'])) {
              ?>
                <html>
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <style>
                  html,
                  body,
                  h1,
                  h2,
                  h3,
                  h4,
                  h5,
                  h6 {
                    font-family: "Roboto", sans-serif
                  }
                  .checked {
                    color: orange;
                  }
                  .w3-display-container {
                    margin-bottom: 30px;
                  }
                </style>

                <body class="w3-light-grey">

                  <!-- Page Container -->
                  <div class="w3-content w3-margin-top" style="max-width:1400px;">

                    <!-- The Grid -->
                    <div class="w3-row-padding">

                      <!-- Left Column -->
                      <div class="w3-third">

                        <div class="w3-white w3-text-grey w3-card-4">
                          <div class="w3-display-container">
                            <img src="<?php 
                      $absoluteURL = "http://sqeassignment.space/" . ltrim($image, '/');
                      echo $absoluteURL;
                      ?>" style="width:100%" alt="Avatar">
                            <div class="w3-display-bottomleft w3-container w3-text-black temp3title" style=" background:#009688; width: 100%; text-align: center;">
                              <h2 style="color:white;"><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
                            </div>
                          </div>
                          <div class="w3-container">
                            <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $currentPosition; ?></p>
                            <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $address; ?></p>
                            <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $email; ?></p>
                            <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $phone; ?></p>
                            <hr>

                            <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>

                            <?php

                            $sql = "SELECT * FROM skill WHERE cv_idcv= $idcv";
                            $result = mysqli_query($con, $sql);
                            $num = (mysqli_query($con, $sql));

                            if (mysqli_num_rows($num) > 0) {
                              while ($srow = mysqli_fetch_array($result)) {
                                $leveltoprecent = $srow['level'];
                                // echo $leveltoprecent;
                                $percentage = ($leveltoprecent) * 10;
                            ?>
                                <div><?php echo $srow['skillname']; ?>
                                  <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:<?php echo $percentage; ?>%"><?php echo $percentage; ?>%</div>
                                  </div>
                                </div>
                            <?php

                              }
                            } else {
                            }
                            ?>
                            <br>

                            <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>

                            <?php

                            $sql = "SELECT * FROM language WHERE cv_idcv= $idcv";
                            $result = mysqli_query($con, $sql);
                            $num = (mysqli_query($con, $sql));

                            if (mysqli_num_rows($num) > 0) {
                              while ($lrow = mysqli_fetch_array($result)) {
                            ?>
                                <p><?php echo $lrow['language']; ?>:

                                  <?php if ($lrow['level']) {

                                    for ($x = 1; $x <= 5; $x++) {
                                      if ($x <= $lrow['level']) {
                                  ?>
                                        <span class="fa fa-star checked"></span>
                                      <?php
                                      } else {
                                      ?>
                                        <span class="fa fa-star"></span>
                                  <?php
                                      }
                                    }
                                  }


                                  ?>
                                </p>

                            <?php

                              }
                            } else {
                            }
                            ?>

                            <br>
                          </div>
                        </div><br>

                        <!-- End Left Column -->
                      </div>

                      <!-- Right Column -->
                      <div class="w3-twothird">

                        <div class="w3-container w3-card w3-white w3-margin-bottom">
                          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>

                          <?php

                          $sql = "SELECT * FROM experience WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($erow = mysqli_fetch_array($result)) {
                          ?>
                              <div class="w3-container">
                                <h5 class="w3-opacity"><b><?php echo $erow['comapny']; ?></b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $erow['startdate']; ?> - <?php echo $erow['enddate']; ?></h6>
                                <p><?php echo $erow['responsibilities']; ?></p>
                                <hr>
                              </div>

                          <?php

                            }
                          } else {
                          }
                          ?>

                        </div>

                        <div class="w3-container w3-card w3-white">
                          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>

                          <?php

                          $sql = "SELECT * FROM qualification WHERE cv_idcv= $idcv";
                          $result = mysqli_query($con, $sql);
                          $num = (mysqli_query($con, $sql));

                          if (mysqli_num_rows($num) > 0) {
                            while ($qrow = mysqli_fetch_array($result)) {
                          ?>

                              <div class="w3-container">
                                <h5 class="w3-opacity"><b><?php echo $qrow['qualificationname'] ?></b> ( <?php echo $qrow['institute'] ?> )</h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $qrow['year'] ?></h6>
                                <p> Grade: <?php echo $qrow['grade'] ?></p>
                                <hr>
                              </div>
                          <?php

                            }
                          } else {
                          }
                          ?>
                        </div>

                        <!-- End Right Column -->
                      </div>

                      <!-- End Grid -->
                    </div>

                    <!-- End Page Container -->
                  </div>


                </body>

                </html>

              <?php
              }


              ?>
            </div>

          </div>
        </div>
      </div>
    </main>
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
              <a href="#" class="nav-link text-muted" target="_blank">Creativ</a>
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
  <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">

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
  
  <script>
  const bodyx = document.getElementById("jobseekerresume");

// Initialize arrays to store tags, scripts, and CSS
let tags = "";

// Traverse through child nodes of the body
bodyx.childNodes.forEach(node => {
    if (node.nodeType === Node.ELEMENT_NODE) {
        // If it's an element node, add to tags array
        tags += node.outerHTML;
    } 
});

    const requestOptions = {
	"method": "POST",
	"url": "https://api.pdfendpoint.com/v1/convert",
	"headers": {
		"Content-Type": "application/json",
		"Authorization": "Bearer pdfe_live_373f373decba61d1c41c131ef6d63870fbf9"
	},
	"data": JSON.stringify({
		"html": tags,
		"sandbox": true,
		"orientation": "vertical",
		"page_size": "A4",
		"margin_top": "0cm",
		"margin_bottom": "1cm",
		"margin_left": "0.5cm",
		"margin_right": "0.5cm"
	})
};

axios.request(requestOptions).then(function (response) {
//   console.log(response.data.data.url);
  
  const url = response.data.data.url;

const link = document.createElement('a');
link.href = url;
link.textContent = 'Download PDF';
link.target = '_blank';
link.className = 'btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0 pdf-download-link';

bodyx.appendChild(link);

}).catch(function (error) {
  console.error(error);
});



</script>
</body>

</html>
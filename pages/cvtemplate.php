<?php
session_start();
include '../conn.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $_SESSION["status"] = "Please login your account here";
  $_SESSION["code"] = "warning";
  header("location: ../cuslogin.php");
  exit;
}
if (!isset($_SESSION["email"]) || $_SESSION["email"] !== true) {
  // echo $_SESSION["email"];
  $email = $_SESSION["email"];
  $sql = "SELECT * FROM cv WHERE email ='" . $email . "' ";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $idcv = $row['idcv'];
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
    Material Dashboard 2 by Creative Tim
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
</head>

<body class="g-sidenav-show  bg-gray-200 virtual-reality">
  <div class="mt-n3">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Virtual Reality</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Virtual Reality</h6>
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
  </div>
  <div class="border-radius-xl mx-2 mx-md-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg'); background-size: cover;">

    <main class="main-content border-radius-lg h-100">

      <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-1">
        <div class="container-fluid">
          <div class="row pt-1">
            <div class="col-lg-12 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 mb-3">
              <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                  <li class="nav-item">
                    <button class="nav-link mb-0 px-0 py-1 active quli" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                      <i class="material-icons text-lg position-relative">topic</i>
                      <span class="ms-1">Template 01</span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 ski" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                      <i class="material-icons text-lg position-relative">apps</i>
                      <span class="ms-1">Template 02</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 expe" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                      <i class="material-icons text-lg position-relative">settings</i>
                      <span class="ms-1">Template 03</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 mb-3">
              <?php
              if (true) {

              ?>
                <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
                <style>
                  
                  .bold {
                    font-weight: 700;
                    font-size: 20px;
                    text-transform: uppercase;
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
                    left: -25px;
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    border: 2px solid #0bb5f4;
                  }

                  .resume .resume_right .resume_work ul li:after,
                  .resume .resume_right .resume_education ul li:after {
                    content: "";
                    position: absolute;
                    top: 14px;
                    left: -21px;
                    width: 2px;
                    height: 115px;
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
                </style>
                <div class="resume">
                  <div class="resume_left">
                    <div class="resume_profile">
                      <img src="https://i.imgur.com/eCijVBe.png" alt="profile_pic">
                    </div>
                    <div class="resume_content">
                      <div class="resume_item resume_info">
                        <div class="title">
                          <p class="bold">stephen colbert</p>
                          <p class="regular">Designer</p>
                        </div>
                        <ul>
                          <li>
                            <div class="icon">
                              <i class="fas fa-map-signs"></i>
                            </div>
                            <div class="data">
                              21 Street, Texas <br /> USA
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="data">
                              +324 4445678
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fas fa-envelope"></i>
                            </div>
                            <div class="data">
                              stephen@gmail.com
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fab fa-weebly"></i>
                            </div>
                            <div class="data">
                              www.stephen.com
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="resume_item resume_skills">
                        <div class="title">
                          <p class="bold">skill's</p>
                        </div>
                        <ul>
                          <li>
                            <div class="skill_name">
                              HTML
                            </div>
                            <div class="skill_progress">
                              <span style="width: 80%;"></span>
                            </div>
                            <div class="skill_per">80%</div>
                          </li>
                          <li>
                            <div class="skill_name">
                              CSS
                            </div>
                            <div class="skill_progress">
                              <span style="width: 70%;"></span>
                            </div>
                            <div class="skill_per">70%</div>
                          </li>
                          <li>
                            <div class="skill_name">
                              SASS
                            </div>
                            <div class="skill_progress">
                              <span style="width: 90%;"></span>
                            </div>
                            <div class="skill_per">90%</div>
                          </li>
                          <li>
                            <div class="skill_name">
                              JS
                            </div>
                            <div class="skill_progress">
                              <span style="width: 60%;"></span>
                            </div>
                            <div class="skill_per">60%</div>
                          </li>
                          <li>
                            <div class="skill_name">
                              JQUERY
                            </div>
                            <div class="skill_progress">
                              <span style="width: 88%;"></span>
                            </div>
                            <div class="skill_per">88%</div>
                          </li>
                        </ul>
                      </div>
                      <div class="resume_item resume_social">
                        <div class="title">
                          <p class="bold">Social</p>
                        </div>
                        <ul>
                          <li>
                            <div class="icon">
                              <i class="fab fa-facebook-square"></i>
                            </div>
                            <div class="data">
                              <p class="semi-bold">Facebook</p>
                              <p>Stephen@facebook</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fab fa-twitter-square"></i>
                            </div>
                            <div class="data">
                              <p class="semi-bold">Twitter</p>
                              <p>Stephen@twitter</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fab fa-youtube"></i>
                            </div>
                            <div class="data">
                              <p class="semi-bold">Youtube</p>
                              <p>Stephen@youtube</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon">
                              <i class="fab fa-linkedin"></i>
                            </div>
                            <div class="data">
                              <p class="semi-bold">Linkedin</p>
                              <p>Stephen@linkedin</p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="resume_right">
                    <div class="resume_item resume_about">
                      <div class="title">
                        <p class="bold">About us</p>
                      </div>
                      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis illo fugit officiis distinctio culpa officia totam atque exercitationem inventore repudiandae?</p>
                    </div>
                    <div class="resume_item resume_work">
                      <div class="title">
                        <p class="bold">Work Experience</p>
                      </div>
                      <ul>
                        <li>
                          <div class="date">2013 - 2015</div>
                          <div class="info">
                            <p class="semi-bold">Lorem ipsum dolor sit amet.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                          </div>
                        </li>
                        <li>
                          <div class="date">2015 - 2017</div>
                          <div class="info">
                            <p class="semi-bold">Lorem ipsum dolor sit amet.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                          </div>
                        </li>
                        <li>
                          <div class="date">2017 - Present</div>
                          <div class="info">
                            <p class="semi-bold">Lorem ipsum dolor sit amet.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="resume_item resume_education">
                      <div class="title">
                        <p class="bold">Education</p>
                      </div>
                      <ul>
                        <li>
                          <div class="date">2010 - 2013</div>
                          <div class="info">
                            <p class="semi-bold">Web Designing (Texas University)</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                          </div>
                        </li>
                        <li>
                          <div class="date">2000 - 2010</div>
                          <div class="info">
                            <p class="semi-bold">Texas International School</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="resume_item resume_hobby">
                      <div class="title">
                        <p class="bold">Hobby</p>
                      </div>
                      <ul>
                        <li><i class="fas fa-book"></i></li>
                        <li><i class="fas fa-gamepad"></i></li>
                        <li><i class="fas fa-music"></i></li>
                        <li><i class="fab fa-pagelines"></i></li>
                      </ul>
                    </div>
                  </div>
                </div>


              <?php

              } else if (false) {
              ?>
                <style>
                  .top {
                    height: 300px;
                    background-color: #24260f;
                  }

                  .top-content {
                    width: 1027px;
                    height: 300px;
                    background-color: #24260f;
                    margin-right: auto;
                    margin-left: auto;
                  }

                  .photo {
                    width: 200px;
                    height: 275px;
                    display: inline-block;
                    margin-top: 20px;
                    margin-left: 300px;
                    background-color: #24260f;
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

                  img {
                    width: 200px;
                    height: 200px;
                    border-radius: 100%;
                  }

                  .info {
                    width: 450px;
                    height: 275px;
                    margin-top: 20px;
                    background-color: #24260f;
                  }

                  .photo,
                  .info {
                    display: inline-block;
                  }

                  .title {
                    width: 350px;
                    height: 80px;
                    margin-left: 50px;
                    padding-top: 15px;
                    text-align: center;
                    font-size: 26px;
                    line-height: 80px;
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
                  }

                  .left,
                  .right {
                    display: inline-block;
                    width: 49%;
                    height: 700px;
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
                    height: 250px;
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
                    height: 170px;
                    border-radius: 10%;
                    background-color: #90a955;
                    margin-left: 24px;
                    margin-top: 5px;
                  }

                  .ex-con-right {
                    display: inline-block;
                    width: 400px;
                    height: 250px;
                  }

                  .ex-con-right h3 {
                    margin: 10px;
                    margin-top: 20px;
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
                    margin: 10px;
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
                    height: 250px;
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
                    height: 170px;
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

                  .ed-con-right h3 {
                    margin: 10px;
                    margin-top: 20px;
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
                </style>
                <div class="top">
                  <div class="top-content">
                    <!-- *照片開始-->
                    <div class="photo"><img src="https://secure.gravatar.com/avatar/a87c99d3d92ff7fd877688ef849201f4?s=128&amp;d=mm&amp;r=g" alt="photo" />
                      <h1>CHEN YI AN</h1>
                    </div>
                    <!-- *照片結束-->
                    <!-- *聯絡資訊開始-->
                    <div class="info">
                      <div class="title">Front-End Developing Learner</div>
                      <div class="contact">
                        <div class="url"><a href="https://www.facebook.com/ianchen0419" target="_blank"><i class="fa fa-facebook-official" style="font-size: 36px; color: #90A955;background-color: #24260f;"></i></a><span>fb.me/ianchen0419</span></div>
                        <div class="url"><i class="fa fa-skype" style="font-size:36px;color:#90A955;background-color: #24260f;"></i><span>ianchen0419</span></div>
                        <div class="url"><i class="fa fa-envelope-o" style="font-size:36px;color:#90A955;background-color: #24260f;"></i><span>ianchen0419@gmail.com</span></div>
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
                        <div class="ex-content">
                          <div class="ex-con-left">
                            <div class="dot"></div>
                            <div class="vertical-line"></div>
                          </div>
                          <div class="ex-con-right">
                            <h3>Japan EC Site Executive</h3>
                            <h5>Uitox Taiwan<span>｜2016.07 ~ 2017.02 </span></h5>
                            <p>Take account of Japan EC Site operating.<br />In terms of Fast Fashion, we export Taiwan online fashion brand to Japan.<br />Duties: Japanese Meeting Interpretion, Japanese Translation, Documents making.</p>
                          </div>
                        </div>
                      </div>
                      <!-- 工作經歷結束-->
                      <!-- 學歷開始-->
                      <div class="education">
                        <div class="con-title ed-title">EDUCATION</div>
                        <div class="ed-content">
                          <div class="ed-con-left">
                            <div class="dot"></div>
                            <div class="vertical-line"></div>
                          </div>
                          <div class="ed-con-right">
                            <h3>Double Major:<br />Japanese & International Business</h3>
                            <h5>Soochow University<span>｜2012.09 ~ 2016.06</span></h5>
                            <p>Study Field:<br />Japanese Languages, Japanese Culture, Japanese Grammer, English, Economics, Statistics, Accounting, Marketing, Management, Trade Practices.</p>
                          </div>
                        </div>
                      </div>
                      <!-- 學歷結束-->
                    </div>
                    <!-- 左邊結束-->
                    <!-- 右邊開始-->
                    <div class="right">
                      <!-- 語言能力開始-->
                      <div class="languagues">
                        <div class="con-title la-title">LANGUAGES</div>
                        <div class="la-content">
                          <div class="chinese">
                            <h3>CHINESE</h3>
                            <h4>native</h4>
                          </div>
                          <div class="outer-jp">
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
                          </div>
                        </div>
                      </div>
                      <!-- 語言能力結束-->
                      <!--技能開始-->
                      <div class="skills">
                        <div class="con-title sk-title">SKILLS</div>
                        <div class="skill-content">
                          <div class="skill-con-left">
                            <div class="skill-bar"><span>HTML</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                              </div>
                            </div>
                            <div class="skill-bar"><span>CSS</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                              </div>
                            </div>
                            <div class="skill-bar"><span>JavaScript</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="no"></div>
                              </div>
                            </div>
                          </div>
                          <div class="skill-con-right">
                            <div class="skill-bar"><span>WordPress</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="no"></div>
                              </div>
                            </div>
                            <div class="skill-bar"><span>Bootstrap</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="no"></div>
                                <div class="no"></div>
                              </div>
                            </div>
                            <div class="skill-bar"><span>PHP</span>
                              <div class="skill-level">
                                <div class="yes"></div>
                                <div class="yes"></div>
                                <div class="no"></div>
                                <div class="no"></div>
                                <div class="no"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 技能結束-->
                      <!-- 作品集開始-->
                      <div class="portfolio">
                        <div class="con-title sk-title">PROTFOLIO</div>
                        <div class="po-content">
                          <div class="po-con-right"><a href="https://codepen.io/ianchen0419/" target="_blank"><i class="fa fa-codepen" style="font-size:100px;"></i></a><span>CODEPEN</span></div>
                          <div class="po-con-middle"><a href="http://ianchen.thisistap.com/" target="_blank"><i class="fa fa-wordpress" style="font-size:100px;"></i></a><span>WEBSITE</span></div>
                          <div class="po-con-left"><a href="https://github.com/ianchen0419" target="_blank"><i class="fa fa-github" style="font-size:100px;"></i><span>GITHUB</span></a></div>
                        </div>
                      </div>
                      <!-- 作品集結束-->
                      <!-- 右邊結束-->
                      <!-- 內容結束-->
                    </div>
                  </div>
                </div>



              <?php
              } else {
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
                            <img src="../uploads/sc1.jpg" style="width:100%" alt="Avatar">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h2>Jane Doe</h2>
                            </div>
                          </div>
                          <div class="w3-container">
                            <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Designer</p>
                            <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>London, UK</p>
                            <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>ex@mail.com</p>
                            <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>1224435534</p>
                            <hr>

                            <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
                            <p>Adobe Photoshop</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                              <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                            </div>
                            <p>Photography</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                              <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
                                <div class="w3-center w3-text-white">80%</div>
                              </div>
                            </div>
                            <p>Illustrator</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                              <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
                            </div>
                            <p>Media</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                              <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                            </div>
                            <br>

                            <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
                            <p>English</p>
                            <div class="w3-light-grey w3-round-xlarge">
                              <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                            </div>
                            <p>Spanish</p>
                            <div class="w3-light-grey w3-round-xlarge">
                              <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
                            </div>
                            <p>German</p>
                            <div class="w3-light-grey w3-round-xlarge">
                              <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                            </div>
                            <br>
                          </div>
                        </div><br>

                        <!-- End Left Column -->
                      </div>

                      <!-- Right Column -->
                      <div class="w3-twothird">

                        <div class="w3-container w3-card w3-white w3-margin-bottom">
                          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>Front End Developer / w3schools.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - <span class="w3-tag w3-teal w3-round">Current</span></h6>
                            <p>Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.</p>
                            <hr>
                          </div>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>Web Developer / something.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mar 2012 - Dec 2014</h6>
                            <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.</p>
                            <hr>
                          </div>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2010 - Mar 2012</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                          </div>
                        </div>

                        <div class="w3-container w3-card w3-white">
                          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                            <p>Web Development! All I need to know in one place</p>
                            <hr>
                          </div>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>London Business School</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                            <p>Master Degree</p>
                            <hr>
                          </div>
                          <div class="w3-container">
                            <h5 class="w3-opacity"><b>School of Coding</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                            <p>Bachelor Degree</p><br>
                          </div>
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
            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">JobSeeker Team</a>
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
</body>

</html>
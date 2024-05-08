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
}
if (isset($_POST['personal'])) {
  // Get other personal details from the form
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $currentosition = $_POST['currentosition'];
  $bio = $_POST['bio'];

  // Handle file upload
  $photoPath = ''; // Initialize variable to store the file path

  // Check if a file was uploaded
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_path = '../uploads/' . $photo_name; // Define the path where the photo will be stored on the server

    // Move the uploaded file to the server
    if (move_uploaded_file($photo_tmp_name, $photo_path)) {
      $photoPath = $photo_path;
    } else {
      // Handle error if file upload fails
      $_SESSION["status"] = "Error uploading photo";
      $_SESSION["code"] = "error";
      header("Location: profile.php");
      exit(); // Exit the script
    }
  }
  //echo $photoPath . ".newpath.";

  // Prepare and execute the SQL statement to update the database
  $stmt = $con->prepare("UPDATE cv SET fname=?, lname=?, dob=?, phone=?, gender=?, image=?, address=?,bio=?,currentosition=? WHERE idcv=?");
  $stmt->bind_param("sssssssssi", $fname, $lname, $dob, $phone, $gender, $photoPath, $address, $bio, $currentosition, $idcv); // Assuming $idcv is the user's ID
  $stmt->execute();
  $stmt->close();

  // Redirect or display a success message
  $_SESSION["status"] = "Personal Details Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php");
  exit();
}
//qulification add and update
if (isset($_POST['qulifi'])) {
  // Assuming you have a database connection named $conn
  $qualificationids = $_POST['qualificationid']; // Corrected variable name
  $qualifications = $_POST['qualification'];
  $institutions = $_POST['institution'];
  $years_obtained = $_POST['year_obtained'];
  $grades = $_POST['grade'];

  // Assuming you have $row['idcv'] to get the CV ID value
  $idcv = $row['idcv'];


  foreach ($qualifications as $key => $qualification) {
    $qualificationid = $qualificationids[$key]; // Corrected variable name
    $qualification = $qualifications[$key];
    $institution = $institutions[$key];
    $year_obtained = $years_obtained[$key];
    $grade = $grades[$key];

    // Check if qualificationid has a value
    if (!empty($qualificationid)) { // Corrected variable name
      // Update the existing qualifications in the database

      $stmt = $con->prepare("UPDATE qualification SET qualificationname=?, institute=?, year=?, grade=?, cv_idcv=? WHERE idqualification=?");
      $stmt->bind_param("ssssii", $qualification, $institution, $year_obtained, $grade, $idcv, $qualificationid);
    } else {
      // Insert new qualifications into the database

      $stmt = $con->prepare("INSERT INTO qualification (qualificationname, institute, year, grade, cv_idcv) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssi", $qualification, $institution, $year_obtained, $grade, $idcv);
    }
    $stmt->execute();
  }


  // Close statement
  $stmt->close();

  // Redirect or display a success message
  $_SESSION["status"] = "Qualifications Added/Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php"); // Redirect to a success page
  exit(); // Exit the script
}
//delete qulification
if (isset($_GET['qualification_id'])) {
  $qualification_id = $_GET['qualification_id'];

  // Prepare the delete query
  $stmt = $con->prepare("DELETE FROM qualification WHERE idqualification = ?");
  $stmt->bind_param("i", $qualification_id);

  // Execute the delete query
  if ($stmt->execute()) {
    // Close statement
    $stmt->close();

    // Redirect or display a success message
    $_SESSION["status"] = "Qualification Deleted Successfully";
    $_SESSION["code"] = "success";
    header("Location: profile.php"); // Redirect to a success page
    exit(); // Exit the script
  } else {
    // Handle error if deletion fails
    $_SESSION["status"] = "Error deleting qualification";
    $_SESSION["code"] = "error";
    header("Location: profile.php"); // Redirect to profile page
    exit(); // Exit the script
  }
}
//skill add and update
if (isset($_POST['skills'])) {
  // Assuming you have a database connection named $conn
  $skillids = $_POST['skillid'];
  $skills = $_POST['skillname'];
  $levels = $_POST['level'];

  // Loop through each skill and execute the SQL statement
  foreach ($skills as $key => $skill) {
    $skillid = $skillids[$key];
    $skillname = $skills[$key];
    $level = $levels[$key];

    // Check if skillid has a value
    if (!empty($skillid)) {
      // Update the existing skill in the database
      $stmt = $con->prepare("UPDATE skill SET skillname=?, level=? WHERE idskill=?");
      $stmt->bind_param("ssi", $skillname, $level, $skillid);
    } else {
      // Insert a new skill into the database
      $stmt = $con->prepare("INSERT INTO skill (skillname, level, cv_idcv) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $skillname, $level, $idcv);
    }

    // Execute the prepared statement
    $stmt->execute();
    // Close statement
    $stmt->close();
  }

  // Redirect or display a success message
  $_SESSION["status"] = "Skills Added/Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php"); // Redirect to a success page
  exit(); // Exit the script
}
//delete qulification
if (isset($_GET['skill_id'])) {
  $id = $_GET['skill_id'];

  // Prepare the delete query
  $stmt = $con->prepare("DELETE FROM skill WHERE idskill = ?");
  $stmt->bind_param("i", $id);

  // Execute the delete query
  if ($stmt->execute()) {
    // Close statement
    $stmt->close();

    // Redirect or display a success message
    $_SESSION["status"] = "Skill Deleted Successfully";
    $_SESSION["code"] = "success";
    header("Location: profile.php"); // Redirect to a success page
    exit(); // Exit the script
  } else {
    // Handle error if deletion fails
    $_SESSION["status"] = "Error deleting Skill";
    $_SESSION["code"] = "error";
    header("Location: profile.php"); // Redirect to profile page
    exit(); // Exit the script
  }
}
// experience add and update
if (isset($_POST['exp'])) {
  // Assuming you have a database connection named $conn
  $experienceids = $_POST['experienceid'];
  $companys = $_POST['company'];
  $sdates = $_POST['sdate'];
  $edates = $_POST['edate'];
  $res = $_POST['res'];

  // Loop through each experience and execute the SQL statement
  foreach ($companys as $key => $company) {
    $experienceid = $experienceids[$key];
    $company = $companys[$key];
    $startdate = $sdates[$key];
    $enddate = $edates[$key];
    $responsibilities = $res[$key];

    // Check if experienceid has a value
    if (!empty($experienceid)) {
      // Update the existing experience record in the database
      $stmt = $con->prepare("UPDATE experience SET comapny=?, startdate=?, enddate=?, responsibilities=? WHERE idexperience=?");
      $stmt->bind_param("ssssi", $company, $startdate, $enddate, $responsibilities, $experienceid);
    } else {
      // Insert a new experience record into the database
      $stmt = $con->prepare("INSERT INTO experience (comapny, startdate, enddate, responsibilities, cv_idcv) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssi", $company, $startdate, $enddate, $responsibilities, $idcv);
    }

    // Execute the prepared statement
    $stmt->execute();
    // Close statement
    $stmt->close();
  }

  // Redirect or display a success message
  $_SESSION["status"] = "Experience Records Added/Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php"); // Redirect to a success page
  exit(); // Exit the script
}
// Delete experience record
if (isset($_GET['exp_id'])) {
  $id = $_GET['exp_id'];

  // Assuming you have a database connection named $conn
  // Prepare the delete query
  $stmt = $con->prepare("DELETE FROM experience WHERE idexperience = ?");
  $stmt->bind_param("i", $id);

  // Execute the delete query
  if ($stmt->execute()) {
    // Close statement
    $stmt->close();

    // Redirect to profile page with a success message
    $_SESSION["status"] = "Experience Record Deleted Successfully";
    $_SESSION["code"] = "success";
    header("Location: profile.php");
    exit(); // Exit the script
  } else {
    // Handle error if deletion fails
    $_SESSION["status"] = "Error deleting Experience Record";
    $_SESSION["code"] = "error";
    header("Location: profile.php"); // Redirect to profile page
    exit(); // Exit the script
  }
}

// certificate add and update
if (isset($_POST['Cerificate'])) {
  // Assuming you have a database connection named $conn
  $idCertificate = $_POST['idCertificate'];
  $Cerificatename = $_POST['Cerificatename'];
  $issueddate = $_POST['issueddate'];

  // Loop through each certificate and execute the SQL statement
  foreach ($Cerificatename as $key => $certificate) {
    $certificateId = $idCertificate[$key];
    $certificateName = $Cerificatename[$key];
    $issuedDate = $issueddate[$key];

    // Check if certificateId has a value
    if (!empty($certificateId)) {
      // Update the existing certificate record in the database
      $stmt = $con->prepare("UPDATE certificate SET certificatename=?, issueddate=? WHERE idCertificate=?");
      $stmt->bind_param("ssi", $certificateName, $issuedDate, $certificateId);
    } else {
      // Insert a new certificate record into the database
      $stmt = $con->prepare("INSERT INTO certificate (certificatename, issueddate, cv_idcv) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $certificateName, $issuedDate, $idcv);
    }

    // Execute the prepared statement
    $stmt->execute();
    // Close statement
    $stmt->close();
  }

  // Redirect or display a success message
  $_SESSION["status"] = "Certificate Records Added/Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php"); // Redirect to a success page
  exit(); // Exit the script
}
// Delete experience record
if (isset($_GET['cert_id'])) {
  $id = $_GET['cert_id'];

  // Assuming you have a database connection named $conn
  // Prepare the delete query
  $stmt = $con->prepare("DELETE FROM certificate WHERE idCertificate = ?");
  $stmt->bind_param("i", $id);

  // Execute the delete query
  if ($stmt->execute()) {
    // Close statement
    $stmt->close();

    // Redirect to profile page with a success message
    $_SESSION["status"] = "Cerificate Record Deleted Successfully";
    $_SESSION["code"] = "success";
    header("Location: profile.php");
    exit(); // Exit the script
  } else {
    // Handle error if deletion fails
    $_SESSION["status"] = "Error Deleting Cerificate Record";
    $_SESSION["code"] = "error";
    header("Location: profile.php"); // Redirect to profile page
    exit(); // Exit the script
  }
}

// Language add and update
if (isset($_POST['language'])) {
  // Assuming you have a database connection named $conn
  $idLanguages = $_POST['idlanguage'];
  $languages = $_POST['languagename'];
  $levels = $_POST['level'];

  // Loop through each language and execute the SQL statement
  foreach ($languages as $key => $language) {
    $languageId = $idLanguages[$key];
    $languageName = $languages[$key];
    $level = $levels[$key];

    // Check if languageId has a value
    if (!empty($languageId)) {
      // Update the existing language record in the database
      $stmt = $con->prepare("UPDATE language SET language=?, level=? WHERE idlanguage=?");
      $stmt->bind_param("ssi", $languageName, $level, $languageId);
    } else {
      // Insert a new language record into the database
      $stmt = $con->prepare("INSERT INTO language (language, level, cv_idcv) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $languageName, $level, $idcv);
    }

    // Execute the prepared statement
    $stmt->execute();
    // Close statement
    $stmt->close();
  }

  // Redirect or display a success message
  $_SESSION["status"] = "Language Records Added/Updated Successfully";
  $_SESSION["code"] = "success";
  header("Location: profile.php"); // Redirect to a success page
  exit(); // Exit the script
}
// Delete experience record
if (isset($_GET['lng_id'])) {
  $id = $_GET['lng_id'];

  // Assuming you have a database connection named $conn
  // Prepare the delete query
  $stmt = $con->prepare("DELETE FROM language WHERE idlanguage = ?");
  $stmt->bind_param("i", $id);

  // Execute the delete query
  if ($stmt->execute()) {
    // Close statement
    $stmt->close();

    // Redirect to profile page with a success message
    $_SESSION["status"] = "Cerificate Record Deleted Successfully";
    $_SESSION["code"] = "success";
    header("Location: profile.php");
    exit(); // Exit the script
  } else {
    // Handle error if deletion fails
    $_SESSION["status"] = "Error Deleting Cerificate Record";
    $_SESSION["code"] = "error";
    header("Location: profile.php"); // Redirect to profile page
    exit(); // Exit the script
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
  <style>
    div#langContainer,
    div#qualificationsContainer,
    div#skillsContainer,
    div#expContainer,
    div#CerificateContainer {
      display: grid;
      flex-direction: row;
      grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .lwrap,
    .qwrap,
    .swrap,
    .ewrap,
    .cwrap {
      margin-left: 20px;
    }

    textarea#w3review {
      width: 100% !important;
      background: none;
      border: 1px solid #d2d6da;
      border-radius: 0.375rem;
      border-top-left-radius: 0.375rem !important;
      border-bottom-left-radius: 0.375rem !important;
      padding: 0.625rem 0.75rem !important;
      line-height: 1.3 !important;
      border-color: #4d90fe !important;
      border-top-color: transparent !important;
      box-shadow: inset 1px 0 #4d90fe, inset -1px 0 #4d90fe, inset 0 -1px #4d90fe;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">
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
        <!--   <li class="nav-item">
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
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/profile.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Profile</h6>
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
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php echo $row['image']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $row['fname'] . " " . $row['lname'];  ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?php echo $row['currentosition'];  ?>
              </p>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active quli" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <i class="material-icons text-lg position-relative">topic</i>
                    <span class="ms-1">Qualification</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 ski" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">apps</i>
                    <span class="ms-1">Skills</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 expe" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">settings</i>
                    <span class="ms-1">Experience</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 cert" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">subtitles</i>
                    <span class="ms-1">Certificates</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 lang" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">translate</i>
                    <span class="ms-1">languages</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="row">

            <div class="col-12 col-xl-6">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="javascript:;">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    <?php echo $row['bio'];  ?></p>
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $row['fname'] . " " . $row['lname'];  ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $row['phone']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $row['email']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; <?php echo $row['address']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Birthday:</strong> &nbsp; <?php echo $row['dob']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; <?php echo $row['gender']; ?></li>

                  </ul>
                </div>
              </div>
            </div>


            <div class="col-12 col-xl-6">
              <div class="card card-plain h-100 pers">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Personal details</h6>
                </div>
                <div class="card-body p-3">
                  <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="personals">
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">First name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $row['fname'];  ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">last name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $row['lname'];  ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Current position</label>
                        <input type="text" name="currentosition" class="form-control" value="<?php echo $row['currentosition'];  ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Birthday</label>
                        <input type="text" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Gender</label>
                        <input type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">photo</label>
                        <input type="file" name="photo" class="form-control">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Bio</label>
                        <textarea id="w3review" name="bio" rows="4" width='100%'>
                        <?php echo $row['bio']; ?>
                        </textarea>
                      </div>

                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="personal">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-12 mt-4 Qulificationmain">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Qualification</h6>
                <p class="text-sm"></p>
              </div>
              <div class="row">
                <form role="form" method="POST">
                  <div id="qualificationsContainer">
                    <?php

                    $sql = "SELECT * FROM qualification WHERE cv_idcv= $idcv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($qrow = mysqli_fetch_array($result)) {
                    ?>
                        <div class="qwrap">
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Qualification</label>
                            <input type="text" name="qualificationid[]" hidden class="form-control" value="<?php echo $qrow['idqualification'] ?>">
                            <input type="text" name="qualification[]" class="form-control" value="<?php echo $qrow['qualificationname'] ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Institution</label>
                            <input type="text" name="institution[]" class="form-control" value="<?php echo $qrow['institute'] ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Year Obtained</label>
                            <input type="text" name="year_obtained[]" class="form-control" value="<?php echo $qrow['year'] ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Grade</label>
                            <input type="text" name="grade[]" class="form-control" value="<?php echo $qrow['grade'] ?>">
                          </div>
                          <button type="submit" class="btn btn-lg bg-gradient-danger btn-lg mt-4 mb-0 dellQualification" data='<?php echo $qrow['idqualification'] ?>' id="dellQualification" name="qdeletebtn"> <i class="material-icons text-lg position-relative">delete</i></button>
                          <br>

                        </div>
                      <?php

                      }
                    } else {
                      ?>
                      <div class="qwrap">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Qualification</label>
                          <input type="text" name="qualificationid[]" hidden class="form-control">
                          <input type="text" name="qualification[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Institution</label>
                          <input type="text" name="institution[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Year Obtained</label>
                          <input type="text" name="year_obtained[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Grade</label>
                          <input type="text" name="grade[]" class="form-control">
                        </div>
                        <br>

                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button type="button" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0" id="addQualification">+</button>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="qulifi">Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12 mt-4 Skillsmain">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Skills</h6>
                <p class="text-sm"></p>
              </div>
              <div class="row">
                <form role="form" method="POST">
                  <div id="skillsContainer">
                    <?php

                    $sql = "SELECT * FROM skill WHERE cv_idcv= $idcv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($srow = mysqli_fetch_array($result)) {
                    ?>
                        <div class="swrap">
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Skill</label>
                            <input type="text" name="skillid[]" hidden class="form-control" value="<?php echo $srow['idskill']; ?>">
                            <input type="text" name="skillname[]" class="form-control" value="<?php echo $srow['skillname']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Level</label>
                            <input type="number" min='1' max='10' name="level[]" class="form-control" value="<?php echo $srow['level']; ?>">
                          </div>
                          <button type="submit" class="btn btn-lg bg-gradient-danger btn-lg mt-4 mb-0 dellskill" data='<?php echo $srow['idskill'] ?>' id="dellskill" name="qdeletebtn"> <i class="material-icons text-lg position-relative">delete</i></button>
                          </br>
                        </div>
                      <?php

                      }
                    } else {
                      ?>
                      <div class="swrap">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Skill</label>
                          <input type="text" name="skillid[]" hidden class="form-control">
                          <input type="text" name="skillname[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Level</label>
                          <input type="number" min='1' max='10' name="level[]" class="form-control">
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button type="button" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0" id="addskill">+</button>

                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="skills">Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12 mt-4 Experiencemain">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Experience</h6>
                <p class="text-sm"></p>
              </div>
              <div class="row">
                <form role="form" method="POST">
                  <div id="expContainer">
                    <?php

                    $sql = "SELECT * FROM experience WHERE cv_idcv= $idcv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($erow = mysqli_fetch_array($result)) {
                    ?>
                        <div class="ewrap">
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" name="experienceid[]" hidden class="form-control" value="<?php echo $erow['idexperience']; ?>">
                            <input type="text" name="company[]" class="form-control" value="<?php echo $erow['comapny']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Start date</label>
                            <input type="date" name="sdate[]" class="form-control" value="<?php echo $erow['startdate']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="edate[]" class="form-control" value="<?php echo $erow['enddate']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" name="res[]" class="form-control" value="<?php echo $erow['responsibilities']; ?>">
                          </div>
                          <button type="submit" class="btn btn-lg bg-gradient-danger btn-lg mt-4 mb-0 dellexperiencel" data='<?php echo $erow['idexperience'] ?>' id="dellexperiencel" name="edeletebtn"> <i class="material-icons text-lg position-relative">delete</i></button>
                          </br>
                        </div>
                      <?php

                      }
                    } else {
                      ?>
                      <div class="ewrap">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Company</label>
                          <input type="text" name="experienceid[]" hidden class="form-control">
                          <input type="text" name="company[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Start date</label>
                          <input type="date" name="sdate[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">End Date</label>
                          <input type="date" name="edate[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Resposibilities</label>
                          <input type="text" name="res[]" class="form-control">
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button type="button" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0" id="addexp">+</button>

                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="exp">Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12 mt-4 Certificate">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Certificate</h6>
                <p class="text-sm"></p>
              </div>
              <div class="row">
                <form role="form" method="POST">
                  <div id="CerificateContainer">
                    <?php

                    $sql = "SELECT * FROM certificate WHERE cv_idcv= $idcv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($crow = mysqli_fetch_array($result)) {
                    ?>
                        <div class="cwrap">
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Cerificate Name</label>
                            <input type="text" name="idCertificate[]" hidden class="form-control" value="<?php echo $crow['idCertificate']; ?>">
                            <input type="text" name="Cerificatename[]" class="form-control" value="<?php echo $crow['certificatename']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Issed Date</label>
                            <input type="text" name="issueddate[]" class="form-control" value="<?php echo $crow['issueddate']; ?>">
                          </div>
                          <button type="submit" class="btn btn-lg bg-gradient-danger btn-lg mt-4 mb-0 dellCerificate" data='<?php echo $crow['idCertificate'] ?>' id="dellCerificate" name="qdeletebtn"> <i class="material-icons text-lg position-relative">delete</i></button>
                          </br>
                        </div>
                      <?php

                      }
                    } else {
                      ?>
                      <div class="cwrap">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Cerificate Name</label>
                          <input type="text" name="idCertificate[]" hidden class="form-control">
                          <input type="text" name="Cerificatename[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">issueddate</label>
                          <input type="text" name="issueddate[]" class="form-control">
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button type="button" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0" id="addCerificate">+</button>

                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="Cerificate">Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12 mt-4 language">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Language</h6>
                <p class="text-sm"></p>
              </div>
              <div class="row">
                <form role="form" method="POST">
                  <div id="langContainer">
                    <?php

                    $sql = "SELECT * FROM language WHERE cv_idcv= $idcv";
                    $result = mysqli_query($con, $sql);
                    $num = (mysqli_query($con, $sql));

                    if (mysqli_num_rows($num) > 0) {
                      while ($lrow = mysqli_fetch_array($result)) {
                    ?>
                        <div class="lwrap">
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Language</label>
                            <input type="text" name="idlanguage[]" hidden class="form-control" value="<?php echo $lrow['idlanguage']; ?>">
                            <input type="text" name="languagename[]" class="form-control" value="<?php echo $lrow['language']; ?>">
                          </div>
                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Level</label>
                            <input type="number" min='1' max='5' name="level[]" class="form-control" value="<?php echo $lrow['level']; ?>">
                          </div>
                          <button type="submit" class="btn btn-lg bg-gradient-danger btn-lg mt-4 mb-0 delllanguage" data='<?php echo $lrow['idlanguage'] ?>' id="delllanguage" name="qdeletebtn"> <i class="material-icons text-lg position-relative">delete</i></button>
                          </br>
                        </div>
                      <?php

                      }
                    } else {
                      ?>
                      <div class="lwrap">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Language</label>
                          <input type="text" name="idlanguage[]" hidden class="form-control">
                          <input type="text" name="languagename[]" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Level</label>
                          <input type="number" min='1' max='5' name="level[]" class="form-control">
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button type="button" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0" id="addlanguage">+</button>

                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="language">Save</button>
                  </div>
                </form>
              </div>
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
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
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
  <script>
    jQuery(document).ready(function($) {
      $(".pers").hide();

      /* qulification validation*/
      $("#addQualification").click(function() {
        var newQualification = $("#qualificationsContainer .qwrap:first").clone();
        newQualification.find('input').val(''); // Clear input values in the cloned fields
        newQualification.find('input').removeAttr("value");
        $("#qualificationsContainer").append(newQualification);
      });
      /* qulification validation*/
      $("#addskill").click(function() {
        var newQualification = $("#skillsContainer .swrap:first").clone();
        newQualification.find('input').val(''); // Clear input values in the cloned fields
        newQualification.find('input').removeAttr("value");
        $("#skillsContainer").append(newQualification);
      });
      /* qulification validation*/
      $("#addexp").click(function() {
        var newQualification = $("#expContainer .ewrap:first").clone();
        newQualification.find('input').val(''); // Clear input values in the cloned fields
        newQualification.find('input').removeAttr("value");
        $("#expContainer").append(newQualification);
      });
      /* qulification validation*/
      $("#addCerificate").click(function() {
        var newQualification = $("#CerificateContainer .cwrap:first").clone();
        newQualification.find('input').val(''); // Clear input values in the cloned fields
        newQualification.find('input').removeAttr("value");
        $("#CerificateContainer").append(newQualification);
      });
      /* qulification validation*/
      $("#addlanguage").click(function() {
        var newQualification = $("#langContainer .lwrap:first").clone();
        newQualification.find('input').val(''); // Clear input values in the cloned fields
        newQualification.find('input').removeAttr("value");
        $("#langContainer").append(newQualification);
      });





      $("#qualificationsContainer").on('focus', 'input', function() {
        $(this).parent('.input-group').addClass('focused is-focused');
      });
      $("#skillsContainer").on('focus', 'input', function() {
        $(this).parent('.input-group').addClass('focused is-focused');
      });
      $("#expContainer").on('focus', 'input', function() {
        $(this).parent('.input-group').addClass('focused is-focused');
      });
      $("#CerificateContainer").on('focus', 'input', function() {
        $(this).parent('.input-group').addClass('focused is-focused');
      });
      $("#langContainer").on('focus', 'input', function() {
        $(this).parent('.input-group').addClass('focused is-focused');
      });


      $("#qualificationsContainer input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });
      $("#skillsContainer input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });
      $("#expContainer input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });
      $("#CerificateContainer input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });
      $("#langContainer input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });
      $(".personals input").each(function() {
        if ($(this).val() !== "") {
          $(this).parent('.input-group').addClass('focused is-focused');
        }
      });


      $(".fas.fa-user-edit.text-secondary.text-sm").click(function() {
        $(".pers").toggle();
      });


      $('.dellQualification').on('click', function(e) {
        e.preventDefault();
        var qualificationId = $(this).attr('data');
        Swal.fire({
          title: 'Confirm to delete account?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];

            // Check if the current URL already has parameters
            var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

            // Append the qualificationId as a parameter to the current URL
            var newUrl = baseUrl + separator + 'qualification_id=' + qualificationId;

            // Redirect to the new URL
            window.location.href = newUrl;

          }
        });
      });
      $('.dellskill').on('click', function(e) {
        e.preventDefault();
        var Id = $(this).attr('data');
        Swal.fire({
          title: 'Confirm to delete account?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];

            // Check if the current URL already has parameters
            var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

            // Append the qualificationId as a parameter to the current URL
            var newUrl = baseUrl + separator + 'skill_id=' + Id;

            // Redirect to the new URL
            window.location.href = newUrl;

          }
        });
      });
      $('.dellexperiencel').on('click', function(e) {
        e.preventDefault();
        var Id = $(this).attr('data');
        Swal.fire({
          title: 'Confirm to delete account?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];

            // Check if the current URL already has parameters
            var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

            // Append the qualificationId as a parameter to the current URL
            var newUrl = baseUrl + separator + 'exp_id=' + Id;

            // Redirect to the new URL
            window.location.href = newUrl;

          }
        });
      });
      $('.dellCerificate').on('click', function(e) {
        e.preventDefault();
        var Id = $(this).attr('data');
        Swal.fire({
          title: 'Confirm to delete account?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];

            // Check if the current URL already has parameters
            var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

            // Append the qualificationId as a parameter to the current URL
            var newUrl = baseUrl + separator + 'cert_id=' + Id;

            // Redirect to the new URL
            window.location.href = newUrl;

          }
        });
      });
      $('.delllanguage').on('click', function(e) {
        e.preventDefault();
        var Id = $(this).attr('data');
        Swal.fire({
          title: 'Confirm to delete account?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];

            // Check if the current URL already has parameters
            var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

            // Append the qualificationId as a parameter to the current URL
            var newUrl = baseUrl + separator + 'lng_id=' + Id;

            // Redirect to the new URL
            window.location.href = newUrl;

          }
        });
      });




      // Show the default section (.Qulificationmain)
      $(".Qulificationmain").show();
      $(".Skillsmain").hide();
      $(".Experiencemain").hide();
      $(".Certificate").hide();
      $(".language").hide();

      // Handle click event for Qulification link
      $(".quli").click(function() {
        $(".Qulificationmain").show();
        $(".Skillsmain").hide();
        $(".Experiencemain").hide();
        $(".Certificate").hide();
        $(".language").hide();
      });

      // Handle click event for Skills link
      $(".ski").click(function() {
        $(".Qulificationmain").hide();
        $(".Skillsmain").show();
        $(".Experiencemain").hide();
        $(".Certificate").hide();
        $(".language").hide();
      });

      // Handle click event for Experience link
      $(".expe").click(function() {
        $(".Qulificationmain").hide();
        $(".Skillsmain").hide();
        $(".Experiencemain").show();
        $(".Certificate").hide();
        $(".language").hide();
      });

      // Handle click event for Experience link
      $(".cert").click(function() {
        $(".Qulificationmain").hide();
        $(".Skillsmain").hide();
        $(".Certificate").show();
        $(".language").hide();
        $(".Experiencemain").hide();
      });

      // Handle click event for Experience link
      $(".lang").click(function() {
        $(".Qulificationmain").hide();
        $(".Skillsmain").hide();
        $(".language").show();
        $(".Certificate").hide();
        $(".Experiencemain").hide();
      });
    });
  </script>
  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
  ?>
    <script type="text/javascript">
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
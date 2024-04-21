<?php
session_start();
include 'conn.php';
if (isset($_POST['log'])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    if (empty($email)) {
        header("Location: login.php?error=");
        exit();
    } else {
        $sql = "SELECT username,password FROM user WHERE username='$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $x = (mysqli_query($con, $sql));
        if (mysqli_num_rows($x) > 0) {
            if ($row["username"] == $email && $row["password"] == $pass) {

                $_SESSION["loggedin"] = true;
                $idd = $row['iduser'];
                $_SESSION["pass"] = $row['password'];
                $_SESSION["id"] = $row['iduser'];
                $_SESSION["email"] = $email;
                $_SESSION["status"] = "Welcome " . $row['username'];
                $_SESSION["code"] = "success";
                $_SESSION['type'] = "admin";
                header("location: pages/dashboard.php");
                exit();
            } else {
                $_SESSION["status"] = "Invalid username or password";
                $_SESSION["code"] = "error";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION["status"] = "Invalid username or password";
            $_SESSION["code"] = "error";
            header("Location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>JOB SEEKER | LOGIN</title>
    <link rel="icon" href="images/abc.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/native-toast.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <meta charset="utf-8">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&display=swap');

        body {
            background: url('images/login_background.jpg');
            margin: 15px;
            margin-top: 180px;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #464646;
        }

        .login-form,
        .login-form * {
            box-sizing: border-box;
            font-family: 'Source Sans Pro';
        }

        .login-form {
            max-width: 350px;
            margin: 0 auto;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        }

        .login-form__logo-container {
            padding: 30px;
            background: #1b2f45;
        }

        .login-form__logo {
            display: block;
            max-width: 125px;
            margin: 0 auto;
        }

        .login-form__content {
            padding: 30px;
            background: #eeeeee;
        }

        .login-form__header {
            margin-bottom: 15px;
            text-align: center;
            color: #333333;
        }

        .login-form__input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 2px solid #dddddd;
            background: #ffffff;
            outline: none;
            transition: border-color 0.5s;
        }

        .login-form__input:focus {
            border-color: #333;
        }

        .login-form__input::placeholder {
            color: #aaaaaa;
        }

        .login-form__button {
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            background: #333;
            width: 100%;
            border: none;
            outline: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form__button:active {
            background: #008067;
        }

        .login-form__links {
            margin-top: 15px;
            text-align: center;
        }

        .login-form__link {
            font-size: 0.9em;
            color: #008067;
            text-decoration: none;
        }

        img.logo {
            max-width: 291px !important;
            margin: 0 auto !important;
            display: block;
        }
    </style>
</head>

<body>
    <form class="login-form" method="POST">
        <div class="login-form__logo-container">

            <img class="logo" src="images/abc banking loog png.png" width="auto">
        </div>
        <div class="login-form__content">
            <div class="login-form__header">Welcome</div>
            <input class="login-form__input" type="email" name="email" placeholder="Username" required autofocus>
            <input class="login-form__input" type="password" name="pass" placeholder="Password" required>
            <button class="login-form__button" type="submit" name="log">Login</button>

        </div>
    </form>
    <script src="js/native-toast.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
" rel="stylesheet">

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
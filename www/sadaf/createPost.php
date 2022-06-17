<?php
session_start();
?>

<!doctype html>
<head>
    <title>Create Post</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="loginStyle/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginStyle/css/style.css">
    <!--===============================================================================================-->
</head>
<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

$username = $_SESSION["UserID"];

?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(loginStyle/images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            create post
                        </span>
                </div>

                <form class="login100-form validate-form" action="uploadPost.php" method="post" enctype="multipart/form-data">
                    <div class="wrap-input100 validate-input m-b-26">
                        <p> Select Image File to Upload: </p>
                        <input type="file" name="image" id="image" placeholder="Image">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18">
                        <span class="label-input100">Caption</span>
                        <input class="input100" type="text" name="caption" id="caption" placeholder="Enter caption">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="container-login100-form-btn">
                            <button  type="submit" name="submit" value="upload" class="login100-form-btn">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="loginStyle/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/vendor/bootstrap/js/popper.js"></script>
    <script src="loginStyle/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/vendor/daterangepicker/moment.min.js"></script>
    <script src="loginStyle/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="loginStyle/js/main.js"></script>

</body>
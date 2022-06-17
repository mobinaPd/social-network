<?php
session_start();
?>

<!doctype html>
<head>
<title>Soso</title>
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
<!-- Programmer: Omid MilaniFard -->
<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";


$_SESSION["UserID"] = null;

$message = "";
if(isset($_REQUEST["UserID"]))
{
    // در این نسخه از چارچوب نرم افزاری کلمه عبور به صورت متن خام ذخیره شده است
    // برای نسخه های عملیاتی حتما از رمزنگاری مناسب استفاده شود - مثال: md5
    // می توان از ldap هم استفاده کرد
    $mysql = pdodb::getInstance();
    $mysql->Prepare("select * from sadaf.user where username=? and pass=?");

    $res = $mysql->ExecuteStatement(array($_REQUEST["UserID"], ($_REQUEST["UserPassword"])));
    if($trec = $res->fetch())
    {
        session_start();
        $_SESSION["UserID"] = $trec["userId"];
        $_SESSION["SystemCode"] = 0;
        $_SESSION['UserName'] = $trec['username'];
        $_SESSION["LIPAddress"] = ip2long(SharedClass::getRealIpAddr());
        if($_SESSION["LIPAddress"]=="") {
            $_SESSION["LIPAddress"] = 0;
        }
        header("Location: main.php");
        die();
    }
    else
        $message = "Username or password is incorrect.";
}
?>
<body>

    <div class="container-fluid">
        <? if($message!="") { ?>
        <div class="row">
            <div class="col-1" ></div>
            <div class="col-10" >
                <div class="alert alert-danger well" role="alert"><?php echo $message; ?></div>
            </div>
            <div class="col-1" ></div>
        </div>
    </div>
    <? } ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(loginStyle/images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            Log In
                        </span>
                </div>

                <form class="login100-form validate-form" method="post">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="UserID" id="UserID" placeholder="Enter username" value=<?php echo $_SESSION["UserID"];
                        $_SESSION["UserID"] = null; ?>>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="UserPassword" id="UserPassword" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">

                        <?php
                        if(isset($_GET["newpwd"])){
                            if($_GET["newpwd"] == "passwordupdated"){
                                echo "<p class=''>Your password has been reset!</p>";
                            }
                        }
                        ?>

                        <!-- redirect to password reset page -->
                        <div>
                            <a href="forgottenpwd/reset-password.php" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <div class="flex-sb-m w-full p-b-30">
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                        <div class="container-login100-form-btn">
                            <a class="login100-form-btn" href="signup.php">
                                <p class="text-white">Signup</p>
                            </a>
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
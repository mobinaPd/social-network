<?php
session_start();
?>

<!doctype html>
<head>
    <title>ChangePassword</title>
    <link rel="stylesheet" href="style.css">

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


$message = "";
$validation = true;

if(isset($_REQUEST["next"]))
{
    $mysql = pdodb::getInstance();
    $mysql->Prepare("select * from sadaf.user where userId=? and pass=?");

    $res = $mysql->ExecuteStatement(array($_SESSION["UserID"], ($_REQUEST["UserPassword"])));
    if($trec = $res->fetch())
    {
        $_SESSION["UserName"] = $trec["username"];
        $_SESSION["SystemCode"] = 0;
        $_SESSION["LIPAddress"] = ip2long(SharedClass::getRealIpAddr());
        if($_SESSION["LIPAddress"]=="") {
            $_SESSION["LIPAddress"] = 0;
        }
        header("Location: ChangePassword.php?verified");
        die();
    }
    else
        $message = "Username or password is incorrect.";
}

if(isset($_REQUEST["change"]))
{
    $password = $_REQUEST["NewPassword"];
    $password_repeat = $_REQUEST["RepeatPassword"];

    // check format of password
    if (!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)){
        $message = "Password must have 8 characters at least that include uppercase, lowercase & numbers.";
        $validation = false;
    }

    // check password & re-password are same
    elseif ($password != $password_repeat){
        $message = "Password & repeat password aren't same.";
        $validation = false;
    }

    if($validation){
        $password_hashed = md5($password);

        $mysql = pdodb::getInstance();
        $mysql->Prepare("UPDATE sadaf.user SET pass = ? where userId = ?");
        $res = $mysql->ExecuteStatement(array($password, $_SESSION['UserID']));
        header("Location: main.php");
    }
}
?>


<body>
<?php include("header-top.php")?>

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
                            Change Password
                        </span>
            </div>

            <form class="login100-form validate-form" method="post">

                <?php
                $buttonName = "next";
                $button = "Next";
                if(isset($_GET["verified"])){
                    $buttonName = "change";
                    $button = "Apply";
                    ?>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">New Password</span>
                        <input class="input100" type="password" name="NewPassword" id="NewPassword" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Re-Password</span>
                        <input class="input100" type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Enter re-password">
                        <span class="focus-input100"></span>
                    </div>
                <?php } else{ ?>
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
                <?php } ?>

                <div class="flex-sb-m w-full p-b-30">
                    <div class="container-login100-form-btn">
                        <button name="<?php echo $buttonName?>" type="submit" class="login100-form-btn">
                            <?php echo $button?>
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
<?php
session_start();
?>

<!doctype html>
<head>
<title>Sign Up SoSo</title>
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


$mysql = pdodb::getInstance();
$query = "select Status from sadaf.ManageStatus where FacilityStatusID = 1;";
$res = $mysql->Execute($query);
if($rec=$res->Fetch())
{
    if($rec['Status'] == 0){
        include "forbidden_sign_up.html";
        die();
    }
}

$message_array = [];
$username = "";
$password = "";
$password_repeat = "";
$email = "";
$fname = "";
$validation = true;
$OTP = null;


if(isset($_REQUEST["submit"]))
{
    $username = $_REQUEST["UserName"];
    $password = $_REQUEST["UserPassword"];
    $password_repeat = $_REQUEST["UserPasswordRepeat"];
    $email = $_REQUEST["UserEmail"];
    $fname = $_REQUEST["fname"];


    // check format of email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_array[0] = "The email format is not valid.";
        $validation = false;
    }

    // check format of username
    if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $username)){
        $message_array[1] = "Username must have 4 characters at least.";
        $validation = false;
    }

    // check format of password
    if (!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)){
        $message_array[2] = "Password must have 8 characters at least that include uppercase, lowercase & numbers.";
        $validation = false;
    }

    // check password & re-password are same
    if ($password != $password_repeat){
        $message_array[3] = "Password & repeat password aren't same.";
        $validation = false;
    }


    // check the username or email doesn't exist in database
    $mysql->Prepare("Select username, email from sadaf.user where username = ? OR email = ?");
    $res = $mysql->ExecuteStatement(array($username,$email));

    if($trec = $res->fetch())
    {
        if($trec['email'] == $email){
            $message_array[4] = "This email address is already registered.";
            $validation = false;

        }
        if($trec['username'] == $username){
            $message_array[5] = "This username is already registered.";
            $validation = false;
        }
    }

    // insert the info to db
    if($validation){

        $mysql = pdodb::getInstance();

        $mysql->Prepare("Insert into sadaf.profile
						    (username, name, bio) values (?, ?, ?)");
        $res = $mysql->ExecuteStatement(array($username, $fname, "hello i'm ".$fname));

        $mysql->Prepare("Select userid from sadaf.profile
						    where name=? and username=?");
        $res = $mysql->ExecuteStatement(array($fname, $username));



        if($trec = $res->fetch())
        {
            $password_hashed = md5($password);
            
            $mysql->Prepare("Insert into sadaf.user (username, pass, email) values (?, ?, ?)");
            $res = $mysql->ExecuteStatement(array($username, $password, $email));
        }

        $_SESSION["UserName"] = $username;
        $_SESSION["UserEmail"] = $email;
        header("Location: login.php");
        die();
    }
}

function erase_val(&$myarr) {
    $myarr = array_map(create_function('$n', 'return null;'), $myarr);
}


?>

<body>

<div class="container-fluid">
    <? if($message_array) {
    foreach($message_array as $msg){
    ?>
    <div class="row">
        <div class="col-1" ></div>
        <div class="col-10" >
            <div class="alert alert-danger well" role="alert"><?php echo $msg; ?></div>
        </div>
        <div class="col-1" ></div>
    </div>
</div>
<? }} ?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 shadow-bottom">
            <div class="login100-form-title" style="background-image: url(loginStyle/images/bg-01.jpg);">
                <span class="login100-form-title-1">
                    Sign Up
                </span>
            </div>

            <form class="login100-form validate-form" method="post">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
                    <span class="label-input100">Name</span>
                    <input class="input100" type="text" name="fname" id="fname" placeholder="Enter name" value= <?php
                    echo $fname;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="UserName" id="UserName" placeholder="Enter username" value=<?php echo $_SESSION["UserName"];
                    $_SESSION["UserName"] = null; ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="UserPassword" id="UserPassword" placeholder="Enter password" value=<?php
                    echo $password;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate = "Repeat Password is required">
                    <span class="label-input100">Re-Password</span>
                    <input class="input100" type="password" name="UserPasswordRepeat" id="UserPasswordRepeat" placeholder="Enter re-password" value=<?php
                    echo $password_repeat;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="UserEmail" id="UserEmail" placeholder="Enter email" value=<?php
                    echo $email;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button name="submit" type="submit" class="login100-form-btn" onclick=<?php
                    erase_val($message_array);
                    ?>>
                        Register
                    </button>
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
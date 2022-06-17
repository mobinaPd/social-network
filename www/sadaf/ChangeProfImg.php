<?php
include('header.inc.php');
session_start();

?>
<html lang="en">

<head>
    <title>Change Info</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">

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

$mysql = pdodb::getInstance();
$mysql->Prepare("select * from sadaf.profile where userId=?");
$res = $mysql->ExecuteStatement(array($_SESSION['UserID']));
if ($trec = $res->fetch()) {
    $userId = $trec['userId'];
    $name = $trec['name'];
    $username = $trec['username'];
    $profimage = $trec['profileimage'];
    $bio = $trec["bio"];
} else
    $message_array[0] = "This person is not valid.";
?>

<body style="background: #ebeeef;">
<?php include("header-top.php")?>
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

<div class="w-100" style="height:70px;"></div>
<div class=" d-flex" style="direction:rtl;: left">
    <?php include("right_side.php");?>
</div>
<div class="profile2">
    <div class="profile2-banner">
    </div>

    <div class="profile2-picture">
        <?php echo "<a href=''><img src= $profimage ></a>"?>

        <?php echo "<span> $name </span>"?>
        <br>
        <?php echo "<small> ($username) </small>"?>
        <small class="w-100"><?php echo $bio ?></small>

        <br>
    </div>

    <div class="wrap-login100 shadow-bottom">
        <form class="login100-form validate-form" action="uploadProfImg.php" method="post" enctype="multipart/form-data">

            <div class="wrap-input100 validate-input m-b-26">
                <span class="label-input100">Pro Image:</span>
                <input type="file" class="input100" name="image" id="image" placeholder="Image">
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
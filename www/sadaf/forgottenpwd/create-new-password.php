<head>
    <title>create-new-password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../loginStyle/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../loginStyle/css/util.css">
    <link rel="stylesheet" type="text/css" href="../loginStyle/css/style.css">
    <!--===============================================================================================-->
</head>

<body>

<div class="container-fluid">
    <?
    if(isset($_GET["newpwd"])){
        if($_GET["newpwd"] == "incorrectform"){
        ?>
            <div class="row">
                <div class="col-1" ></div>
                <div class="col-10" >
                    <div class="alert alert-danger well" role="alert">Password must have 8 characters at least that include uppercase, lowercase & numbers.</div>
                </div>
                <div class="col-1" ></div>
            </div>
       <?}elseif ($_GET["newpwd"] == "empty") {
            ?>
            <div class="row">
                <div class="col-1" ></div>
                <div class="col-10" >
                    <div class="alert alert-danger well" role="alert">Password or repeat password is empty.</div>
                </div>
                <div class="col-1" ></div>
                </div>
        <?}elseif ($_GET["newpwd"] == "pwdnotsame"){
            ?>
            <div class="row">
                <div class="col-1" ></div>
                <div class="col-10" >
                    <div class="alert alert-danger well" role="alert">Password & repeat password aren't same.</div>
                </div>
                <div class="col-1" ></div>
            </div>
        <?}
    } ?>
</div>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(../loginStyle/images/icons/lock.pn.png);">
                        <span class="login100-form-title-1">
                            Create new password
                        </span>
            </div>

            <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if (empty($selector) || empty($validator)){
                echo "Could not validate your request!";
            } else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    ?>
                    <form action="includes/reset-password.inc.php" class="login100-form validate-form" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">

                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                            <span class="label-input100">Password</span>
                            <input class="input100" type="password" name="pwd" id="pwd" placeholder="Enter password">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Repeat Password is required">
                            <span class="label-input100">Re-Password</span>
                            <input class="input100" type="password" name="pwd-repeat" id="pwd-repeat" placeholder="Enter re-password">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="flex-sb-m w-full p-b-30">
                            <div class="container-login100-form-btn">
                                <button type="submit" name="reset-password-submit" class="login100-form-btn">
                                    Receive new password
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="../loginStyle/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/vendor/bootstrap/js/popper.js"></script>
<script src="../loginStyle/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/vendor/daterangepicker/moment.min.js"></script>
<script src="../loginStyle/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="../loginStyle/js/main.js"></script>

</body>


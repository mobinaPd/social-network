<head>
    <title>reset-password</title>
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

<?php
    $msg = '<p class="text-center"><b>notice: </b>An email will be send to you with instructions on how to reset your password.</p>'
?>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(../loginStyle/images/icons/lock.pn.png);">
                        <span class="login100-form-title-1">
                            Reset password
                        </span>
                </div>
                <form action="includes/reset-request.inc.php" class="login100-form validate-form" method="post">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <label for="email"></label><input class="input100" type="text" name="email" id="email" placeholder="Enter your e-mail address...">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="container-login100-form-btn">
                            <button type="submit" name="reset-request-submit" class="login100-form-btn">
                                Receive new password
                            </button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET["reset"])){
                    if ($_GET["reset"] == "success"){
                        $msg = '<p class="text-center">Check your e-mail!</p>';
                    }
                }
                ?>
                <div class="wrap-input100 validate-input m-b-26">
                    <?php echo $msg ?>
                </div>
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

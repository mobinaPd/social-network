<?php
session_start();
?>
<div class="col-2 side" style="direction: ltr;position: fixed;left:-40px; top: 100px; ">
            <div class="pl-5 ml-3 mt-1">
                <a href="">
                    <div class="d-flex menu">
                        <img src="./asset/images/black-circle.png">
                        <p class="ml-2"><a href="profile.php?user=<? echo $_SESSION['UserID']; ?>">See Your Profile</a></p>

                    </div>
                </a>
                <a href="">
                    <div class="d-flex menu">
                        <img src="./asset/images/black-circle.png">
                        <p class="ml-2"><a href="setting.php">Update Your Info</a></p>

                    </div>
                </a>
                <a href="">
                    <div class="d-flex menu">

                        <img src="./asset/images/black-circle.png">
                        <p class="ml-2"><a href="ChangeProfImg.php">Change Your Photo People See</a></p>

                    </div>
<!--                    <a href="">-->
<!--                        <div class="d-flex menu">-->
<!--                            <img src="./images/profile.png">-->
<!--                            <p class="ml-2"><a href="profile.php">Change Bio</a></p>-->
<!---->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <p style="font-weight: bold" class="mt-3">community</p>-->
<!--                    <a href="">-->
<!--                        <div class="d-flex menu">-->
<!--                            <img src="./images/profile.png">-->
<!--                            <p class="ml-2"><a href="profile.php">See Your Followers</a></p>-->
<!---->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a href="">-->
<!--                        <div class="d-flex menu">-->
<!--                            <img src="./images/profile.png">-->
<!--                            <p class="ml-2"><a href="profile.php">See Your follows</a></p>-->
<!---->
<!--                        </div>-->
<!--                    </a>-->
                    <p style="font-weight: bold" class="mt-3">Manage Account</p>
                    <a href="">
                        <div class="d-flex menu">
                            <img src="./asset/images/black-circle.png">
                            <p class="ml-2"><a href="login.php">Login</a></p>

                        </div>
                    </a>
                    <a href="">
                        <div class="d-flex menu">
                            <img src="./asset/images/black-circle.png">
                            <p class="ml-2"><a href="signup.php">Sign up</a></p>

                        </div>
                    </a>
<!--                    <a href="">-->
<!--                        <div class="d-flex menu">-->
<!--                            <img src="./images/profile.png">-->
<!--                            <p class="ml-2"><a href="profile.php">Set Username</a></p>-->
<!---->
<!--                        </div>-->
<!--                    </a>-->
                    <a href="">
                        <div class="d-flex menu">
                            <img src="./asset/images/black-circle.png">
                            <p class="ml-2"><a href="ChangePassword.php">Change Your Password</a></p>

                        </div>
                    </a>
                    <p style="font-weight: bold" class="mt-3">explore</p>
                    <a href="">
                        <div class="d-flex menu">
                            <img src="./asset/images/black-circle.png">
                            <p class="ml-2"><a href="">Search People</a></p>
                        </div>
                    </a>
            </div>
        </div>
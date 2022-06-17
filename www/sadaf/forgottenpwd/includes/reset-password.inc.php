<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

    if(isset($_POST["reset-password-submit"])){
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["pwd-repeat"];

        if(!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)){
            header("Location: ../create-new-password.php?newpwd=incorrectform");
            exit();
        }elseif (empty($password) || empty($passwordRepeat)){
            header("Location: ../create-new-password.php?newpwd=empty");
            exit();
        }elseif ($password != $passwordRepeat){
            header("Location: ../create-new-password.php?newpwd=pwdnotsame");
            exit();
        }

        $currentDate = date('U');

        $sql = "SELECT * FROM sadaf.pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";

        $mysql = pdodb::getInstance();
        $mysql->Prepare($sql);
        $res = $mysql->ExecuteStatement(array($selector, $currentDate));

        if($row = $res->fetch())
        {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if($tokenCheck === false){
                echo "You need re-submit your reset request.";
                exit();
            }elseif ($tokenCheck === true){
                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM sadaf.user WHERE email = ?;";

                $mysql = pdodb::getInstance();
                $mysql->Prepare($sql);
                $res = $mysql->ExecuteStatement(array($tokenEmail));
                if ($row = $res->fetch()){
                    $sql = "UPDATE sadaf.user SET pass=? WHERE email=?;";

//                    $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                    $mysql = pdodb::getInstance();
                    $mysql->Prepare($sql);
                    $res = $mysql->ExecuteStatement(array($password, $tokenEmail));

                    $sql = "DELETE FROM sadaf.pwdReset WHERE pwdResetEmail=?;";

                    $mysql = pdodb::getInstance();
                    $mysql->Prepare($sql);
                    $mysql->ExecuteStatement(array($tokenEmail));
                }
            }
            header("Location: ../../login.php?resetpwd=successfully");

        }
        else {
            $message = "You need re-submit your reset request.";
            header("Location: ../../login.php");
        }
    }else{
        header("Location: ../../login.php/resetpwd=failed");
    }



<?php
session_start();
?>

<!doctype html>

<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

HTMLBegin();

$message = "";
$username = $_SESSION["UserID"];
$email = $_SESSION["UserEmail"];
$OTP = $_SESSION["OTP"];
$mysql = pdodb::getInstance();
if(isset($_REQUEST["submit"]))
{
    $OTP = $_SESSION["OTP"];
    console_log($OTP);
    $userOTP = $_REQUEST["UserOTP"];
    console_log($userOTP);

    if ($userOTP != $OTP) {
        $message = "رمز عبور یکبارمصرف درست نمی باشد. لطفا مجدد تلاش کنید.";
    }

    else{

        $mysql->Prepare("UPDATE sadaf.AccountSpecs
                            SET Status = 'Enable'
                            WHERE UserID = ? ;");
        $res = $mysql->ExecuteStatement(array($username));

        echo "<script>document.location='login.php';</script>";
        die();
    }
}

function console_log( $data ){echo '<script>'.'console.log('. json_encode( $data ) .')'.'</script>';}

function send_email($email_address){

    $OTP = 123456789;
    $_SESSION["OTP"] = $OTP;
    $to = $email_address;
    $subject = "Sadaf system activation code";
    $txt = "کاربر گرامی سلام. کد فعال سازی زیر مربوط به حساب کاربری شما در سیستم سدف می باشد.". "\n\n".$OTP ;
    mail($to, $subject, $txt);
}
?>

<body >
<form method=post>

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
    <div class="row">
        <div class="col-3" ></div>
        <div class="col-6" >
            <br>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        چارچوب توسعه نرم افزار سدف
                    </div>
                    <div class="caption", style="float: left">
                        اعتبارسنجی ایمیل < ثبت نام
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <tr>
                            <td>رمز عبور یکبارمصرف</td>
                            <td><input type=text name=UserOTP id=UserOTP class="form-control"></td>
                        </tr>
                        <tr>
                            <td colspan=2 align=center>
                                <button name="submit" type="submit" class="btn btn-primary active">ثبت نام</button>
                            </td>

                            <td>
                                <a href=""  onclick=<?php
                                if(isset($_REQUEST["resend"]))
                                {
                                    send_email($email);
                                }?>>ارسال مجدد به ایمیل</a>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-3" ></div>
        </div>

</form>
</div>
</body>

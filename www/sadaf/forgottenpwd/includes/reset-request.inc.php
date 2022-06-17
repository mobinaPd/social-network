
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

require '../../../../vendor/autoload.php';



if(isset($_POST["reset-request-submit"])){
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost/social-media/www/sadaf/forgottenpwd/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    $userEmail = $_POST['email'];

    $sql = "DELETE FROM sadaf.pwdreset WHERE pwdResetEmail=?;";

    $mysql = pdodb::getInstance();

    $mysql->Prepare($sql);
    $mysql->ExecuteStatement(array($userEmail));
    $sql = "INSERT INTO sadaf.pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $mysql = pdodb::getInstance();
    $mysql->Prepare($sql);
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    $mysql->ExecuteStatement(array($userEmail, $selector, $hashedToken, $expires));

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com;';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sosomedia11@gmail.com';
        $mail->Password   = 'sosomedia123456';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('sosomedia11@gmail.com', 'soso');
        $mail->addAddress($userEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Reset your password for our website';
        $message = "<p>We received a password reset request. The link to reset your password, if you remember your password you can ignore this e-mail.</p>";
        $message .= "<p>Here is your password reset link: <br>";
        $message .= '<a href='.$url.'>'.$url.'</a></p>';
        $mail->Body    = $message;
        $mail->send();
        header("Location: ../reset-password.php?reset=success");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}else{
    header("location: ../login.php");
}

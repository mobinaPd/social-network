<!doctype html>
<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

HTMLBegin();

$wwwroot = "";
$message_array = [];
$username = "";
$password = "";
$DBIP = "";
if(isset($_REQUEST["submit"])){
    $mysqlConfigPath = '../shares/MySql.config.php';
    $ConfigClassPath = '../shares/config.class.php';
    $htaccessPath = '../.htaccess' ;
    $wwwroot = $_REQUEST["Userwwwroot"];
    $username = $_REQUEST["Username"];
    $DBIP = $_REQUEST["Userip"];
    $password = $_REQUEST["UserPassword"];
    writeToMySqlConfig($mysqlConfigPath,$password,$username,$DBIP);
    replace_config($username,$password,$DBIP,$ConfigClassPath);
    writeTohtaccess($htaccessPath,$wwwroot);
    execDB();
    header("Location: signup.php");
    //if you uncomment below file will be deleted uncomment just in the final commmit
    unlink(__FILE__);
}
function execDB(){
    $mysql = pdodb::getInstance("","","","sys","");
    $sql = file_get_contents('../../simple_sadaf_database.sql');
    $mysql->Execute($sql);
}
function writeTohtaccess($htaccessPath='../.htaccess' ,$wwwroot){
    $htfile = fopen($htaccessPath,'w');
    fwrite($htfile,'php_value include_path  ".;'.$wwwroot.'\www\shares;'.$wwwroot.'\www\adodb"'.PHP_EOL);
    fwrite($htfile,'php_value short_open_tag "On"'.PHP_EOL);
    fwrite($htfile,'php_value error_reporting "On"'.PHP_EOL);
    fwrite($htfile,'php_value display_errors "On"'.PHP_EOL);
    fwrite($htfile,'php_value default_charset   "utf-8"'.PHP_EOL);
    fwrite($htfile,'php_value session.save_handler  "files"'.PHP_EOL);
    fwrite($htfile,'php_value session.gc_maxlifetime  "1800"'.PHP_EOL);
    fclose($htfile);
}
function writeToMySqlConfig($mysqlConfigPath='../shares/MySql.config.php',$password,$username,$DBIP){
    $str=file_get_contents($mysqlConfigPath);
    $str=preg_replace('/localhost/', $DBIP,$str);
    $str=preg_replace('/user1/',$username,$str,1);
    $str=preg_replace('/user1/',$password,$str,1);
    file_put_contents($mysqlConfigPath, $str);
}
function replace_config($username, $password, $DBIP, $configPath = '../shares/config.class.php')
{
    $str = file_get_contents($configPath);
    $str=preg_replace('/localhost/', $DBIP,$str);
    $str=preg_replace('/user1/',$username,$str,1);
    $str=preg_replace('/user1/',$password,$str,1);
    file_put_contents($configPath, $str);
}
?>
<body >
<form method=post>
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
    <div class="row">
        <div class="col-3" ></div>
        <div class="col-6" >
            <br>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        چارچوب توسعه نرم افزار سدف
                    </div>
                    <div class="caption" style="float: left">
                        برنامه نصب
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <tr>
                            <td>آدرس دیتابیس</td>
                            <td><input type=text name=Userip id=Userip class="form-control"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>نام کاربری دیتابیس</td>
                            <td><input type=text name=Username id=Username class="form-control"></td>
                        </tr>
                        <tr>
                            <td>کلمه عبور دیتابیس</td>
                            <td><input type=password id=UserPassword name=UserPassword class="form-control"></td>
                        </tr>
                        <tr>
                            <td>آدرس wwwroot</td>
                            <td><input type=text id=wwwroot name=Userwwwroot class="form-control" placeholder="like : D:\Programfiles\wamp\www\sadaf"></td>
                        </tr>
                        <tr>
                            <td colspan=2 align=center>
                                <button type="submit" class="btn btn-primary active" name="submit">نصب</button>
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
</html>
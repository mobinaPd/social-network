<?php

include("header.inc.php");
HTMLBegin();
$mysql = pdodb::getInstance();

if (isset($_REQUEST["Save"])) {
    if (isset($_REQUEST["Item_FacilityStatus"])){
        $Item_FacilityStatus = $_REQUEST["Item_FacilityStatus"];

        $mysql->Prepare("UPDATE sadaf.ManageStatus
                            SET Status = ?
                            WHERE FacilityStatusID = 1 ;");
        $res = $mysql->ExecuteStatement(array($Item_FacilityStatus));
    }
    echo SharedClass::CreateMessageBox("اطلاعات ذخیره شد");
}

function loadStatus($mysql){

    $query = "select Status from sadaf.ManageStatus where FacilityStatusID = 1;";
    $res = $mysql->Execute($query);

    if($rec=$res->Fetch())
    {
        return $rec['Status'];
    }
}

function console_log( $data ){echo '<script>'.'console.log('. json_encode( $data ) .')'.'</script>';}


?>
<form method="post" id="f1" name="f1">

    <br>
    <table width="90%" border="1" cellspacing="0" align="center">
        <tr class="HeaderOfTable">
            <td align="center">ویرایش وضعیت ثبت نام</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0">

                    <tr>
                        <td width="1%" nowrap>
                            وضعیت ثبت نام
                        </td>
                        <td nowrap>
                            <select name="Item_FacilityStatus" id="Item_FacilityStatus">
                                <? $status = loadStatus($mysql);
                                console_log($status);

                                if($status == 0){
                                    $text1 = "غیرفعال";
                                    $text2 = "فعال";

                                }
                                else{
                                    $text1 = "فعال";
                                    $text2 = "غیرفعال";
                                }
                                ?>
                                <option value=<? echo ''.$status;?>><? echo $text1;?></option>
                                <option value=<? echo ''.($status ^ 1);?>><? echo $text2;?></option>

                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="FooterOfTable">
            <td align="center">
                <input type="button" onclick="javascript: ValidateForm();" value="ذخیره">
            </td>
        </tr>
    </table>
    <input type="hidden" name="Save" id="Save" value="1">
</form>
<script>
    <? echo $LoadDataJavascriptCode; ?>
    function ValidateForm() {
        document.f1.submit();
    }

    function ConfirmDelete() {
        if (confirm('آیا مطمین هستید؟')) document.ListForm.submit();
    }
</script>
</html>


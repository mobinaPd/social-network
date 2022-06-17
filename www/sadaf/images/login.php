<?php  include ("head.php"); ?>
<div class="box">
    <h2 style="text-align:center;">log in</h2>
    <form class="form" action="check.php" method=post>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><label>نام:</label></td>
                        <td><input type="email" name="name" placeholder="نام" required></td>
                    </tr>
                    <tr>
                        <td><label>نام خانوادگی:</label></td>
                        <td><input type="email" name="lastname" placeholder="نام خانوادگی" required></td>
                    </tr>
                    <tr>
                        <td><label>کدملی :</label></td>
                        <td><input type="text" name="code" placeholder=" کدملی " required></td>
                    </tr>
                    <tr>
                        <td><label>آدرس ایمیل:</label></td>
                        <td><input type="email" name="email" placeholder="آدرس ایمیل"></td>
                    </tr>
                    <tr>
                        <td><label>شماره تلفن :</label></td>
                        <td><input type="text" name="number" placeholder="شماره تلفن" required></td>
                    </tr>
                    <tr>
                        <td><label>ملیت :</label></td>
                        <td><input type="text" name="nationality" placeholder="ملیت" required></td>
                    </tr>
                </table>
                <a href="signin.php" class="bg-dark p-2">گرفتن نوبت</a>
                <input type="submit" class="btnup" name="sendlogin" value="log-in">
            </div>
        </div>
    </form>
</div>
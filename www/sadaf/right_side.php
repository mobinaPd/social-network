
<div class="col-2 div-radius  shadow-left ml-3 pt-2" style="margin-top: 82px; background-color: #f6f6f6;top:-20px;height: 900px;position: fixed;">
        <div class="text-left">
            <!-- <div class="mt-1 d-inline">
                <button type="button" id="dropdownbtn" class="ml-2 bg-none border-none mt-1"><img src="asset/images/down.png" class="" style="height: 10px;width: 15px;" alt=""></button>
            </div>
            <a href="" style=""><img class=" d-inline titer" style="margin-left: 60%;opacity: 0.3;height: 25px;width: 30px;" src="asset/images/groupp.png"></a> -->
            <p class=" d-inline titer">Chat</p>
        </div>
        <div class="d-flex shadow-bottom shadow-left py-3 bg-white" id="online">
            <div class="d-flex">
                <button class="btn hover-primary"> online <img src="asset/images/eye.png" style="width: 20px;"> </button>
            </div>
<!--            <div class="d-flex">-->
<!--                <button class="btn hover-primary">offline <img src="asset/images/invisible.png" style="width: 20px;"> </button>-->
<!--            </div>-->
        </div>
        <div class=" mt-2">
            <div>
                <form class="row" action="" method="post">
                    <div class="form-group col-auto">
                    <input type="submit" name="submit" class="search-btn btn btn-primary-myself float-left text-white p-2" value="Search" />
                    <input type="text" name="query" placeholder="search for users" class="col-8 p-2 text-left" style="width: 200px" />
                    
                    </div>
                </form>
            </div>
            <div class="search">
                <?php

                if(isset($_POST['submit'])){

                    if(!empty($_POST['query'])) {
                        $query = $_POST['query'];
                        $mysql = pdodb::getInstance();
                        $res = $mysql->Execute("select * from sadaf.user where username like '%$query%' ");
                    }


                    while($rec2 = $res->fetch())
                    {
                        ?>
                        <div class='d-flex mt-2'>
                            <div class='col-9 ' >
                                <a href="profile.php?user=<?echo $rec2['userId']?>"><p class="mt-1"><?echo $rec2['username']?>@</p></a>
                            </div>
                        </div>
<?
                    }
                }
                ?>
            </div>
            <div style="margin-left: 20px;">
            <a href="createPost.php"><button class="btn-lg btn-primary-myself  text-white" style="position: fixed; bottom: 25px; right: 25px;">Create New Post</button></a>
            </div>
           <!-- <div class="w-100 mt-2" >
               <div>
                   <a href=""><img src="./images/icons8-replay-30.png" class="offset-3 mt-1 d-inline" style="width: 20px ; height: 20px;"></a>
                   <p class="d-inline titer">What's happening</p>
               </div>
              <?php
               $mysql = pdodb::getInstance();
               $res = $mysql->Execute("select * from sadaf.post, sadaf.profile  where
                   sadaf.post.username =  sadaf.profile.username and
                   sadaf.post.postId in (select postId from sadaf.likes  group by postId having count(*) > 10 ) limit 5");
               while($rec = $res->fetch())
               {
                   echo "<div class='d-flex mt-3'>
                       <p style='font-size: 14px;'>". $rec['username']."@<br> commented on Masoud <br> posted ".rand(1, 5)." days ago</p>
                       <p class='mt-4 mr-3'><img src='./images/megaphone.png' class='profile-header'></p>
                       <hr>
                   </div>" ;
               }
               ?>
           </div> -->
        </div>

    </div>
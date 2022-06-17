<?php
include('header.inc.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="" href="./css/bootstrap.min.css">
    <title>Social Network</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link rel="stylesheet" href="profile.css">
    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="right_script.js"></script>
</head>
<?php

$id_post = array();
$img_post = array();
$caption_post = array();
$likes = array();
$comment_size = array();

$followingNumber = 0;
$followerNumber = 0;

$followed = '';
$counter = 0;
$name = '';
$userId = '';
$profimage = '';
$bio = '';

$cnt = array();
if(isset($_GET['user']) and is_numeric($_GET['user'])) {
    $mysql = pdodb::getInstance();
    $mysql->Prepare("select * from sadaf.profile where userId=?");
    $res = $mysql->ExecuteStatement(array($_GET['user']));

    if ($trec = $res->fetch()) {
        $userId = $trec['userId'];
        $name = $trec['name'];
        $username = $trec['username'];
        $profimage = $trec['profileimage'];
        $bio = $trec["bio"];
        if($_SESSION['UserID'] != $_GET['user']) {
            $mysql->Prepare("select * from sadaf.follow where followingId=? and followedId=? ");
            $res = $mysql->ExecuteStatement(array($_SESSION['UserID'], $userId));

            if ($trec = $res->fetch()) {
                $followed = 'true';
            } else {
                $followed = 'false';
            }
        }
    } else
        $message = "This person is not valid.";
}

if (isset($_POST['follow'])) {
    $mysql->Prepare("INSERT INTO `follow` (`followingId`, `followedId`) VALUES (?, ?);");
    $res = $mysql->ExecuteStatement(array($_SESSION['UserID'], $userId));
    exit();
}

if (isset($_POST['unfollow'])) {
    $mysql->Prepare("DELETE  FROM `follow` where `followingId` = ? and `followedId` = ? ;");
    $res = $mysql->ExecuteStatement(array($_SESSION['UserID'], $userId));
    exit();
}

// comment
if (isset($_POST['iscomment'])) {
    $postid = $_POST['postid'];
    $text = $_POST['text'];
    $mysql->Prepare("INSERT INTO sadaf.comment (username, userId, postId, comment) VALUES (?, ?, ?, ?)");
    $res = $mysql->ExecuteStatement(array($_SESSION['UserName'], $_SESSION['UserID'], $postid, $text));
    exit();
}

$mysql->Prepare("select count(*) from sadaf.follow where followingId=?");
$res = $mysql->ExecuteStatement(array($userId));
if ($frec = $res->fetch()) {
    $followingNumber = $frec['count(*)'];
}

$mysql->Prepare("select count(*) from sadaf.follow where followedId=?");
$res = $mysql->ExecuteStatement(array($userId));
if ($frec = $res->fetch()) {
    $followerNumber = $frec['count(*)'];
}
$mysql->Prepare("select * from sadaf.post where userId=?");
$res = $mysql->ExecuteStatement(array($userId));

while($trec = $res->fetch())
{
    array_push($id_post, $trec['postId']);
    array_push($img_post, $trec['image']);
    array_push($caption_post, $trec['text']);

    $mysql->Prepare("select count(*) from sadaf.likes where postId=?");
    $result = $mysql->ExecuteStatement(array($trec['postId']));
    if ($frec = $result->fetch()) {
        array_push($likes, $frec['count(*)']);
    }

    $mysql->Prepare("select count(*) from sadaf.comment where postId=?");
    $result = $mysql->ExecuteStatement(array($trec['postId']));
    if ($crec = $result->fetch()) {
        array_push($comment_size, $crec['count(*)']);
    }

    // liked by user or not
    $mysql->Prepare( "SELECT * FROM sadaf.likes WHERE userId=? AND postId=?");
    $result = $mysql->ExecuteStatement(array($_SESSION['UserID'], $trec['postId']));
    array_push($cnt, intval(count($result->fetch())));

}

?>

<body style="background: #ebeeef;">
<?php include("header-top.php")?>

<div class="w-100" style="height:70px;"></div>
<div class=" d-flex" style="direction:rtl;: left">
    <?php include("right_side.php");?>
</div>
<div class="profile2">
    <div class="profile2-banner">
    </div>

    <div class="profile2-picture">

        <?php if ((!empty($followed)) and $followed === 'false') { ?>
            <button class="following follow btn btn-primary py-1 shadow-bottom" data-id = "<? echo $userId?>">Follow</button>
            <?php $followed = 'true'; }elseif ((!empty($followed)) and $followed === 'true') { ?>
            <button class="unfollowing follow btn btn-primary py-1 shadow-bottom" data-id = "<? echo $userId?>">Followed</button>
            <?php $followed = 'false'; } ?>
        <p class="follow btn btn-secondary text-white" style="margin-left:-140px;font-size:12px;">Following : <?php echo $followingNumber?></p>
        <p class="follow btn btn-secondary text-white mt-5" style="margin-left:-140px;font-size:12px;">Followers : <?php echo $followerNumber?></p>
        <?php echo "<a href=''><img src= $profimage ></a>"?>

        <?php echo "<span> $name </span>"?>

        <br>
        <?php echo "<small> ($username) </small>"?>
        <small class="w-100 text-dark"><?php echo $bio ?></small>

    </div>

    <div class="profile2-content mt-5">
        <div class="content-middle">
            <?php for ($i=0; $i<sizeof($caption_post); $i++) { ?>
            <div class="content-md-left">
                <?php echo "<a href=''><img src= $profimage ></a>"?>
            </div>
            <div class="content-md-middle">
                <div class="post-title-name">
                    <?php echo "<a href='post.php'> $name </a>" ?>
                    <br>
                    <?php echo "<small> ($username) </small>"?>
                </div>
                <div class="mt-3 bg-white  px-2 py-2 shadow-bottom div-radius-tr div-radius-tl post pl-4">
                    <div class="post-desc">
                        <p style=" font-family: 'byekan'; font-size:25px;text-align: right; direction: rtl; font-size: 20px;opacity:0.8">
                            <?php echo $caption_post[$i] ?>
                        </p>
                        <br>
                        <?php if (!empty($img_post[$i])) echo "<img src='./postImg/$img_post[$i]' class='w-100'>"?>

                    </div>
                    <div class="mt-5 bg-white w-100 px-2 py-2 shadow-bottom post pl-4">

                        <?php echo "<p class='d-inline' style='font-size: 14px;'>like $likes[$i] comment $comment_size[$i]</p>" ?>
                        <form method="post">
                            <div class="w-100">
                                <div class=" kadr w-100 d-flex post-detail">
                                    <p class="text-right detail">
                                        <? if ($cnt[$i] > 1){ ?>
                                            <span class="unlike fa fa-heart fa-lg"  style="color: red" data-id="<?php echo $id_post[$i]; ?>"></span>
                                            <span class="like hide fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $id_post[$i]; ?>"></span>
                                        <? }else{ ?>
                                            <!-- user has not yet liked post -->
                                            <span class="like fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $id_post[$i]; ?>"></span>
                                            <span class="unlike hide fa fa-heart fa-lg" style="color: red" data-id="<?php echo $id_post[$i]; ?>"></span>
                                        <? } ?>
                                    </p>
                                    <p class="text-right detail">
                                        <a href="post.php?post=<?echo $id_post[$i]?>"><i class="fa fa-comments"></i> COMMENT</a>
                                    </p>
                                    <p class="text-right detail">
                                        <a href=""><i class="fa fa-share"></i> SHARE</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                        <div class="bg-gray comment p-3 w-100 shadow-bottom div-radius-br div-radius-bl">
                            <div class="d-flex w-100">
                                <?php echo "<img src= $profimage >" ?>
                                <input type="text" class="iscomment comment-holder ml-3 mr-1 col-10" placeholder="Write a Comment and press enter" data-id="<?php echo $id_post[$i].'-'.$userId ?>" />
                                <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                                <!-- <img class="ml-2" src="asset/images/plus.png"> -->
                            </div>
                        </div>
                    </div>

                </div>
                <?php }?>

            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        var vis = false;
        $("#dropdownbtn").click(function() {
            if (vis == true) {
                $("#online").css({
                    "visibility": "hidden"
                })
                vis = false;
            } else {
                $("#online").css({
                    "visibility": "visible"
                })
                vis = true;
            }

        });
        $("#group-chats").click(function() {
            $("#group-chats").css({
                "border-color": "red"
            })
            $("#person-chats").css({
                "border-color": "black"
            })
            $(".group-chat").show(200);
            $(".person-chat").hide(200);
            $("#group-pic").attr("src", "asset/images/icons8-user-group-red.png");
            $("#person-pic").attr("src", "asset/images/icons8-person-30.png");
        });
        $("#person-chats").click(function() {
            $(".person-chat").show(200);
            $(".group-chat").hide(200);
            $("#group-pic").attr("src", "asset/images/icons8-user-group-30.png");
            $("#person-pic").attr("src", "asset/images/icons8-person-30-red.png");
            $("#group-chats").css({
                "border-color": "black"
            })
            $("#person-chats").css({
                "border-color": "red"
            })
        });

    });
</script>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // when the user clicks on like
        $('.like').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'main.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });

        // when the user clicks on unlike
        $('.unlike').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'main.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });

    $(document).ready(function(){
        $('.iscomment').keydown(function(event){
            var keyCode = (event.keyCode ? event.keyCode : event.which);
            if (keyCode == 13) {
                $post = $(this);
                var res = $(this).data('id').split('-');
                var postid = res[0];
                var userId = res[1];
                var text = $(this).val();
                $.ajax({
                    url: 'profile.php?user=' + userId,
                    type: 'post',
                    data: {
                        'iscomment': 1,
                        'postid': postid,
                        'text':text
                    },
                    success: function(response){
                        $post.val("");
                        alert('comment added successfully')
                    }
                });
            }
        });
    });

    $(document).ready(function(){
        // when the user clicks on follow
        $('.following').on('click', function(){
            var userid = $(this).data('id');
            $user = $(this);

            $.ajax({
                url: 'profile.php?user=' + userid,
                type: 'post',
                data: {
                    'follow': 1,
                    'userid': userid
                },
                success: function(response){
                    $user.removeClass('btn-primary');
                    $user.addClass('btn-outline-primary');
                    // $user.addClass('unfollow');
                    $user.text("Followed!")
                }
            });
        });
    });

    $(document).ready(function(){
        // when the user clicks on unfollow
        $('.unfollowing').on('click', function(){
            var userid = $(this).data('id');
            $user = $(this);

            $.ajax({
                url: 'profile.php?user=' + userid,
                type: 'post',
                data: {
                    'unfollow': 1,
                    'userid': userid
                },
                success: function(response){
                    $user.removeClass('btn-primary');
                    $user.addClass('btn-outline-primary');
                    // $user.addClass('unfollow');
                    $user.text("Follow")
                }
            });
        });
    });
</script>

</html>

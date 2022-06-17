<?php
include('header.inc.php');
$mysql = pdodb::getInstance();

$mysql->Prepare("select * from sadaf.post where postId= ? ");
$res = $mysql->ExecuteStatement(array($_GET['post']));
$post = $res->fetch();

$mysql->Prepare("select * from sadaf.comment, sadaf.profile where 
                                    sadaf.profile.userId=sadaf.comment.userId and postId=?");
$res1 = $mysql->ExecuteStatement(array($_GET['post']));
$userid = $_SESSION['UserID'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Social Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!--    <link rel="stylesheet" type="" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">-->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
<!--    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="fontStyle.css">
</head>







<body style="background: #ebeeef;">
<?php include("header-top.php")?>

<?php include("left_side.php"); ?>
<?
$postuserid = $post['userId'];
//$userProfile = $mysql->Execute("SELECT * FROM sadaf.profile WHERE userId=$userid");
//$rec = $userProfile->fetch();
$userProfile = $mysql->Execute("SELECT * FROM sadaf.profile WHERE userId=$postuserid");
$rec = $userProfile->fetch();
?>
<div class="profile2" style="margin-top: 70px; margin-left: 350px ">
    <div class="profile2-content" >
        <div class="content-middle" >
            <div class="content-md-left">
                <img src="<?echo $rec["profileimage"]?>">
            </div>
            <div class="content-md-middle">
                <div class="post-title-name">
                    <a href=""><?echo $rec["name"]?></a><br>
                </div>
                <div class="post-title-time">
                    <a href="">@<?echo $rec["username"]?></a>
                </div>
                <div class="post-desc postFont" style="font-family:'beykan'; font-size: 25px; text-align: right; direction: rtl">
                    <?echo $post['text'];?>
                    <br>
                    <?
                    if($post["image"] != null){?>
                        <div class="w-100" style="height: 500px;overflow: hidden;">
                            <img src="./postImg/<?echo $post['image']?>" class="img-fluid w-100 h-100 border-none">
                        </div>
                    <?} ?>
                </div>
                <div class="mt-3  w-100 px-2 py-2 post pl-4">
                    <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                    <div class="w-100">
                        <div class=" kadr w-100 d-flex justify-content-between post-detail">
                            <p class="text-rights detail">
                                <?
                                $results = $mysql->Execute( "SELECT * FROM sadaf.likes WHERE userId=".$_SESSION['UserID']." AND postId=".$_GET['post']);
                                //
                                $cnt =  intval(count($results->fetch()));
                                if ($cnt>1){ ?>
                                    <span class="unlike fa fa-heart fa-lg"  style="color: red" data-id="<?php echo $_GET['post']; ?>"></span>
                                    <span class="like hide fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $_GET['post']; ?>"></span>
                                <? }else{ ?>
                                    <!-- user has not yet liked post -->
                                    <span class="like fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $_GET['post']; ?>"></span>
                                    <span class="unlike hide fa fa-heart fa-lg" style="color: red" data-id="<?php echo $_GET['post']; ?>"></span>
                                <? } ?>
                            </p>
                            <p class="text-right detail">
                                <a href=""><i class="fa fa-share"></i> SHARE</a>
                            </p>
                        </div>
                    </div>

                    <div class=" comment p-3 w-100">
                        <div class="d-flex w-100">
                            <img src="<?echo $rec["profileimage"]?>">
                            <input type="text " class="bg-none iscomment comment-holder ml-3 mr-1 col-10" placeholder="Write a Comment and press enter" data-id="<?php echo$_GET['post']; ?>" />
                            <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                            <!-- <img class="ml-2" src="asset/images/plus.png"> -->
                        </div>
                    </div>
                </div>
                <?
                while ($row = $res1->fetch()) {
                    ?>
                    <div class="mt-3 w-100  py-2 post" >
                        <hr>
                        <div class="bg-gray comment p-3 w-100">
                            <div class="d-flex">
                                <img id="profile-post" class="shadow-bottom" src=<?echo $row["profileimage"]?>>
                                <div class="ml-2">
                                    <p class="mt-1" style="font-weight: bold"><?echo $row['name']?></p>
                                    <p class="text-dark" style="font-size:12px;margin-top: -20px;">@<?echo $row['username']?></p>
                                </div>
                            </div>
                            <p><?echo $row['comment']?> </p>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div><br><br><br><br>

</body>
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
                var postid = $(this).data('id');
                var text = $(this).val();
                $.ajax({
                    url: 'main.php',
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
</script>
</html>

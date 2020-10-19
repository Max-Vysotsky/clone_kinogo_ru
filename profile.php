<?php require_once('db.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  clear cache -->
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
    <!--  clear cache -->
    <title>KinoGo</title>
    <link rel="stylesheet" href="static/css/reset.css">
    <link rel="stylesheet" href="static/css/main.css">
</head>

<body>
    <?php 
     require('includes/header.php');   
     require_once('includes/functions.php'); 
     require('includes/navigation.php'); 
     ?>
    <main class="main-main">
        <div class="container">
          <div class="main-wrap">
         
            <?php require('includes/navigationPanel.php'); ?>
            <div class="side-right gray-color">
                <div class="main-block items" id="main">
                 <?php 
                      require('includes/config.php');
                      if ( isset($_COOKIE['uid'] ))
                      {
                        $user;
                          if (!empty($user = R::find( 'user', ' uid  = ?', [$_COOKIE['uid']] ))) {
                           $user = array_values($user);
                           $user = array_shift($user);
                           $user = $user->export();
                             $numOfComments = R::count( 'comments', ' userid > ? ', [ $user['id']] );
                             $nickname = $user['name'];
                             $uid = $user['uid'];
                             $emailAdress = $user['email'];
                             $likes = $user['likes'];
                             $dislikes = $user['dislikes'];
                             $avatar = $user['avatar'];
                             $lastlogin = $user['lastlogin'];
                             $rating = $likes - $dislikes;
                             $sec =   strtotime($user['sign_date']); 
                             $registationData = date ("d F Y H:i", $sec); 
                           ?>
                            <div class="profile">
                              <div class="profile__left">
                                <div class="row profile_nickname">Ник: <?php echo $nickname; ?></div>
                                <div class="row profile_numOfComments">Всего комментариев: <?php echo $numOfComments; ?></div>
                                <div class="row profile_registationData">Дата регистрации: <?php echo $registationData; ?></div>
                                <div class="row profile_emailAdress">Электронный адрес: <?php echo $emailAdress; ?></div>
                                <div class="row profile_rating">Рейтинг: <?php echo $rating ?> [<?php echo $likes ?> лайков - <?php echo $dislikes ?> дизлайков]</div>
                                <div class="row profile_emailAdress">Последнее посещение <?php echo $lastlogin; ?></div>
                              </div>
                              <div class="profile__right">
                                <img  class="profile_img"src="upload/<?php echo $avatar ?>" alt="<?php echo $avatar ?>">
                                <form  class="profile_imgupload" action="uploadimage.php" enctype="multipart/form-data" method="post">
                                  <input class="profile_imgfilechoose" accept="image/x-png,image/gif,image/jpeg" type="file" name="image">
                                  <input class="profile_imgfilechoose" type="hidden" name="uid" value="<?php echo $uid ?>"  >
                                  <input  class="profile_imgfileBtn form-btn" type="submit" value="Upload New Image" class="form-btn ml5">
                                </form>
                              </div>
                            </div>
                           <?php
                          }
                      }
                   ?>
                </div>
            </div>
        </div>
      </div>
    </main>
   
     <?php require('includes/footer.php'); ?>
</body>

</html>
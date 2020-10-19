<?php 
  if(isset($_COOKIE['uid']))
  {
require_once('../db.php'); 
if($admin = R::find( 'user', ' `uid`  = ? ', [ $_COOKIE['uid'] ] ) ) 
  {
    $admin = array_shift( $admin);
    $admin = $admin->export();
   if(isset($admin['isadmin']))
    {
 $AllArticles    = R::count( 'item' );
  require('../includes/paginatorhead.php'); 
  
  $articles;
 
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
    <link rel="stylesheet" href="/static/css/reset.css">
    <link rel="stylesheet" href="/static/css/main.css">
</head>

<body>
    <?php 
     require('../includes/header.php');   
     require_once('../includes/functions.php'); 
     ?>
    <main class="main-main main-admin">
        <div class="container">
          <div class="main-wrap">
            <?php require('../includes/navigationAdminPanel.php'); ?>
            <div class="side-right gray-color">
                <div class="main-block items" id="main">

                </div>
            </div>
        </div></div>
    </main>
</body>

</html>
<?php }}} ?>
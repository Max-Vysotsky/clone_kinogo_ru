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
     $eng =[
            'Biografii',
            'Boeviki',
            'Vesterni',
            'Voennie',
            'Detektivi',
            'Dokumentalynie',
            'Drami',
            'Istoricheskie',
            'Komedii',
            'Kriminal',
            'Melodrami',
            'Mulytfilymi',
            'Myuzikli',
            'Priklyucheniya',
            'Semeynie',
            'Cportivnie',
            'Trilleri',
            'Uzhasi',
            'Fantastika',
            'Fentezi',
            'anime',
        ];
     ?>
    <main class="main-main main-admin">
        <div class="container">
          <div class="main-wrap">
            <?php require('../includes/navigationAdminPanel.php'); ?>
            <div class="side-right gray-color">
                <div class="main-block items" id="main">
                    <form action="handlercreateVideo.php" method="POST" class="makevideoform">
                      <input type="text" name="title"  placeholder="tittle" class="makevideoinput">
                      <input type="text" name="year"  placeholder="year" class="makevideoinput">
                      <textarea  name="text"  placeholder="text" class="makevideoTextArea"></textarea>
                      <input type="text" name="countyes"  placeholder="countyes" class="makevideoinput">
                      <select name="genders[]" id="genders-select" multiple class="makevideoinput">
                      <option  value="">--Please choose an genders--</option>
                        <?php foreach ($eng as $key => $value) {
                          echo " <option value=\"$value\">$value</option>";
                        } ?>
                      </select>
                       <select name="quality[]" id="quality-select" class="makevideoinput">
                      <option  value="">--Please choose an quality--</option>
                          <option value="380p">380p</option>
                          <option value="480p">480p</option>
                          <option value="720p">720p</option>
                          <option value="1080p">1080p</option>
                      </select>
                       <select name="type[]" id="type-select" class="makevideoinput">
                      <option  value="">--Please choose an type of video--</option>
                          <option value="1">isanime</option>
                          <option value="2">istv</option>
                          <option value="3">isfilm</option>
                          <option value="4">ismult</option>
                          <option value="5">isserial</option>
                      </select>
                      <input type="text" name="duratation"  placeholder="duratation" class="makevideoinput">
                      <input type="text" name="thumbnail"  placeholder="thumbnail" class="makevideoinput">
                      <input type="text" name="actors"  placeholder="actors" class="makevideoinput">
                      <input type="text" name="link"  placeholder="link" class="makevideoinput">
                      <input type="text" name="videourl"  placeholder="videourl" class="makevideoinput">
                      <input type="submit">
                    </form>
                </div>
            </div>
        </div></div>
    </main>
</body>

</html>

<?php      
            }
          } 
        }
?>
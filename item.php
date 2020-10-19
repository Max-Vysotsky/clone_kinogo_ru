<?php require_once('db.php');
  $item;
        if (isset($_GET['id'])) {
          if($item = R::find( 'item', ' link  = ? LIMIT 1', [$_GET['id']] ))
          {
            require_once('includes/functions.php');
            $item = array_shift($item);
            $genders1 = json_decode($item['genders'], true);
            $item['issanime'] =  (int) $item['isanime'];
            $item['videojsconf'] = getNewjsConf($item['isserial'], $item['isanime'], $item['istv'], $item['link']);
            $isfilm = false;
           if($item['isfilm'] == 1 || $item['ismult'] == 1){
            $isfilm = true;
            $item['downloadlinks'] = getDownloadFilmArray( $item['videojsconf'] );
          }
          }else{
           die;
          }
        }else{
          die;
        }
    $item['comentsCount'] = (int) $item['comentsCount'];
    $currentItem = $item['id'];
  $ipOfUser = $_SERVER["REMOTE_ADDR"];
    if(!$unicUser = R::find( 'unic_user', ' host  = ?', [$ipOfUser] ))
    {
       R::exec( 'INSERT INTO `unic_user` ( `host`) VALUES (?)',[$ipOfUser] );
    }
    else
    {
   $unicUser = array_shift($unicUser);
   $unicUser =  $unicUser->export();
   if($unicUser['watched'] == 'null')
   {
       R::exec( 'UPDATE item SET views=views +1 WHERE id = ?',[$currentItem]);
       $watchedRow = json_encode($currentItem);
       R::exec( 'UPDATE unic_user SET watched=? WHERE host = ?',[$watchedRow, $ipOfUser]);

   }
   else
   {    
        $watchedArray;
        global $lastKey;
        $iswatched = false;
        $watchedArray =  json_decode($unicUser['watched'],1);
        if (!is_array($watchedArray)) {
          $watchedArray   = array($watchedArray);
        }
        $i = 0;
        foreach ($watchedArray as $key => $value) {
           if($value == $currentItem)
            {
                $iswatched = true;
            }
            $i++;
            $lastKey = $i;
        }
        if(!$iswatched)
        {
           R::exec( 'UPDATE item SET views=views +1 WHERE id = ?',[$currentItem]);
           $watchedArray[$lastKey] = $currentItem;
           $watchedRow = json_encode($watchedArray);
           R::exec( 'UPDATE unic_user SET watched=? WHERE host = ?',[$watchedRow, $ipOfUser]);
        }
   }
  } ?>
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
     <?php require('includes/header.php'); ?>
   <?php require('includes/navigation.php'); ?>
    <main class="main-main">
        <div class="container">
            <div class="main-wrap">
                 <?php   require('includes/navigationPanel.php'); ?>
                <div class="side-right gray-color">
                   <?php  if (!isset($_GET['id'])) {require('includes/sortBy.php'); } ?>
                    <div class="main-block items" id="main">
                        <article class="items__item item">
                            <div class="item__top">
                                <a href="https://kinogo.by/<?php echo $item['link'] ?>.html" class="bold">
                                    <h2 class="item__title"><?php echo $item['title'] ?></h2>
                                </a>
                            </div>
                            <div class="item__main">
                                <div class="side__left">
                                    <div class="item__img-block">
                                        <img class="item__img" src="<?php echo $item['thumbnail'] ?>" alt="Захар Беркут (2019)">
                                    </div>
                                </div>
                                <div class="side__right">
                                    <p class="item__text"><?php echo mb_strimwidth($item['text'], 0, 1000, '...'); ?></p>
                                    <div class="item__desc">
                                        <ul class="item__desc-list desc-list">
                                            <li class="desc-list__item">Год выпуска: <a href="/items/video?whereYear=<?php echo $item['year'] ?>" class="desc__list__link"><?php echo $item['year'] ?></a></li>
                                            <li class="desc-list__item">Страна: <?php echo $item['countryes'] ?></li>
                                            <li class="desc-list__item">Жанр: <?php getgenders($item['genders']); ?></li>
                                            <li class="desc-list__item">Качество: WEB-DLRip</li>
                                            <li class="desc-list__item">Продолжительность: 135 мин</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item__main-content main-content">
                                <div class="main-content__video video">
                                    <div class="video__top">
                                      <?php  if (isset($_COOKIE['uid'])) {  ?>
                                        <div class="video__rating" data-like="470" data-dislike="419">
                                            <div class="video-rating">
                                                <div class="rating-like">
                                                    <div class="notLiked" data-itemid="<?php echo $item['id'] ?>" data-uid="<?php   echo $_COOKIE['uid']; ?>" data-isliked="0" data-action="like" id="likeThisVideo"></div>
                                                    <div class="comment-rating-cnt"><?php echo $item['likes'] ?></div>
                                                </div>
                                                <div class="rating-dislike">
                                                    <div class="notDisliked" data-itemid="<?php echo $item['id'] ?>" data-uid="<?php  echo $_COOKIE['uid'];  ?>" data-isdisliked="0" data-action="dislike" id="dislikeThisVideo"></div>
                                                    <div class="comment-rating-cnt"><?php echo $item['dislikes'] ?></div>
                                                </div>
                                            </div>
                                            <script src="/static/js/ratingLogic.js"></script>
                                        </div>
                                      <?php } ?>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
                                    <div class="video__main">
                                        <?php require('includes/serialPlayerHtml.php'); ?>
                                    </div>
                                </div>
                            </div>
                           <?php require('includes/itemBottom.php'); ?>
                        </article>
                        <link rel="stylesheet" href="minified/themes/modern.min.css" />
                        <?php if ( isset($_COOKIE['uid']) ) {echo ' <script src="minified/sceditor.min.js"></script>

                      <!-- Include the BBCode or XHTML formats -->
                      <script src="minified/formats/bbcode.js"></script>
                      <script src="minified/formats/xhtml.js"></script>'; } ?>
                      <!-- Include the editors JS -->

                     
                        <div class="addcomment" <?php if ( isset($_COOKIE['uid']) ) {echo 'style="display: none;'; } ?>">

                            <?php  if ( isset($_COOKIE['uid']) ) {
                              require('includes/addcomment.php');
                              echo ' <script src="static/js/addcomment.js"></script>';
                            }else{
                              echo 'войдите или зарегестрируйтесь';
                            }
                            ?>

                        </div>
                       <?php require('includes/comments-block.php'); ?>
                       <script src="static/js/ratignOfComments.js"></script>
                        <div class="more-comments-container">
                          <?php if($item['comentsCount'] > 12){ ?>
                            <div class="more-comments main-button" onclick="getComments(this, <?php echo $item['id'] ?>)">Еще комментарии</div>
                          <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   <?php require('includes/footer.php'); ?>
</body>

</html>
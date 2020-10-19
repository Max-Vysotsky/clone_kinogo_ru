<?php require_once('../db.php'); 
  
 $AllArticles    = R::count( 'item', ' isserial = 1 ' );
  require('../includes/paginatorhead.php'); 
         
  $articles = R::getAll( 'SELECT * FROM `item` WHERE `isserial` = 1 ORDER BY `id` DESC LIMIT ?,?', [$offset, $articlesOnPage] );
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
     require('../includes/navigation.php'); 
     ?>
    <main class="main-main">
        <div class="container">
          <div class="main-wrap">
            <?php require('../includes/navigationPanel.php'); ?>
            <div class="side-right gray-color">
               <?php require('../includes/sortBy.php'); ?>
                <div class="main-block items" id="main">
                  <?php foreach ($articles as $key => $article):   
                    $title = $article['title'];
                    $text = $article['text'];
                    $year = $article['year'];
                    $countryes = $article['countryes'];
                    $quality = $article['quality'];
                    $duratation = $article['duratation'];
                    $views = $article['views'];
                    $comentsCount = $article['comentsCount'];

                   

                    ?>
                    <article class="items__item item">
                        <div class="item__top">
                            <a href="/<?php echo 'item.php?id='.$article['link'] ?>" class="bold"><h2 class="item__title"><?php echo $title ?></h2></a>
                        </div>
                        <div class="item__main">
                            <div class="side__left">
                                <div class="item__img-block">
                                    <img class="item__img" src="<?php echo $article['thumbnail'] ?>" alt="Захар Беркут (2019)">
                                </div>
                            </div>
                            <div class="side__right">
                                <p class="item__text"><?php echo mb_strimwidth($text, 0, 1000, '...'); ?></p>
                                <div class="item__desc">
                                    <ul class="item__desc-list desc-list">
                                        <li class="desc-list__item">Год выпуска: <a href="item.php?whereYear=<?php echo $year ?>" class="desc__list__link"><?php echo $year ?></a></li>
                                        <li class="desc-list__item">Страна: <?php echo $countryes ?></li>
                                        <li class="desc-list__item">Жанр: <?php echo getgenders($article['genders']); ?></li>
                                        <li class="desc-list__item">Качество: <?php echo $quality ?></li>
                                        <li class="desc-list__item">Продолжительность: <?php echo $duratation ?> мин</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item__bottom">
                            <a href="/items/video?whereTitle=26544-zahar-berkut" class="item__watch">Смотреть онлайн</a>
                            <div class="item__bottom-wrap">
                              <span class="item__bottom-count" title="59693 просмотров"><img src="https://kinogo.by/templates/Kinogo/images/eye.png" alt="Просмотров 59693"><?php echo $views ?></span>
                              <span class="item__bottom-count" title="59693 коментариев"><img src="https://kinogo.by/templates/Kinogo/images/mail.png" alt="Просмотров 59693"><?php echo $comentsCount ?></span>
                            </div>
                        </div>
                    </article>
                   <?php endforeach ?>
                   <?php require('../includes/paginator.php') ?>
                </div>
            </div>
        </div></div>
    </main>
   
     <?php require('../includes/footer.php'); ?>
    <script src="/static/js/main.js"></script>
</body>

</html>

<?php
 if(isset($_COOKIE['uid']))
  {
    require('../db.php');
if($admin = R::find( 'user', ' `uid`  = ? ', [ $_COOKIE['uid'] ] ) ) 
  {
    $admin = array_shift( $admin);
    $admin = $admin->export();
   if(isset($admin['isadmin']))
    {
    if( isset($_POST['idcarousel']) && isset($_POST['iditem']) )
    {
       $corouselItem =  R::find('item', '`id` = ?',[ $_POST['iditem'] ]);
       $corouselItem = array_shift($corouselItem);
       $corouselItem = $corouselItem->export();
       R::exec('UPDATE `carousel` SET `id`= ? ,`title`= ? ,`year`= ? ,`text`= ? ,`create_date`= ? ,`countryes`= ? ,`genders`= ? ,`quality`= ? ,`duratation`= ? ,
        `thumbnail`= ? ,`actors`= ? ,`likes`= ? ,`dislikes`= ? ,`views`= ? ,`isanime`= ? ,`istv`= ? ,`isfilm`= ? ,`ismult`= ? ,`isserial`= ? ,`link`= ? ,
        `videojsconf`= ? ,`comentsCount`= ?  WHERE `id` = ?',[ 
        $_POST['idcarousel'],
        $corouselItem['title'],
         $corouselItem['year'],
          $corouselItem['text'],
         $corouselItem['create_date'], $corouselItem['countryes'], $corouselItem['genders'], 
         $corouselItem['quality'], $corouselItem['duratation'], $corouselItem['thumbnail'],
          $corouselItem['actors'], $corouselItem['likes'], $corouselItem['dislikes'],
           $corouselItem['views'], $corouselItem['isanime'], $corouselItem['istv'],
            $corouselItem['isfilm'], $corouselItem['ismult'], $corouselItem['isserial'],
             $corouselItem['link'], $corouselItem['videojsconf'],
              $corouselItem['comentsCount'], $_POST['idcarousel'] ]);
       print_r($corouselItem);die;
    }

  }}
}
<?php
require('db.php');
 // is exist all data
$uid;$text;$link;$title;$userid;$textlen;$level;$username;$parentid;$itemid;
 if(isset($_POST['uid'])  && isset($_POST['text']) && isset($_POST['itemid']) && isset($_POST['link'])  && isset($_POST['commentid']) && isset($_POST['title']) && isset($_POST['level']))
 {
    $uid     = $_POST['uid'];
    $text    = $_POST['text'];
    $link    = $_POST['link'];
    $title   = $_POST['title'];
    $parentid= $_POST['commentid'];
    $itemid  = $_POST['itemid'];
    $level   = (int)$_POST['level'];
    $level++;
    $textlen = strlen($text);
    $user = R::find( 'user', ' `uid`  = ? ', [ $uid ]  );
    $user = array_shift($user);
    $user = $user->export();
    if( isset($user['id']) )
    {
      $userid = $user['id'];
      $username = $user['name'];
    }else { echo 1; die; }

    if($textlen < 3 || $textlen > 1000)
    {
      echo 2; die;
    }
    $item = R::find( 'item', ' `link`  = ? and `title` = ?', [ $link, $title ] );
    $item = array_shift($item);
    $item = $item->export();
    if( isset($item['id']) )
    {

    }else{ echo 3; die; }

    R::exec("INSERT INTO `comments` ( `title`, `text`, `link`, `itemid`,`level`, `userid`, `username`,  `parentid`) VALUES (?,?,?,?,?,?,?,?)",[$title, $text, $link, $itemid, $level, $userid, $username, $parentid]);
    R::exec('UPDATE `comments` SET ischild = 1 WHERE `id` = ?',[$parentid]);
    R::exec( 'UPDATE item SET comentsCount=comentsCount + 1 WHERE id = ?',[ $itemid] );
    echo 4;

 }
 else{
  echo 5;
 }

 //erors
 // 1. user with this uid does`n exist
 // 2. text must be higest then 3 and lower than 1000
 // 3. that item does`n exist
 // 4. all okey
 // 5  not  all data
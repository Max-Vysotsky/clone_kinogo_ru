<?php
require('db.php');
 if ( isset($_POST['uid']) && isset($_POST['text']) && isset($_POST['title']) && isset($_POST['itemid'])  && isset($_POST['link']) ) {
    if(strlen($_POST['text']) < 3){
      die('слишком короткий текст');
    }
     if(strlen($_POST['uid']) != 50){
      die('неправильный uid');
    }
    if(strlen($_POST['text']) > 1000){
      die('слишком длинный текст');
    }

    if( $user  = R::find( 'user', ' uid = ? ',  [ $_POST['uid'] ] ) )
    {
      $user = array_shift($user);
      $user = $user->export();
      $bean = R::dispense( 'comments' );
      $bean->title = $_POST['title'];
      $bean->userid = $user['id'];
      $bean->username = $user['name'];
      $bean->itemid = (int) $_POST['itemid'];
      $bean->itemid = (int) $_POST['itemid'];
      $bean->text = $_POST['text'];
      $bean->link = $_POST['link'];
      $id = R::store( $bean );
  
      R::exec( 'UPDATE item SET comentsCount=comentsCount + 1 WHERE id = ?',[ $_POST['itemid'] ] );
      echo 1;
      die;
    }


 }
 echo 2;
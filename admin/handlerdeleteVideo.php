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

require('../db.php');
print_r($_POST);
if( isset($_POST['title']) )
{
  R::exec( 'DELETE FROM `item` WHERE `title` = ?', [$_POST['title']] );
  header('Location: /admin/');
  die;
}

if( isset($_POST['year']) )
{
  R::exec( 'DELETE FROM `item` WHERE `year` = ?', [$_POST['year']] );
  header('Location: /admin/');
  die;
}

if( isset($_POST['link']) )
{
  R::exec( 'DELETE FROM `item` WHERE `link` = ?', [$_POST['link']] );
  header('Location: /admin/');
  die;
}


    }
} 
}
<?php
 require_once('db.php');
if(isset( $_GET['loginName']) & isset( $_GET['loginPass']) & isset( $_GET['issubmit']))
{
  $login = $_GET['loginName'];
  $pass = $_GET['loginPass'];
  $bean = R::find( 'user', ' `login`  = ? and `pass` = ?', [$login, $pass] );
  if ( !empty($bean) ) {
    $bean =  array_values($bean);
    $bean = array_shift($bean)->export();
    $cookie_name = "uid";
    $uid = $bean['uid'];
    $cookie_value = $uid;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    R::exec( 'UPDATE `user` SET lastlogin= CURRENT_TIMESTAMP, isonline=1 WHERE `login`  = ? and `pass` = ? and `uid` = ? ', [$login, $pass, $uid]  );
    echo '2';
  }
  else
  {
    echo '1';
  }
}

<?php
require('../db.php');
if (isset($_POST['isfromform']) && isset($_POST['token']) && isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['ip'])) {
  $bean = R::find( 'user', ' login  = ? or uid = ?', [$_POST['login'], $_POST['token']] );

  if (!empty($bean)) {
   header('Location : /sign-up.php');
  }

  if (empty($bean)) {
    if ($_POST['password'] == $_POST['password_repeat']) {
      if (strlen($_POST['login'] ) <= 13 && strlen($_POST['password'] ) >= 6 && strlen($_POST['password'] ) <= 255) {
        R::exec( "INSERT INTO `user` (`id`, `name`, `sign_date`, `likes`, `dislikes`, `avatar`, `login`, `pass`, `email`,`ip`,  `uid`,`isonline`) VALUES (NULL, ?, CURRENT_TIMESTAMP, '0', '0', 'default.jpg', ?, ?, ?, ?,1) ",[ $_POST['nickname'], $_POST['login'],  $_POST['password'],$_POST['email'],$_POST['ip'],$_POST['token'] ] );
        $cookie_name = "uid";
$cookie_value = $_POST['token'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header('Location : http://kinogo.ru/');
      }
    }
  }
}
else
{
  echo 'подозрительно!?!';
}

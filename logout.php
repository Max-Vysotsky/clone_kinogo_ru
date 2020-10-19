<?php
require('includes/functions.php');
require('includes/config.php');
require('db.php');
 R::exec( 'UPDATE `user` SET isonline=0 WHERE `uid` = ? ', [$_COOKIE['uid']]  );
 deleteCookie('uid');
 header('Location: http://'. $nameOfDomain  .'/');

<?php
require('db.php');
  define('KB', 1024);
  define('MB', 1048576);
  define('GB', 1073741824);
  define('TB', 1099511627776);
  if ( isset($_FILES['image']) && isset($_COOKIE['uid']) && $_FILES['image']['error'] == 0) {
    $name = $_FILES['image']['name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $uid = $_COOKIE['uid'];
    $user = R::find( 'user', ' `uid`  = ? ', [$uid]);
    $user = array_values($user);
    $user = $user[0];
    $user = $user->export();
    $pathtouplad = __DIR__.'/upload/';
    $oldimage = $user['avatar'];
    unlink($pathtouplad.$oldimage);
    $tmpname = $_FILES['image']['tmp_name'];
    if ($_FILES['image']['size'] < 50*MB)
    {
       $token = openssl_random_pseudo_bytes(2) ;

      //Convert the binary data into hexadecimal representation.
      $token = bin2hex($token);

      //Print it out for example purposes.
      $token = strtoupper(  $token .rand(10000,99999). uniqid() );
      $name =$token .'.'. $ext;
      move_uploaded_file($tmpname, $pathtouplad. $name);
      R::exec( 'UPDATE `user` SET avatar="'. $name.'" WHERE `uid` = ? ', [$uid]  );
    }else{
      echo 'max-size of file is 50 MB or 1048576 bytes';
    }
  }
      header('Location: '.$_SERVER['HTTP_REFERER']);

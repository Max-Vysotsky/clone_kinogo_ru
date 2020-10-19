<?php 
  $newcomments = array();
if (isset($_GET['offset']) && isset($_GET['itemid'])) {
  require('db.php');
  $offset =  $_GET['offset'];
  $itemid = (int) $_GET['itemid'];
  $comments = array_values(R::find( 'comments', ' itemid  = ? and ischild = 0 LIMIT ?,20', [ $itemid, $offset] )) ;
    foreach ($comments as $key => $comment){
      $comment = $comment->export();
       $sec = strtotime($comment['time']); 
       $comment['time'] = date ("d M H:i", $sec); 
         $user = R::find( 'user', ' id  = ?', [$comment['userid']] ); 
     $user = array_shift($user);
     $user = $user->export();
     $comment['img'] = $user['avatar'];

       $newcomments[$key] = $comment;
    }
}

print_r(json_encode( $newcomments ));
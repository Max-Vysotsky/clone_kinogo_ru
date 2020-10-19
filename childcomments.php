<?php 



if ( isset($_GET['itemid']) && isset($_GET['commentid']) ) {

  $itemid = (int) $_GET['itemid'];
  $commentid = (int) $_GET['commentid'];
  require('db.php');
    # code...
   $comments = array();
  $childcomments = array_values(R::find( 'comments', ' itemId  = ?  and parentid = ?', [$itemid, $commentid] )); 
  $ischild = false;
  if (!empty($childcomments)) {
   $ischild = true;
  } 
  foreach ($childcomments as $key => $childcomment) {
     $comments[$key] = $childcomment->export();
     $user = R::find( 'user', ' id  = ?', [$childcomments[$key]['userid']] ); 
     $user = array_shift($user);
     $user = $user->export();
     $comments[$key]['img'] = $user['avatar'];
      $sec = strtotime($comments[$key]['time']); 
      $comments[$key]['time'] = date ("d M H:i", $sec); 
   }
  print_r(json_encode($comments));
}else
{
  print_r('get out of here');
}

<?php
require('db.php');
if (isset($_POST['uid'])  && isset($_POST['itemid']) && isset($_POST['commentid']) ) {
  if(isset($_POST['like']))
  {

      if($user = R::getAll( 'SELECT * FROM `user` WHERE `uid` = ? ', [ $_POST['uid'] ] ))
      {
        $user = array_shift($user);
        $userId = $user['id'];
         if($user['likescommentsarray'] == 'null')
          {
             $comments = R::exec( 'UPDATE comments SET likes=likes + 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
             $likesRow = json_encode($_POST['commentid']);
             $users = R::exec( 'UPDATE user SET likescommentsarray=?  WHERE `uid` = ? ', [$likesRow,$_POST['uid']] );
          }
          else
          {
              $likedcomArray;
                global $lastKey;
                  global $likedKey;
                $isliked = false;
                $likedcomArray =  json_decode($user['likescommentsarray'],1);
                if (!is_array($likedcomArray)) {
                  $likedcomArray   = array($likedcomArray);
                }
                $i = 0;
                foreach ($likedcomArray as $key => $value) {
                   if($value == $_POST['commentid'])
                    {
                        $isliked = true;
                         $likedKey = $i;
                    }
                    $i++;
                    $lastKey = $i;
                }
                if(!$isliked)
                {
                     $comments = R::exec( 'UPDATE comments SET likes=likes + 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
                   $likedcomArray[$lastKey] =  $_POST['commentid'];
                   $likedRow = json_encode($likedcomArray);
                   $likedRow = preg_replace('!\"\"\,!','',$likedRow);
                    $users = R::exec( 'UPDATE user SET likescommentsarray=?  WHERE `uid` = ? ', [$likedRow,$_POST['uid']] ); 
                }
                if($isliked)
                {
                     $comments = R::exec( 'UPDATE comments SET likes=likes - 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
                   $key = array_search($_POST['commentid'],$likedcomArray,true);
                   $likedcomArray[$key] =  '';
                   $likedRow = json_encode($likedcomArray);
                    $likedRow = preg_replace('!\"\"\,!','',$likedRow);
                    $users = R::exec( 'UPDATE user SET likescommentsarray=?  WHERE `uid` = ? ', [$likedRow,$_POST['uid']] ); 
                }
          }
       
       if($comment = R::find( 'comments', ' id  = ?', [$_POST['commentid']] ))
     {
        $comment= array_shift($comment);
        $comment = $comment->export();
        $like = (int) $comment['likes'];
        $dislike = (int) $comment['dislikes'];
        $array = array($like,$dislike);
        $array = json_encode($array);
        echo $array;die;
      }
  }
}
  if(isset($_POST['dislike']))
  {
    

     if($user = R::getAll( 'SELECT * FROM `user` WHERE `uid` = ? ', [ $_POST['uid'] ] ))
      {
        $user = array_shift($user);
        $userId = $user['id'];
         if($user['dislikescommentsarray'] == 'null')
          {
             $comments = R::exec( 'UPDATE comments SET dislikes=dislikes + 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
             $dislikesRow = json_encode($_POST['commentid']);
            $users = R::exec( 'UPDATE user SET dislikescommentsarray=?  WHERE `uid` = ? ', [$dislikesRow,$_POST['uid']] ); 
          }
          else
          {
              $dislikedcomArray;
                global $lastKey;
                  global $dislikedKey;
                $isdisliked = false;
                $dislikedcomArray =  json_decode($user['dislikescommentsarray'],1);
                if (!is_array($dislikedcomArray)) {
                  $dislikedcomArray   = array($dislikedcomArray);
                }
                $i = 0;
                foreach ($dislikedcomArray as $key => $value) {
                   if($value == $_POST['commentid'])
                    {
                        $isdisliked = true;
                         $dislikedKey = $i;
                    }
                    $i++;
                    $lastKey = $i;
                }
                if(!$isdisliked)
                {
                     $comments = R::exec( 'UPDATE comments SET dislikes=dislikes + 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
                   $dislikedcomArray[$lastKey] =  $_POST['commentid'];
                   $dislikedRow = json_encode($dislikedcomArray);
                    $dislikedRow = preg_replace('!\"\"\,!','',$dislikedRow);
                  $users = R::exec( 'UPDATE user SET dislikescommentsarray=?  WHERE `uid` = ? ', [$dislikedRow,$_POST['uid']] ); 
                }
                if($isdisliked)
                {
                     $comments = R::exec( 'UPDATE comments SET dislikes=dislikes - 1 WHERE `itemid` = ? and `id` = ? ', [$_POST['itemid'], $_POST['commentid']] );
                 $key = array_search($_POST['commentid'],$dislikedcomArray,true);
                   $dislikedcomArray[$key] =  '';
                   $dislikedRow = json_encode($dislikedcomArray);
                   $dislikedRow = preg_replace('!\"\"\,!','',$dislikedRow);
                  $users = R::exec( 'UPDATE user SET dislikescommentsarray=?  WHERE `uid` = ? ', [$dislikedRow,$_POST['uid']] ); 
                }
          }
      }
      if($comment = R::find( 'comments', ' id  = ?', [$_POST['commentid']] ))
         {
            $comment= array_shift($comment);
            $comment = $comment->export();
            $like = (int) $comment['likes'];
            $dislike = (int) $comment['dislikes'];
            $array = array($like,$dislike);
            $array = json_encode($array);
            echo $array;die;
          }
      }
      echo 1;
}
<?php
require('db.php');
 if (isset($_COOKIE['uid']) && isset($_POST['uid']) && isset($_POST['itemid']))
 {
    if($_COOKIE['uid'] == $_POST['uid'])
    {
      if(isset($_POST['like']))
      {
           if($User = R::find( 'user', ' uid  = ?', [$_POST['uid']] ))
           {
              $User= array_shift($User);
              $User = $User->export();
              // if($User['isdisliked'] != 1)
              // {

                                  if($User['islikedarray'] == 'null')
                                  {
                                     R::exec( 'UPDATE item SET likes=likes +1 WHERE id = ?',[ $_POST['itemid'] ] );
                                     $watchedRow = json_encode($_POST['itemid']);
                                     R::exec( 'UPDATE user SET islikedarray=? WHERE uid = ?',[$watchedRow, $_POST['uid']]);
                                  }
                                  else
                                  {
                                           $likedArray;
                                          global $lastKey;
                                            global $likedKey;
                                          $isliked = false;
                                          $likedArray =  json_decode($User['islikedarray'],1);
                                          if (!is_array($likedArray)) {
                                            $likedArray   = array($likedArray);
                                          }
                                          $i = 0;
                                          foreach ($likedArray as $key => $value) {
                                             if($value == $_POST['itemid'])
                                              {
                                                  $isliked = true;
                                                   $likedKey = $i;
                                              }
                                              $i++;
                                              $lastKey = $i;
                                          }
                                          if(!$isliked)
                                          {
                                              R::exec( 'UPDATE item SET likes=likes +1 WHERE id = ?',[ $_POST['itemid'] ] );
                                             $likedArray[$lastKey] =  $_POST['itemid'];
                                             $likedRow = json_encode($likedArray);
                                              $likedRow = preg_replace('!\"\"\,!','',$likedRow);
                                             R::exec( 'UPDATE user SET islikedarray=?,isliked =1 WHERE uid = ?',[ $likedRow, $_POST['uid'] ] );
                                          }
                                           if($isliked == true)
                                          {
                                              R::exec( 'UPDATE item SET likes=likes -1 WHERE id = ?',[ $_POST['itemid'] ] );
                                             $likedArray[$likedKey] =  '';
                                             $likedRow = json_encode($likedArray);
                                              $likedRow = preg_replace('!\"\"\,!','',$likedRow);
                                             R::exec( 'UPDATE user SET islikedarray=?,isliked =0 WHERE uid = ?',[ $likedRow, $_POST['uid'] ] );
                                          }
                                  }

              // }else //if dislike exist
              // {
              //       $dislikedArray;
              //       global $lastKey;
              //       global $dislikedKey;
              //       $isdisliked = false;
              //       $dislikedArray =  json_decode($User['isdislikedarray'],1);
              //       if (!is_array($dislikedArray)) {
              //         $dislikedArray   = array($dislikedArray);
              //       }
              //       $i = 0;
              //       foreach ($dislikedArray as $key => $value) {
              //          if($value == $_POST['itemid'])
              //           {
              //               $isdisliked = true;
              //               $dislikedKey = $i;
              //           }
              //           $i++;
              //           $lastKey = $i;
              //       }
              //        if($isdisliked == true)
              //       {
              //           R::exec( 'UPDATE item SET dislikes=dislikes -1 WHERE id = ?',[ $_POST['itemid'] ] );
              //          $dislikedArray[$dislikedKey] =  '';
              //          $dislikedRow = json_encode($dislikedArray);
              //          R::exec( 'UPDATE user SET isdislikedarray=?,isdisliked =0 WHERE uid = ?',[ $dislikedRow, $_POST['uid'] ] );
              //       }
              // }
           }
            if($like = R::find( 'item', ' id  = ?', [$_POST['itemid']] ))
           {
              if($dislike = R::find( 'item', ' id  = ?', [$_POST['itemid']] ))
                {
                     $dislike= array_shift($dislike);
              $dislike = $dislike->export();
              $dislike = (int) $dislike['dislikes'];
                }
              $like= array_shift($like);
              $like = $like->export();
              $like = (int) $like['likes'];
              $array = array($like,$dislike);
              $array = json_encode($array);
              echo $array;die;
            }
           echo 1;
      }
      if(isset($_POST['dislike']))
      {
         if($User = R::find( 'user', ' uid  = ?', [$_POST['uid']] ))
           {
              $User= array_shift($User);
              $User = $User->export();
              //   if($User['isliked'] != 1)
              // {
                                if($User['isdislikedarray'] == 'null')
                                {
                                   R::exec( 'UPDATE item SET dislikes=dislikes +1 WHERE id = ?',[ $_POST['itemid'] ] );
                                   $watchedRow = json_encode($_POST['itemid']);
                                   R::exec( 'UPDATE user SET isdislikedarray=? WHERE uid = ?',[$watchedRow, $_POST['uid']]);
                                }
                                else
                                {
                                         $dislikedArray;
                                        global $lastKey;
                                        global $dislikedKey;
                                        $isdisliked = false;
                                        $dislikedArray =  json_decode($User['isdislikedarray'],1);
                                        if (!is_array($dislikedArray)) {
                                          $dislikedArray   = array($dislikedArray);
                                        }
                                        $i = 0;
                                        foreach ($dislikedArray as $key => $value) {
                                           if($value == $_POST['itemid'])
                                            {
                                                $isdisliked = true;
                                                $dislikedKey = $i;
                                            }
                                            $i++;
                                            $lastKey = $i;
                                        }
                                        if(!$isdisliked)
                                        {
                                            R::exec( 'UPDATE item SET dislikes=dislikes +1 WHERE id = ?',[ $_POST['itemid'] ] );
                                           $dislikedArray[$lastKey] =  $_POST['itemid'];
                                           $dislikedRow = json_encode($dislikedArray);
                                            $dislikedRow = preg_replace('!\"\"\,!','',$dislikedRow);
                                           R::exec( 'UPDATE user SET isdislikedarray=?,isdisliked =1 WHERE uid = ?',[ $dislikedRow, $_POST['uid'] ] );
                                        }
                                         if($isdisliked == true)
                                        {
                                            R::exec( 'UPDATE item SET dislikes=dislikes -1 WHERE id = ?',[ $_POST['itemid'] ] );
                                           $dislikedArray[$dislikedKey] =  '';
                                           $dislikedRow = json_encode($dislikedArray);
                                            $dislikedRow = preg_replace('!\"\"\,!','',$dislikedRow);
                                           R::exec( 'UPDATE user SET isdislikedarray=?,isdisliked =0 WHERE uid = ?',[ $dislikedRow, $_POST['uid'] ] );
                                        }
                                }
         //   }
         //   else //if dislike exist
         //      {
         //             $likedArray;
         //              global $lastKey;
         //                global $likedKey;
         //              $isliked = false;
         //              $likedArray =  json_decode($User['islikedarray'],1);
         //              if (!is_array($likedArray)) {
         //                $likedArray   = array($likedArray);
         //              }
         //              $i = 0;
         //              foreach ($likedArray as $key => $value) {
         //                 if($value == $_POST['itemid'])
         //                  {
         //                      $isliked = true;
         //                       $likedKey = $i;
         //                  }
         //                  $i++;
         //                  $lastKey = $i;
         //              }
         //               if($isliked == true)
         //              {
         //                  R::exec( 'UPDATE item SET likes=likes -1 WHERE id = ?',[ $_POST['itemid'] ] );
         //                 $likedArray[$likedKey] =  '';
         //                 $likedRow = json_encode($likedArray);
         //                 R::exec( 'UPDATE user SET islikedarray=?,isliked =0 WHERE uid = ?',[ $likedRow, $_POST['uid'] ] );
         //              }
         // }
       }
       if($dislike = R::find( 'item', ' id  = ?', [$_POST['itemid']] ))
           {
             if($like = R::find( 'item', ' id  = ?', [$_POST['itemid']] ))
           {
              $like= array_shift($like);
              $like = $like->export();
              $like = (int) $like['likes'];
              
            }
              $dislike= array_shift($dislike);
              $dislike = $dislike->export();
              $dislike = (int) $dislike['dislikes'];
              $array = array($like,$dislike);
              $array = json_encode($array);
              echo $array;die;
            }
           echo 1;
      }
  }

 }
 <?php  require_once('functions.php');
 ?>

 <div class="coomments-block">
  <?php $comments = R::find( 'comments', ' itemid  = ? and parentid = 0 LIMIT 20', [$item['id']] ) ;
  ?>
  <?php foreach ($comments as $key => $comment):
      $comment = $comment->export();
       $sec = strtotime($comment['time']); 
       $comment['time'] = date ("d M H:i", $sec); 
         $user = R::find( 'user', ' id  = ?', [$comment['userid']] ); 
     $user = array_shift($user);
     $user = $user->export();
     $comment['img'] = $user['avatar'];
      $comment['text'] = bbcodeParse($comment['text']);
     ?>
     <div class="comment comment-item" data-id="<?php echo $comment['id'] ?>">
          <a href="/users/id591981" class="comment-img"><img src="<?php echo '/upload/'.$comment['img'] ?>" alt="https://i.imgur.com/DZUsQ1I.jpg"></a>
          <div class="comment-body">
              <div class="comment-top">
                  <div><a href="user.php?id=<?php echo $comment['userid'] ?>" class="comment-author"><?php echo $comment['username'] ?></a>
                      <div class="comment-date" title="<?php echo $comment['time'] ?>"><?php echo $comment['time'] ?></div>
                  </div>
              </div>
              <div class="comment-text"><?php echo $comment['text'] ?></div>
              <div class="comment-karma">
                  <div class="rating-like">
                      <div class="rating-btn-like" data-uid="<?php  if (isset($_COOKIE['uid'])) {echo $_COOKIE['uid'];} ?>" data-itemid="<?php echo $item['id'] ?>"  data-commentid="<?php echo $comment['id'] ?>" class="likeThisComment"></div><div class="comment-rating-cnt"><?php echo $comment['likes'] ?></div>
                  </div>
                  <div class="rating-dislike">
                      <div class="rating-btn-dislike" data-uid="<?php  if (isset($_COOKIE['uid'])) {echo $_COOKIE['uid'];} ?>" data-itemid="<?php echo $item['id'] ?>"   data-commentid="<?php echo $comment['id'] ?>" class="dislikeThisComment"></div><div class="comment-rating-cnt"><?php echo $comment['dislikes'] ?></div>
                  </div>
              </div>
          </div>
          <div class="comment-replay">
              <?php if ( isset($_COOKIE['uid']) ) { ?>
                   <button class="button button-replay" data-level="1"  data-title="<?php echo $item['title'] ?>"  data-link="<?php echo $item['link'] ?>" data-itemid="<?php echo $item['id'] ?>" data-hide="1" data-uid="<?php echo htmlspecialchars($_COOKIE['uid'], ENT_QUOTES, 'UTF-8'); ?>" data-commentid="<?php echo $comment['id']; ?>" >Ответить</button>
              <?php } ?>
          </div>
          <div class="comment-childs-container" id="childsOf_<?php echo $comment['id'] ?>">
          </div>
          <script src="static/js/comments-block.js"></script>
          <?php if (intval($comment['ischild']) == 1) {
            $count = R::count( 'comments', ' itemId  = ?  and parentid = ?', [$comment['itemid'], $comment['id']] )
           ?>
          <div class="comment-more-button" data-num="1" onclick="moreComments(this,<?php echo $comment['itemid'] ?>,'<?php echo htmlspecialchars($_COOKIE['uid']); ?>','<?php echo $item['title'] ?>', '<?php echo  $item['link']  ?>' )">
              <i class="fa fa-caret-down"></i> Показать ответы (<span><?php echo $count; ?></span>)
          </div>
         <?php } ?>
     </div>
  <?php endforeach ?>

</div>
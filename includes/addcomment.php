<textarea placeholder="Write something here..." class="addCommentArea">
  
</textarea>

<div class="row"><button class="button addcommentbtn" id="makeMessage" data-uid="<?php  if (isset($_COOKIE['uid'])) { echo $_COOKIE['uid']; } ?>" data-itemid="<?php echo $item['id']; ?>"  data-link="<?php echo $item['link']; ?>" data-title="<?php echo $item['title']; ?>" >Добавить</button></div>
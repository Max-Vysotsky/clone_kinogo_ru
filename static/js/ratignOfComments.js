$allDislikesBtns = '';
window.addEventListener('DOMContentLoaded', () => {
  $allLikesBtns = document.querySelectorAll('.rating-btn-like');
  $allDislikesBtns = document.querySelectorAll('.rating-btn-dislike');
  $allLikesBtns.forEach(el => {
    el.addEventListener('click', likeThisComment);
  });
  $allDislikesBtns.forEach(el => {
    el.addEventListener('click', dislikeThisComment);
  });
});

function likeThisComment() {
  $text = textarea.value;
  var data = new FormData();
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $commentid = this.getAttribute("data-commentid");
  var $isliked = this.getAttribute("data-isliked");
  if (!($isliked == 1)) data.append('uid', $uid);
  data.append('itemid', $itemid);
  data.append('commentid', $commentid);
  data.append('like', 1);
  axios.post('rating-of-comment.php', data).then(response => {
    //if 1 all bad
    if (response.data != 1) {
      this.nextSibling.innerText = response.data[0];
    }

    this.filter = response.data;
  }).catch(e => {
    this.errors.push(e);
  });
}

function dislikeThisComment() {
  $text = textarea.value;
  var data = new FormData();
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $commentid = this.getAttribute("data-commentid");
  var $isliked = this.getAttribute("data-isliked");
  if (!($isliked == 1)) data.append('uid', $uid);
  data.append('itemid', $itemid);
  data.append('commentid', $commentid);
  data.append('dislike', 1);
  axios.post('rating-of-comment.php', data).then(response => {
    //if 1 all bad
    if (response.data != 1) {
      this.nextSibling.innerText = response.data[1];
    }

    this.filter = response.data;
  }).catch(e => {
    this.errors.push(e);
  });
}
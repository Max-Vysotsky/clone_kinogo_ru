window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('likeThisVideo').addEventListener('click', LikeThisVideo);
  document.getElementById('dislikeThisVideo').addEventListener('click', DislikeThisVideo);
});
$ratingCnt = document.querySelectorAll('.comment-rating-cnt');

function LikeThisVideo() {
  $text = textarea.value;
  var data = new FormData();
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $isliked = this.getAttribute("data-isliked");
  if (!($isliked == 1)) data.append('uid', $uid);
  data.append('itemid', $itemid);
  data.append('like', 1);
  axios.post('rating-of-this-video.php', data).then(response => {
    //if 1 all bad
    if (response.data != 1) {
      $ratingCnt[0].innerText = response.data[0];
      $ratingCnt[1].innerText = response.data[1];
    }

    this.filter = response.data;
  }).catch(e => {
    this.errors.push(e);
  });
}

function DislikeThisVideo() {
  $text = textarea.value;
  var data = new FormData();
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $isliked = this.getAttribute("data-isliked");
  if (!($isliked == 1)) data.append('uid', $uid);
  data.append('itemid', $itemid);
  data.append('dislike', 1);
  axios.post('rating-of-this-video.php', data).then(response => {
    //if 1 all bad 
    if (response.data != 1) {
      $ratingCnt[0].innerText = response.data[0];
      $ratingCnt[1].innerText = response.data[1];
    }

    this.filter = response.data;
  }).catch(e => {
    this.errors.push(e);
  });
}
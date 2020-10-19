$offsetcomment = 0;

function moreComments($btn, $itemid, $uid, $title, $link) {
  console.log($link);
  console.log($itemid);
  $commentid = parseInt($btn.parentElement.getAttribute('data-id'));
  $box = $btn.parentElement.querySelector('.comment-childs-container');
  axios.get('childcomments.php?itemid=' + $itemid + '&commentid=' + $commentid).then(function (response) {
    // handle success
    let data = response.data;
    data.forEach(el => {
      el['level'] = parseInt(el['level']);
      el['level'] = ++el['level'];
      $html = `<div class="comment-childs">
            <div class="comment non-auth" data-id="${el['id']}">
            <a href="user.php?=${el['userid']}" class="comment-img"><img  src="upload/${el['img']}" alt="https://i.imgur.com/DZUsQ1I.jpg"></a>
            <div class="comment-body">
             <div class="comment-top">
             <div>
             <a href="user.php?=${el['userid']}" class="comment-author">${el['username']}</a>
             <div class="comment-date" title="<?php echo $childcomment['time'] ?>">${el['time']}</div>
            </div>
            </div>
            <div class="comment-text">${el['text']}</div>

            <div class="comment-karma">
                  <div class="rating-like">
                      <div class="rating-btn-like" data-uid="${$uid}" data-itemid="${$itemid}" data-commentid="${el['id']}" class="likeThisComment"></div><div class="comment-rating-cnt">${el['likes']}</div>
                  </div>
                  <div class="rating-dislike">
                      <div class="rating-btn-dislike"  data-uid="${$uid}" data-itemid="${$itemid}" data-commentid="${el['id']}" class="dislikeThisComment"></div><div class="comment-rating-cnt">${el['dislikes']}</div>
                  </div>
              </div>

            </div>`;

      if ($uid != '' && $title != '' && $link != '') {
        $html += `
                  <div class="comment-replay">
                  <button class="button button-replay" data-level="${el['level']}"  data-title="${$title}"  data-link="${$link}" data-itemid="${$itemid}" data-hide="1" data-uid="${$uid}" data-commentid="${el['id']}" >Ответить</button>
                  </div>
                  <div class="comment-childs-container" id="childsOf_${el['id']}">
                  </div>`;
      }

      if (el['ischild'] == 1) {
        $html += `<div class="comment-more-button" data-num="1" onclick="moreComments(this,${$itemid},'${$uid}','${$title}', '${$link}' )">
                <i class="fa fa-caret-down"></i> Показать ответы
                </div>
                `;
      }

      $html += ` </div>
                        </div>`;
      $box.appendChild(createElementFromHTML($html));
      $btnsreplays = document.querySelectorAll('.button-replay');
      $btnsreplays.forEach(el => {
        el.addEventListener('click', replay);
      });
      $btn.style.display = 'none';
      $allLikesBtns = document.querySelectorAll('.rating-btn-like');
      $allDislikesBtns = document.querySelectorAll('.rating-btn-dislike');
      $allLikesBtns.forEach(el => {
        el.addEventListener('click', likeThisComment);
      });
      $allDislikesBtns.forEach(el => {
        el.addEventListener('click', dislikeThisComment);
      });
    });
  }).catch(function (error) {
    // handle error
    console.log(error);
  }).then(function () {// always executed
  });
}

function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.innerHTML = htmlString.trim(); // Change this to div.childNodes to support multiple top-level nodes

  return div.firstChild;
}

function getComments($btn, $itemid) {
  let $box = document.querySelector('.coomments-block');
  axios.get('newcomments.php?offset=' + $offsetcomment + '&itemid=' + $itemid).then(function (response) {
    // handle success
    let data = response.data;
    console.log(data);
    data.forEach(el => {
      $html = ` 
                             <div class="comment non-auth" data-id="${el['id']}">
                                <a href="user.php?=${el['userid']}" class="comment-img"><img src="${el['img']}" alt="https://i.imgur.com/DZUsQ1I.jpg"></a>
                                <div class="comment-body">
                                    <div class="comment-top">
                                        <div><a href="users.php?id=${el['userid']}" class="comment-author">${el['username']}</a>
                                            <div class="comment-date" title="${el['time']}">${el['time']}</div>
                                        </div>
                                    </div>
                                    <div class="comment-text">${el['text']}</div>

                                    <div class="comment-karma">
                                        <div class="rating-like">
                                            <div class="rating-btn-like" data-uid="${$uid}" data-itemid="${$itemid}" data-commentid="${el['id']}" class="likeThisComment"></div><div class="comment-rating-cnt">${el['likes']}</div>
                                        </div>
                                        <div class="rating-dislike">
                                            <div class="rating-btn-dislike"  data-uid="${$uid}" data-itemid="${$itemid}" data-commentid="${el['id']}" class="dislikeThisComment"></div><div class="comment-rating-cnt">${el['dislikes']}</div>
                                        </div>
                                    </div>

                                </div>
                                <div class="comment-childs-container" id="childsOf_${el['id']}">
                                </div>
                                <div class="comment-more-button" data-num="1" onclick="moreComments(this, ${el['itemid']})">
                                    <i class="fa fa-caret-down"></i> Показать ответы (<span>1</span>)
                                </div>
                             </div>   `;
      $box.appendChild(createElementFromHTML($html));

      if (!data[0]) {
        $btn.style.display = 'none';
      }

      ;
      $allLikesBtns = document.querySelectorAll('.rating-btn-like');
      $allDislikesBtns = document.querySelectorAll('.rating-btn-dislike');
      $allLikesBtns.forEach(el => {
        el.addEventListener('click', likeThisComment);
      });
      $allDislikesBtns.forEach(el => {
        el.addEventListener('click', dislikeThisComment);
      });
    });
    $commentid += 1;
  }).catch(function (error) {
    // handle error
    console.log(error);
  }).then(function () {// always executed
  });
}

window.addEventListener('DOMContentLoaded', () => {
  $spoilersBtn = document.querySelectorAll('.spoiler-button');
  $spoilersBtn.forEach(el => {
    el.addEventListener('click', showSpoiler);
  });
  $btnsreplays = document.querySelectorAll('.button-replay');
  $btnsreplays.forEach(el => {
    el.addEventListener('click', replay);
  });
});

function showSpoiler() {
  this.style.display = 'none';
  this.nextSibling.style.display = 'inline-block';
}

function replay() {
  var $ishide = parseInt(this.getAttribute('data-hide'));
  var $commentid = this.getAttribute('data-commentid');
  var $dataUid = this.getAttribute('data-uid');
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $link = this.getAttribute("data-link");
  var $title = this.getAttribute("data-title");
  var $level = this.getAttribute("data-level");
  var $commentid = this.getAttribute("data-commentid");

  if ($ishide == 1) {
    $el = createElementFromHTML(`<textarea placeholder="Write something here..." class="replayCommentArea commentreplay-${$commentid}"></textarea>`);
    this.parentElement.prepend($el);
    sceditor.formats.bbcode.set('spoiler', {
      tags: {
        spoiler: null
      },
      allowsEmpty: false,
      allowedChildren: null,
      isSelfClosing: false,
      format: ' [spoiler]{0}[/spoiler] ',
      html: ' [spoiler]{0}[/spoiler] ',
      quoteType: sceditor.BBCodeParser.QuoteType.auto
    });
    sceditor.command.set('spoiler', {
      exec: function () {
        var editor = this;
        editor.wysiwygEditorInsertHtml('[spoiler]', '[/spoiler]');
      },
      txtExec: ['[spoiler]', '[/spoiler]'],
      tooltip: 'spoiler'
    });
    var textarea = document.querySelector('.commentreplay-' + $commentid);
    sceditor.create(textarea, {
      format: 'bbcode',
      resizeEnabled: false,
      height: '200px',
      width: '100%',
      autoUpdate: true,
      bbcodeTrim: true,
      fixInvalidNesting: true,
      toolbar: 'bold,italic,underline,emoticon,quote,link,time,spoiler,source',
      style: 'minified/themes/content/default.min.css'
    });
    this.setAttribute("data-hide", "0");
  } else {
    $text = document.querySelector('.commentreplay-' + $commentid).value;
    if ($text != '' && $text.length > 3 && $text.length < 1000) var data = new FormData();
    data.append('uid', $uid);
    data.append('text', $text);
    data.append('itemid', $itemid);
    data.append('link', $link);
    data.append('title', $title);
    data.append('level', $level);
    data.append('commentid', $commentid);
    axios.post('replayComment.php', data).then(response => {
      // 1. user with this uid does`n exist
      // 2. text must be higest then 3 and lower than 1000
      // 3. that item does`n exist
      // 4. all okey
      // 5  not all data exist
      $code = parseInt(response.data);

      if ($code == 1) {
        alert('user with this uid does`n exist');
      }

      if ($code == 2) {
        alert('text must be higest then 3 and lower than 1000');
      }

      if ($code == 3) {
        alert('that item does`n exist');
      }

      if ($code == 4) {
        location.reload();
      }

      if ($code == 5) {
        alert('not all data exist');
      }

      this.filter = response.data;
    }).catch(e => {
      this.errors.push(e);
    });
  }
}
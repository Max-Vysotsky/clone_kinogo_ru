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
var textarea = document.querySelector('.addCommentArea');
sceditor.create(textarea, {
  format: 'bbcode',
  resizeEnabled: false,
  height: '200px',
  autoUpdate: true,
  bbcodeTrim: true,
  fixInvalidNesting: true,
  toolbar: 'bold,italic,underline,emoticon,quote,link,time,spoiler,source',
  style: 'minified/themes/content/default.min.css'
});
$hidebox = true;
$addcommentBox = '';
$spoilersBtn = '';
window.addEventListener('DOMContentLoaded', () => {
  $addcommentBox = document.querySelector('.addcomment');
  document.querySelector('.addcomment');
  document.querySelector('#addcoment').addEventListener('click', showAddcomment);
  document.querySelector('.addcommentbtn').addEventListener('click', CreateComment);
});

function showAddcomment() {
  if ($hidebox) {
    $addcommentBox.style.display = 'block';
    $hidebox = false;
  }
}

function CreateComment() {
  $text = textarea.value;
  var data = new FormData();
  var $uid = this.getAttribute("data-uid");
  var $itemid = this.getAttribute("data-itemid");
  var $link = this.getAttribute("data-link");
  var $title = this.getAttribute("data-title");
  data.append('uid', $uid);
  data.append('text', $text);
  data.append('itemid', $itemid);
  data.append('link', $link);
  data.append('title', $title);
  axios.post('msgcreate.php', data).then(response => {
    //if 1 all okey 
    //if 2 all bad
    if (response.data == 1) {
      location.reload();
    }

    this.filter = response.data;
  }).catch(e => {
    this.errors.push(e);
  });
}
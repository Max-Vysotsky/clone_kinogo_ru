$slidernum = 1;
$slifeLeftBtn = '';
$slifeRightBtn = '';
$SlideblockOne = '';
$SlideblockTwo = '';
window.addEventListener('DOMContentLoaded', () => {
  $slifeLeftBtn = document.querySelector('.carousel__left');
  $slifeRightBtn = document.querySelector('.carousel__right');
  $SlideblockOne = document.querySelectorAll('.carousel__block')[0];
  $SlideblockTwo = document.querySelectorAll('.carousel__block')[1];
  $slifeLeftBtn.addEventListener('click', sliderLeft);
  $slifeRightBtn.addEventListener('click', sliderRight);
  $notwork = document.querySelector('#notWork');
  $notwork.addEventListener('click', notworking);
});

function sliderLeft() {
  if ($slidernum == 2) {
    $SlideblockTwo.style.display = 'none';
    $SlideblockOne.style.display = 'flex';
    $slidernum = 1;
  }
}

function sliderRight() {
  if ($slidernum == 1) {
    $SlideblockOne.style.display = 'none';
    $SlideblockTwo.style.display = 'flex';
    $slidernum = 2;
  }
}

function notworking() {
  alert('мы понили щас все сделаем');
}
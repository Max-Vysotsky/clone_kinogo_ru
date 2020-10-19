<?php 
 if(isset($_COOKIE['uid']))
  {
require_once('../db.php'); 
if($admin = R::find( 'user', ' `uid`  = ? ', [ $_COOKIE['uid'] ] ) ) 
  {
    $admin = array_shift( $admin);
    $admin = $admin->export();
    if(isset($admin['isadmin']))
    {
      $title = $_POST['title'];
      $year = $_POST['year'];
      $text = $_POST['text'];
      $countyes = $_POST['countyes'];
      $genders = json_encode($_POST['genders']);
      $quality = $_POST['quality'][0];
      $type = $_POST['type'][0];
      $typefield = 'isanime';
      if($type  == 2)
        $typefield = 'istv';
      if($type  == 3)
        $typefield = 'isfilm';
      if($type  == 4)
        $typefield = 'ismult';
      if($type  == 5)
        $typefield = 'isserial';

      $duratation = (int) $_POST['duratation'];
      $thumbnail = $_POST['thumbnail'];
      $actors = json_encode($_POST['actors']);
      $link = $_POST['link'];
      $videourl = $_POST['videourl'];
      $eng =[
            'Biografii',
            'Boeviki',
            'Vesterni',
            'Voennie',
            'Detektivi',
            'Dokumentalynie',
            'Drami',
            'Istoricheskie',
            'Komedii',
            'Kriminal',
            'Melodrami',
            'Mulytfilymi',
            'Myuzikli',
            'Priklyucheniya',
            'Semeynie',
            'Cportivnie',
            'Trilleri',
            'Uzhasi',
            'Fantastika',
            'Fentezi',
            'anime',
        ];
        $rus =[
            'Биография',
            'Боевик',
            'вестерн',
            'Военный',
            'Детектив',
            'Документальные',
            'Драма',
            'Исторический',
            'Комедия',
            'Криминал',
            'Мелодрама',
            'Мультфильмы',
            'Мюзикл',
            'Приключения',
            'Семейный',
            'Спортивный',
            'Триллер',
            'Ужасы',
            'Фантастика',
            'Фэнтези',
            'аниме',
        ];
        $genders = str_replace($eng,  $rus, $genders);
      R::exec('INSERT INTO `item` ( `title`, `year`, `text`,  `countryes`, `genders`, `quality`, `duratation`, `thumbnail`,  `actors`,  
        '.$typefield.', `link`, `videourl`, `ismaked`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',[$title,$year,$text,$countyes,$genders,$quality,$duratation,$thumbnail,$actors,$type,$link,$videourl,1]);
      header('Location: /admin');
    }
}
}
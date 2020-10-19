<?php 
require_once('../includes/rb.php');
set_time_limit (0);

R::setup('mysql:host=127.0.0.1;dbname=kinogo_ru', 'root', 'toor');

R::freeze(true); // when thid code in production turn on.

if ( !R::testConnection() )
{
  die('can`t to connect to database');
}
for ($i= 5; $i <= 41; $i++) {

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://kinogo.by/tv/page/$i/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // store instent show in client
//  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: kinogo.by';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: none';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Cookie: __cfduid=de4e4fc068aff37c82f31dc2bef61de7f1598990413; mobi=nomobile; PHPSESSID=me31pcoa1lu4ghbb8spijnset6';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result =  iconv("Windows-1251", "UTF-8", curl_exec($ch)); // convert Windows-1251 to UTF-8


$movie = array();


if(preg_match_all('!\<b\>Продолжительность:\<\/b\>\s(\d*).*?(\<br\>|\<span)\s!',$result,$match))
{
 // print_r($match);die();
foreach ($match[1] as $key => $value) {
  $movie['duratation'][$key] = (int) $value;
}
$match = '';
}else{
  echo "page number  $i and row num $key duratation is 0";
}




//////////////////////////////////preg movie title
preg_match_all('!\<h2 class="zagolovki"\>\<a aria-label="(.*?)"!',$result,$match);
$movie['title'] = $match[1];
$match = '';
preg_match_all('!\<h2 class="zagolovki"\>\<a aria-label=".*?" href="(.*?)"\>!',$result,$match);
$movie['templink'] = $match[1];
foreach ($match[1] as $key => $value) {
  preg_match_all('!https:\/\/kinogo.by\/(.*)\.html!',$value,$matchLink);
  $matchl[$key] = $matchLink[1][0];
}
$movie['link'] = $matchl;
$match = '';
///////////////////////////////////////////
preg_match_all('!\<div id="news-id-\d*" style="display:inline;">(.*?)<\/div>!',$result,$match);
 $movie['text'] = $match[1];
$match = '';
preg_match_all('!\<\/div>\<br>\<br>\s\<b\>Год выпуска:\<\/b\>\s\<a href=".*?"\>(\d{4})!',$result,$match);
$movie['year'] = $match[1];
$match = '';

preg_match_all('!<\/div\><br\>\<br\>\s<b>Год выпуска:\<\/b\>\s\<a href=".*?"\>.*\s\<b\>Страна:\<\/b\>\s(.*)\<br\>!',$result,$match);
$movie['country'] = $match[1];
$match = '';




//start grab element
preg_match_all('!\<b\>Жанр:\<\/b\>\s\<a\s(.*)!',$result,$match);
$elements = $match[0];
$match = '';

foreach ($elements as $key => $value) {
 
  preg_match_all('!\<a\s?href="(https:\/\/kinogo.by\/(serial|film|anime|tv|mult).*?)"\>(.*?)\<\/a\>!',$value,$match);
  $movie['genders'][$key]['links'] = $match[1];
  $movie['genders'][$key]['titles'] = $match[3];

  // add genders
   // $countOfLinks = count($movie['genders'][$key]['links']);
   // $countOfTitles = count($movie['genders'][$key]['titles']);
   // $movie['genders'][$key]['links'][$countOfLinks + 1]   = 'https://kinogo.by/film/dokumentalnye/';
   // $movie['genders'][$key]['titles'][$countOfTitles + 1] = 'Документальные';


  $match = '';

  $movie['isserial'][$key] = (preg_match_all('!\<a\s?href="https:\/\/kinogo.by\/serial.*"\>.*\<\/a\>!',$value,$match)) ? 1 : 0;
  $movie['isanime'][$key] = (preg_match_all('!\<a\s?href="https:\/\/kinogo.by\/anime.*"\>.*\<\/a\>!',$value,$match)) ? 1 : 0;
  $movie['istv'][$key] = (preg_match_all('!\<a\s?href="https:\/\/kinogo.by\/tv.*"\>.*\<\/a\>!',$value,$match)) ? 1 : 0;
  $movie['isfilm'][$key] = (preg_match_all('!\<a\s?href="https:\/\/kinogo.by\/film.*"\>.*\<\/a\>!',$value,$match)) ? 1 : 0;
  $movie['ismult'][$key] = (preg_match_all('!\<a\s?href="https:\/\/kinogo.by\/mult.*"\>.*\<\/a\>!',$value,$match)) ? 1 : 0;

}

//end of grab element


preg_match_all('!\<b\>Качество:\<\/b\>(.*?)(\<br\>|\<span)\s!',$result,$match);
$movie['quality'] = $match[1];
$match = '';


preg_match_all('!\<img src="\/templates\/Kinogo\/images\/eye.png" alt="Просмотров (\d*?)">!',$result,$match);

foreach ($match[1] as $key => $value) {
  $match[1][$key] = (int) $match[1][$key];
}

$movie['views'] =  $match[1];
$match = '';


if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);



















foreach ($movie['templink'] as $key => $value) {
  $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $value);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // store instent show in client
//  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: kinogo.by';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: none';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Cookie: __cfduid=de4e4fc068aff37c82f31dc2bef61de7f1598990413; mobi=nomobile; PHPSESSID=me31pcoa1lu4ghbb8spijnset6';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result2 =  iconv("Windows-1251", "UTF-8", curl_exec($ch)); // convert Windows-1251 to UTF-8

  if(preg_match_all('!\<img src="(\/uploads\/cache\/.*\.(jpg|png))" width="200" height="300" style="float:left;" alt=".*" title=""\>!',$result2,$match))
  {
     $movie['thumbnail'][$key] = 'https://kinogo.by' . $match[1][0];
  }else{
    preg_match_all('!\<img alt=".*" src="(\/uploads\/cache\/.*\.(jpg|png))" width="200" height="300" style="float:left;"\>!',$result2,$match);
     $movie['thumbnail'][$key] = 'https://kinogo.by' . $match[1][0];
  }
  $match = '';

    preg_match_all('!\<b\>Режиссер:\<\/b\>.\<a href="\/tags\/.*\/">(.*)\<\/a\>\<br\>!',$result2,$match);
    if (isset($match[1][0])) {
      # code...
    
  $movie['producer'][$key] = $match[1][0];
  $match = '';
}else{
  break;//network error
}
   preg_match_all('!\<a href="\/tags\/.*?\/">(.*?)\<\/a\>[^\<]!',$result2,$match);
   foreach ($match[1] as $key2 => $value) {
    $match[1][$key2] = '<span class="actor">'. $value .'</span>';
   }
  $movie['actors'][$key] = $match[1];
  $match = '';
//////////////////////////////////////////
  preg_match_all('!data-comm_id="0" data-like=".*" data-dislike=".*"\>\<div class="comment-rating-like"\>\<div class="comment-rating-btn" data-action="like"\>\<\/div\>\<div class="comment-rating-cnt"\>(.*)\<\/div\>\<\/div\>\<div class="comment-rating-dislike"\>\<div class="comment-rating-btn" data-action="dislike"\>\<\/div\>\<div class="comment-rating-cnt"\>(.*)\<\/div\>\<\/div\>\<\/div\>!',$result2,$match);
  $movie['likes'][$key] = (int)$match[1][0];
  $movie['dislikes'][$key] = abs((int)$match[2][0]);
  $match = '';

  if ( $movie['isserial'][$key] || $movie['isanime'][$key] || $movie['istv'][$key]) {
    preg_match_all('! var player1 = new Playerjs.*\s.*\s.*\s*.*\s*.*\s*.*\s*.*\s!',$result2,$match);
    $movie['videojsconf'][$key] = $match[0][0];
    $match = '';
  }else{
     preg_match_all('!var fmp4 .*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*!',$result2,$match);
     if (isset($match[0][0])) {
        $movie['videojsconf'][$key] = $match[0][0];
     }
    $match = '';
  }
  

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

if ( preg_match_all('!\<b\>Продолжительность:\<\/b\>\s(\d{2}):(\d{2}):(\d{2}).*?(\<br\>|\<span)\s!',$result2,$match)) {
  $h= (intval($match[1][0]) * 60) * 60;
  $m= intval($match[2][0]) * 60;
  $s= intval($match[3][0]);
  $alls= $h + $m + $s;
  $allm  = intval( $alls/60);
  $movie['duratation'][$key] = (int) $allm ;
}

if ($movie['duratation'] === null) {
 $movie['duratation'][$key] = 0;
}

curl_close($ch);

}
$id = 0;


//  print_r($movie);die;

 foreach ($movie['title'] as $key => $value) { 
    //if not network error
    if (isset($movie['year'][$key])    && isset($movie['actors'][$key]) && isset($movie['country'][$key]) ) {
        # code...
      
      $bean = R::dispense( 'item' );

      $bean->title = $movie['title'][$key];
      $bean->text = $movie['text'][$key];
      $bean->year = $movie['year'][$key];
      $bean->countryes = $movie['country'][$key];

      $bean->genders = json_encode($movie['genders'][$key]);
      $bean->isserial = $movie['isserial'][$key];
      $bean->isanime = $movie['isanime'][$key];
      $bean->istv = $movie['istv'][$key];
      $bean->isfilm = $movie['isfilm'][$key];
      $bean->ismult = $movie['ismult'][$key];
      $bean->quality = str_replace(' ', '', $movie['quality'][$key]);
      if (isset($movie['duratation'][$key])) {
        $bean->duratation = $movie['duratation'][$key];
      }
      $bean->views = $movie['views'][$key];
      $bean->thumbnail = $movie['thumbnail'][$key];
      $bean->producer = $movie['title'][$key];
      $bean->actors = json_encode($movie['actors'][$key]);
      $bean->likes = $movie['likes'][$key];
      $bean->dislikes = $movie['dislikes'][$key];
      $bean->videojsconf = $movie['videojsconf'][$key];
      $bean->link = $movie['link'][$key];

      $id = R::store( $bean );
     echo 'page is ' . $i . ' ';
    }
  }
}
echo $id ;

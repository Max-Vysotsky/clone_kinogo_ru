<?php 

function getNewjsConf($isserial,$isanime,$istv,$link){
  $jsconf;
   $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://kinogo.by/".$link.".html");
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

 $doc =  iconv("Windows-1251", "UTF-8", curl_exec($ch)); // convert Windows-1251 to UTF-8

  if ( $isserial ||  $isanime ||  $istv  ) {
    preg_match_all('! var player1 = new Playerjs.*\s.*\s.*\s*.*\s*.*\s*.*\s*.*\s!',$doc,$match);
    $jsconf = $match[0][0];
    $match = '';
  }else{
     preg_match_all('!var fmp4 .*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*\s*.*!',$doc,$match);
    $jsconf = $match[0][0];
    $match = '';
  }

  return  $jsconf ;
}



function getgenders($txt)
{ 
      $genders = json_decode($txt, true);
    foreach ($genders['links'] as $key => $value) {
          $gender['link'] = $genders['links'][$key];
          preg_match_all('!https:\/\/kinogo\.by\/(film\/|serial\/|)(.*)\/!', $gender['link'], $matches);
          $gender['link'] = $matches[2][0];
          $gender['title'] = $genders['titles'][$key];
          if ( isset($genders['titles'][$key + 1]) ) {
            $separator = ', ';
          }else{
            $separator = ', ';
          }
            echo '<a href="' . 'item.php?whereGender=' . $gender['link'] .'" class="desc__list__link">' . $gender['title'] . '</a>' . $separator;
          } 
}

function getDownloadFilmArray($conf)
{
  $arr = array();
  preg_match_all('!(https:\/\/cdn1\.kinogo\.by\/movies\/.*?\/240\.mp4)\sor\sh!', $conf, $matches);
  $arr['240'] = $matches[1][0];

  preg_match_all('!\[480p\](https:\/\/cdn1\.kinogo\.by\/movies\/.*?\/360\.mp4)\sor\sh!', $conf, $matches);
  $arr['360'] = $matches[1][0];

  preg_match_all('!\[720p](https:\/\/cdn1\.kinogo\.by\/movies\/.*?\/480\.mp4)\sor\sh!', $conf, $matches);
  $arr['480'] = $matches[1][0];

  if(preg_match_all('!\[1080p](https:\/\/cdn1\.kinogo\.by\/movies\/.*?\/720\.mp4)\sor\sh!', $conf, $matches))
  {
  $arr['720'] = $matches[1][0];

  }
  return $arr;
}


function deleteCookie($nameOfcookie)
{
  if (isset($_COOKIE[$nameOfcookie])) 
  {
    unset($_COOKIE[$nameOfcookie]);
    setcookie($nameOfcookie, '', time() - 3600, '/'); // empty value and old timestamp
    return true;
  }
    return false;
}

function console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('". $output . "');</script>";
}

function bbcodeParse($text)
{
   $composer = trim(__DIR__,'includes').'vendor\autoload.php';
    require_once($composer);
    $bbCode = new Genert\BBCode\BBCode();


// Add "[link target=http://example.com]Example[/link]" parser.
$bbCode->addParser(
    'custom-link',
    '!\[spoiler\](.*)\[\/spoiler\]!s',
    '<button class="spoiler-button button">Спойлер!</button><spoiler style="display:none;" >$1</spoiler>',
    '$1'
);
return $bbCode->convertToHtml($text);
}
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 require_once('db.php');
 // если в куки есть токен то берем с него и говорим что вы уже заригесртированыы на сервере такая же проверка
 $token = openssl_random_pseudo_bytes(16) ;
 
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);
 
//Print it out for example purposes.
$token = strtoupper(  $token .rand(10000,99999). uniqid() );
$ip ;
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  clear cache -->
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
    <!--  clear cache -->
    <title>KinoGo</title>
    <link rel="stylesheet" href="static/css/reset.css">
    <link rel="stylesheet" href="static/css/main.css">
</head>
<body>
     <?php require('includes/header.php'); ?>
   <?php require('includes/navigation.php'); ?>
    <main class="main-main">
        <div class="container">
            <div class="main-wrap">
                 <?php   require('includes/navigationPanel.php'); ?>
                 <script src="static/js/sugn-up.js"></script>
                <div class="side-right gray-color sign-up">
                  <?php if (isset($_COOKIE['uid'])) {
                    ?>
                    <h1>Вы уже зарегистрированы</h1>
                 <?php }else{ ?>
                      <h1>Регистрация нового пользователя</h1>
                      <p class="m5all">Условия регистраци:</p>
                      <ol class="sign-up-list">
                          <li>Все поля - обязательные</li>
                          <li>Вводите только рабочий корректный e-mail, он используется для восстановления пароля</li>
                          <li>Ник должен быть уникальным в пределах сайта, минимальная длина 3 символа, максимальная - 13
                              символов, можно использовать нижнее подчеркивание, дефис, латиницу и кириллицу (русские буквы)
                          </li>
                          <li>Не рекомендуем использовать в нике спецсимволы, если они будут мешать (в чате или комментариях),
                              администратор будет в праве их убрать.
                          </li>
                      </ol>
                      <p>После заполнения формы вам на e-mail придет письмо с подтверждением.</p>

                      <form action="ajax/register.php" method="post"  id="sign-up">
                          <input type="hidden" name="token" value="<?php echo $token ?>">
                          <input type="hidden" name="ip" value="<?php echo $ip ?>">
                          <div class="form-cell">
                            <label for="check-email">Ваш рабочий e-mail</label>
                              <input id="check-email" autocomplete="off"" name="email" type="email">
                          </div>
                           <div class="form-cell">
                            <label for="nickname">Ваш ник</label>
                              <input id="nickname" name="nickname" type="text">
                          </div>
                          <div class="form-cell">
                            <label for="login-input">Ваш логин</label>
                            <div class="flex-column">
                              <div class="wrap">
                              <input id="login-input" autocomplete="off" name="login" type="text">
                              <div class="checklogin form-btn">Проверить логин</div>
                            </div>
                              <div id="result"></div>
                            </div>
                          </div>
                          <div class="form-cell">
                            <label for="password">Ваш пароль</label>
                              <input id="password" name="password" type="password">
                          </div>
                          <div class="form-cell">
                            <label for="password_repeat">Повторите пароль</label>
                              <input id="password_repeat"  name="password_repeat" type="password">
                          </div>
                          <div class="form-cell">
                            <input id="password_repeat"  name="isfromform" type="hidden" value="yes">
                              <input class="form-btn regup-btn" type="submit" value="Зарегистрироваться">
                              <div id="errors"></div>
                          </div>
                      </form>
                </div>
              <?php } ?>
            </div>
        </div>
    </main>
   <?php require('includes/footer.php'); ?>
</body>

</html>
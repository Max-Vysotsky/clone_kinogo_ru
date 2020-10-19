<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<?php if ( !isset($_COOKIE['uid']) ) { ?>

 <script src="/static/js/sign-in.js"></script>

<?php } ?>
<header class="main-header">
        <div class="container flex-betw">
            <a href="/" class="logo"><img src="https://kinogo.by/templates/Kinogo/images/logo.png" alt="KinoGo_Ru" class="logoimg"></a>
            <div class="auth">
              <?php if (!isset($_COOKIE['uid'])) {?>
                <a href="/log-in" class="log-in">Вход</a>
                <a href="/sign-up.php#sign-up" class="log-up">Регистрация</a>

                <form id="login-form" method="post" action="">
                  <label for="login_name">Логин: </label>
                  <input class="login-input" type="text" name="login_name" id="login_name" style="width: 60px;">

                  <label for="login_password">Пароль (<a href="/index.php?do=lostpassword">Забыли?</a>): </label>
                  <input  class="login-input" type="password" name="login_password" id="login_password" style="width: 60px;">&nbsp;

                  <button class="fbutton2 submitsearch-input form-btn"  type="submit" title="Войти"><span>Войти</span></button>
                  <input name="login" type="hidden" id="login" value="submit">
                </form>
              <?php }else{ ?>
                  <div class="login-box">
                <?php if($user = R::find( 'user', ' `uid`  = ? ', [ $_COOKIE['uid'] ] ) ) 
                      {
                        $user = array_shift( $user);
                        $user = $user->export();
                        if($user['isadmin'] == 1)
                        {
                          echo '<a href="/admin/" class="adminPanel m10">Админка</a>';
                        }
                      }
                ?>
                <a href="/profile.php" class="m10">Профиль</a>
                <a href="/logout.php" class="logout m10">Выйти</a>
              </div>
              <?php } ?>
                <form action="/results.php" method="get">
                    <input type="text" placeholder="поиск" class="search-input" name="search_query">
                    <input type="submit" value="оk" class="form-btn ml5">
                </form>
            </div>
        </div>
    </header>
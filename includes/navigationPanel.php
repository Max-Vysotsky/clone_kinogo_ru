<div class="side-left">
                <div class="sub-nav left-block">
                    <div class="sub-nav__top left-block__top">
                        <span class="bold">Панель навигации</span>
                    </div>
                    <div class="sub-nav-flex">
                        <div class="side_left">
                            <div class="sub-nav__main left-block__main">
                                <div class="sub-nav__main_top bold">Категории</div>
                                <div class="side-left categories">
                                    <ul class="categories-list">
                                      <?php 
                                        $url = preg_replace('!kinogo\.ru(.*)!','',__DIR__) . 'kinogo.ru\db.php';
                                      require_once($url);
                                         $counters = R::getAll( 'SELECT count FROM `genders` ' );
                                       ?>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Biografii" class="sub-link">Биографии</a><span class="sub-nav__count">(<?php echo $counters[0]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Boeviki" class="sub-link">Боевики</a><span class="sub-nav__count">(<?php echo $counters[1]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Vesterni" class="sub-link">Вестерны</a><span class="sub-nav__count">(<?php echo $counters[2]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Voennie" class="sub-link">Военные</a><span class="sub-nav__count">(<?php echo $counters[3]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Detektivi" class="sub-link">Детективы</a><span class="sub-nav__count">(<?php echo $counters[4]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Dokumentalynie" class="sub-link">Документальные</a><span class="sub-nav__count">(<?php echo $counters[5]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Drami" class="sub-link">Драмы</a><span class="sub-nav__count">(<?php echo $counters[6]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Istoricheskie" class="sub-link">Исторические</a><span class="sub-nav__count">(<?php echo $counters[7]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Komedii" class="sub-link">Комедии</a><span class="sub-nav__count">(<?php echo $counters[8]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Kriminal" class="sub-link">Криминал</a><span class="sub-nav__count">(<?php echo $counters[9]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Melodrami" class="sub-link">Мелодрамы</a><span class="sub-nav__count">(<?php echo $counters[10]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Mulytfilymi" class="sub-link">Мультфильмы</a><span class="sub-nav__count">(<?php echo $counters[11]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Myuzikli" class="sub-link">Мюзиклы</a><span class="sub-nav__count">(<?php echo $counters[12]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Priklyucheniya" class="sub-link">Приключения</a><span class="sub-nav__count">(<?php echo $counters[13]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Semeynie" class="sub-link">Семейные</a><span class="sub-nav__count">(<?php echo $counters[14]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Cportivnie" class="sub-link">Cпортивные</a><span class="sub-nav__count">(<?php echo $counters[15]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Trilleri" class="sub-link">Триллеры</a><span class="sub-nav__count">(<?php echo $counters[16]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Uzhasi" class="sub-link">Ужасы</a><span class="sub-nav__count">(<?php echo $counters[17]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Fantastika" class="sub-link">Фантастика</a><span class="sub-nav__count">(<?php echo $counters[18]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=Fentezi" class="sub-link">Фэнтези</a><span class="sub-nav__count">(<?php echo $counters[19]['count'] ?>)</span></li>
                                        <li class="sub-nav__item"><a href="/film.php?gender=anime" class="sub-link">Аниме</a><span class="sub-nav__count">(<?php echo $counters[20]['count'] ?>)</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ad-div"></div>
                <div class="left-block last-comments">
                    <div class="last-comments left-block__top">
                        <span class="bold">Последние комментарии</span>
                    </div>
                    <div class="left-block__main last-comments">
                        <?php  $comments = R::getAll( 'SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 12' ); 
                        foreach ($comments as $key => $comment) {
                        ?>
                        <article class="last-comments__item comment">
                            <a href="<?php echo 'item.php?id='.$comment['link'] ?>" class="noneDecor">
                                <h2 class="comment__title bold"><?php echo $comment['title'] ?></h2>
                            </a>
                            <p class="comment__text"><a href="user.php?id=<?php echo $comment['userid'] ?>" class="comment__user"><?php echo $comment['username'] ?></a><span class="comentDelimeter"> : </span><?php echo mb_strimwidth(bbcodeParse($comment['text']), 0, 587, " ...") ?></p>
                        </article>
                      <?php } ?>
                    </div>
                </div>
            </div>
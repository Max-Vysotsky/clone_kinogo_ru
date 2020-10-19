<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>

<div class="navigation">
        <div class="container">
            <div class="navigation__top">
                <span> </span>
                <nav class="nav">
                    <ul>
                        <li><a href="/" class="nav-item">главная</a></li>
                        <li><a href="/serial/" class="nav-item">сериалы</a></li>
                        <li><a href="/anime/"" class="nav-item">аниме</a></li>
                        <li><a href="/mult/"" class="nav-item">мульт</a></li>
                        <li><a href="/tv/"" class="nav-item">tv</a></li>
                    </ul>
                </nav>
            </div>
            <div class="navigation__main">
                <div class="navigation__carousel carousel">

                    <div class="carousel__block">
                      <?php  $slides = R::getAll( 'SELECT * FROM `carousel` ORDER BY `id`' ); 
                            for ($i=0; $i < 14; $i++) { $slide = $slides[$i] ?>
                              <div class="carousel__slide">
                                  <a href="/<?php echo 'item.php?id='.$slide['link'] ?>">
                                    <?php 
                                    // $img;
                                    //    if (getimagesize($slide['thumbnail'])) {
                                    //        $img = $slide['thumbnail'] ;
                                    //       }  else{
                                    //        preg_match_all('https:\/\/kinogo\.by\/uploads\/cache\/.\/.\/.\/.\/.\/.\/.\/.\/.\/(.*)-.*\.(.*)', $slide['thumbnail']  ,$match);
                                    //        print_r($match);die();
                                    //       }
                                     ?>
                                      <img src="<?php echo  $slide['thumbnail'] ?>" alt="<?php echo $slide['title'] ?>" width="128px" height="190px">
                                  </a>
                              </div>
                            <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>  
        $('.carousel__block').slick({
  infinite: true,
  slidesToShow: 7,
  slidesToScroll: 7
});
    </script> 
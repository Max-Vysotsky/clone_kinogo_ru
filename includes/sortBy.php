
<div class="sortingBy">
  <span>Сортировать по :</span>
  <ul class="sortmenu">
    <?php if( $NumOfSortingMethod == 1){ ?>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[1].$adddesc ?>" class="sortmenu__link"> <img src="https://kinogo.by/templates/Kinogo/dleimages/desc.gif" alt=" ">дате </li></a> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[2]?>" class="sortmenu__link">рейтингу</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[3]?>" class="sortmenu__link">посещаемости</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[4]?>" class="sortmenu__link">комментариям</a> </li>
    <?php }elseif( $NumOfSortingMethod == 2){ ?>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[1]?>" class="sortmenu__link"> <img src="https://kinogo.by/templates/Kinogo/dleimages/desc.gif" alt=" ">дате </li></a> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[2].$adddesc ?>" class="sortmenu__link">рейтингу</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[3]?>" class="sortmenu__link">посещаемости</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[4]?>" class="sortmenu__link">комментариям</a> </li>
    <?php }elseif( $NumOfSortingMethod == 3){ ?>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[1]?>" class="sortmenu__link"> <img src="https://kinogo.by/templates/Kinogo/dleimages/desc.gif" alt=" ">дате </li></a> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[2]?>" class="sortmenu__link">рейтингу</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[3].$adddesc?>" class="sortmenu__link">посещаемости</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[4]?>" class="sortmenu__link">комментариям</a> </li>
     <?php }elseif( $NumOfSortingMethod == 4){ ?>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[1]?>" class="sortmenu__link"> <img src="https://kinogo.by/templates/Kinogo/dleimages/desc.gif" alt=" ">дате </li></a> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[2]?>" class="sortmenu__link">рейтингу</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[3]?>" class="sortmenu__link">посещаемости</a> </li> <span class="delimeter"> | </span>
    <li class="sortmenu__item"><a href="<?php echo $nameOfFileForSort. $sortingMethod[4].$adddesc ?>" class="sortmenu__link">комментариям</a> </li> 
    <?php } ?>
  </ul>
</div>
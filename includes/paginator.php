<?php if ($AllPages != 1) {
?>

<?php if ($isfirstPage) {
  ?>
    <div class="paginator">
      <span class="pagintor__item prev notavaible">Предыдущая</span>
      <div class="paginator__main">
        <ul class="paginator__list">
          <li class="pagintor__item notavaible">
            <span class="pagintor__link "><?php echo $pageNumber ?></span>
          </li>
          <?php for ($i=2; $i <=   $maxPaginatorItems; $i++) { 
              $pageLink = $fileWithNumber .$i;
          ?>
          <li class="pagintor__item">
            <a href="<?php echo $pageLink ?>" class="paginator__link"><?php echo $i ?></a>
          </li>
         <?php } ?>
          <li class="pagintor__item">
             <a href="<?php echo$fileWithNumber . $AllPages?>" class="paginator__link"><?php echo $AllPages ?></a>
           </li>
        </ul>
      </div>
      <a href="<?php echo $nextPage ?>" class="next pagintor__item">Следующая</a>
    </div>
  <?php
} ?>

<?php if ($pageNumber < 7 && $pageNumber != 1) {
  ?>
    <div class="paginator">
       <a href="<?php echo $prevPage ?>" class="next pagintor__item">Предыдущая</a>
      <div class="paginator__main">
        <ul class="paginator__list">
     
          <?php for ($i=1; $i < $pageNumber; $i++) { 
              $pageLink = $fileWithNumber .$i;
          ?>
          <li class="pagintor__item">
            <a href="<?php echo $pageLink ?>" class="paginator__link"><?php echo $i ?></a>
          </li>
         <?php } ?>

         <li class="pagintor__item notavaible">
            <span class="pagintor__link "><?php echo $pageNumber ?></span>
          </li>

         <?php for ($i=$pageNumber+1; $i <=   $maxPaginatorItems; $i++) { 
                $pageLink = $fileWithNumber .$i;
          ?>
              <li class="pagintor__item">
                <a href="<?php echo $pageLink ?>" class="paginator__link"><?php echo $i ?></a>
              </li>
         <?php } ?>
          <li class="pagintor__item notavaible">
            <span class="pagintor__link ">...</span>
          </li>
          <li class="pagintor__item">
             <a href="<?php echo $lastPage?>" class="paginator__link"><?php echo $AllPages ?></a>
           </li>
        </ul>
      </div>
      <a href="<?php echo $nextPage ?>" class="next pagintor__item">Следующая</a>
    </div>
  <?php
} ?>

<?php if ($pageNumber >= 7 ) {
  ?>
    <div class="paginator">
       <a href="<?php echo $prevPage ?>" class="next pagintor__item">Предыдущая</a>
      <div class="paginator__main">
        <ul class="paginator__list">
           <li class="pagintor__item">
             <a href="<?php echo $firstPage?>" class="paginator__link"><?php echo 1 ?></a>
           </li>

          <li class="pagintor__item notavaible">
            <span class="pagintor__link ">...</span>
          </li>

          <?php for ($i=$pageNumber-4; $i < $pageNumber; $i++) { 
              $pageLink = $fileWithNumber .$i;
          ?>
          <li class="pagintor__item">
            <a href="<?php echo $pageLink ?>" class="paginator__link"><?php echo $i ?></a>
          </li>
         <?php } ?>

         <li class="pagintor__item notavaible">
            <span class="pagintor__link "><?php echo $pageNumber ?></span>
          </li>
          <?php if(!($pageNumber == $AllPages)){ ?>
         <?php for ($i=$pageNumber+1; $i <=   $pageNumber+4; $i++) { 
                $pageLink = $fileWithNumber .$i;
          ?>
              <li class="pagintor__item">
                <a href="<?php echo $pageLink ?>" class="paginator__link"><?php echo $i ?></a>
              </li>
         <?php } ?>

          <?php if(!($pageNumber > $AllPages - 4)){ ?>
          <li class="pagintor__item notavaible">
            <span class="pagintor__link ">...</span>
          </li>
        <?php } ?>
          <li class="pagintor__item">
             <a href="<?php echo $lastPage?>" class="paginator__link"><?php echo $AllPages ?></a>
           </li>
         <?php } ?>
        </ul>
      </div>
      <?php if(!($pageNumber == $AllPages)){ ?>
      <a href="<?php echo $nextPage ?>" class="next pagintor__item">Следующая</a>
    <?php }else{ ?>
       <span class="pagintor__item next notavaible">Следующая</span>
    <?php } ?>
    </div>
  <?php
} ?>

<?php } ?>
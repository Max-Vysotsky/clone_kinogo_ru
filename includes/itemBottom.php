 <?php if($isfilm){ ?>
 <div class="item__bottom isdownloadBox <?php if($isfilm) { echo 'ml-20'; } ?>">
  <?php }else{ ?>
 <div class="item__bottom ">
    <?php } ?>
    <div class="item__bottom-wrap flex">
        <button class="button " id="addcoment">Добавить комментарий</button>
        <span class="item__bottom-count" title="<?php  if($item['views'] == 0){echo 0;}else{echo $item['views'];} ?> просмотров"><img src="https://kinogo.by/templates/Kinogo/images/eye.png" alt="Просмотров "><?php  if($item['views'] == 0){echo 0;}else{echo $item['views'];} ?></span>
        <span class="item__bottom-count" title="<?php  if($item['comentsCount'] == 0){echo 0;}else{echo $item['comentsCount'];} ?> просмотров"><img src="https://kinogo.by/templates/Kinogo/images/mail.png" alt="Коментариев "><?php  if($item['comentsCount'] == 0){echo 0;}else{echo $item['comentsCount'];} ?></span>
         <?php if($item['isfilm'] == 1 || $item['ismult'] == 1){ ?>
         <div class="video__download-div download">
            <span>Скачать</span>
            <ul class="download-list">
                <li class="download-list__item"><a class="download-list__link" href="<?php echo $item['downloadlinks']['240'] ?>" download>240p</a></li>
                <li class="download-list__item"><a class="download-list__link" href="<?php echo $item['downloadlinks']['360'] ?>" download="">360p</a></li>
                <li class="download-list__item"><a class="download-list__link" href="<?php echo $item['downloadlinks']['480'] ?>" download>480p</a></li>
                <li class="download-list__item"><a class="download-list__link" href="<?php echo $item['downloadlinks']['720'] ?>" download>720p</a></li>
            </ul>
        </div>
      <?php }else{ ?>
        <div class="sirial-share">
            <a rel="noopener" href="https://vk.com/kinogo_by" target="_blank"><button class="fbutton_vk">VK</button></a>
            <a rel="noopener" href="https://www.youtube.com/channel/UCGFEPjKJ1WRffxDeSS3r6Tg?sub_confirmation=1" target="_blank"><button class="fbutton_you">YouTube</button></a>
            <a rel="noopener" href="https://t.me/kinogoby" target="_blank"><button class="fbutton_telega">Telegram</button></a>
            <a rel="noopener" href="https://instagram.com/kinogoby/" target="_blank"><button class="fbutton_insta">Instagram</button></a>
        </div>
      <?php } ?>
        <div class="doesnotworking">
            <button class="button" id="notWork">Не работает?</button>
        </div>
    </div>
</div>
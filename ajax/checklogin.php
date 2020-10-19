<?php
require('../db.php');
  $bean;
if(!$bean = R::find( 'user', ' login  = ?', [$_GET['login']] )){
  if(empty($bean))  
    echo '1';

  }else
  {
  if(!empty($bean))  
    echo '2';
}

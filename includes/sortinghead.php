<?php 
  $sortingMethod = array();
  $sortingMethod[1] = 'create_date';
  $sortingMethod[2] = 'rating';
  $sortingMethod[3] = 'views';
  $sortingMethod[4] = 'comentsCount';
  $adddesc = '';
  $NumOfSortingMethod = 1;
  $isdesc = true;
  if (isset($_GET['sortBy'])) {
    $sortingMethodcheck = $_GET['sortBy'];
    switch ($sortingMethodcheck ) {
      case 'create_date':
        $NumOfSortingMethod = 1;
        break;
      case 'rating':
        $NumOfSortingMethod = 2;
        break;
      case 'views':
        $NumOfSortingMethod = 3;
        break;
       case 'comentsCount':
        $NumOfSortingMethod = 4;
        break;
    }
    if (isset($_GET['desc'])) {
        if ($_GET['desc'] == 'no') {
          $isdesc = false;
        }
    }
  }
if ($isdesc) {
  $adddesc = '&desc=no';
}
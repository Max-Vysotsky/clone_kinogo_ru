<?php
require('sortinghead.php');
  require('functions.php');
   $articlesOnPage = 12;
   $maxPaginatorItems = 10;
    
   $AllPages       = ceil($AllArticles / $articlesOnPage);
   if($AllPages < 12)
   {
      $AllPages = 1;
   }
   $nameOfFile = $_SERVER['PHP_SELF'];
   $nameOfFileForSort = $nameOfFile . '?sortBy=';
   $isfirstPage= false;
   $isLastPage= false;
   $pageNumber = 1;

   $fileWithNumber = $nameOfFile . '?NumberOfPage=';
   if(isset($_GET['gender']))
    {
      $fileWithNumber = $nameOfFile . '?gender=' . $_GET['gender'] . '&NumberOfPage=';
    }
   if(isset($ontherPartOfURl))
   {
     $fileWithNumber = $nameOfFile . $ontherPartOfURl .'&NumberOfPage=';
   }
   $firstPage = $fileWithNumber . $pageNumber;
   $lastPage = $fileWithNumber . $AllPages;
   if (isset($_GET['NumberOfPage']))
   {
     $pageNumber = (int)$_GET['NumberOfPage'];
     if($pageNumber == 0)
     {
      $pageNumber = 1;
     }
     //print_r($pageNumber);die;
     if ($pageNumber == $AllPages)
     {
       $isLastPage= true;
     }
     if($_GET['NumberOfPage'] == 1)
     {
      $isfirstPage= true;
     }
   }
   else
   {
    $isfirstPage= true;
   }
   $prevPage =  $fileWithNumber . ($pageNumber-1);
   $nextPage =  $fileWithNumber . ($pageNumber+1);
   $offset = ($pageNumber - 1) * $articlesOnPage;

<?php
require('../db.php');
 $rus =[
    'Биография',
    'Боевик',
    'вестерн',
    'Военный',
    'Детектив',
    'Документальные',
    'Драма',
    'Исторический',
    'Комедия',
    'Криминал',
    'Мелодрама',
    'Мультфильмы',
    'Мюзикл',
    'Приключения',
    'Семейный',
    'Спортивный',
    'Триллер',
    'Ужасы',
    'Фантастика',
    'Фэнтези',
    'аниме',
];
$i = 0;
$counters = [];
foreach ($rus as $key => $value) {
   $count = R::count( 'item', ' `genders` LIKE ? ', ['%'.$value.'%'] );
 //  $articles = R::getAll( 'SELECT * FROM `item` WHERE `genders` LIKE ? ORDER BY `id` DESC LIMIT ?,?', ['%'.$gender.'%',$offset, $articlesOnPage] );
   $counters[$i] = $count;
   $i++;
}

foreach ($counters as $key => $value) {
   R::exec( 'INSERT INTO `genders` (`count`) VALUES (?)', [$value]  );
}
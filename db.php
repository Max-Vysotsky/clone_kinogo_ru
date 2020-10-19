<?php 
require('includes/rb.php');
$config = array(
    'title' => 'KINOGO',
    'vk_url' => '',
    'db' => array(
            'host' => '127.0.0.1',
            'driver' => 'mysql',
            'db_name' => 'kinogo_ru',
            'username' => 'root',
            'pass' => 'toor',
            'charset' => 'utf8'
    )
);


$confstring = $config['db']['driver'] . ':host=' . $config['db']['host'] . ';dbname=' . $config['db']['db_name'];




R::setup( $confstring , $config['db']['username'], $config['db']['pass'] );


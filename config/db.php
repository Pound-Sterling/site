<?php

// нициальзация подключения к Базе Данных

$dblocation = "127.0.0.1";
$dbname = "site";
$dbuser = "root";
$dbpasswd = "";

$db = new mysqli($dblocation, $dbuser, $dbpasswd);
if(!$db){
    echo 'Ошибка доступа к MySql';
    exit();
}
mysqli_set_charset($db, 'utf8');

if(! mysqli_select_db($db, $dbname)){
    echo "Ошибка доступа к базе данных: {$dbname}";
    exit();
}
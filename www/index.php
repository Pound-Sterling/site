<?php
session_start();// стартуем сессию

// если в сессии нет массива корзины, то создаем его
if(! isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}



include_once '../config/config.php';         // инициализация настроек
include_once '../config/db.php';             // инициализация базы данных
include_once '../library/mainFunctions.php'; // основные функции

// определяем с каким контролером будем работать 
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
// определяем с какой функцией будем работать
$actionName = isset($_GET['action']) ? ($_GET['action']) : 'index';


if(isset($_SESSION['user'])){
    $smarty->assign('arUser', $_SESSION['user']);
}


$smarty->assign('cartCntItems', count($_SESSION['cart']));


loadPage($smarty, $controllerName, $actionName);


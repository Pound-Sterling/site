<?php

//подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';



// главная страница

function indexAction($smarty){

    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getLastProducts(21);

    for ($w = 0; $w < count($rsProducts); $w++) {
        $rsProducts[$w]['image'] = preg_replace('/(\S+),(.+)/i', '\1' , $rsProducts[$w]['image']);
    }


$breadcrumbs_back = "<div class='icon-home breadcrumb'> Главная</div>";
$breadcrumbs = "<div class='icon-home breadcrumb'>Главная</div>";

// 
    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);


// 
    $smarty->assign('rsBread', $breadcrumbs);
    $smarty->assign('rsBread_back', $breadcrumbs_back);


// 
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}
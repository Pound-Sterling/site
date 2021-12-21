<?php

//
//
//      Контроллер страницы категории (/category/1)
//

include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

function indexAction($smarty){
    $catId = isset($_GET['id']) ? $_GET['id'] : null;
    $catId = intval($catId);
    if(! $catId) exit();
    $rsProducts = null;
    $rsChildCats = null;
    $rsCategory = getCatById($catId);

    if($rsCategory['parent_id'] == 0){
        $rsChildCats = getChildrenForCat($catId);
        for($k = 0 ; $k < count($rsChildCats); $k++){
            $a[$k] = ($rsChildCats[$k]['id']);
        }
        $rsProducts = getProductsFromCatArray($a);

    } else {
        $rsProducts = getProductsByCat($catId);
    }
    for ($w = 0; $w < count($rsProducts); $w++) {
        $rsProducts[$w]['image'] = preg_replace('/(\S+),(.+)/i', '\1' , $rsProducts[$w]['image']);
    }

    // хлебные крошки
    $cat = get_cat();
    $breadcrumbs_array = breadcrumbs($cat, $catId);
    $index = 0 ;
    $breadcrumbs = "";    
    $breadcrumbs_back = "";    
    if($breadcrumbs_array){
        $breadcrumbs = "<div class='icon-home breadcrumb'><a href='/'>Главная</a></div>";
        foreach ($breadcrumbs_array as $id => $name) { 
            $index++;
            $breadcrumbs .= "<div class='icon-long-arrow-right-solid'></div><div class='breadcrumb'><a href='?controller=category&id={$id}'>{$name}</a></div>";
            if($index == count($breadcrumbs_array) - 1 ){
                $breadcrumbs_back = "<a class='step-back-link' href='?controller=category&id={$id}'><div class='icon-step-back'></div><div class='breadcrumb brd-hide'>({$name})</div></a>";
            } 
            else if($index == 1){
                $breadcrumbs_back = "<a class='step-back-link' href='index/'><div class='icon-step-back'></div><div class='icon-home breadcrumb brd-hide'> (Главная)</div></a>";
            }
        }
    } 
    $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>(.+)$#", "$1$2$3", $breadcrumbs);

    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('pageTitle', 'Товары категории ' .$rsCategory['name']);

    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    
    $smarty->assign('rsCategories', $rsCategories);
    
    $smarty->assign('rsBread', $breadcrumbs);
    $smarty->assign('rsBread_back', $breadcrumbs_back);



    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'category');
    loadTemplate($smarty, 'footer');
}
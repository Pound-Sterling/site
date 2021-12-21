<?php

//
//
//  Контроллер страницы товара (/product/1)
//

include_once '../models/ProductsModel.php';
include_once '../models/CategoriesModel.php';

function indexAction($smarty){
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    if(! $itemId) exit();
    $rsProduct = getProductById($itemId);
    // для проверки всех атрибутов товара
    // d($rsProduct); 
    $rsCategories = getAllMainCatsWithChildren();
    // для проверки всех атрибутов
    // d($rsCategories); 
    if(!$rsProduct['description']) {
        $desc = getDescByGroup($rsProduct['group_id']);

        for($i = 0; $i < count($desc);$i++){
            if ($desc[$i]['description']){
                $rsProduct['description'] = $desc[$i]['description'];
            }
        }
    }


    $category_id = $rsProduct["category_id"];



    $prName = preg_replace('/(.{30,40})\s(.+)/i', '\1...' , $rsProduct['name']);
    


    $cat = get_cat();
    $cat_id = getCatById($category_id);
    $catId = $cat_id['id'];
    $breadcrumbs_array = breadcrumbs($cat, $catId);
    $index = 0 ;
    $breadcrumbs = "";    
    $breadcrumbs_back = "";       
    if($breadcrumbs_array){
        $breadcrumbs = "<div class='icon-home breadcrumb'><a href='/'>Главная</a></div>";

        foreach ($breadcrumbs_array as $id => $name) { 
            $index++;
            $breadcrumbs .= "<div class='icon-long-arrow-right-solid'></div><div class='breadcrumb'><a href='?controller=category&id={$id}'>{$name}</a></div>";
                $breadcrumbs_back = "<a class='step-back-link' href='?controller=category&id={$id}'><div class='icon-step-back'></div><div class='breadcrumb brd-hide'>({$name})</div></a>";

        }
        $breadcrumbs .= "<div class='icon-long-arrow-right-solid' ></div><div class='breadcrumb'><a href='?controller=category&id={$id}'>{$prName}</a></div>";
    } 

    $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>(.+)$#", "$1$2$3", $breadcrumbs);
    $smarty->assign('itemInCart', 0);
    if(in_array($itemId, $_SESSION['cart'])){
        $smarty->assign('itemInCart', 1);
    }

    $smarty->assign('pageTitle', $rsProduct['name']);
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProduct', $rsProduct);
    
    $smarty->assign('rsBread', $breadcrumbs);
    $smarty->assign('rsBread_back', $breadcrumbs_back);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}

function imageAction(){
    $itemId   = isset($_REQUEST['id'])      ?     $_REQUEST['id'] : null;
    $res = getProductById($itemId);
    echo json_encode($res);
}

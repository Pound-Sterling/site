<?php

//
//  Для роботы с корзиной
//

include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';




function addcntAction($smarty){

    $itemId = isset($_POST['id']) ? intval($_POST['id']) : null;

    $itemCnt = isset($_GET['cnt']) ? intval($_GET['cnt']) : 1;

    $key = array_search($itemId, $_SESSION['cart']);
    
    if(isset($_SESSION['cart'])){
        $resData['success'] = 1;
        $_SESSION['cnt'][$key] = $itemCnt;
        d($_SESSION['cnt'][$key]);
    }

    // $smarty->assign('itemCnt', $_SESSION[$key]['cnt']);
    $resData['cnt'] = $itemCnt;
    $resData['id'] = $itemId;



    echo json_encode($resData);
    
}


// Добавление продукта в корзину
// @param integer id GET параметр - ID добавляемого товара
// @return json информация об операции (успех, колво элементов в корзине)

function addtocartAction($smarty){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(! $itemId) return false;
    $resData = array();
    // если значени не найдено, то добавляем 
    if(isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false){
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
    }

    
    echo json_encode($resData);

}

// Удаление продукта из корзины
// @param integer id GET параметр - ID удаляемого товара
// @return json информация об операции (успех, колво элементов в корзине)

function removefromcartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(! $itemId) exit();

    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if($key !== false){
        unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
    }
    
    echo json_encode($resData);
}

// формирование страницы корзины
// link /cart/

function indexAction($smarty){

    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getProductsFromArray($itemsIds);

    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}

// Формируем страницу заказа
function orderAction($smarty){
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    if(! $itemsIds){
        redirect('/cart/');
        return;
    }
    $itemsCnt = array();
    foreach($itemsIds as $item){
        $postVar = 'itemCnt_' . $item;

        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }
    $rsProducts = getProductsFromArray($itemsIds);

    // добавляем каждому продукту дополнительно поле
    $i = 0;
    foreach($rsProducts as &$item){
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 0;
        if($item['cnt']){
            $item['realPrice'] = $item['cnt'] * $item['price'];
        } else {
            unset($rsProducts[$i]);
        }
        $i++;
    }
    if(! $rsProducts){
        echo "Корзина пуста";
        return;
    }
    
    $_SESSION['saleCart'] = $rsProducts;
     
    $rsCategories = getAllMainCatsWithChildren();
    
    //Взять на вооружение / если в сессии нету юзера, тогда скрываем регистрационное меню и логин меню
    if(! isset($_SESSION['user'])){
        $smarty->assign('hideLoginBox', 1);
    }
    for ($w = 0; $w < count($rsProducts); $w++) {
        $rsProducts[$w]['image'] = preg_replace('/(\S+),(.+)/i', '\1' , $rsProducts[$w]['image']);
    }
    $smarty->assign('pageTitle', 'Заказ');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}

// AJAX функция сохранения заказа
// @param array $_SESSION['saleCart'] массив покупаемых товаров
// @return json информация о результате выполнения 
function saveorderAction(){
    $cart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : null;
    // если корзина пуста, формируем ответ с ошибкой, отдаем в формате json и выходим из фун-ции
    if(! $cart){
        $resData['success'] = 0;
        $resData['message'] = 'Нет товара в корзине';
        echo json_encode($resData);
        return;
    } 
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];


    $orderId = makeNewOrder($name, $phone, $adress); 

    if(! $orderId){
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка создания заказа';
        echo json_encode($resData);
        return;
    }
    $res = setPurchaseForOrder($orderId, $cart);

    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Заказ сохранен';
        unset($_SESSION['saleCart']);
        unset($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка внесеня данных для заказа № ' . $orderId;
    }

    echo json_encode($resData);
}
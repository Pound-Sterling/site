<?php

// Admin controller
//
// Контроллер бэкэнда сайта (/admin/)
//

include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

$smarty->setTemplateDir(TemplateAdminPrefix);
$smarty->assign('templateWebPath', TemplateAdminWebPath);

function indexAction($smarty){

    $rsCategories = getAllMainCategories();


    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');
    
    loadAdminTemplate($smarty, 'adminHeader');
    loadAdminTemplate($smarty, 'admin');
    loadAdminTemplate($smarty, 'adminFooter');
}


function addnewcatAction(){

    $catName = $_POST['newCategoryName'];
    $catParentId = $_POST['generalCatId'];

    $res = insertCat($catName, $catParentId);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = "Категория добавлена";
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка добавления категории';
    }

    echo json_encode($resData);
    return;
}

function categoryAction($smarty){
    
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();


    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadAdminTemplate($smarty, 'adminHeader');
    loadAdminTemplate($smarty, 'adminCategory');
    loadAdminTemplate($smarty, 'adminFooter');
}

function updatecategoryAction(){
    $itemId = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $newName = $_POST['newName'];

    $res = updateCategoryData($itemId, $parentId, $newName);

    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Категория обновлена';
    } else {
        $resData['success'] = 0 ;
        $resData['message'] = 'Ошибка изменения данных категории' ;
    }

    echo json_encode($resData);
    return;
}

function productsAction($smarty){
    $rsCategories = getAllCategories();
    $rsProducts = getProducts();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    $smarty->assign('pageTitle', 'Упралвение сайтом');

    loadAdminTemplate($smarty, 'adminHeader');
    loadAdminTemplate($smarty, 'adminProducts');
    loadAdminTemplate($smarty, 'adminFooter');
}

function addproductAction(){
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];

    $res = insertProduct($itemName, $itemPrice, $itemDesc, $itemCat);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = "Измененния успешно внесены";
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Ошибка изменения данных";
}

    echo json_encode($resData);
    return;
}

function updateproductAction(){
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemStatus = $_POST['itemStatus'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];

    $res = updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Изменения успешно внесены';
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Ошибка изменения данных";
    }

    echo json_encode($resData);
    return;
}

function uploadAction(){
    $maxSize = 2 * 1024 * 1024;

    $itemId = $_POST['itemId'];

    $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
    $newFileName = $itemId . '.' . $ext;
    
    if($_FILES['filename']['size'] > $maxSize){
        echo ("Размер файла превышает два мегабайта");
        return; 
    }
    if(is_uploaded_file($_FILES['filename']['tmp_name'])){
        $res = move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $newFileName);
    }
    if($res){
        $res = updateproductImage($itemId, $newFileName);
        if($res){
            redirect('/admin/products/');
        }
    } else {
        echo ("Ошибка загрузки файла");
    }
}

function ordersAction($smarty){

    $rsOrders = getOrders();
    $smarty->assign('rsOrders', $rsOrders);
    $smarty->assign('pageTitle', 'Заказы');

    loadAdminTemplate($smarty, 'adminHeader');
    loadAdminTemplate($smarty, 'adminOrders');
    loadAdminTemplate($smarty, 'adminFooter');
}

function setorderstatusAction(){
    $itemId = $_POST['itemId'];
    $status = $_POST['status'];

    $res = updateOrderStatus($itemId, $status);
    $top = updateTop($itemId, $status);



    
    if($res){
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка установки статуса';
    }
    if($top){
        $resData['success-top'] = 1;
    } else {
        $resData['success-top'] = 0;
        $resData['message-top'] = 'Ошибка обновления топ';
    }

    echo json_encode($resData);
    return;
}

function setorderdatepaymentAction(){
    $itemId = $_POST['itemId'];
    $datePayment = $_POST['datePayment'];

    $res = updateOrderDatePayment($itemId, $datePayment);

    if($res){
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка установки статуса';
    }

    echo json_encode($resData);
    return;
}

function createxmlAction(){
    $rsProducts = getProducts();
    $xml = new DomDocument('1.0','utf-8');

    $xmpProducts = $xml->appendChild($xml->createElement('products'));

    foreach ($rsProducts as $product){
        $xmpProduct = $xmpProducts->appendChild($xml->createElement('product'));

        foreach ($product as $key => $val){
            $xmlName = $xmpProduct->appendChild($xml->createElement($key));
            $xmlName->appendChild($xml->createTextNode($val));
        }
    }
    $xml->save($_SERVER["DOCUMENT_ROOT"] . '/xml/products.xml');
    echo 'ok';
}

function uploadFile($localFilename, $localPath = '/upload/'){
    
    $maxSize = 2 * 1024 * 1024;

    $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);

    $pathInfo = pathinfo($localFilename);
    if($ext != $pathInfo['extension']) return false;

    $newFileName = $pathInfo['filename'] . '_' . time() . '.' . $pathInfo['extension'];

    if($_FILES["filename"]["size"] > $maxSize){
        return "большой размер файла";
    }

    $path = $_SERVER['DOCUMENT_ROOT'] . $localPath;
    if(! file_exists($path)){
        mkdir($path);
    }

    if(is_uploaded_file($_FILES['filename']['tmp_name'])){
        $res = move_uploaded_file($_FILES['filename']['tmp_name'], $path . $newFileName);
            return ($res == true) ? $newFileName : false;
    } else {
        return false;
    }
}

function loadfromxmlAction(){
    $successUploadFileName = uploadFile('import_products.xml', '/xml/import/');
    if(! $successUploadFileName){
        echo 'Ошибка загрузки файла';
        return;
    }

    $xmlFile = $_SERVER['DOCUMENT_ROOT'].'/xml/import/'.$successUploadFileName;
    $xmlProducts = simplexml_load_file($xmlFile);
    $products = array(); 
    $i = 0;
    $xmlProducts = $xmlProducts->shop->offers->offer;

    foreach ($xmlProducts as $product) {
        $products[$i]['id'] = intval($product['id']);
        $products[$i]['group_id'] = intval($product['group_id']);
        $products[$i]['category_id'] = intval($product->categoryId);
        $products[$i]['name'] = htmlentities($product->name);
        $products[$i]['description'] = htmlentities($product->description);
        $products[$i]['price'] = intval($product->price) + 250;
        $products[$i]['oldprice'] = $products[$i]['price'] + 500;
       
        $j = 0;
        foreach($product->picture as $picture){
            $products[$i]['image'][$j] = htmlentities($picture);
            $j++;            
        }

        $products[$i]['status'] = htmlentities($product['available']);
        $products[$i]['code'] = htmlentities($product->vendorCode);
        
        $k = 0;
        foreach($product->param as $param){
            $products[$i]['params'][$k]['name'] = htmlentities($param['name']);
            $products[$i]['params'][$k]['param'] = htmlentities($param);
            $products[$i]['params'][$k] = implode(", ", $products[$i]['params'][$k]) ;
            $k++;
        }
        $products[$i]['image'] = implode(", ", $products[$i]['image']) ;
        $products[$i]['params'] = '"'. implode('", "', $products[$i]['params']) .'"';

        $i++;
    }

    //TODO:  // перед парсингом проверять на d()  
    $res = insertImportProducts($products);
    // d($res);

    if($res){
        redirect('/admin/products/');
    }
}


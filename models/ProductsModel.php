<?php
require_once '../config/db.php';

//
//  Модель для таблицы продукции
//  
//

//
//  Получаем последние добавленные товары
//
//       
function getLastProducts($limit = null){
    $sql = "SELECT *
            FROM `products`
            ORDER BY `top` DESC";
    if($limit){
        $sql .= " LIMIT {$limit}";
    }
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return createSmartyRsArray($rs);
}


function getProductsByCat($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT * 
            FROM products
            WHERE category_id = '{$itemId}' AND
            status = 'true'";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return createSmartyRsArray($rs);
}

// data of products by id
function getProductById($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT *
            FROM products
            WHERE id = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return mysqli_fetch_assoc($rs);
}

// Получить список продуктов из массива индентифекатора
// @param array $itemsIds массив идентификаторов продуктов 
// @return array массив данных продуктов
function getProductsFromArray($itemsIds){
    $strIds = implode( ', ', $itemsIds);
    $sql = "SELECT *
            FROM products
            WHERE id in ({$strIds})";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return createSmartyRsArray($rs);
}
function getProductsFromCatArray($itemsIds){
    $strIds = implode( ', ', $itemsIds);
    $sql = "SELECT *
            FROM products
            WHERE category_id in ({$strIds})";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return createSmartyRsArray($rs);
}
function getDescByGroup($itemId){
    $sql = "SELECT `description`
            FROM products
            WHERE group_id = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"],$sql);

return createSmartyRsArray($rs);
}

function getProducts(){
    
    $sql = "SELECT *
            FROM `products`
            ORDER BY category_id";
    $rs = mysqli_query($GLOBALS["db"], $sql);

    return createSmartyRsArray($rs);
}

function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat){
    
    $sql = "INSERT INTO products
            SET
                `name` = '{$itemName}',
                `price` = '{$itemPrice}',
                `description` = '{$itemDesc}',
                `category_id` = '{$itemCat}'";
        $rs = mysqli_query($GLOBALS["db"], $sql);
        return $rs;
}

function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = null){

    $set = array();
    if($itemName){
        $set[] = "`name` = '{$itemName}'";
    }
    if($itemPrice > 0){
        $set[] = "`price` = '{$itemPrice}'";
    }
    if($itemStatus !== null){
        $set[] = "`status` = '{$itemStatus}'";
    }
    if($itemDesc){
        $set[] = "`description` = '{$itemDesc}'";
    }
    if($itemCat){
        $set[] = "`category_id` = '{$itemCat}'";
    }
    if($newFileName){
        $set[] = "`image` = '{$newFileName}'";
    }

    $setStr = implode(", ", $set);
    $sql = "UPDATE products
            SET {$setStr}
            WHERE id = '{$itemId}'";
            
    $rs = mysqli_query($GLOBALS["db"], $sql);

    return $rs;
}

function updateproductImage($itemId, $newFileName){
    $rs = updateProduct($itemId, null, null,
                        null, null, null, $newFileName);
                        return $rs;
}

function insertImportProducts($aProducts){
    if(! is_array($aProducts)) return false;
    
    $sql = "INSERT INTO products
            (`id`, `group_id`, `category_id`, `name`, `description`, `price`, `oldprice`, `image`, `status`, `code`, `params`)
            VALUES
            ";
    $cnt = count($aProducts);
    for($i = 0; $i < $cnt; $i++){
        if($i > 0) $sql .= ', ';
        $sql .= "('" .implode("', '", $aProducts[$i]) . "')";
    }
    $rs = mysqli_query($GLOBALS["db"], $sql);

    // d($sql);
    return $rs;
}
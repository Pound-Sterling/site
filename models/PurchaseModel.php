<?php

// Модель для таблицы продуктов 
//

require_once '../config/db.php';

// Внесение в БД данных продуктов с привязкой к заказу
//
// @param integer $orderId ID заказа
// @param array $cart массив корзины
// @return boolean TRUE в случае успешного добавления в БД
function setPurchaseForOrder($orderId, $cart){
    $sql = "INSERT INTO purchase
            (order_id, product_id, price, amount)
            VALUES ";
    
    $values = array();
    // формиреум массив строк для запроса для каждого товара
    foreach($cart as $item){
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }

    // преобразовываем массив в строку
    $sql .= implode(', ', $values);
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return $rs;
}

function getPurchaseForOrder($orderId){
    $sql = "SELECT `pe`.*, `ps`.`name`
            FROM purchase as `pe`
            JOIN products as `ps` ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = {$orderId}";

    $rs = mysqli_query($GLOBALS["db"],$sql);
    return createSmartyRsArray($rs);
}
<?php

// Модель для таблицы заказов 
// 

require_once '../config/db.php';

// Создание заказа (без привязки товара)
//
// @param string $name
// @param string $phone
// @param string $adress
// @return integer ID созданного заказа
function makeNewOrder($name, $phone, $adress){
    $userId = $_SESSION['user']['id'];
 
    // защита от sql инъекций
    $comment = "Имя: {$name} <br>
                Телефон: {$phone} <br> 
                Адресс: {$adress}";
    $dateCreated = date('Y-m-d H:i:s');
    $userIp = $_SERVER['REMOTE_ADDR']; // айпи клиента , найти другой способо взять айпи
    
    $sql = "INSERT INTO
            orders (`user_id`, `date_created`, `date_payment`,
                     `status`, `comment`, `user_ip`)
            VALUES ('{$userId}', '{$dateCreated}', null,
                    '0', '{$comment}', '{$userIp}')";
    $rs = mysqli_query($GLOBALS["db"], $sql);
    if($rs){
        $sql = "SELECT id
                FROM orders
                ORDER BY id DESC
                LIMIT 1";

        $rs = mysqli_query($GLOBALS["db"], $sql);
        $rs = createSmartyRsArray($rs);
        // возвращаем id созданного запроса
        if(isset($rs[0])){
            return $rs[0]['id'];
        }
    }
    return false;
}
  
// Получить список заказов с привязкой к продуктам для пользователя $userId
// @param integer $userId ID пользователя
// @return array массив заказов с привязкой к продуктам
function getOrdersWithProductsByUser($userId){
  
    $userId = intval($userId);
    $sql = "SELECT * FROM orders
            WHERE `user_id` = '{$userId}'
            ORDER BY id DESC";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    $smartyRs = array();
    while($row = mysqli_fetch_assoc($rs)){
        $rsChildren = getPurchaseForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
    }

    return $smartyRs;
}

function getOrders(){

    $sql = "SELECT o.*, u.name, u.email, u.phone, u.adress
            FROM orders AS `o`
            LEFT JOIN users AS `u` ON o.user_id = u.id
            ORDER BY id DESC";
    $rs = mysqli_query($GLOBALS["db"], $sql);

    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)){

        $rsChildren = getProductsForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
    }

    return $smartyRs;
}


function getProductsForOrder($orderId){
    $orderId = intval($orderId);
    
    $sql = "SELECT *
            FROM purchase AS pe
            LEFT JOIN products AS ps
                ON pe.product_id = ps.id
            WHERE (`order_id` = '{$orderId}')";
    $rs = mysqli_query($GLOBALS["db"], $sql);
    return createSmartyRsArray($rs);
}

function updateOrderStatus($itemId, $status){
    
    $status = intval($status);
    $itemId = intval($itemId);
    $sql = "UPDATE orders 
            SET `status` = '{$status}'
            WHERE id = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"], $sql);
    return $rs;

}
function updateTop($itemId, $status){
    $itemId = intval($itemId);
    $sql = "SELECT * FROM `purchase`
            WHERE `order_id` = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"], $sql);
    $arr_top = createSmartyRsArray($rs);
    if(! is_array($arr_top)) return false;
    $cnt = count($arr_top);
    
    $sql = "UPDATE `products`
            SET `top` = ";
    $sql2 = '';
    $sql2 .= "SELECT top 
    from `products`
    WHERE id in ";    
    
    for($i = 0; $i < $cnt; $i++){
        if($i == 0){
            $b = "(";
        }   
        if($i > 0) $b .= ', ';
        $b .=    "{$arr_top[$i]['product_id']}";        
        if($i == $cnt-1) {
            $b .= ")";
        }
    }

    $sql2 .= $b;
    $rs2 = mysqli_query($GLOBALS["db"], $sql2);
    $arr_top2 = createSmartyRsArray($rs2);
    for($i = 0; $i < $cnt; $i++){
        if($i == 0){
            $sql .= "(case ";
            $a = "(";
        }   
        if($i > 0) $a .= ', ';
        if($status){
            $arr_top2[$i]['top'] += $arr_top[$i]['amount'] ;
            
            $a .= "'{$arr_top[$i]['product_id']}'";
            $sql .=  "when id = '{$arr_top[$i]['product_id']}' then '{$arr_top2[$i]['top']}' \n";
        } else {
            $arr_top2[$i]['top'] -= $arr_top[$i]['amount']  ;
            $a .= "'{$arr_top[$i]['product_id']}'";
            $sql .=  "when id = '{$arr_top[$i]['product_id']}' then '{$arr_top2[$i]['top']}' \n";
        }
        if($i == $cnt-1) {
            $sql .= "end)\n";
            $a .= ")";
        }
    }  
    
    $sql .= "WHERE id in {$a}";
    $rs = mysqli_query($GLOBALS["db"], $sql);

    return $rs;


}

function getImageById($arr){
    $sql = "SELECT image FROM `products`
            WHERE `id` in ";
    if(! is_array($arr)) return false;
    
    
    $in = 0;
    foreach($arr as $item){
        foreach($item as $pict){
            $c[$in] = $pict;
            $in++;
        }
    }
    if(!$c) {
        return false;
    }
    $c = array_unique($c); 
    $c = array_values($c);
    $cnt = count($c);

    $d = array();
    for($i = 0; $i < $cnt; $i++){
        if($i == 0){
            $b = "(";
        }   
        if($i > 0) $b .= ', ';
        $b .= "{$c[$i]}";
        if($i == $cnt-1) {
            $b .= ")";
        }
    }
    $sql .= $b;
    $sql .= " ORDER BY id DESC";
    $i = 0;
    $rs = mysqli_query($GLOBALS["db"], $sql);
    $rs = createSmartyRsArray($rs);
    foreach($rs as $item){
        $item['image'] = preg_replace('/(\S+),(.+)/i', '\1' , $item['image']);
        $item['id'] = $c[$i];
        $rs[$i] = $item;  
        $i++;     
    }
    return $rs;
}


function updateOrderDatePayment($itemId, $datePayment){
    $itemId = intval($itemId);

    $sql = "UPDATE orders
            SET `date_payment` = '{$datePayment}'
            WHERE id = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"], $sql);

    return $rs;

}
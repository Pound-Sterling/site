<?php

//
// Модель для таблицы пользователей (users)
//

require_once '../config/db.php';

//
// Регистрация нового пользователя 
// @param string $email почта
// @param string $pwdMD5 пароль зашифрованный в MD5
// @param string $name имя 
// @param string $phone телефон
// @param string $adress адресс пользователя
// @return array массив данных нового пользователя 
//
//
function registerNewUser($email, $pwdMD5, $name, $phone, $adress){
    $email  = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$email));
    $name   = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$name));
    $phone  = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$phone));
    $adress = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$adress));
    $sql = "INSERT INTO
           users (`email`, `pwd`, `name`, `phone`, `adress`)
           VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')";

    $rs = mysqli_query($GLOBALS["db"],$sql);

    if($rs){
        $sql = "SELECT * FROM users
                WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
                LIMIT 1";

        $rs = mysqli_query($GLOBALS["db"],$sql);
        $rs = createSmartyRsArray($rs);
    
        if(isset($rs[0])){
            $rs['success'] = 1;
        } else {
            $rs['success'] = 0;
        }
    } else {
        $rs['success'] = 0;
    }
    
    return $rs;
}

// Проверка параметров для регитсрации пользователя
// @param string $email email
// @param string $pwd1 пароль
// @param string $pwd2 повтор пароля
// @return array результат в виде массива
//
function checkRegisterParams($email, $pwd1, $pwd2){

    $res = null;
    if(! $email){
        $res['success'] = false;
        $res['message'] = 'Введите email';
    }
    if(! $pwd1){
        $res['success'] = false;
        $res['message'] = 'Введите пароль';
    }
    if(! $pwd2){
        $res['success'] = false;
        $res['message'] = 'Введите повтор пароля';
    }
    if($pwd1 != $pwd2){
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }

    return $res;
}

//  Проверка почты
//  @paran string $email
//  @return array массив - строка из таблицы users, либо пустой массив
//

function checkUserEmail($email){
    $email = mysqli_real_escape_string($GLOBALS["db"],$email);
    $sql = "SELECT id FROM
            users WHERE
            email = '{$email}'";

    $rs = mysqli_query($GLOBALS["db"],$sql);
    $rs = createSmartyRsArray($rs);

    return $rs;
}

// Авторизация пользователя
//
// @param string $email почта(логин) 
// @param string $pwd пароль 
// @return array массив данных пользователя  
//

function loginUser($email, $pwd)
{
    $email = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$email));
    $pwd   = md5($pwd);
    $sql = "SELECT * FROM users
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    $rs = createSmartyRsArray($rs);
    if(isset($rs[0])){
        $rs['success'] = 1;
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

//
// Изменение данных пользователя
// 
// @param string $name имя
// @param string $phone телефон
// @param string $adress адресс
// @param string $pwd1 пароль 
// @param string $pwd2 повтор парооля
// @param string $curPwd текущий пароль
// @return boolean true в случае успеха
//
function updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwd){
// $curPwd - незащищённая переменная
    $email  = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$_SESSION['user']['email']));
    $name   = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$name));
    $phone  = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$phone));
    $adress = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"],$adress));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);
    $newPwd = null;

    if( $pwd1 && ($pwd1 == $pwd2)){
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE users
            SET ";

    if($newPwd){
        $sql .= "`pwd` = '{$newPwd}', ";
    }

    $sql .= "   `name` = '{$name}',
                `phone` = '{$phone}',
                `adress` = '{$adress}' 
                WHERE
                `email` = '{$email}' AND `pwd` = '{$curPwd}'
                LIMIT 1";


    $rs = mysqli_query($GLOBALS["db"],$sql);
    return $rs;
}

// Получаем данные заказа текущего пользователя
// @return array массив заказов с привязкой к продуктам
function getCurUserOrders(){
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $rs = getOrdersWithProductsByUser($userId);

    return $rs;
}
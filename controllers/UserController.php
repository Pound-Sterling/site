<?php

//
// Контроллер функции пользователя
//

include_once '../models/CategoriesModel.php';
include_once '../models/UsersModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';


function registerAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);
    $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;


    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);
    
    $resData = null;
    $resData = checkRegisterParams($email, $pwd1, $pwd2);

    if(! $resData && checkUserEmail($email)){
        $resData['success'] = false;
        $resData['message'] = "Пользователь с таким email уже зарегистрирован";
    }
    if(! $resData){
        $pwdMD5 = md5($pwd1);

        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $adress);
        if($userData['success']){
            $resData['message'] = 'Пользователь успешно зарегестрирован';
            $resData['success'] = 1;
            $userData = $userData[0];
            $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
            $resData['userEmail'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];        
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Ошибка регистрации';
        }
    }
    echo json_encode($resData);
}

// Востановление пароля
//

function recoverAction(){

    $email = isset($_REQUEST['email_recover']) ? $_REQUEST['email_recover'] : null;
    $resData = null;
    $email_recover = htmlspecialchars(mysqli_real_escape_string($GLOBALS["db"], $_POST['email']));
    $zapros = "SELECT `id` FROM `users` WHERE `email`='{$email_recover}'";
    $sql = mysqli_query($GLOBALS["db"],$zapros) or die(mysqli_error());
    if (mysqli_num_rows($sql)==1){
    $simv = array ("92", "83", "7", "66", "45", "4", "36", "22", "1", "0", 
                   "k", "l", "m", "n", "o", "p", "q", "1r", "3s", "a", "b",
                   "c", "d", "5e", "f", "g", "h", "i", "j6", "t", "u", "v9", "w", "x5", "6y", "z5");
            $string = '';
                   for ($k = 0; $k < 8; $k++){
            shuffle ($simv);
            $string = $string.$simv[1];
        }
        $key = $email_recover;
        
        for ($k = 0; $k < 5; $k++){
            shuffle ($simv);
            $key = $key.$simv[1];
        }
        $key = md5($key);
        $zapros = "UPDATE `users` SET  `change_key`='{$key}' WHERE `email`='{$email_recover}' ";
        $sql = mysqli_query($GLOBALS["db"],$zapros) or die(mysqli_error());
        $zapros = "SELECT `name` FROM `users` WHERE `email`='{$email_recover}' LIMIT 1";
        $sql = mysqli_query($GLOBALS["db"],$zapros) or die(mysqli_error());
        $n = mysqli_fetch_assoc($sql);
        $name = $n['name'];
        $url = 'http://site/newpass.php?key='.$key;
        $message = "Здравствуйте, $name. Был выполнен запрос на изменение вашего пароля. \n\n Для изменения перейдите по ссылке: ".$url."\n\n Если это были не вы, то советуем изменить ваш пароль";
        mail($email_recover, "Запрос на восстановление пароля", $message);
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
        
    }
    // echo $string;
    echo json_encode($resData);
}


//  Разлогинивание пользователя
//
function logoutAction(){

    if(isset($_SESSION['user'])){
        unset($_SESSION['user']); // удаляет пользователя с сессии /// unset- удаление элемента массива
        unset($_SESSION['cart']); // удаляет корзину с сессии
    }

    redirect('/');

}

// AJAX авторизация пользователя
// @return json массив данных пользователя

function loginAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
    $pwd = trim($pwd);

    $userData = loginUser($email, $pwd);

    if($userData['success']){
        $userData = $userData[0];

        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];

        $resData = $_SESSION['user'];
        $resData['success'] = 1;
    } else{
        $resData['success'] = 0;
        $resData['message'] = 'Неверный логин или пароль';
    }

    echo json_encode($resData);
}

// Формирование страница пользователя
// @link /user/
// @param object $smarty шаблонизатор
//
function indexAction($smarty){
    if(! isset($_SESSION['user'])){
        redirect('/');
    }

    $rsCategories = getAllMainCatsWithChildren();

    $rsUserOrders = getCurUserOrders();

    $smarty->assign('pageTitle', 'Страница пользователя');
    $smarty->assign('rsCategories', $rsCategories);

    $sum_item = [];
    $img = [];
    $in = 0;
    $in2 = 0;
    
    foreach($rsUserOrders as $item){
        $sum[$in2] = 0;
        foreach($item['children'] as $item_sum){
            $sum[$in2] += $item_sum['price'] * $item_sum['amount'];
            $img[$in2][$in] = $item_sum['product_id'];
            $in++;
        }
        $in2++;
    }
    $t = 0;
    $images = getImageById($img);
    foreach($rsUserOrders as $item){
        $v = 0;
        foreach($item['children'] as $item_sum){
            for($i = 0; $i< count($images); $i++){
                if($item_sum['product_id'] == $images[$i]['id']){
                    $item_sum['image'] = $images[$i]['image'];
                }
            }
            $item['children'][$v] = $item_sum;
            $v++;
        }
        $prod[$t] = $item;
        $t++;
    }
    $smarty->assign('images', $images);
    $smarty->assign('rsSum', $sum);
    
    $smarty->assign('rsUserOrders', $prod);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'user');
    loadTemplate($smarty, 'footer');
}


// Обновление данных пользователей
//
// @return json результаты выполнения функции
//

function updateAction(){
    if(! isset($_SESSION['user'])){
        redirect('/');
    }   

    // инициализация переменных
    $resData = array();
    $phone   = isset($_REQUEST['phone'])      ?     $_REQUEST['phone'] : null;
    $adress  = isset($_REQUEST['adress'])     ?     $_REQUEST['adress'] : null;
    $name    = isset($_REQUEST['name'])       ?     $_REQUEST['name'] : null;
    $pwd1    = isset($_REQUEST['pwd1'])       ?     $_REQUEST['pwd1'] : null;
    $pwd2    = isset($_REQUEST['pwd2'])       ?     $_REQUEST['pwd2'] : null;
    $curPwd  = isset($_REQUEST['curPwd'])     ?     $_REQUEST['curPwd'] : null;
    $curPwdMD5 = md5($curPwd);
    
    if(! $curPwd || ($_SESSION['user']['pwd'] != $curPwdMD5)){
        $resData['success'] = 0;
        $resData['message'] = 'Введите коректный пароль';

        echo json_encode($resData);
        return false;
    }

    $res = updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwdMD5);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Данные сохранены';
        $resData['userName'] = $name;

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['adress'] = $adress;

        $newPwd = $_SESSION['user']['pwd'];
        if($pwd1 && ($pwd1 == $pwd2)){
            $newPwd = md5(trim($pwd1));
        } 

        $_SESSION['user']['pwd'] = $newPwd;
        $_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка сохранения данных';
     }

    echo json_encode($resData);

}
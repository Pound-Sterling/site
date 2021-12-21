<?php 
    include_once '../config/config.php';         // инициализация настроек
    include_once '../config/db.php';             // инициализация базы данных
    include_once '../library/mainFunctions.php'; // основные функции

    $data = $_GET;
    if($_SESSION['user'] != NULL) header('Location: /');
    if($data['key'] == NULL) header('Location: /');

    $zapros = "SELECT * FROM `users` WHERE `change_key` = '{$data['key']}'";
    $sql = mysqli_query($GLOBALS["db"],$zapros) or die(mysqli_error());
    $user = mysqli_fetch_assoc($sql);
    if(!$user) header('Location: /');

    if(isset($data['pwd1']) && isset($data['pwd2'])){
        $pwd1 = $data['pwd1'];
        $pwd2 = $data['pwd2'];
        $user["pwd"] = md5($data['pwd1']);
        $user["change_key"] = NULL;
        $zapros = "UPDATE `users` SET `pwd`='{$user["pwd"]}',  `change_key` = '{$user["change_key"]}' WHERE `email`='{$user['email']}'";
        $sql = mysqli_query($GLOBALS["db"],$zapros) or die(mysqli_error());

            header('Location: /');
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="templates/default/css/pass_chng.css">
    <link rel="stylesheet" href="templates/default/css/reset.css">
    <title>Document</title>
</head>

<body>
    <div class="popup" id="popup_reg">
        <div class="popup__body">
            <div class="popup__content">
                <div class="popup__title">Востановление пароля</div>
                <div class="popup__text">
                    <form action="/newpass.php" method="GET" class="change_pwd_form">
                    <input type="hidden" name="key" value="<?php echo $data['key']; ?>">    
                        <div class="person-item">
                            <label for="pwd1">пароль:</label>
                            <input type="password" id="pwd1" name="pwd1">
                        </div>
                        <div class="person-item">
                            <label for="pwd2">повторить пароль:</label>
                            <input type="password" id="pwd2" name="pwd2">
                        </div>
                        <button class="btn-person" type="submit" name="change">Изменить пароль</button>
                </form>
            </div>

        </div>
    </div>
    </div>
    <script src="js/change_pwd.js"></script>
</body>

</html>
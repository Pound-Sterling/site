<?php
/* Smarty version 3.1.39, created on 2021-09-04 12:54:51
  from 'C:\OpenServer\domains\site\views\default\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6133426bc00df0_02071406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dda91d47698bbc082bad78ffcffe924661d155b0' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\default\\header.tpl',
      1 => 1630749283,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftcolumn.tpl' => 1,
  ),
),false)) {
function content_6133426bc00df0_02071406 (Smarty_Internal_Template $_smarty_tpl) {
?><html>

<head>
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/icon.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

</head>

<body class="preload">
    <div class="wrapper">
        <!--  -->
        <div id="header">
            <div class="container">
                <div class="header__wrapper">
                    <div class="header__logo-wrap">
                        <a href="/">
                            <div class="icon-logo">

                            </div>
                        </a>
                    </div>
                    <div class="header__right-sect">
                        <div class="header__person">
                            <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                            <div id="userBox">
                                <a href="/user/" id="userLink"><?php echo $_smarty_tpl->tpl_vars['arUser']->value['displayName'];?>
</a><br>
                                <a href="/user/logout/" onclick="logout()">Выход</a>
                            </div>
                            <?php } else { ?>

                            <div id="userBox" class="hideme">
                                <a href="#" id="userLink"></a><br>
                                <a href="/user/logout/" onclick="logout();">Выход</a>
                            </div>

                            <?php if (!(isset($_smarty_tpl->tpl_vars['hideLoginBox']->value))) {?>
                            <div class="header__person-btns">
                                <div id="loginBox">
                                    <a href="#popup_login" class="person-active popup-link">Авторизация</a>
                                </div>

                                <div id="register">
                                    <a href="#popup_reg" class="person-active popup-link">Регистрация</a>
                                </div>
                            </div>

                            <?php }?>
                            <?php }?>
                        </div>
                        <div class="header__person-mob">
                            <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                            <div id="userBoxM">
                                <div class="userBox-cont">
                                    <a href="/user/" id="userLinkM" class="icon-acc"></a>
                                    <a href="/user/logout/" onclick="logout()">Выход</a>
                                </div>
                            </div>
                            <?php } else { ?>

                            <div id="userBoxM" class="hideme">
                                <div class="userBox-cont">
                                    <a href="#" id="userLinkM" class="icon-acc"></a>
                                    <a href="/user/logout/" onclick="logout();">Выход</a>
                                </div>
                            </div>

                            <?php if (!(isset($_smarty_tpl->tpl_vars['hideLoginBox']->value))) {?>
                            <div id="loginBoxM">
                                <a href="#popup_login" class="person-active popup-link icon-acc"></a>
                            </div>

                            <?php }?>
                            <?php }?>
                        </div>
                        <div class="menuCart">
                            <div class="menuCaption">

                                <a class="icon-shopping-basket" href="/cart/" title="Перейти в корзину">
                                    <span id="cartCnt">
                                        Корзина
                                    </span>
                                    <span id="cartCntItems">
                                        <?php if ($_smarty_tpl->tpl_vars['cartCntItems']->value > 0) {
echo $_smarty_tpl->tpl_vars['cartCntItems']->value;
} else { ?>0<?php }?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__info">

            <div class="container">
                <div class="main__info-title">
                    <h1>ДО 31.08 - <span style="color:yellow;font-weight: bold;text-decoration:underline;"><i>СКИДКА
                                45%</i></span></h1>
                </div>
            </div>
        </div>
        <main class="main">
            <div class="container">
                <div class="main-breadcrumbs">
                    <div class="breadcrumbs-wrapper">
                        <div class="breadcrumbs">
                            <?php echo $_smarty_tpl->tpl_vars['rsBread']->value;?>

                        </div>
                        <div class="breadcrumbs-back">
                            <?php echo $_smarty_tpl->tpl_vars['rsBread_back']->value;?>

                        </div>
                    </div>
                </div>
                <div class="main__wrapper">
                    <?php $_smarty_tpl->_subTemplateRender('file:leftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


                    <!--     -->

                    <div id="centerColumn"><?php }
}

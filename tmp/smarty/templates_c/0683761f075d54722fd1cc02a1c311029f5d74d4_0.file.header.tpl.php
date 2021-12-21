<?php
/* Smarty version 3.1.39, created on 2021-07-29 18:03:31
  from 'Z:\home\Site\views\default\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6102df63164792_10992017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0683761f075d54722fd1cc02a1c311029f5d74d4' => 
    array (
      0 => 'Z:\\home\\Site\\views\\default\\header.tpl',
      1 => 1627578193,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftcolumn.tpl' => 1,
  ),
),false)) {
function content_6102df63164792_10992017 (Smarty_Internal_Template $_smarty_tpl) {
?><html>

<head>
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/main.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/icon.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <!--  -->
    <div id="header">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__logo-wrap">
                    <a href="/">
                        <h1>my shop - интернет магазин</h1>
                    </a>
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
   <div class="main__info">
        <div class="container">
            <div class="main__info-title">
                <h1>ДО 31.08 - СКИДКА 45%</h1> 
            </div>
        </div>
    </div> 
    <main class="main">
        <div class="container">
            <div class="main__wrapper">
            <?php $_smarty_tpl->_subTemplateRender('file:leftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


            <!--     -->

            <div id="centerColumn">

 <?php }
}

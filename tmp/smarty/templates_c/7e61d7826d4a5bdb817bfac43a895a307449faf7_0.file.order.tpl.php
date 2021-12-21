<?php
/* Smarty version 3.1.39, created on 2021-07-29 19:03:32
  from 'Z:\home\Site\views\default\order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6102ed74cf4383_30783595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e61d7826d4a5bdb817bfac43a895a307449faf7' => 
    array (
      0 => 'Z:\\home\\Site\\views\\default\\order.tpl',
      1 => 1627581810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6102ed74cf4383_30783595 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Данные заказа</h2>
<form id="frmOrder" action="/cart/saveorder/" method="POST">
    <table>
        <tr>
            <td>№</td>
            <td>Наименование</td>
            <td>Количество</td>
            <td>Цена за единицу</td>
            <td>Стоимость</td>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
?>
        <tr>
            <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null);?>
</td>
            <td><a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></td>
            <td>
                <span id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                    <input type="hidden" name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>
" >
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>

                </span>
            </td>
            <td>
                <span id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                    <input type="hidden" name="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                </span>
            </td>
            <td>
                <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                    <input type="hidden" name="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>

                </span>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
    <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
            <?php $_smarty_tpl->_assignInScope('buttonClass', '');?> 
            <h2>Данные заказчика</h2>
    <div id="orderUserInfoBox" <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
>
        <?php $_smarty_tpl->_assignInScope('name', $_smarty_tpl->tpl_vars['arUser']->value['name']);?>
        <?php $_smarty_tpl->_assignInScope('phone', $_smarty_tpl->tpl_vars['arUser']->value['phone']);?>
        <?php $_smarty_tpl->_assignInScope('adress', $_smarty_tpl->tpl_vars['arUser']->value['adress']);?>
        <table>
            <tr>
                <td>Имя*</td>
                <td><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></td>
            </tr>
            <tr>
                <td>Тел*</td>
                <td><input type="text" name="phone" id="phone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
"></td>
            </tr>
            <tr>
                <td>Адресс*</td>
                <td><textarea name="adress" id="adress"><?php echo $_smarty_tpl->tpl_vars['adress']->value;?>
</textarea></td>
            </tr>
        </table>
    </div>
    <?php } else { ?>
    <div id="loginBox">
        <div class="menuCaption">Авторизация</div>
        <input type="text" name="loginEmail" id="loginEmail" value="" placeholder="Логин">
        <input type="password" name="loginPwd" id="loginPwd" value="" placeholder="Пароль">
        <input type="button" value="Войти" onclick="login()">
    </div>
    <div id="registerBox">
        <div class="menuCaption">Registration</div>
        email:<br>
        <input type="text" id="email" name="email" value=""><br>
        пароль:<br>
        <input type="password" id="pwd1" name="pwd1" value=""><br>
        повторить пароль:<br>
        <input type="password" id="pwd2" name="pwd2" value=""><br>

        Имя* : <input type="text" name="name" id="name" value=""><br>
        Тел* : <input type="text" name="phone" id="phone" value=""><br>
        Адресс* : <textarea name="adress" id="adress" placeholder="Input your adress"></textarea><br>
        <input type="button" onclick="registerNewUser();" value="Registration"><br>
    </div>
    <?php $_smarty_tpl->_assignInScope('buttonClass', "class='hideme'");?>
    <?php }?>
    <input <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
 type="button" id="btnSaveOrder" value="Оформить заказ" onclick="saveOrder();">
</form><?php }
}

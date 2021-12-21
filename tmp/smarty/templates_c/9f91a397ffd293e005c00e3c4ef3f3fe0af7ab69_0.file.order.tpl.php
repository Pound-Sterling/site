<?php
/* Smarty version 3.1.39, created on 2021-09-03 11:31:39
  from 'C:\OpenServer\domains\site\views\default\order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6131dd6b958a26_38684323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f91a397ffd293e005c00e3c4ef3f3fe0af7ab69' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\default\\order.tpl',
      1 => 1630657898,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6131dd6b958a26_38684323 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="order-page">
    <div class="main-title">
        <h2>Данные заказа</h2>
    </div>
    <form id="frmOrder" action="#">
        <div class="order-data">
            <?php $_smarty_tpl->_assignInScope('val', 0);?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <div class="order-data__item">
                <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/" class="order-data__item__title">
                    <div class="order-data__item__title-img">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" alt="">
                    </div>
                    <div class="order-data__item__title-name">
                        <span><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</span>
                    </div>
                </a>
                <div class="order-data__item__price">
                    <div class="test__price">
                        <span class="tile__options">Цена</span>
                        <span id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                            <input type="hidden" name="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
">
                        </span>
                        <span class="tile__digit"><?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
 грн</span>
                    </div>
                    <div class="test__amount">
                        <span class="tile__options">Количество</span>
                        <span id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                            <input type="hidden" name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>
">
                        </span>
                        <span class="tile__digit"><?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>
</span>
                    </div>
                    <div class="test__sum">
                        <span class="tile__options">Сумма</span>
                        <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                            <input type="hidden" name="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>
">
                        </span>
                        <span class="tile__digit"> <?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>
 грн</span>
                    </div>
                </div>
            </div>

            <?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('val', $_smarty_tpl->tpl_vars['val']->value+$_prefixVariable1);?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
        <?php $_smarty_tpl->_assignInScope('buttonClass', '');?>
        <div class="order">
            <div class="main-title">
                <h2>Данные заказчика</h2>
            </div>
            <?php $_smarty_tpl->_assignInScope('name', $_smarty_tpl->tpl_vars['arUser']->value['name']);?>
            <?php $_smarty_tpl->_assignInScope('phone', $_smarty_tpl->tpl_vars['arUser']->value['phone']);?>
            <?php $_smarty_tpl->_assignInScope('adress', $_smarty_tpl->tpl_vars['arUser']->value['adress']);?>
            <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
            <div id="order-active">
                <div id="orderUserInfoBox" <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
>


                    <div id="BoxOrder">
                        <div class="person-item">
                            <label for="orderName">Имя*:</label>
                            <input class="_req" type="text" name="name" id="orderName" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
                        </div>
                        <div class="person-item">
                            <label for="orderPhone">Тел*:</label>
                            <input class="_req" type="text" name="phone" id="orderPhone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
">
                        </div>
                        <div class="person-item">
                            <label for="orderAdress">Адресс*:</label>
                            <textarea class="_req" name="adress" id="orderAdress"><?php echo $_smarty_tpl->tpl_vars['adress']->value;?>
</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div id="order-active" class="hideme">
                <div id="orderUserInfoBox" <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
>
                    <div id="BoxOrder">
                        <div class="person-item">
                            <label for="orderName">Имя*:</label>
                            <input class="_req" type="text" name="name" id="orderName" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
                        </div>
                        <div class="person-item">
                            <label for="orderPhone">Тел*:</label>
                            <input class="_req" type="text" name="phone" id="orderPhone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
">
                        </div>
                        <div class="person-item">
                            <label for="orderAdress">Адресс*:</label>
                            <textarea class="_req" name="adress" id="orderAdress"><?php echo $_smarty_tpl->tpl_vars['adress']->value;?>
</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btns-log-reg">
                <div id="loginBox">
                    <a href="#popup_login" class="btn-person person-active popup-link">Авторизация</a>
                </div>
                <div id="register">
                    <a href="#popup_order" class="btn-person person-active popup-link">Регистрация</a>
                </div>
            </div>

            <?php $_smarty_tpl->_assignInScope('buttonClass', 'hideme');?>
            <?php }?>
            <div class="item-cart__sum-price">
                <span>Сумма заказа:</span>
                <span class=""><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
 грн</span>
            </div>
            <div class="item-cart__btn">
                <input class="btn-person <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
" type="submit" id="btnSaveOrder" value="Оформить заказ">
            </div>
        </div>
    </form>
</div><?php }
}

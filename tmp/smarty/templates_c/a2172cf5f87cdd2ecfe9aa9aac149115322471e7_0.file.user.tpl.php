<?php
/* Smarty version 3.1.39, created on 2021-08-29 22:41:20
  from 'C:\OpenServer\domains\site\views\default\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_612be2e0e3f533_24749279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2172cf5f87cdd2ecfe9aa9aac149115322471e7' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\default\\user.tpl',
      1 => 1630266080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_612be2e0e3f533_24749279 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-title">
    <h1>Ваши регестрационые данные</h1>
</div>
<div class="user-page">
    <table border="0" id="user-data">
        <tr>
            <td>Логин (email)</td>
            <td><?php echo $_smarty_tpl->tpl_vars['arUser']->value['email'];?>
</td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><input type="text" name="name" id="newName" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
"></td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td><input type="text" name="phone" id="newPhone" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['phone'];?>
"></td>
        </tr>
        <tr>
            <td>Адресс</td>
            <td><textarea style="max-width:202px;width:202px;min-width:202px;" name="adress" id="newAdress"><?php echo $_smarty_tpl->tpl_vars['arUser']->value['adress'];?>
</textarea></td>
        </tr>
        <tr>
            <td>Новый пароль</td>
            <td><input name="pwd1" type="password" id="newPwd1" value=""></td>
        </tr>
        <tr>
            <td>Повтор нового пароля</td>
            <td><input name="pwd2" type="password" id="newPwd2" value=""></td>
        </tr>
        <tr>
            <td>Для того чтобы изменить пароль введите текущий пароль</td>
            <td><input name="curPwd" type="password" id="curPwd" value=""></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="button" value="Сохранить изменения" onclick="updateUserData();"></td>
        </tr>
    </table>
    <div class="main-title">
        <h2>Заказы:</h2>
    </div>
    <?php if (!$_smarty_tpl->tpl_vars['rsUserOrders']->value) {?>
    Нет заказов
    <?php } else { ?>




    <div class="order-table">
        <?php $_smarty_tpl->_assignInScope('val', 0);?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsUserOrders']->value, 'item', false, NULL, 'orders', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>

        <div class="order-table__item">
            <a href="#" onclick="showProducts('<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
', this); return false;">
                <div class="order-table__main">
                    <div class="order-table__main-flex">
                        <div class="order-table__info">
                            <div class="order-table__title">
                                <span class="order-table__span-header">№ <?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
 дата заказа:
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['date_created'];?>
</span>

                            </div>
                            <div class="order-table__status">
                                <?php if ($_smarty_tpl->tpl_vars['item']->value['status'] == 1) {?>
                                <span>Выполнен</span>
                                <?php } else { ?>
                                <span>Не Выполнен</span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="order-table__price">
                            <span class="order-table__span-header">Сумма заказа</span>
                            <span><?php echo $_smarty_tpl->tpl_vars['rsSum']->value[$_smarty_tpl->tpl_vars['val']->value];?>
 грн</span>
                        </div>
                        <div class="order-table__images">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['children'], 'itemChild', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['itemChild']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
$_smarty_tpl->tpl_vars['itemChild']->do_else = false;
?>
                            <div class="order-table__images-item">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['image'];?>
">
                            </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                        <div class="order-table__hide-btn">

                            <div class="chevron-link">
                                <span class="icon-chevron-down"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </a>




            <div class="hideme order-table__details" id="purchasesForOrderId_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <div class="order-table__details__comment">
                    <span><?php echo $_smarty_tpl->tpl_vars['item']->value['comment'];?>
</span>
                    <span>Сумма заказа: <?php echo $_smarty_tpl->tpl_vars['rsSum']->value[$_smarty_tpl->tpl_vars['val']->value];?>
 грн</span>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['date_payment'] != null) {?>


                    <div style="display: flex; flex-direction: column;">
                        <span>Оплачено&nbsp;</span>
                        <span>Дата оплаты:</span>
                        <span><?php echo $_smarty_tpl->tpl_vars['item']->value['date_payment'];?>
</span>
                    </div>

                    <?php } else { ?>
                    <span>Не оплачено</span>
                    <?php }?>
                    <span></span>

                </div>
                <div class="order-table__details__goods">
                    <div class="order-table__details__header">
                        <span>Товары</span>
                    </div>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['children'], 'itemChild', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['itemChild']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
$_smarty_tpl->tpl_vars['itemChild']->do_else = false;
?>


                    <div class="order-table__details__info">
                        <a href="/product/<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['product_id'];?>
/" class="order-table__details__info-figure">

                            <div class="order-table__details__info-figure-image">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['image'];?>
">
                            </div>
                            <div>
                                <span><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>
</span>
                                <div style="margin-top: 5px; color:midnightblue">
                                    <span style="font-size: 14px;">Id товара</span>
                                    <?php echo $_smarty_tpl->tpl_vars['itemChild']->value['product_id'];?>

                                </div>
                            </div>

                        </a>
                        <div class="order-table__details__info-options">
                            <div class="test__price">
                                <span class="tile__options">Цена</span>
                                <span class="tile__digit"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['price'];?>
</span>
                            </div>
                            <div class="test__amount">
                                <span class="tile__options">Количество</span>
                                <span class="tile__digit"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['amount'];?>
</span>
                            </div>
                            <div class="test__sum">
                                <span class="tile__options">Сумма</span>
                                <span class="tile__digit"> <?php echo $_smarty_tpl->tpl_vars['itemChild']->value['price']*$_smarty_tpl->tpl_vars['itemChild']->value['amount'];?>
</span>
                            </div>
                        </div>
                    </div>




                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>

            </div>
        </div>





        <?php $_smarty_tpl->_assignInScope('val', $_smarty_tpl->tpl_vars['val']->value+1);?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

</div>


<?php }?>
</div><?php }
}

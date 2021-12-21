<?php
/* Smarty version 3.1.39, created on 2021-08-02 09:34:50
  from 'C:\OpenServer\domains\site\views\default\cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6107920a230cf2_32731751',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ff0408feb7c6f01d6ffc4cbbcd92c706f7a974a' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\default\\cart.tpl',
      1 => 1627577765,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6107920a230cf2_32731751 (Smarty_Internal_Template $_smarty_tpl) {
?><h1>Корзина</h1>

<?php if (!$_smarty_tpl->tpl_vars['rsProducts']->value) {?>
В корзине пусто.
<?php } else { ?>
<form action="/cart/order/" method="POST">
    <div class="items-group">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
        <div class="item-cart">
            <div class="item-cart__img-wrapper">
                <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" class="item-cart__img"></a>
            </div>
            <div class="item-cart__info-cell">
                <div class="item-cart__main-info">
                    <div class="item-cart__title">
                        <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
                    </div>
                </div>
                <div class="item-cart__infoPrice">
                    <div class="item-cart__itemCnt">
                        <div class="item-cart__cntBtns">
                            <div class="item-cart__cntChange" onclick="removeCnt(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">-</div>
                            <input class="item-cart__itemCnt-input" name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                                id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" type="text" value="1"
                                onchange="conversionPrice(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
);">
                            <div class="item-cart__cntChange" onclick="addCnt(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">+</div>
                        </div>
                        <div class="item-cart__cntError-cont cont_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
 hideme">
                            <span class="item-cart__cntError">
                                Минимальное количество для заказа 1 шт.
                            </span>
                        </div>

                    </div>
                    <div class="item-cart__itemPrice">
                        <span class="item-cart__itemPrice-span">Price:</span>
                        <div class="item-cart__itemPrice-price" id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                        </div>
                    </div>
                    <div class="item-cart__itemRealPrice">
                        <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                        </span>
                    </div>
                </div>
            </div>
            <div class="item-cart__delete">
                <a class="icon-trash" id="removeCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="#"
                    onClick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;"></a>
                <a class="icon-trash-restore hideme" id="addCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="#"
                    onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;"></a>
            </div>
        </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <input type="submit" value="Оформить заказ">
</form>
<?php }
}
}

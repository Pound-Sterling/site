<?php
/* Smarty version 3.1.39, created on 2021-08-13 21:17:12
  from 'C:\OpenServer\domains\site\views\default\category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6116b728038320_16592017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9373a29470fbf13b9459b06a85e5a63ab55e231' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\default\\category.tpl',
      1 => 1628878133,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6116b728038320_16592017 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-title">
    <h1>Товары категории <?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['name'];?>
</h1>
</div>
<div class="goods">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
    <div class="single-goods">
        <div class="product-img">
            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/">
                <div class="goods__img-wrapper">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" class="goods__img" />
                </div>
            </a>
        </div>
        <div class="product-name">
            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
        </div>
        <div class="product-price">
            <span class="old-price"><?php echo $_smarty_tpl->tpl_vars['item']->value['oldprice'];?>
 грн</span>
            <span class="cur-price"><?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
 грн</span>
        </div>
        <div class="person-cur">
            <?php if ($_smarty_tpl->tpl_vars['item']->value['status'] == 'true') {?>
            <span class="cur-status-yes">В наличии</span>
            <?php } else { ?>
            <span class="cur-status-no">Нету в наличии</span>
            <?php }?>
        </div>

            <?php if ($_smarty_tpl->tpl_vars['item']->value['status'] == 'true') {?>
            <div class="person-cart">
                <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="icon-cart-arrow-down person-cart-link add-to-cart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                    onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;" alt="Добавить в корзину"><span>Добавить в
                        корзину</span></a>
            </div>
            <?php } else { ?>
            <div class="person-cart">
                <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="icon-cart-arrow-down person-cart-link add-to-cart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
 cant-buy"
                    onClick="addToCartError(); return false;" alt="Добавить в корзину"><span>Нету в наличии</span></a>
            </div>
            <?php }?>
        
        <div class="person-recall">
            <a class="popup-link person-recall-link" href="popup_recall"><span class="re-call icon-phone">Перезвонить</span></a>
        </div>
        <span class="person-code">Код: <?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
</span>
    </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsChildCats']->value, 'item', false, NULL, 'childCats', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
<h2><a href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></h2>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}

<?php
/* Smarty version 3.1.39, created on 2021-07-27 09:00:18
  from 'Z:\home\Site\views\default\product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60ffbd125590c3_54918844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf9eb8370ad6c75f08c3f26f389e16e2ec09af2b' => 
    array (
      0 => 'Z:\\home\\Site\\views\\default\\product.tpl',
      1 => 1627372815,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60ffbd125590c3_54918844 (Smarty_Internal_Template $_smarty_tpl) {
?>    <h3><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h3>

    <img src="<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
">
    Стоимость: <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['price'];?>


    <a id="removeCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if (!$_smarty_tpl->tpl_vars['itemInCart']->value) {?>class="hideme"<?php }?>href="#" onClick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
); return false;" alt="Удалить из корзины">Удалить из корзины</a>
    <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['itemInCart']->value) {?>class="hideme"<?php }?> href="#" onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
); return false;" alt="Добавить в корзину">Добавить в корзину</a>
    <p> Описание <br /><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['description'];?>
</p><?php }
}

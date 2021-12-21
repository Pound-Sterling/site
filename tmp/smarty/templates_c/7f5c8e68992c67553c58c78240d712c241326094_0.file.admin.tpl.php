<?php
/* Smarty version 3.1.39, created on 2021-08-02 10:28:01
  from 'C:\OpenServer\domains\site\views\admin\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61079e8109b7f0_86614586',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f5c8e68992c67553c58c78240d712c241326094' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\admin\\admin.tpl',
      1 => 1627889279,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61079e8109b7f0_86614586 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="blockNewCategory">
    Новая категория:
    <input name="newCategoryName" id="newCategoryName" type="text" value="">
    <br>

    Является подкатегорий для
    <select name="generalCatId">
        <option value="0">Главная категория
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>
    <br>
    <input type="button" onclick="newCategory();" value="Добавить категорию">    
</div><?php }
}

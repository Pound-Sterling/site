<?php
/* Smarty version 3.1.39, created on 2021-07-30 09:20:00
  from 'Z:\home\Site\views\default\leftcolumn.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6103b630ae07d6_29709080',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '428e5cbea8a7cb6cd5bac31506588ce67c8188f2' => 
    array (
      0 => 'Z:\\home\\Site\\views\\default\\leftcolumn.tpl',
      1 => 1627632199,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6103b630ae07d6_29709080 (Smarty_Internal_Template $_smarty_tpl) {
?><!--  -->
<div id="leftColumn">

    
    <nav id="cssmenu">
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <li><a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
                <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['children']))) {?>
                <ul>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['children'], 'itemChild');
$_smarty_tpl->tpl_vars['itemChild']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
$_smarty_tpl->tpl_vars['itemChild']->do_else = false;
?>
                    <li><a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>
</a></li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </li>
            <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </nav>
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
        <div id="loginBox">
            <div class="menuCaption">Авторизация</div>
            <input type="text" id="loginEmail" name="email" value=""><br>
            <input type="password" id="loginPwd" name="loginPwd" value=""><br>
            <input type="button" onclick="login();" id="loginBtn" value="Enter"><br>
        </div>
    
    
        <div id="registerBox">
            <div class="menuCaption showHidden" onclick="showRegisterBox();">Registration</div>
            <div id="registerBoxHidden">
                email:<br>
                <input type="text" id="email" name="email" value=""><br>
                пароль:<br>
                <input type="password" id="pwd1" name="pwd1" value=""><br>
                повторить пароль:<br>
                <input type="password" id="pwd2" name="pwd2" value=""><br>
                <input type="button" onclick="registerNewUser();" value="Registration"><br>
            </div>
        </div>
        <?php }?>
    <?php }?>
</div><?php }
}

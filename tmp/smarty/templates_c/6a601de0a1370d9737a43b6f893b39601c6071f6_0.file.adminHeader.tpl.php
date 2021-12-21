<?php
/* Smarty version 3.1.39, created on 2021-08-02 10:08:34
  from 'C:\OpenServer\domains\site\views\admin\adminHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_610799f27fe047_01222948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a601de0a1370d9737a43b6f893b39601c6071f6' => 
    array (
      0 => 'C:\\OpenServer\\domains\\site\\views\\admin\\adminHeader.tpl',
      1 => 1627888097,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:adminLeftcolumn.tpl' => 1,
  ),
),false)) {
function content_610799f27fe047_01222948 (Smarty_Internal_Template $_smarty_tpl) {
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
        123
    </div>
    <?php $_smarty_tpl->_subTemplateRender("file:adminLeftcolumn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div id="centerColumn"><?php }
}

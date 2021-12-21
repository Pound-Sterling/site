<?php

define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');

$template = 'default';
$templateAdmin = 'admin';

define ('TemplatePrefix', "../views/{$template}/");
define ('TemplateAdminPrefix', "../views/{$templateAdmin}/");
define ('TemplatePostfix', '.tpl');

define('TemplateWebPath', "/templates/{$template}/");
define('TemplateAdminWebPath', "/templates/{$templateAdmin}/");

require('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/lexer');

$smarty->assign('templateWebPath', TemplateWebPath);
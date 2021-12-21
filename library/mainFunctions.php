<?php

function loadPage($smarty, $controllerName, $actionName = 'index'){
    include_once PathPrefix . $controllerName . PathPostfix;

    $function = $actionName . 'Action';
    $function($smarty);
}

function loadTemplate($smarty, $templateName){
    $smarty->display(TemplatePrefix . $templateName . TemplatePostfix);
}
function loadAdminTemplate($smarty, $templateName){
    $smarty->display(TemplateAdminPrefix . $templateName . TemplatePostfix);
}

function d($value = null, $die = 1){

    function debugOut($a){
        echo '<br><b>'. basename($a['file']). '</b>'
            . "&nbsp;<b color='red'>({$a['line']})</b>"
            . "&nbsp;<b color='green'>{$a['function']} ()</b>"
            . "&nbsp; -- ". dirname( $a['file']);
    }
    echo '<pre>';
        $trace = debug_backtrace();
        array_walk($trace, 'debugOut');
        echo "\n\n";
        var_dump($value);
    echo '</pre>';

    if($die) die;
}

function createSmartyRsArray($rs){
    if(! $rs) return false;
    $smartyRs = array();
    while($row = mysqli_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

// redirect  
// @param string $url адрес для перенаправления

function redirect($url){
    if(! $url) $url = '/';
    header("Location: {$url}");
    exit;
}


<?php

//Модель для таблицы категорий ==================

// получить дочернии категории для категории $catId
// @param integer $catId ID категории
// @return array массив дочерних категорий
//
require_once '../config/db.php';


function getChildrenForCat($catId){
    $sql= "SELECT *
        FROM categories
        WHERE parent_id = '{$catId}'";
    $rs = mysqli_query($GLOBALS["db"],$sql);

    return createSmartyRsArray($rs);
}


// получить главные категории с привязками дочерних
function getAllMainCatsWithChildren(){
    $sql= 'SELECT *
            FROM categories
            WHERE parent_id = 0';
    
    $rs = mysqli_query($GLOBALS["db"], $sql);
    
    $smartyRS = array();
    while ($row = mysqli_fetch_assoc($rs)){

        $rsChildren = getChildrenForCat($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
        }

        $smartyRS[] = $row;
    }
    return $smartyRS;
}

//  Получить данные категории по айди
//  параметр integer $carId ID категории
//  array - массив - строка категории
//
function getCatById($catId){
    $catId = intval($catId);
    $sql = "SELECT *
            FROM categories
            WHERE 
            id = '{$catId}'";
    $rs = mysqli_query($GLOBALS["db"],$sql);


    return mysqli_fetch_assoc($rs); 


}

function getAllMainCategories(){
    
    $sql = 'SELECT *
            FROM categories
            WHERE parent_id = 0';

        $rs = mysqli_query($GLOBALS["db"], $sql);
        
        return createSmartyRsArray($rs);
}
function insertCat($catName, $catParentId = 0){

    
    $sql = "INSERT INTO
            categories (`parent_id`, `name`)
            VALUES ('{$catParentId}', '{$catName}')";

    mysqli_query($GLOBALS["db"], $sql);

    $id = mysqli_insert_id($GLOBALS["db"]);

    return $id;
}

function getAllCategories(){

    $sql = 'SELECT *
            FROM categories
            ORDER BY parent_id ASC';

    $rs = mysqli_query($GLOBALS["db"], $sql);

    return createSmartyRsArray($rs);
}

function updateCategoryData($itemId, $parentId = -1, $newName = ''){

    $set = array();

    if($newName){
        $set[] = "`name` = '{$newName}'";
    }

    if($parentId > -1){
        $set[] = "`parent_id` = '{$parentId}'";
    }

    $setStr = implode(", ", $set);
    $sql = "UPDATE categories
            SET {$setStr}
            WHERE id = '{$itemId}'";
    $rs = mysqli_query($GLOBALS["db"], $sql);
    
    return $rs;
}
/**
* Получение массива категорий
**/
function get_cat(){
	$query = "SELECT * FROM categories";
	$res = mysqli_query($GLOBALS["db"], $query);

	$arr_cat = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_cat[$row['id']] = $row;
	}
	return $arr_cat;
}
/*
 * Хлебные крошки
 */

function breadcrumbs($array, $id){
	if(!$id) return false;

	$count = count($array);
	$breadcrumbs_array = array();
	for($i = 0; $i < $count; $i++){
		if(isset($array[$id])){
			$breadcrumbs_array[$array[$id]['id']] = $array[$id]['name'];
			$id = $array[$id]['parent_id']; 
		} else break;
	}
	return array_reverse($breadcrumbs_array, true);
}
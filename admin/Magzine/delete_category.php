<?php

require_once("../class/category_class.php");

$category = new Category();

$category->set('id',$_GET['id']);

$statusDelete = $category->destroy(); 

if ($statusDelete == true) {
	header("location:list_category.php");
}else{
	die('Data canot be deleted');
}




?>
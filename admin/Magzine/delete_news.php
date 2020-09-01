<?php

require_once("../class/news_class.php");

$news = new News();

$news->set('id',$_GET['id']);

$statusDelete = $news->destroy(); 

if ($statusDelete == true) {
	header("location:list_news.php");
}else{
	die('Data canot be deleted');
}




?>


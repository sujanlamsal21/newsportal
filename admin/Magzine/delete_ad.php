<?php

include("../class/ad_class.php");

$advertisement = new Advertisement();

$advertisement->set('id', $_GET['id']);

$st = $advertisement->destroy();

if ($st == true) {
	header("location:list_ad.php");
}else{
    die("Data cannot be deleted");
}




?>
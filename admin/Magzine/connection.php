<?php

$link = mysqli_connect('localhost', 'root', '', 'newsmagzine');


 if (mysqli_connect_error($link) > 0) {
	die("database connection error");
 }

?>
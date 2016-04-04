<?php
	$protocol = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ? "https://" : "http://";  
	$root = $_SERVER['DOCUMENT_ROOT'].'/alice2/public/img/';
	move_uploaded_file($_FILES["image"]["tmp_name"], $root. $_FILES["image"]["name"]);
?>
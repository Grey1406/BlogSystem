<!DOCTYPE html>
<html>
	<head>
		<title>Blog System</title>
		<?PHP header("Content-Type: text/html; charset=utf-8");?>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
		<script src="ckeditor/ckeditor.js"/></script>
		
	</head>
	<body>
<div style="height:100px">
<span>
		<a href="/" ><h1 style="display:inline">Blog System</h1></a>
	
		<a href="/createArticle.php?id=null" style="display:inline;float:right;margin: 10px;">Create new article</a>
</span>
</div>


<?php
require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");
?>
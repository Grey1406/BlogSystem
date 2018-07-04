<!DOCTYPE html>
<html>
	<head>
		<title>Blog System</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
		<script src="ckeditor/ckeditor.js"/></script></head>
	<body>


<div style="height:100px" >

		<a href="/" ><h1 class="headerLink">Blog System</h1></a>
        <a href="/Authorisation.php" ><h1 class="headerLink">Авторизация</h1></a>
        <?php
        if($_SESSION['isAdmin'])
             echo '<a href="/createArticle.php?id=null"><h1 class="headerLink">Создать новую статью</h1></a>';
        ?>
</div>


<?php
if($_SESSION['isAdmin'])
    $AutorisationStat="Вы авторизованы как: ".$_SESSION['UserName'];
else
    $AutorisationStat="Вы не авторизованы";
?>

<p><?php echo($AutorisationStat); ?></p>


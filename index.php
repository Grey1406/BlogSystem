<?php session_start(); ?>

<?php
//получение линка для запросов
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($link, "utf8");
//файл с функциями
require_once 'Function.php';

$resultArticlesOrderDate = GetArticlesOrderDate($link);
$resultTopArticles = GetTopArticles($link);

mysqli_close($link);

?>


<?php include("header.php"); ?>

<?php include("indexView.php"); ?>

<?php include("footer.php");

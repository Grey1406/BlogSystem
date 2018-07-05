<?php session_start(); ?>


<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($link, "utf8");

require_once 'Function.php';
$resultActicle = GetArticle($link, $_GET['id']);
AddViewToArticle($link, $_GET['id']);
mysqli_close($link);
?>

<?php include("header.php"); ?>

<?php include("articleView.php"); ?>

<?php include("footer.php");
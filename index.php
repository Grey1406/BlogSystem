<?php session_start(); ?>

<?php
//получение линка для запросов
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database)
or die("ошибка" . mysqli_error($link));
mysqli_set_charset($link, "utf8");
//файл с функциями
require_once 'Function.php';

$resultActiclesOrderDate =GetArticlesOrderDate ($link);
$resultTopActicles = GetTopArticles ($link);

mysqli_close($link);

?>


<?php
include("header.php");
?>

<div class="articles" >
<H2>Последние статьи</H2>
<?php if (!empty($resultActiclesOrderDate)) : ?>
    <ul>
    <?php foreach($resultActiclesOrderDate as $item) : ?>
	    <li class="article">
			<?php
			if (!empty($item['image'])){
			echo '<div class="articleImage" ><img src="'.$item['image'].'" /></div>';}
			?>
			<div class="articleTitle"><h3>
			<?php
			echo '<a href="/article.php?id='.$item['id'].'">'.$item['header'].'</a>';
			?>
			</h3></div>
			<div class="articleBody">
			<?php
			$text=$item['text'];
			if (strlen($text)>600){
			$text = substr ($text, 0,strpos($text, " ", 600)); echo $text." ...";}
			else echo $text;
			?>
			</div>
		</li>
    <?php endforeach ?>
    </ul>
<?php endif ?>


</div>

<div class="topArticles">
<H2>Горячие статьи</H2>
<?php if (!empty($resultTopActicles)) : ?>
    <ul>
    <?php foreach($resultTopActicles as $item) : ?>
	    <li class="article">
			<div class="articleTitle"><h3>
			<?php
			echo '<a href="/article.php?id='.$item['id'].'">'.$item['header'].'</a>';
			?>
			</h3></div>
		</li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
</div>



<?php include("footer.php"); ?>

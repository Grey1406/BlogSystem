

<?php

include("header.php");

$query ="SELECT * FROM news ORDER BY date DESC limit 10";
$resultActicleOrderDate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 
$date1=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
$date2=date("Y-m-d");
$query ='SELECT * FROM news Where date between "'.$date1.'" and "'.$date2.'" ORDER BY viewCount DESC limit 10';
$resultTopActicle = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 
mysqli_close($link);

?>

<div class="articles" >

<H2>Последние статьи</H2>
<?php if (!empty($resultActicleOrderDate)) : ?>
    <ul>
    <?php foreach($resultActicleOrderDate as $item) : ?>
	    <li class="article">
			<?php
			if (!empty($item['image'])){
			echo '<div style="float:left;"><img src="'.$item['image'].'" /></div>';}
			?>
			<div class="articleTitle"><h3>
			<?php
			echo '<a href="/article.php?id='.$item['id'].'">'.$title=$item['header'].'</a>';
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
<?php if (!empty($resultTopActicle)) : ?>
    <ul>
    <?php foreach($resultTopActicle as $item) : ?>
	    <li class="article">
			<div class="articleTitle"><h3>
			<?php
			echo '<a href="/article.php?id='.$item['id'].'">'.$title=$item['header'].'</a>';
			?>
			</h3></div>
		</li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
</div>



<?php include("footer.php"); ?>
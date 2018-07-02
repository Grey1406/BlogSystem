
<?php

include("header.php");

$articleId = $_GET['id'];
$query ="SELECT * FROM news where id=".$articleId;
$resultActicleOrderDate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 

mysqli_close($link);
?>




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
            echo '<a href="/createArticle.php?articleId='.$item['id'].'">--------редактировать</a>';
			?>
			</h3></div>
			<div class="articleBody">
			<?php
			$text=$item['text'];
			echo $text;
			?>
			</div>
		</li>
    <?php endforeach ?>
    </ul>
<?php endif ?>




<?php include("footer.php"); ?>

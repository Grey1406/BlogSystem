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


<?php
include("header.php");
?>

<div class="articles" >
<H2>Последние статьи</H2>
<?php if (!empty($resultArticlesOrderDate)) :
    ?>
    <ul>
    <?php foreach ($resultArticlesOrderDate as $item) :
        ?>
	    <li class="article">
			<?php
            if (!empty($item['image'])) {
                echo '<div class="articleImage" ><img src="'.$item['image'].'" /></div>';
            }
            ?>
			<div class="articleTitle"><h3>
			<?php
            echo '<a href="/article.php?id='.$item['id'].'">'.$item['header'].'</a>';
            ?>
			</h3></div>
			<div class="articleBody">
			<?php
            $text = $item['text'];
            if (mb_strlen($text) > 300) {
                $text = mb_substr($text, 0, mb_strpos($text, " ", 300)) . "...";
            }
            echo $text;
            ?>
			</div>
		</li>
    <?php endforeach ?>


    </ul>
<?php endif ?>


</div>

<div class="topArticles">
<H2>Горячие статьи</H2>
<?php if (!empty($resultTopArticles)) :
    ?>
    <ul>
    <?php foreach ($resultTopArticles as $item) :
        ?>
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



<?php include("footer.php");

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


<?php if (!empty($resultActicle)) :
    ?>
    <ul>
	    <li class="article">
			<?php
            if (!empty($resultActicle['image'])) {
                echo '<div class="articleImage"><img src="'.$resultActicle['image'].'" /></div>';
            }
            ?>
			<div class="articleTitle"><h3>
			<?php
            echo ($resultActicle['header']);
            if ($_SESSION['isAdmin']) {
                echo '<a href="/createArticle.php?articleId=' . $resultActicle['id'] . '">--------редактировать</a>';
            }
            ?>
			</h3></div>
			<div class="articleBody">
			<?php
            echo $resultActicle['text'];
            ?>
			</div>
		</li>
    </ul>
<?php endif ?>




<?php include("footer.php"); ?>

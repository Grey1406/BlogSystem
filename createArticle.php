<?php
session_start();

if (!$_SESSION['isAdmin']) {
    header('Refresh: 3; url=/Authorisation.php');
    echo "Вы не прошли авторизацию ! через 3 секунды это сообщение исчезнет";
}
?>


<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($link, "utf8");

require_once 'Function.php';
?>

<?php include("header.php");?>

<?php
$articleId = null;
if (array_key_exists('articleId', $_POST)) {
    $articleId = $_POST['articleId'];
}
if (array_key_exists('articleId', $_GET)) {
    $articleId = $_GET['articleId'];
}
$updateFlag = "false";
if (array_key_exists('update', $_GET)) {
    $updateFlag = $_GET['update'];
}

if ($updateFlag == "true") {
    $title = $_POST['title'];
    $Text = $_POST['articleText'];
    if (array_key_exists('articleImage', $_POST)) {
        $ImagePath = $_POST['articleImage'];
    } elseif (array_key_exists('imagePath', $_FILES) && $_FILES['imagePath']['tmp_name'] !== "") {
        $ImagePath = GetImageFile($_FILES);
    } else {
        $ImagePath = null;
    }
    if ($articleId === "null") {
        $resultInsert = InsertArticle($link, $title, $Text, $ImagePath);
        if ($resultInsert) {
            echo("Статья успешно создана");
        } else {
            echo("При создании что-то пошло не так");
        }
        $articleId = GetIdLastInsertedArticle($link);
    } else {
        $resultUpdate = UpdateArticle($link, $title, $Text, $ImagePath, $articleId);
        if ($resultUpdate) {
            echo("Статья успешно изменена");
        } else {
            echo("При сизменении что-то пошло не так");
        }
    }
}

if (is_null($articleId) || $articleId=="null") {
    $title = '';
    if (array_key_exists('title', $_POST)) {
        $title = $_POST['title'];
    }
    $Text = '';
    if (array_key_exists('articleText', $_POST)) {
            $Text = $_POST['articleText'];
    }
    $ImagePath = null;
    if (!array_key_exists('articleImage', $_POST)) {
        if (array_key_exists('imagePath', $_FILES) && $_FILES['imagePath']['tmp_name'] !== "") {
            $ImagePath = GetImageFile($_FILES);
        }
    }
}
else {
        $displayItem = GetArticle($link, $articleId);
        $title = $displayItem['header'];
        $Text = $displayItem['text'];
        $ImagePath = $displayItem['image'];

}
?>





<?php
if (is_null($articleId)) {
    echo('<H2>Создание новой статьи:</H2>');
} else {
    echo ('<H2>Редактирование статьи: '.$articleId.'</H2>');
}
?>

<form action="createArticle.php?update=true" method=POST enctype="multipart/form-data">
<input type="hidden" name=articleId value =
<?php if (is_null($articleId)) {
        echo('null');
} else {
        echo($articleId);
}?>>

<p>Заголовок статьи:</p>

<input type=Text name=title value ="<?php echo($title);?> "  required >

<p>Текст статьи:</p>
<textarea name=articleText id="editor1" rows="10" cols="80"  required>
<?php echo($Text);?>
</textarea>

<p>Картинка:</p>
<?php
if (is_null($ImagePath) || empty($ImagePath)) {
    echo('<input type="file" name=imagePath >');
} else {
    echo ('<div class=article style="float:left;"><img name=articleImage src="'.$ImagePath.'" /></div>');
    echo ('<input type="hidden" name=articleImage value = '.$ImagePath.'>');
}
?>
<button type=submit>опубликовать статью</button>
</form>


<?php include("footer.php");


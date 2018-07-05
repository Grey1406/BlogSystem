
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

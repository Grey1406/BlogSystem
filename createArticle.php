<?php include("header.php");?>

<?php 
$articleId=null;
if(array_key_exists('articleId',$_POST))
$articleId =$_POST['articleId'];
if(array_key_exists('articleId',$_GET))
$articleId =$_GET['articleId'];
$updateFlag="false";
if(array_key_exists('update',$_GET))
$updateFlag =$_GET['update'];

If($updateFlag=="true")
{
	
		$title =$_POST['title'];
		$Text =$_POST['articleText'];
		if(array_key_exists('articleImage',$_POST))
			$ImagePath=$_POST['articleImage'];
		elseif(array_key_exists('imagePath',$_FILES)&&$_FILES['imagePath']['tmp_name']!=="")
			{
				$filePath  = $_FILES['imagePath']['tmp_name'];
				$errorCode = $_FILES['imagePath']['error'];
				// Создадим ресурс FileInfo
				$fi = finfo_open(FILEINFO_MIME_TYPE);
				// Получим MIME-тип
				$mime = (string) finfo_file($fi, $filePath);
				// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
				if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
				$name = md5_file($filePath);
				$image = getimagesize($filePath);
				// Сгенерируем расширение файла на основе типа картинки
				$extension = image_type_to_extension($image[2]);
				// Сократим .jpeg до .jpg
				$format = str_replace('jpeg', 'jpg', $extension);
				// Переместим картинку с новым именем и расширением в папку /pics
				$newFilePath=__DIR__ . "/images/" . $name . $format;
				if (!move_uploaded_file($filePath,$newFilePath )) {
					die('При записи изображения на диск произошла ошибка.');
				}
				$ImagePath="/images/".$name.$format;
			}
			else $ImagePath=null;
		
	
	if( $articleId==="null")
	{	
		$query ="INSERT INTO `news`(`id`, `header`, `text`, `image`, `date`, `viewCount`) 
		VALUES (null,'".$title."','".$Text."','".$ImagePath."','".date("Y-m-d")."','0')";
		$resultInsert = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 
		if($resultInsert)
		print_r("Статья успешно создана");
		$articleId=mysqli_insert_id($link); 
	}
	else 
	{	
		$query ="UPDATE `news` SET 
			`header`='".$title."',
			`text`='".$Text."',
			`image`='".$ImagePath."' WHERE id = ".$articleId;
		$resultUpdate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 
		if($resultUpdate)
		print_r("Статья успешно изменена");

	}
}

if(is_null($articleId)||$articleId=="null")
	{
		$title = 'Обязателен к заполнению !';
		if(array_key_exists('title',$_POST))
		$title =$_POST['title'];
		$Text = 'Этот блок обязателен к заполнению !';
		if(array_key_exists('articleText',$_POST))
		$Text =$_POST['articleText'];
		$ImagePath=null;
		if(!array_key_exists('articleImage',$_POST))
		{
			if(array_key_exists('imagePath',$_FILES)&&$_FILES['imagePath']['tmp_name']!=="")
			{
				$filePath  = $_FILES['imagePath']['tmp_name'];
				$errorCode = $_FILES['imagePath']['error'];
				// Создадим ресурс FileInfo
				$fi = finfo_open(FILEINFO_MIME_TYPE);
				// Получим MIME-тип
				$mime = (string) finfo_file($fi, $filePath);
				// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
				if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
				$name = md5_file($filePath);
				$image = getimagesize($filePath);
				// Сгенерируем расширение файла на основе типа картинки
				$extension = image_type_to_extension($image[2]);
				// Сократим .jpeg до .jpg
				$format = str_replace('jpeg', 'jpg', $extension);
				// Переместим картинку с новым именем и расширением в папку /pics
				$newFilePath=__DIR__ . "/images/" . $name . $format;
				if (!move_uploaded_file($filePath,$newFilePath )) {
					die('При записи изображения на диск произошла ошибка.');
				}
				$ImagePath="/images/".$name.$format;
			}
		}
		else 
		{
			
		}
	}
	else
	{
		$query = "SELECT * FROM news WHERE id={$articleId}";
		$result = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link)); 
		$displayItem=[];
		foreach($result as $item)
		$displayItem=$item;
		$title = $displayItem['header'];
		$Text = $displayItem['text'];
		$ImagePath=$displayItem['image'];
	}

?>

<?php 
	
	if(is_null($articleId))
		echo('<H2>Создание новой статьи:</H2>');
	else 
	{	
		echo '<H2>Редактирование статьи: '.$articleId.'</H2>' ;
	}
?>

<form action="createArticle.php?update=true" method=POST enctype="multipart/form-data">
<input type=Text style="width:0px;height:0px;visibility:hidden" name=articleId value =<?php if(is_null($articleId))echo('null');else echo($articleId);?>>
<p>Заголовок статьи:</p>
<input type=Text name=title value = <?php echo('"'.$title.'"');?>>
<p>Текст статьи:</p>
<textarea name=articleText id="editor1" rows="10" cols="80">
<?php echo($Text);?>
</textarea>
<p>Картинка:</p>



<?php 
	if(is_null($ImagePath)||empty($ImagePath))
		echo('<input type="file" name=imagePath >');
	else 
	{	
		echo '<div class=article style="float:left;"><img name=articleImage src="'.$ImagePath.'" /></div>' ;
		echo '<input type=Text style="width:0px;height:0px;visibility:hidden" name=articleImage value = '.$ImagePath.'>' ;
	}
?>

<button type=submit>опубликовать статью</button>
</form>




<?php include("footer.php");?>
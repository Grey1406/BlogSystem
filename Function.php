<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 04.07.18
 * Time: 9:52
 */

function GetArticlesOrderDate ($link)
{
    $query ="SELECT * FROM news ORDER BY date DESC";
    $resultArticleOrderDate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultArticleOrderDate;
}
function GetTopArticles ($link)
{
    $date1=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
    $date2=date("Y-m-d");
    $query ='SELECT * FROM news Where date between "'.$date1.'" and "'.$date2.'" ORDER BY viewCount DESC limit 10';
    $resultTopArticle = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultTopArticle;
}

function GetArticle($link,$articleId)
{
    $query ="SELECT * FROM news where id='".$articleId."'";
    $resultQuery = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    $returnedResult=[];
    foreach($resultQuery as $item)
        $returnedResult=$item;
    return $returnedResult;
}
function AddViewToArticle($link,$articleId)
{
    $query ="SELECT * FROM news where id='".$articleId."'";
    $resultQuery = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    $returnedResult=[];
    foreach($resultQuery as $item)
        $returnedResult=$item;
    $query ="UPDATE `news` SET 
			`header`='".$returnedResult['header']."',
			`text`='".$returnedResult['text']."',
			`image`='".$returnedResult['imagePath']."',
			`viewCount`='".($returnedResult['viewCount']+1)."'  WHERE id = ".$articleId;
    $resultUpdate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultUpdate;
}


function GetAllUsers($link)
{
    $Users=[];
    $query ="SELECT * FROM users ";
    $resultUsers= mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    foreach ($resultUsers as $user)
        $Users[] = $user;
    return $Users;
}

function InsertArticle($link,$title,$text,$imagePath)
{
    $query = "INSERT INTO `news`(`id`, `header`, `text`, `image`, `date`, `viewCount`) 
		VALUES (null,'" . $title . "','" . $text . "','" . $imagePath . "','" . date("Y-m-d") . "','0')";
    $resultInsert = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultInsert;


}
function UpdateArticle($link,$title,$text,$imagePath,$articleId)
{
    $query ="UPDATE `news` SET 
			`header`='".$title."',
			`text`='".$text."',
			`image`='".$imagePath."' WHERE id = ".$articleId;
    $resultUpdate = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultUpdate;

}
function GetIdLastInsertedArticle($link)
{
    $articleId = mysqli_insert_id($link);
    return $articleId;
}

function GetImageFile($My_FILES)
{
    $filePath  = $My_FILES['imagePath']['tmp_name'];
    $errorCode = $My_FILES['imagePath']['error'];
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
    return $ImagePath="/images/".$name.$format;
}
//("SELECT * FROM users WHERE username = ?", $_GET['username']);
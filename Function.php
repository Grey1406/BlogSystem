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

    //mysqli_real_escape_string($link, gfgf );

    $query ='SELECT * FROM news Where date between "'.mysqli_real_escape_string($link, $date1 )
        .'" and "'.mysqli_real_escape_string($link, $date2).'" ORDER BY viewCount DESC limit 10';
    $resultTopArticle = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultTopArticle;
}

function GetArticle($link,$articleId)
{
    $query ="SELECT * FROM news where id='".mysqli_real_escape_string($link, $articleId)."'";
    $resultQuery = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    $returnedResult=[];
    foreach($resultQuery as $item)
        $returnedResult=$item;
    return $returnedResult;
}
function AddViewToArticle($link,$articleId)
{
    $query ="SELECT * FROM news where id='".mysqli_real_escape_string($link, $articleId)."'";
    $resultQuery = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    $returnedResult=[];
    foreach($resultQuery as $item)
        $returnedResult=$item;
    $query ="UPDATE `news` SET 
			`header`='".mysqli_real_escape_string($link, $returnedResult['header'])."',
			`text`='".mysqli_real_escape_string($link, $returnedResult['text'])."',
			`image`='".mysqli_real_escape_string($link, $returnedResult['image'])."',
			`viewCount`='".mysqli_real_escape_string($link, ($returnedResult['viewCount']+1))."' 
			 WHERE id = ".mysqli_real_escape_string($link, $articleId);
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
		VALUES (null,'" .
        mysqli_real_escape_string($link, $title) . "','" .
        mysqli_real_escape_string($link, $text) . "','" .
        mysqli_real_escape_string($link, $imagePath) . "','" . date("Y-m-d") . "','0')";
    $resultInsert = mysqli_query($link, $query) or die("ошибка " . mysqli_error($link));
    return $resultInsert;


}
function UpdateArticle($link,$title,$text,$imagePath,$articleId)
{
    $query ="UPDATE `news` SET 
			`header`='".mysqli_real_escape_string($link, $title)."',
			`text`='".mysqli_real_escape_string($link, $text)."',
			`image`='".mysqli_real_escape_string($link, $imagePath)."' 
			WHERE id = ".mysqli_real_escape_string($link, $articleId);
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

<?php

function GetArticlesOrderDate($link)
{
    $query = "SELECT * FROM news ORDER BY date DESC";
    $resultArticleOrderDate = mysqli_query($link, $query);
    $returnedMass=[];
    foreach ($resultArticleOrderDate as $item) {
        if (mb_strlen($item['text']) > 300) {
            $item['text'] = mb_substr($item['text'], 0, mb_strpos($item['text'], " ", 300)) . "...";
        }
        $returnedMass[]=$item;
    }
    return  $returnedMass;
}

function GetTopArticles($link)
{
    $date1 = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
    $date2 = date("Y-m-d");
    $query = "SELECT * FROM news Where date between '".mysqli_real_escape_string($link, $date1)
        ."' and '".mysqli_real_escape_string($link, $date2)."' ORDER BY viewCount DESC limit 10";
    $resultTopArticle = mysqli_query($link, $query);
    return $resultTopArticle;
}

function GetArticle($link, $articleId)
{
    $query = "SELECT * FROM news where id='".mysqli_real_escape_string($link, $articleId)."'";
    $resultQuery = mysqli_query($link, $query);
    $returnedResult = [];
    foreach ($resultQuery as $item) {
        $returnedResult = $item;
    }
    return $returnedResult;
}

function AddViewToArticle($link, int $articleId)
{
    $query = "UPDATE `news` SET 
			`viewCount`= viewCount + 1
			 WHERE id = ".mysqli_real_escape_string($link, $articleId);
    $resultUpdate = mysqli_query($link, $query);
    return $resultUpdate;
}

function GetAllUsers($link)
{
    $Users = [];
    $query = "SELECT * FROM users ";
    $resultUsers = mysqli_query($link, $query);
    foreach ($resultUsers as $user) {
        $Users[] = $user;
    }
    return $Users;
}

function InsertArticle($link, $title, $text, $imagePath)
{
    $query = "INSERT INTO `news`(`id`, `header`, `text`, `image`, `date`, `viewCount`) 
		VALUES (null,'" .
        mysqli_real_escape_string($link, $title) . "','" .
        mysqli_real_escape_string($link, $text) . "','" .
        mysqli_real_escape_string($link, $imagePath) . "','" . date("Y-m-d") . "','0')";
    $resultInsert = mysqli_query($link, $query);
    return $resultInsert;
}

function UpdateArticle($link, $title, $text, $imagePath, $articleId)
{
    $query = "UPDATE `news` SET 
			`header`='".mysqli_real_escape_string($link, $title)."',
			`text`='".mysqli_real_escape_string($link, $text)."',
			`image`='".mysqli_real_escape_string($link, $imagePath)."' 
			WHERE id = ".(int)$articleId;
    $resultUpdate = mysqli_query($link, $query);
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
    $name = md5_file($filePath);
    $image = getimagesize($filePath);
    $extension = image_type_to_extension($image[2]);
    $format = str_replace('jpeg', 'jpg', $extension);
    $newFilePath = __DIR__ . "/images/" . $name . $format;
    move_uploaded_file($filePath, $newFilePath);
    return $ImagePath = "/images/".$name.$format;
}

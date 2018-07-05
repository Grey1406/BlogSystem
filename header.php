<?php
if ($_SESSION['isAdmin']){
    $AuthorisationStat = "Вы авторизованы как: ".$_SESSION['UserName'];
} else {
    $AuthorisationStat = "Вы не авторизованы";
}
?>

<?php include("headerView.php"); ?>



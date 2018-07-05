<?php
session_start();
session_unset();
?>

<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($link, "utf8");

require_once 'Function.php';

$users = GetAllUsers($link);

mysqli_close($link);
?>



<?php


if (!isset($_POST['UserName']) || empty($_POST['UserName'])) {
    $_SESSION['UserName'] = null;
} else {
    $_SESSION['UserName'] = $_POST['UserName'];
}
if (!isset($_POST['UserPass']) || empty($_POST['UserPass'])) {
    $_SESSION['UserPass'] = null;
} else {
    $_SESSION['UserPass'] = $_POST['UserPass'];
}


$_SESSION['isAdmin'] = false;
if (!is_null($_SESSION['UserName']) && !is_null($_SESSION['UserPass'])) {
    foreach ($users as $user) {
        if ($_SESSION['UserName'] == $user['name'] && $_SESSION['UserPass'] == $user['pass']) {
            $_SESSION['isAdmin'] = true;
            break;
        }
    }
}

?>

<?php include("header.php"); ?>





<form action="Authorisation.php" method=POST >
    <h3>Авторизация:</h3>
    <p>Логин:
    <input type=Text name=UserName value ="" required></p>
    <p>Пароль:
    <input type=Password name=UserPass value ="" required></p>
    <button type=submit>Авторизироваться</button>
</form>

<?php include("footer.php"); ?>


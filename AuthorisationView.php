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
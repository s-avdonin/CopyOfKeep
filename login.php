<?php
session_start();
// страница логина

// команда загрузить содержимое из файла "db.php" (описывает подключение к БД)
include_once("db.php");

// создадим будущее сообщение о неверном пароле
$pass_err = "";
// если форма отправлена
if (isset($_POST['submit'])) {
    // записываем в пременные данные формы
    $login = $_POST['login'];
    $pass = md5($_POST['pass']);
    // запрашиваем из БД данные о зарегистрированном пользователе
    $login_query = mysqli_query($connection, "SELECT * 
                                                FROM user 
                                                WHERE login = '$login'");
    // записываем в массив $login_data полученные данные
    $login_data = mysqli_fetch_array($login_query);
    // проверяем правильность пароля
    if ($login_data['pass'] == $pass) {
        // запиываем в глобальный массив $_SESSION данные юзера
        $_SESSION['login'] = $login_data['login'];
        $_SESSION['name'] = $login_data['name'];
        $_SESSION['id'] = $login_data['id'];
        ?>
        <script type='text/javascript'>
            // обновляем главное окно, чтобы применить изменения
            window.parent.location.reload();
        </script>
        <?php
    } else {
        // если пароли не совпадают - сообщаем об этом
        $pass_err = "<span style='color: red'>Incorrect password or login!</span><br>";
    }
}
// если нажата кнопка выхода
if (isset($_POST['exit'])) {
    // завершаем сессию
    session_destroy();
    ?>
    <script type='text/javascript'>
        // обновляем страницу для применения изменений
        window.parent.location.reload();
    </script>
    <?php
}
?>
<html>
<head>
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
// если юзер не залогинился отобразить:
if (!isset($_SESSION['login'])) {
    ?>
    <form method="post" action="login.php">
        <input type="text" name="login" placeholder=" Login" required/><br><br>
        <input type="password" name="pass" placeholder=" Password" required/><br><br>
        <input type="submit" name="submit" value="Войти"/>
        <input type="button" onclick="location.href='reg.php'" value="Регистрация">
    </form>
    <?php
// если юзер залогинился
} else {
    // вывести приветствие
    echo "<b>Wellcome, " . $_SESSION['name'] . "!</b><br><br>";
    ?>
    <form method="post" action="login.php">
        <input type="submit" name="exit" value="Выйти">
    </form>
    <?php
}
// сообщение о неверном пароле или логине
echo $pass_err;
?>
</body>
</html>
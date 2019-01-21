<?php
session_start();
// страница регистрации

// команда загрузить содержимое из файла "db.php" (описывает подключение к БД)
include_once("db.php");
// запишем сообщение о неверном пароле
$pass_err = "<br>";
?>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// если форма отправлена
if (isset($_POST['submit'])) {
    // записываем в пременные данные формы
    $name = $_POST['name'];
    $login = $_POST['login'];
    $exist = mysqli_query($connection, "SELECT id FROM user WHERE login = '$login'");
    if(mysqli_num_rows($exist)>0) {
        ?><script>
        // сообщение об ошибке
        alert("Такой пользователь уже существет! Выберите другой логин.");
    </script><?php
    }
    else {

        // предварительно проверяем совпадают ли введённые пароли
        if ($_POST['pass'] == $_POST['r_pass']) {
            // сохраняем только хеш пароля
            $pass = md5($_POST['pass']);
            $pass_err = "<br>";
            // запрос к базе данных на добавление юзера
            mysqli_query($connection, "INSERT INTO user 
                                    VALUES ('','$name','$login','$pass')");
            ?>
            <script>
                // сообщение об успешной регистрации
                alert("Вы успешно зарегистрировались! Войдите под своим логином.");
                // обновление страницы для применения изменений
                window.parent.location.reload();
            </script><?php
            // если пароли не совпадают
        } else {
            // сообщаем о несовпадении паролей
            $pass_err = "<span style='color: red'>Passwords must match!</span><br>";
        }
    }
}
?>
<!-- форма регистрации -->
<form method="post" action="reg.php">
    <input type="text" name="name" placeholder=" Name" required/><br><br>
    <input type="text" name="login" placeholder=" Login" required/><br><br>
    <input type="password" name="pass" placeholder=" Password" required/><br>
<!-- вывод сообщения об ошибке -->
    <?php echo $pass_err ?>
    <input type="password" name="r_pass" placeholder=" Repeat password" required/><br><br>
    <input type="submit" name="submit" value="Зарегистрироваться"/>
</form>
</body>
</html>
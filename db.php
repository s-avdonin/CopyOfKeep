<?php


// создаём переменную в которую записываем подключение к БД
//$connection = mysqli_connect ("localhost", "db_user", "1234", "keepnotes");
$connection = mysqli_connect ("eu-cdbr-west-02.cleardb.net:3306", "b003195f256764", "4fa37762", "heroku_420524c624766a5");
// устанавливаем для подключения кодировку utf8
// mysqli_set_charset($connection,"utf8" );
// если подключение неудачно выводим ошибку
if(!$connection)
{
	mysqli_error($connection);
}
?>
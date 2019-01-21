<?php
// если нужно, создаём базу данных и таблицы


// создаём переменную в которую записываем подключение к БД
$connection = mysqli_connect ("localhost", "db_user", "1234", "keepnotes");
// устанавливаем для подключения кодировку utf8
mysqli_set_charset($connection,"utf8" );
// если подключение неудачно выводим ошибку
if(!$connection)
{
	 
            <script>
                // сообщение об ошибке подключения
                alert("Не удалось подключиться к базе данных.");
             </script>
    mysqli_error($connection);
}
?>
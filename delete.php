<?php
session_start();
// страница удаления заметки

// в отдельно созданном файле берём параметры подключения
include_once ("db.php");
// из глоб. массива $_GET получаем значение, переданное в адресной строке и записываем его в переменную
$id = $_GET['id'];
// удаляем текущую запись из БД
mysqli_query($connection, "DELETE FROM notes 
                              WHERE id = '$id'");
// закрываем подключение
mysqli_close($connection);
// перенаправляем на главную
header("Location: index.php");
?>
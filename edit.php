<?php
session_start();
// страница редактирования заметки
?>
<!doctipe html>
<html>
<head>
    <title>Edit Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="margin: 0%">
<?php
// из глоб. массива $_GET получаем значение, переданное в адресном запросе и записываем его в переменную
$note_id = $_GET['id'];
// в отдельно созданном файле берём параметры подключения
include_once("db.php");
// запрос к БД: записываем в переменную $res выборку записи с полученным ИД из таблицы notes
$res = mysqli_query($connection, "SELECT id, title, text, last_change FROM notes WHERE id =$note_id") or die("Error: ".mysqli_error($connection));
// результат выборки $res записываем в массив
$row = mysqli_fetch_array($res);

// действия при отправке формы
if (isset($_POST['ok'])) {
// записываем в переменные данные из формы
    $title = strip_tags(trim($_POST['title']));
    $text = strip_tags(trim($_POST['text']));
    $date = $_POST['date'];
// запрос к БД: обновляем полученные значения в БД
    mysqli_query($connection, "UPDATE notes 
                                SET title='$title', text='$text', last_change='$date' 
                                WHERE id='$note_id'");
// закрываем соединение с БД
    mysqli_close($connection);
    // перезагружаем страницу, чтобы обновить данные
    echo "<script>window.parent.location.reload();</script>";
}
?>
<!-- форма редактирования заметки -->
<div style="width: 300px; margin: 2em" class="note_block">
    <h3>Редактировать заметку</h3>
    <form method="post" action="edit.php?id=<?php echo $note_id; ?>" >
        <input name="title" type="text" value="<?php echo $row['title'] ?>" style="width: 95%" /><br><br>
        <textarea   name="text" cols="30" rows="11" ><?php echo $row['text'] ?></textarea>
        <input      name="date" type="hidden"  value="<?php echo date('Y-m-d H:i:s'); ?>" /> <br><br>
        <input      name="ok" type="submit" value="Сохранить" onclick="window.parent.document.getElementById('addit').style.display='none'" />
        <input      name="cancel" type="button" value="Отмена" onclick="window.parent.document.getElementById('addit').style.display='none'; window.parent.document.getElementById('note_img').style.display='inline'" style="float: right" />
    </form>
</div>

</body>
</html>
<!doctipe html>
<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
// страница добавления новой заметки
?>
<html>

<head>
    <title>Add Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="margin: 0%">

<div style="width: 300px; margin: 2em" class="note_block">
    <h3>Новая заметка</h3>
    <!-- ПОСТ-форма добавления новой заметки   -->
    <form method="post" action="add.php">
        <input name="title" type="text" placeholder=" Заголовок" style="width: 95%"/><br><br>
        <textarea name="text" placeholder=" Основной текст" rows="11"></textarea>
        <input name="date" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>"/> <br><br>
        <input name="ok" type="submit" value="Сохранить"/>
        <input name="cancel" type="button" value="Отмена" onclick="window.parent.document.getElementById('addit').style.display='none'; window.parent.document.getElementById('note_img').style.display='inline'" style="float: right"/>
    </form>
</div>
<?php
// включаем файл описывающий подключение
include_once("db.php");
// при отправке формы
if (isset($_POST['ok'])){
    // если юзер залогинился
    if (isset($id)) {
// записываем в переменные данные из формы
        $title = strip_tags(trim($_POST['title']));
        $text = strip_tags(trim($_POST['text']));
        $date_time = $_POST['date'];

// запрос к БД: передаём полученные значения в базу данных если заголовок или название не пусты
        if ($title != "" OR $text != "") {
            mysqli_query($connection, "INSERT INTO notes (title, text, last_change, users_id)  
                                    VALUES ('$title', '$text', '$date_time', '$id')");
// закрываем соединение с БД
            mysqli_close($connection);
        }
    }
    ?>
    <script type='text/javascript'>
//        обновляем страницу, чтобы проявились изменения
        window.parent.location.reload();
    </script>
    <?php
}
?>
</body>
</html>
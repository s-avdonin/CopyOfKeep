<?php
// открываем сессию
session_start();
// если юзер залогинился, то
if (isset($_SESSION['id'])) {
    // записываем в переменную его ИД
    $id = $_SESSION['id'];
}
?>
<!doctipe html>
<html>

<head>
    <title>Keep Notes</title>
    <!--    подключаем стили -->
    <link rel="stylesheet" href="style.css">
    <!--    подключаем скрипты -->
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<?php
// если юзер залогинился
if (isset($id)) {
// в отдельно созданном файле берём параметры подключения
    include_once("db.php");
	
// запрос к БД: записываем в переменную $result выборку всех записей из таблицы notes по текущему пользователю
    $result = mysqli_query($connection, "SELECT * 
                                            FROM notes 
                                            WHERE users_id = $id
                                            ORDER BY last_change 
                                            DESC 
");
// закрываем соединение с БД
    mysqli_close($connection);
}
?>
<div style="height: 800px; width: 400px; float: left">
<iframe id="login" src="login.php" height="300px" style="float: left; margin: 2em" seamless></iframe>
    <br>
<!-- вставляем скрытый фрейм, который будет выводить формы добавления или редактирования записей -->
<iframe id="addit" src="add.php" style="display: none; float: left; width: 400px; height: 420px; border: none" seamless></iframe>
<?php
// если юзер залогинился
if (isset($id)) {
    ?>
    <!-- картинка, кот. по клику выполняет функцию show_add() -->
    <div id="note_img" style="width: 400px; height: 400px; float: left">
    <input type="image" src="заметка1.png" style=" margin: 3em 3em 0em 4em" onclick="show_add()" value="Добавить заметку" /><br>
    </div>
</div>
    <?php
    // запускаем цикл, который обращается к (здесь же созданной) переменной $notes_row
    // и пока в ней есть значения выполняется тело цикла
    // т.е. выводятся все заметки 
    while ($notes_row = mysqli_fetch_array($result)) {
        // создаём $row_id в которую записываем ИД текущей заметки
        $row_id = $notes_row['id'];
        ?>

        <span class="note_block">
<!-- выводим заголовок название текущей заметки -->
<h3 style="height: 2em"><?php echo $notes_row['title'] ?></h3>
            <!-- выводим текст заметки -->
<p><?php echo $notes_row['text'] ?></p>
            <!-- выводим дату последнего изменения заметки-->
<p style="font-size: small; text-align: right; margin-right: 2em"><?php echo $notes_row['last_change'] ?></p>
            <!-- кнопка вызывает функцию show_edit(ИД текущей заметки) -->
            <button onclick="show_edit(<?php echo $notes_row['id']; ?>)" style="float: left">Изменить</button>
            <!-- кнопка вызывает удаление текущей заметки -->
        <button style="float: right" onclick="location='delete.php?id=<?php echo $row_id ?>'">Удалить</button>
    </span>
    <?php }
} else {
    // если юзер не залогинился выводим предложение это сделать
    ?>
        </div>
        <h2 style="text-align: center">Войдите, чтобы начать работу с заметками.</h2><?php
}
?>
</body>
</html>
// добавление заметки
function show_add() {
    // выводит в скрытый айфрейм страницу добавления заметки
    document.getElementById('addit').src='add.php';
    // делает скрытый айфрейм видимым
    document.getElementById('addit').style.display='block';
    // а также скрывает картинку-ссылку на добавление заметки
    document.getElementById('note_img').style.display='none';
}
// редактирование заметки (получает ИД заметки)
function show_edit(id) {
    // выводит в айфрейм страницу редактирования заметки
    document.getElementById('addit').src="edit.php?id="+id;
    // делает скрытый айфрейм видимым
    document.getElementById('addit').style.display='block';
    // а также скрывает картинку-ссылку на добавление заметки
    document.getElementById('note_img').style.display='none';
}
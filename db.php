<?php
// если нужно, создаём базу данных и таблицы
/*CREATE DATABASE IF NOT EXISTS keepnotes CHARACTER SET latin1 COLLATE latin1_swedish_ci

USE keepnotes;
CREATE  TABLE IF NOT EXISTS keepnotes.user (
  id INT  AUTO_INCREMENT ,
  name VARCHAR(30),
  login VARCHAR(30) ,
  pass VARCHAR(64),
   PRIMARY KEY (id) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS keepnotes.notes (
  id INT  AUTO_INCREMENT ,
  title TINYTEXT,
  text TEXT ,
  last_change DATETIME,
  users_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES user(id)  )
ENGINE = InnoDB;
*/
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
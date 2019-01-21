CREATE  TABLE user (
  id INT  AUTO_INCREMENT ,
  name VARCHAR(30),
  login VARCHAR(30) ,
  pass VARCHAR(64),
   PRIMARY KEY (id) );


CREATE  TABLE notes (
  id INT  AUTO_INCREMENT ,
  title TINYTEXT,
  text TEXT ,
  last_change DATETIME,
  users_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES user(id)  );
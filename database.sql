CREATE DATABASE graphqldatabase;

USE graphqldatabase;

CREATE TABLE users (
  id int PRIMARY KEY AUTO_INCREMENT,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL
);

INSERT INTO users (id, first_name, last_name, email) VALUES
(1, 'marcos', 'federico', 'carlos@gmail.cm'),
(2, 'Juan', 'Fernandez', 'juan@gmail.com');

CREATE TABLE addresses (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  name varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO addresses (id, user_id, name, description) VALUES
(1, 1, 'casa', 'cll 68 # 59 - 54 apt. 110'),
(2, 1, 'trabajo', 'fake street 123'),
(3, 2, 'apartamento', 'carrera 98 # 99 - 77 edificio fake');
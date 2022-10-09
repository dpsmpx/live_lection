SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- create database end_live_lection;
USE end_live_lection;

CREATE TABLE lections (
  id_lect int NOT NULL,
  id_user int NOT NULL,
  name varchar(50) NOT NULL,
  about varchar(500) NOT NULL,
  have_scenario int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO lections (id_lect, id_user, name, about, have_scenario) VALUES
(1, 0, 'Лекция 1 - Типы данных', 'В данной лекции речь пойдет о типах данных языка C++', 0),
(2, 0, 'Лекция 2 - Операции', 'В данной лекции речь пойдет об операциях языка C++', 0);

CREATE TABLE slide (
  id_slide int NOT NULL,
  id_lect int NOT NULL,
  name varchar(50) NOT NULL,
  about varchar(200) NOT NULL,
  vid_path varchar(100) NOT NULL,
  pic_path varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO slide (id_slide, id_lect, name, about, vid_path, pic_path) VALUES
(1, 1, 'Слайд 1 Лекция 1', 'Целочисленные', 'media\\vid1.mp4','media\\pic1.jpg'),
(2, 1, 'Слайд 2 Лекция 1', 'Логические', 'media\\vid2.mp4','media\\pic2.jpg');

CREATE TABLE users (
  id_user int NOT NULL,
  name varchar(50) NOT NULL,
  login varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  now_lection int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO users (id_user, name, login, password, now_lection) VALUES
(1, 'Роман Федорович', 'roman', 'roman', 0),
(2, 'Алексей Игоревич', 'alex', '60c6d277a8bd81de7fdde19201bf9c58a3df08f4', 0),
(5, 'Король', 'Король', '2db03ab22d80d6e86c9688dbb07ca58c15c7b3c2', 0),
(6, 'Король', 'Король', '2db03ab22d80d6e86c9688dbb07ca58c15c7b3c2', 0),
(7, 'kolya', 'kolya', 'd7832105622b959a1e4a42881f834648b81e169f', 0),
(8, 'kolya', 'kolya', 'd7832105622b959a1e4a42881f834648b81e169f', 0),
(9, 'kolya', 'kolya', 'd7832105622b959a1e4a42881f834648b81e169f', 0);

ALTER TABLE lections
  ADD PRIMARY KEY (id_lect);
ALTER TABLE lections
  MODIFY id_lect int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE slide
  ADD PRIMARY KEY (id_slide);
ALTER TABLE slide
  MODIFY id_slide int NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  ADD PRIMARY KEY (id_user);
ALTER TABLE users
  MODIFY id_user int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

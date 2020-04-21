-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 21 2020 г., 03:57
-- Версия сервера: 8.0.15
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson_6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `big_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Имя товара',
  `price` int(10) NOT NULL DEFAULT '0',
  `description` varchar(8000) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'описание отсутствует',
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `big` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'big',
  `small` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'small',
  `vews` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `img`
--

INSERT INTO `img` (`id`, `big_name`, `price`, `description`, `name`, `big`, `small`, `vews`) VALUES
(1, 'Пояс астероидов', 2250000, 'Описание картины художника №1, написанную в лохматых годах. ', '01.jpg', 'big', 'small', 6),
(2, 'Две луны', 100000, 'Описание картины художника №2, написанную в лохматых годах. ', '02.jpg', 'big', 'small', 4),
(3, 'Синяя планета', 400000, 'Описание картины художника №3, написанную в лохматых годах. ', '03.jpg', 'big', 'small', 10),
(4, 'Что-то с чем-то', 300000, 'Описание картины художника №4, написанную в лохматых годах. ', '04.jpg', 'big', 'small', 0),
(5, 'Мы не одни', 1000000, 'Описание картины художника №5, написанную в лохматых годах. ', '05.jpg', 'big', 'small', 21),
(6, 'Белая звезда', 240000, 'Описание картины художника №6, написанную в лохматых годах. ', '06.jpg', 'big', 'small', 5),
(7, 'Властелин колец', 765000, 'Описание картины художника №7, написанную в лохматых годах. ', '07.jpg', 'big', 'small', 10),
(8, 'Замок', 345000, 'Описание картины художника №8, написанную в лохматых годах. ', '08.jpg', 'big', 'small', 21),
(9, 'Белые паруса', 980000, 'Описание картины художника №9, написанную в лохматых годах. ', '09.jpg', 'big', 'small', 14),
(10, 'Новый день', 3050000, 'Описание картины художника №10, написанную в лохматых годах. ', '10.jpg', 'big', 'small', 25),
(11, 'Пространство', 210000, 'Описание картины художника №11, написанную в лохматых годах. ', '11.jpg', 'big', 'small', 4),
(12, 'Чужой мир', 680000, 'Описание картины художника №12, написанную в лохматых годах. ', '12.jpg', 'big', 'small', 4),
(13, 'Какой-то мост', 1200000, 'Описание картины художника №13, написанную в лохматых годах. ', '13.jpg', 'big', 'small', 6),
(14, 'Великая Стена', 354000, 'Описание картины художника №14, написанную в лохматых годах. ', '14.jpg', 'big', 'small', 36),
(15, 'Эйфелева башня', 743000, 'Описание картины художника №15, написанную в лохматых годах. ', '15.jpg', 'big', 'small', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `review` varchar(8000) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `data` date NOT NULL,
  `picture` int(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `review`, `name`, `data`, `picture`) VALUES
(3, 'Отличная картина, все супер', 'Василий Попов', '2020-04-12', 14),
(4, 'Чувствуются нотки фантазии', 'Епифанцева Мария', '2020-04-12', 14),
(9, 'Всегда хотел побывать тут.', 'Поттер', '2020-04-12', 14),
(10, 'все, выезжаю', 'рыжий', '2020-04-12', 14),
(11, 'Хотел бы взглянуть на эту стену', 'Мелочь', '2020-04-12', 14),
(12, 'А чего так дорого?????', 'Якреведко', '2020-04-12', 6),
(13, 'аечраерерае', 'Поттер', '2020-04-18', 3),
(14, 'Какие красивые пояса астеройдов', 'Васька', '2020-04-20', 1),
(15, 'норм кораблик', 'Поттер', '2020-04-21', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/O',
  `loggin` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `loggin`, `password`, `date`) VALUES
(1, 'N/O', 'qwe', '$2y$10$kQ8gTHvUiafUtZj0pyG/qeXJSx91v2WN.5a4yrtSb2Dt/ZWmIjvHW', '2020-04-21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

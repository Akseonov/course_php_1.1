-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2020 г., 18:50
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
(1, 'Пояс астероидов', 2250000, 'Описание картины художника №1, написанную в лохматых годах. ', '01.jpg', 'big', 'small', 15),
(2, 'Две луны', 100000, 'Описание картины художника №2, написанную в лохматых годах. ', '02.jpg', 'big', 'small', 4),
(3, 'Синяя планета', 400000, 'Описание картины художника №3, написанную в лохматых годах. ', '03.jpg', 'big', 'small', 17),
(4, 'Что-то с чем-то', 300000, 'Описание картины художника №4, написанную в лохматых годах. ', '04.jpg', 'big', 'small', 4),
(5, 'Мы не одни', 1000000, 'Описание картины художника №5, написанную в лохматых годах. ', '05.jpg', 'big', 'small', 30),
(6, 'Белая звезда', 240000, 'Описание картины художника №6, написанную в лохматых годах. ', '06.jpg', 'big', 'small', 22),
(7, 'Властелин колец', 765000, 'Описание картины художника №7, написанную в лохматых годах. ', '07.jpg', 'big', 'small', 17),
(8, 'Замок', 345000, 'Описание картины художника №8, написанную в лохматых годах. ', '08.jpg', 'big', 'small', 21),
(9, 'Белые паруса', 980000, 'Описание картины художника №9, написанную в лохматых годах. ', '09.jpg', 'big', 'small', 17),
(10, 'Новый день', 3050000, 'Описание картины художника №10, написанную в лохматых годах. ', '10.jpg', 'big', 'small', 31),
(11, 'Пространство', 210000, 'Описание картины художника №11, написанную в лохматых годах. ', '11.jpg', 'big', 'small', 10),
(12, 'Чужой мир', 680000, 'Описание картины художника №12, написанную в лохматых годах. ', '12.jpg', 'big', 'small', 8),
(13, 'Какой-то мост', 1200000, 'Описание картины художника №13, написанную в лохматых годах. ', '13.jpg', 'big', 'small', 14),
(14, 'Великая Стена', 354000, 'Описание картины художника №14, написанную в лохматых годах. ', '14.jpg', 'big', 'small', 38),
(15, 'Эйфелева башня', 743000, 'Описание картины художника №15, написанную в лохматых годах. ', '15.jpg', 'big', 'small', 19);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(36) NOT NULL,
  `user_id` int(36) NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(36) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Обрабатывается'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `status`) VALUES
(1, 1, 'г.Герой, ул.Ленина, д.45, кв.45', 'Обрабатывается'),
(2, 1, 'Планета земля', 'Обрабатывается'),
(3, 1, 'Туда, где не ждали. Тудааааа, где забыы-ы-ы-ыыыыли. Тудааа-ааа', 'Обрабатывается'),
(4, 3, 'там где я', 'Обрабатывается'),
(5, 3, 'в лес', 'Обрабатывается');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(36) NOT NULL,
  `order_id` int(36) NOT NULL,
  `img_id` int(36) NOT NULL,
  `price` int(36) NOT NULL,
  `count` int(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `img_id`, `price`, `count`) VALUES
(1, 1, 13, 1200000, 8),
(2, 2, 10, 3050000, 3),
(3, 2, 12, 680000, 2),
(4, 3, 13, 1200000, 1),
(5, 3, 11, 210000, 1),
(6, 3, 5, 1000000, 1),
(7, 3, 6, 240000, 1),
(8, 4, 13, 1200000, 1),
(9, 5, 13, 1200000, 1);

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
(15, 'норм кораблик', 'Поттер', '2020-04-21', 9),
(16, 'привет', 'qwe', '2020-04-27', 7),
(17, 'красиво', 'qwe', '2020-04-27', 6),
(18, 'очень красиво', 'qwe', '2020-04-27', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/O',
  `loggin` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `admin` varchar(36) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `loggin`, `password`, `date`, `admin`) VALUES
(1, 'N/O', 'qwe', '$2y$10$kQ8gTHvUiafUtZj0pyG/qeXJSx91v2WN.5a4yrtSb2Dt/ZWmIjvHW', '2020-04-21', ''),
(2, 'N/O', 'admin', '$2y$10$Y/Nc9uFzYORiCAfAlCGwKODTC0O9sW9999dAD473HVb5EBH2MbjN2', '2020-04-27', 'admin'),
(3, 'N/O', 'asd', '$2y$10$PYC/kdpiAVdcKgUyH5YnZe/WMkfO2dhBWEqyEbxtGp0rwIRIugz2C', '2020-04-27', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

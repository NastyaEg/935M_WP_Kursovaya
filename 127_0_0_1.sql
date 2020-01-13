-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 13 2020 г., 21:43
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smart`
--
DROP DATABASE IF EXISTS `smart`;
CREATE DATABASE IF NOT EXISTS `smart` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `smart`;

-- --------------------------------------------------------

--
-- Структура таблицы `anketa`
--

CREATE TABLE `anketa` (
  `id` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `fio` varchar(60) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `age` int(10) NOT NULL,
  `marka` varchar(30) NOT NULL,
  `quality` varchar(20) NOT NULL,
  `internet` varchar(3) NOT NULL,
  `store` varchar(3) NOT NULL,
  `other` varchar(3) NOT NULL,
  `buy` varchar(30) NOT NULL,
  `buycoffee` varchar(30) NOT NULL,
  `improve` varchar(256) NOT NULL,
  `id_item` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `anketa`
--

INSERT INTO `anketa` (`id`, `id_user`, `fio`, `sex`, `city`, `telephone`, `age`, `marka`, `quality`, `internet`, `store`, `other`, `buy`, `buycoffee`, `improve`, `id_item`) VALUES
(1, 1, 'Измаил Иванов', 'Мужской', 'ываыва', '+37529234234', 3, 'Samsung', 'Хорошее', 'yes', 'yes', 'No', 'Для себя', 'Несомненно да', 'выавыа', 17);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(12) NOT NULL,
  `strength` varchar(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  `weight` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(256) NOT NULL,
  `uploadlink` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `strength`, `model`, `weight`, `price`, `description`, `uploadlink`) VALUES
(17, 'Samsung', 'Galaxy A50', 2500, 2000, 'Android 9.0 (Pie)\r\nОбъем встроенной памяти:64 ГБ\r\nДиагональ экрана: 6.4', 'Images/1.jpeg'),
(18, 'Honor', 'Mate 10 Pro', 2500, 15000, 'Объем встроенной памяти 128 ГБ\r\nОбъем оперативной памяти 6144 Мб\r\nДиагональ экрана 6 \"\r\nТехнология экрана OLED', 'Images/18.jpeg'),
(19, 'Xiaomi', 'MI A2 Lite', 3800, 23000, 'Версия операционной системы Android 8.1 (Oreo)\r\nПоддержка нескольких SIM-карт 	2\r\nОбъем встроенной памяти 	64 ГБ\r\nОбъем оперативной памяти 	4096 Мб\r\nДиагональ экрана 	5.8 \"', ''),
(20, 'Apple', 'Q7', 2500, 19000, 'Бабушкафон', ''),
(21, 'Lenovo', 'S660', 2500, 10000, 'Диагональ:4.5', ''),
(22, 'Asus', 'Xabcd Xabcd', 2500, 2500, 'qwerty', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'test', '0598017037abb693aab867d5455b9f27', 'test@mail.ru'),
(2, 'test2', '6a15fc5c52b1764dbd36cca01df8e024', 'test2@test2.ru'),
(3, '123', '6a15fc5c52b1764dbd36cca01df8e024', '123@mail.ru'),
(6, '5', 'fda7f2b0ad642815ac47ad6394191ad2', '5@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
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
-- AUTO_INCREMENT для таблицы `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

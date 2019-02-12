-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 18 2018 г., 16:18
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `randomly`
--

-- --------------------------------------------------------

--
-- Структура таблицы `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `sex` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_birth` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `orientation` varchar(50) NOT NULL,
  `avatar_user` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `date_registration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `registered_users`
--

INSERT INTO `registered_users` (`id`, `email`, `sex`, `name`, `nickname`, `password`, `date_birth`, `city`, `orientation`, `avatar_user`, `language`, `date_registration`) VALUES
(1, 'witalik_win@mail.ru', 1, 'Віталій Булавін', 'bulava', 'q1w2e3', '1996-02-02', 'Kyiv', 'heterosexual', '', 'ua', '2018-11-03'),
(2, 'witalikwin@gmail.com', 0, 'Таня', '', 'й1ц2у3', '1997-08-12', 'Kyiv', 'heterosexual', '', '', '2018-11-07'),
(3, 'hurtovabaza@gmail.com', 1, 'Василь', '', 'q1w2e3', '2000-11-12', '', 'heterosexual', '', '', '2018-11-11'),
(4, 'witalikwin@mail.ru', 1, 'Гуртова', '', 'q1q1q1', '1999-10-14', '', 'heterosexual', '', '', '2018-11-11'),
(5, 'witalik_win2@mail.ru', 1, 'Василь', '', 'й1й1й1', '1998-12-12', 'Kyiv', '', '', '', '2018-11-14'),
(6, 'witalikwin2@mail.ru', 0, 'Лена', '', 'q1w2e3', '1999-12-12', 'Kyiv', '', '', '', '2018-11-14'),
(7, 'witalik_win1@mail.ru', 0, 'Катя', '', 'й1ц2у3', '1992-09-15', 'Rivne', '', '', 'ru', '2018-11-18'),
(8, 'witalikwin1@gmail.com', 0, 'Наташа', '', 'й1ц2у3', '1990-10-31', 'Rivne', '', '', 'ru', '2018-11-18'),
(9, 'hurtovabaza1@gmail.com', 0, 'Ілона', '', 'й1ц2у3', '1988-06-07', 'Lviv', '', '', 'ru', '2018-11-18'),
(10, 'hurtovabaza2@gmail.com', 0, 'Настя', '', 'й1ц2у3', '1989-06-09', 'Lviv', '', '', 'ua', '2018-11-18'),
(11, 'witalikwin2@gmail.com', 1, 'Віктор', '', 'й1ц2у3', '1992-03-12', 'Lviv', '', '', 'ua', '2018-11-18'),
(12, 'witalikwin3@gmail.com', 1, 'Ваня', '', 'й1ц2у3', '1991-05-09', 'Rivne', '', '', 'ua', '2018-11-18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

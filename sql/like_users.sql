-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2018 г., 10:57
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
-- Структура таблицы `like_users`
--

CREATE TABLE `like_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_sender_like` varchar(50) NOT NULL,
  `email_recipient_like` varchar(50) NOT NULL,
  `date_like` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `like_users`
--

INSERT INTO `like_users` (`id`, `email_sender_like`, `email_recipient_like`, `date_like`) VALUES
(12, 'witalik_win@mail.ru', 'hurtovabaza2@gmail.com', '2018-12-01 17:00:08'),
(32, 'witalikwin1@gmail.com', 'witalikwin@gmail.com', '2018-12-01 18:28:00'),
(34, 'witalik_win@mail.ru', 'witalikwin1@gmail.com', '2018-12-01 18:48:51');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `like_users`
--
ALTER TABLE `like_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `like_users`
--
ALTER TABLE `like_users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

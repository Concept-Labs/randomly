-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 14 2018 г., 14:52
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
-- Структура таблицы `subscription_users`
--

CREATE TABLE `subscription_users` (
  `id` int(255) UNSIGNED NOT NULL,
  `email_sender_subscription` varchar(50) NOT NULL,
  `email_recipient_subscription` varchar(50) NOT NULL,
  `locked` varchar(50) NOT NULL,
  `date_subscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subscription_users`
--

INSERT INTO `subscription_users` (`id`, `email_sender_subscription`, `email_recipient_subscription`, `locked`, `date_subscription`) VALUES
(32, 'witalikwin1@gmail.com', 'witalikwin@gmail.com', '', '2018-12-01 18:28:00'),
(46, 'witalikwin@gmail.com', 'witalik_win@mail.ru', 'YES', '2018-12-14 11:22:39'),
(47, 'witalik_win@mail.ru', 'sonya1995@mail.ru', '', '2018-12-14 11:52:25'),
(51, 'witalik_win@mail.ru', 'witalikwin@gmail.com', '', '2018-12-14 12:50:27');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `subscription_users`
--
ALTER TABLE `subscription_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `subscription_users`
--
ALTER TABLE `subscription_users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

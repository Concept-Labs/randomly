-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 13 2018 г., 16:10
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
-- Структура таблицы `news_users`
--

CREATE TABLE `news_users` (
  `id` int(255) UNSIGNED NOT NULL,
  `email_user_news` varchar(50) NOT NULL,
  `kod_news` int(255) NOT NULL,
  `text_news` text NOT NULL,
  `date_news` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news_users`
--

INSERT INTO `news_users` (`id`, `email_user_news`, `kod_news`, `text_news`, `date_news`) VALUES
(1, 'witalik_win@mail.ru', 123454321, 'Перша новина, яку я пребую зробить. Ну попребуєм!', '2018-12-12 16:12:00'),
(2, 'witalikwin@gmail.com', 1121354, 'І в мене перша новина))))', '2018-12-13 14:30:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news_users`
--
ALTER TABLE `news_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news_users`
--
ALTER TABLE `news_users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

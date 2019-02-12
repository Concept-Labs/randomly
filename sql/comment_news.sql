-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 24 2019 г., 12:31
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
-- Структура таблицы `comment_news`
--

CREATE TABLE `comment_news` (
  `id` int(255) UNSIGNED NOT NULL,
  `email_sender_user` varchar(50) NOT NULL,
  `email_user_news` varchar(50) NOT NULL,
  `kod_news` int(50) NOT NULL,
  `comment_user` varchar(225) NOT NULL,
  `date_comment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment_news`
--

INSERT INTO `comment_news` (`id`, `email_sender_user`, `email_user_news`, `kod_news`, `comment_user`, `date_comment`) VALUES
(1, 'witalik_win@mail.ru', 'witalikwin@gmail.com', 1121354, 'Чотко!!!', '2019-01-20 00:02:00'),
(2, 'svit@mail.ru', 'witalikwin@gmail.com', 1121354, 'І мені не погано*)', '2019-01-20 01:03:00'),
(3, 'witalik_win@mail.ru', 'witalikwin@gmail.com', 1121354, 'Класна фотка', '2019-01-20 13:38:06'),
(10, 'witalikwin@gmail.com', 'witalik_win@mail.ru', 513321949, 'Такий смішний)', '2019-01-20 16:03:26'),
(11, 'witalik_win@mail.ru', 'witalik_win@mail.ru', 513321949, 'freds', '2019-01-20 16:08:08');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment_news`
--
ALTER TABLE `comment_news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment_news`
--
ALTER TABLE `comment_news`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

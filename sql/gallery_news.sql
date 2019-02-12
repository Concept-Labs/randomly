-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 13 2018 г., 16:11
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
-- Структура таблицы `gallery_news`
--

CREATE TABLE `gallery_news` (
  `id` int(255) UNSIGNED NOT NULL,
  `email_users_news` varchar(50) NOT NULL,
  `kod_news` int(255) NOT NULL,
  `path_image_news` varchar(255) NOT NULL,
  `date_image_news` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_news`
--

INSERT INTO `gallery_news` (`id`, `email_users_news`, `kod_news`, `path_image_news`, `date_image_news`) VALUES
(1, 'witalik_win@mail.ru', 123454321, 'krasota_01.jpg', '2018-12-12 16:12:00'),
(2, 'witalik_win@mail.ru', 123454321, 'завантаження.jpg', '2018-12-12 16:12:00'),
(3, 'witalikwin@gmail.com', 1121354, 'krasota_01.jpg', '2018-12-13 14:30:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery_news`
--
ALTER TABLE `gallery_news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery_news`
--
ALTER TABLE `gallery_news`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

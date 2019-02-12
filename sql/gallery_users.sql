-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 26 2018 г., 11:31
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
-- Структура таблицы `gallery_users`
--

CREATE TABLE `gallery_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_user_gallery` varchar(50) NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `date_image` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_users`
--

INSERT INTO `gallery_users` (`id`, `email_user_gallery`, `path_image`, `date_image`) VALUES
(1, 'witalik_win@mail.ru', 'krasota_01.jpg', '0000-00-00'),
(2, 'witalik_win@mail.ru', '109c2cbe5bfbeb32a48fad5a550b24c6.jpg', '0000-00-00'),
(3, 'witalik_win@mail.ru', 'завантаження.jpg', '0000-00-00'),
(4, 'witalik_win@mail.ru', '9459ca6194054864774ed671d5cc8068.jpg', '2018-11-24'),
(6, 'witalik_win@mail.ru', '9459ca6194054864774ed671d5cc8068.jpg', '2018-11-24'),
(7, 'witalik_win@mail.ru', '7ac61da90c3131698d11d56c49d239fb.jpg', '2018-11-26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery_users`
--
ALTER TABLE `gallery_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery_users`
--
ALTER TABLE `gallery_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

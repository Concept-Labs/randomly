-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 10 2019 г., 13:15
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
-- Структура таблицы `more_info_users`
--

CREATE TABLE `more_info_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `sharp` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `hair` varchar(50) NOT NULL,
  `eyes` varchar(50) NOT NULL,
  `hobby` varchar(50) NOT NULL,
  `purpose_life` text NOT NULL,
  `religion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `more_info_users`
--

INSERT INTO `more_info_users` (`id`, `email`, `sharp`, `weight`, `hair`, `eyes`, `hobby`, `purpose_life`, `religion`) VALUES
(6, 'witalikwin@gmail.com', 160, 30, '', 'curry', 'Backend', '', ''),
(7, 'witalik_win@mail.ru', 0, 0, '', '', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `more_info_users`
--
ALTER TABLE `more_info_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `more_info_users`
--
ALTER TABLE `more_info_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

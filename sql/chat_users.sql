-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2018 г., 10:58
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
-- Структура таблицы `chat_users`
--

CREATE TABLE `chat_users` (
  `id` int(255) UNSIGNED NOT NULL,
  `kod_dialog` int(11) NOT NULL,
  `email_sender_message` varchar(50) NOT NULL,
  `email_recipient_message` varchar(50) NOT NULL,
  `message_sender` text NOT NULL,
  `reading_message` int(11) NOT NULL,
  `date_posting` date NOT NULL,
  `time_posting` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat_users`
--

INSERT INTO `chat_users` (`id`, `kod_dialog`, `email_sender_message`, `email_recipient_message`, `message_sender`, `reading_message`, `date_posting`, `time_posting`) VALUES
(1, 11111111, 'witalikwin@gmail.com', 'witalik_win@mail.ru', 'Привет, ти мне понравился, я хочу познакомится!', 0, '2018-11-28', '11:27:17'),
(2, 11111111, 'witalik_win@mail.ru', 'witalikwin@gmail.com', 'Привет, ну давай, дерзай!', 0, '2018-11-28', '11:41:25'),
(3, 11121111, 'witalikwin2@mail.ru', 'witalik_win@mail.ru', 'Привет, давай знакомится.', 0, '2018-11-29', '11:55:23'),
(4, 11112111, 'witalik_win@mail.ru', 'witalik_win1@mail.ru', 'Привет, как дела? Подскажите, пожалуйста, есть ли какой-то простой способ провести такую манипуляцию? Подскажите, пожалуйста, есть ли какой-то простой способ провести такую манипуляцию?', 0, '2018-11-29', '12:00:14'),
(5, 11121111, 'witalikwin2@mail.ru', 'witalik_win@mail.ru', 'Почему молчиш?', 0, '2018-11-29', '12:32:08'),
(6, 12111111, 'witalikwin2@mail.ru', 'witalik_win1@mail.ru', 'Привет, ти така нічо.', 0, '2018-11-29', '15:06:22'),
(7, 11121111, 'witalikwin2@mail.ru', 'witalik_win@mail.ru', 'Ти мне понравился)))', 0, '2018-11-30', '12:07:14'),
(9, 11121111, 'witalikwin2@mail.ru', 'witalik_win@mail.ru', 'das', 0, '2018-11-30', '19:44:25'),
(10, 11121111, 'witalikwin2@mail.ru', 'witalik_win@mail.ru', 'csdf', 0, '2018-11-30', '20:06:22'),
(11, 11111111, 'witalikwin@gmail.com', 'witalik_win@mail.ru', 'Привет, як ти?', 0, '2018-11-30', '20:20:22'),
(12, 11112111, 'witalik_win1@mail.ru', 'witalik_win@mail.ru', 'Нууу', 0, '2018-11-30', '20:22:17'),
(18, 1288854164, 'witalik_win@mail.ru', 'hurtovabaza2@gmail.com', 'Я потвердил твоё предложения, теперь мы можем узналь лучше друг друга)))', 0, '2018-11-30', '22:07:55'),
(19, 1482263899, 'witalik_win@mail.ru', 'witalikwin1@gmail.com', 'Я потвердил твоё предложения, теперь мы можем узналь лучше друг друга)))', 0, '2018-11-30', '22:08:23');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

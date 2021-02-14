-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 21 2020 г., 23:56
-- Версия сервера: 10.3.22-MariaDB-54+deb10u1
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `solidmike`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `email` varchar(300) NOT NULL,
  `api_key` varchar(300) DEFAULT NULL,
  `activation` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `photo`, `email`, `api_key`, `activation`, `status`) VALUES
(1, 'test', 'images91a2eb39.jpg', 'ramaj46773@gomail4.com', NULL, '', 1),
(3, 'test1', 'images2724b4a4.png', 'xibeh39360@dnawr.com', NULL, '', 1),
(4, 'solid', 'imagesd46db1e7.jpg', 'asdasdasd@dnawr.com', NULL, '', 1),
(5, 'test5', 'imagesdcd5fbca.png', 'xosaha8117@qlenw.com', '123', '', 1),
(6, 'test6', 'imagesfef874ec.jpg', 'cihegec816@lege4h.com', NULL, '', 1),
(9, 'solidmike', 'images56a5ebb2.jpg', 'napepis135@exploraxb.com', 'nnc4kbn95s5o6kcm5kuval1z0sfuqa', '', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

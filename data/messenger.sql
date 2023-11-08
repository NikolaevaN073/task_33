-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 08 2023 г., 14:07
-- Версия сервера: 11.1.0-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `messenger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `contact_user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `contact_user_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `msg_from_user`
--

CREATE TABLE `msg_from_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `msg_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `msg_to_user`
--

CREATE TABLE `msg_to_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `msg_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `login`, `password`) VALUES
(1, 'TestUser', 'testuser@test.com', '$2y$10$d7WQ.Z7J6lBjzUTJAOwhs.rSvSXb2FQCZTdDsBbL98eocM0a70OzO'),
(2, 'TestUser2', 'testuser2@test.com', '$2y$10$TRG.qZbLQ6JUmhHY4MWPm.iU2vUaSQy/O.gS/R9DWZZ/bX4TyKpVW'),
(3, 'TestUser3', 'testuser3@test.com', '$2y$10$9qnVDV/wkZ93Q0f20XxUzuQjTw3igGKpTVWlTpy6FdYDD7pqf5aha');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `contact_user_id` (`contact_user_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `msg_from_user`
--
ALTER TABLE `msg_from_user`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- Индексы таблицы `msg_to_user`
--
ALTER TABLE `msg_to_user`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`contact_user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `msg_from_user`
--
ALTER TABLE `msg_from_user`
  ADD CONSTRAINT `msg_from_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `msg_from_user_ibfk_2` FOREIGN KEY (`msg_id`) REFERENCES `messages` (`id`);

--
-- Ограничения внешнего ключа таблицы `msg_to_user`
--
ALTER TABLE `msg_to_user`
  ADD CONSTRAINT `msg_to_user_ibfk_1` FOREIGN KEY (`msg_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

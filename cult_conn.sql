-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 05 2025 г., 13:59
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cult_conn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`Id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `Id` int(11) NOT NULL,
  `Name` varchar(55) NOT NULL,
  `Short_desc` varchar(150) NOT NULL,
  `Full_desc` varchar(320) NOT NULL,
  `Date` varchar(25) NOT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Date`, `Editor`) VALUES
(4, 'Новая статья', 'Описание статьи', 'Подробное описание', '2025-03-05', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `editors`
--

CREATE TABLE `editors` (
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `editors`
--

INSERT INTO `editors` (`Id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Структура таблицы `museums`
--

CREATE TABLE `museums` (
  `Id` int(11) NOT NULL,
  `Name` varchar(55) NOT NULL,
  `Short_desc` varchar(150) NOT NULL,
  `Full_desc` varchar(320) NOT NULL,
  `Image_path` varchar(255) DEFAULT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `museums`
--

INSERT INTO `museums` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Image_path`, `Editor`) VALUES
(2, 'Третьяковская галерея', 'Главный музей русского искусства, находящийся в Москве.', 'Коллекция включает более 170 тысяч произведений русского изобразительного искусства.', '../../uploads/museums/tretyakovskaya-galereya-v-moskve-ekskursii.jpeg', 10),
(3, 'Русский музей', 'Крупнейшее собрание русского изобразительного искусства в Санкт-Петербурге.', 'Музей хранит около 400 тысяч экспонатов, охватывающих все исторические периоды.', '../../uploads/museums/russmuzei2.jpg', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `Id` int(11) NOT NULL,
  `Name` varchar(55) NOT NULL,
  `Short_desc` varchar(150) NOT NULL,
  `Full_desc` varchar(320) NOT NULL,
  `Footer_desc` varchar(150) NOT NULL,
  `Date` varchar(25) NOT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Footer_desc`, `Date`, `Editor`) VALUES
(2, 'День открытых дверей в Третьяковской галерее', 'Приглашаем посетить музей бесплатно.', 'Третьяковская галерея проводит день открытых дверей, где можно бесплатно посетить все экспозиции.', 'Узнайте больше о мероприятии.', '2023-10-07', 10),
(3, 'Реставрация завершена', 'Завершение реставрации исторических экспонатов.', 'Музей завершил реставрацию нескольких исторических экспонатов, которые теперь доступны для посещения.', 'Подробности на официальном сайте.', '2023-10-15', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `Name` varchar(55) NOT NULL,
  `Short_desc` varchar(150) NOT NULL,
  `Full_desc` varchar(320) DEFAULT NULL,
  `Price` varchar(25) DEFAULT NULL,
  `Available` varchar(15) DEFAULT NULL,
  `Image_path` varchar(255) DEFAULT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Price`, `Available`, `Image_path`, `Editor`) VALUES
(3, 'Набор открыток с репродукциями', 'Красочные открытки с известными картинами.', 'Набор включает 10 открыток с репродукциями картин из коллекции музея.', '500', 'No', '../../uploads/products/6487855075.jpg', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Login` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(320) DEFAULT NULL,
  `Image_path` varchar(255) DEFAULT NULL,
  `Admin` int(11) DEFAULT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `Login`, `Password`, `Email`, `Image_path`, `Admin`, `Editor`) VALUES
(9, 'Student', '$2y$10$lWFPXk4mxN45MpdyFQTWoOD0OMprUgIK9MozjxloeSqAbdKgS.J3u', 'Student@mail.ru', NULL, 1, NULL),
(10, 'UserLocal', '$2y$10$Z..FCITPmnElz37Dp7uyEeGqspwL1DrR.ZQhmRev5KXDTC5vAPQwe', 'UserLocal@gmail.copm', NULL, NULL, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Editor` (`Editor`);

--
-- Индексы таблицы `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `museums`
--
ALTER TABLE `museums`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Editor` (`Editor`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Editor` (`Editor`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Editor` (`Editor`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Admin` (`Admin`),
  ADD KEY `Editor` (`Editor`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `editors`
--
ALTER TABLE `editors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `museums`
--
ALTER TABLE `museums`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`Editor`) REFERENCES `users` (`Id`);

--
-- Ограничения внешнего ключа таблицы `museums`
--
ALTER TABLE `museums`
  ADD CONSTRAINT `museums_ibfk_1` FOREIGN KEY (`Editor`) REFERENCES `users` (`Id`);

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`Editor`) REFERENCES `users` (`Id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Editor`) REFERENCES `users` (`Id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Admin`) REFERENCES `admins` (`Id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`Editor`) REFERENCES `editors` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

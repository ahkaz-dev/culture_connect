-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 04 2025 г., 18:29
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

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
(1, 'История Эрмитажа', 'Краткая история создания и развития музея.', 'Эрмитаж был основан в 1764 году Екатериной Великой и с тех пор стал одним из крупнейших музеев мира.', '2023-10-01', 7),
(2, 'Современное искусство в России', 'Обзор современных тенденций в российском искусстве.', 'Статья рассматривает работы современных художников и их влияние на культуру.', '2023-10-05', 9),
(3, 'Реставрация музейных экспонатов', 'Процесс реставрации и сохранения музейных ценностей.', 'В статье описываются методы и технологии, используемые для реставрации исторических артефактов.', '2023-10-12', 10);

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
(1, 'Государственный Эрмитаж', 'Один из крупнейших музеев мира, расположенный в Санкт-Петербурге.', 'Эрмитаж хранит более трех миллионов произведений искусства и памятников мировой культуры.', '../../uploads/museums/1e687dd4-9976-11ed-9ef2-66b3d6a09b77.1220x600.jpeg', 7),
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
(1, 'Новая выставка в Эрмитаже', 'Открытие выставки современного искусства.', 'Эрмитаж представляет новую выставку, посвященную современному искусству и его влиянию на культуру.', 'Подробнее на сайте музея.', '2023-10-01', 7),
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
(1, 'Книга по истории искусства', 'Увлекательное путешествие в мир искусства.', 'Книга рассказывает о развитии искусства с древних времен до наших дней.', '990', 'Yes', '../../uploads/products/01915442-0e04-7e96-997a-d155b7b5ea87.webp', 7),
(2, 'Сувенирная статуэтка', 'Миниатюрная копия известной скульптуры.', 'Статуэтка выполнена из высококачественного материала и является отличным подарком.', '1500', 'Yes', '../../uploads/products/6830023010.jpg', 7),
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
  `Admin` int(11) DEFAULT NULL,
  `Editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `Login`, `Password`, `Email`, `Admin`, `Editor`) VALUES
(7, 'Zakhar', '$2y$10$Hj1Im.rY.6AvElyOPzGU7edkUp4Vt/YeVlUlmsQ/6cMeFariuIOui', 'Zakhar@gmail.com', 1, NULL),
(9, 'Student', '$2y$10$lWFPXk4mxN45MpdyFQTWoOD0OMprUgIK9MozjxloeSqAbdKgS.J3u', 'Student@mail.ru', NULL, NULL),
(10, 'UserLocal', '$2y$10$Z..FCITPmnElz37Dp7uyEeGqspwL1DrR.ZQhmRev5KXDTC5vAPQwe', 'UserLocal@gmail.copm', NULL, 1);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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

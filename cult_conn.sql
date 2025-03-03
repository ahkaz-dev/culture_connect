-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 03 2025 г., 14:06
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
(11, 'История Эрмитажа', 'Краткая история создания и развития музея.', 'Эрмитаж был основан в 1764 году Екатериной Великой и с тех пор стал одним из крупнейших музеев мира.', '2023-10-01', 7),
(12, 'Современное искусство в России', 'Обзор современных тенденций в российском искусстве.', 'Статья рассматривает работы современных художников и их влияние на культуру.', '2023-10-05', 9),
(13, 'Реставрация музейных экспонатов', 'Процесс реставрации и сохранения музейных ценностей.', 'В статье описываются методы и технологии, используемые для реставрации исторических артефактов.', '2023-10-12', 10);

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
  `Image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `museums`
--

INSERT INTO `museums` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Image_path`) VALUES
(16, 'Государственный Эрмитаж', 'Один из крупнейших музеев мира, расположенный в Санкт-Петербурге.', 'Эрмитаж хранит более трех миллионов произведений искусства и памятников мировой культуры.', '../../uploads/museums/1e687dd4-9976-11ed-9ef2-66b3d6a09b77.1220x600.jpeg'),
(17, 'Третьяковская галерея', 'Главный музей русского искусства, находящийся в Москве.', 'Коллекция включает более 170 тысяч произведений русского изобразительного искусства.', '../../uploads/museums/tretyakovskaya-galereya-v-moskve-ekskursii.jpeg'),
(18, 'Русский музей', 'Крупнейшее собрание русского изобразительного искусства в Санкт-Петербурге.', 'Музей хранит около 400 тысяч экспонатов, охватывающих все исторические периоды.', '../../uploads/museums/russmuzei2.jpg');

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
  `Date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Footer_desc`, `Date`) VALUES
(7, 'Новая выставка в Эрмитаже', 'Открытие выставки современного искусства.', 'Эрмитаж представляет новую выставку, посвященную современному искусству и его влиянию на культуру.', 'Подробнее на сайте музея.', '2023-10-01'),
(8, 'День открытых дверей в Третьяковской галерее', 'Приглашаем посетить музей бесплатно.', 'Третьяковская галерея проводит день открытых дверей, где можно бесплатно посетить все экспозиции.', 'Узнайте больше о мероприятии.', '2023-10-07'),
(9, 'Реставрация завершена', 'Завершение реставрации исторических экспонатов.', 'Музей завершил реставрацию нескольких исторических экспонатов, которые теперь доступны для посещения.', 'Подробности на официальном сайте.', '2023-10-15');

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
  `Image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Price`, `Available`, `Image_path`) VALUES
(2, 'Книга по истории искусства', 'Увлекательное путешествие в мир искусства.', 'Книга рассказывает о развитии искусства с древних времен до наших дней.', '990', 'Yes', '../../uploads/products/01915442-0e04-7e96-997a-d155b7b5ea87.webp'),
(3, 'Сувенирная статуэтка', 'Миниатюрная копия известной скульптуры.', 'Статуэтка выполнена из высококачественного материала и является отличным подарком.', '1500', 'Yes', '../../uploads/products/6830023010.jpg'),
(4, 'Набор открыток с репродукциями', 'Красочные открытки с известными картинами.', 'Набор включает 10 открыток с репродукциями картин из коллекции музея.', '500', 'No', '../../uploads/products/6487855075.jpg');

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
(7, 'Zakhar', '$2y$10$y1SFU80ULveZ2DvmhfwBR.OXorngvLJasb3GXMb2/mO0bJbbEmJiK', 'Zakhar@gmail.com', 1, 1),
(9, 'logout', '$2y$10$XZe2C6ZGU.TACuUbR/4yBuqSgOu2iYBWXaAakq4KHh5F7UFz2XJQW', 'mygmail@gmail.com', NULL, 1),
(10, 'UserLocal', '$2y$10$9WRE70qkDz4KxQQ5rxPByOekR8my1FA.dxsTtws7Bg4QZFSyFg/rW', 'UserLocal@gmail.copm', NULL, NULL),
(11, 'admin5', '$2y$10$3r06ymiYvd9zUYgVWcHb9ejFYoCRNFXvU6USx3IXFwjzB5lQOWc2u', 'asd@asd.com', NULL, NULL);

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
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `editors`
--
ALTER TABLE `editors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `museums`
--
ALTER TABLE `museums`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`Editor`) REFERENCES `users` (`Id`);

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

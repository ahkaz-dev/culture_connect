-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 27 2025 г., 19:10
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
(1, 'История Искусства', 'Обзор развития искусства с древности до наших дней.', 'Полное описание истории искусства, включающее анализ древних цивилизаций, средневекового периода, Возрождения, барокко, классицизма и современных направлений. Разбираются ключевые произведения, художественные техники, влияние культуры на искусство и его значение в современном обществе.', '2024-02-27', 2),
(2, 'Современная живопись', 'Изучение новых тенденций в живописи.', 'Детальное исследование современных направлений в живописи, включая абстракционизм, концептуальное искусство, гиперреализм и цифровые формы творчества. Рассматриваются ключевые художники, их техники, стили и влияние на искусство в глобальном масштабе.', '2024-02-26', 2),
(3, 'Греческая скульптура', 'Описание величайших произведений древней Греции.', 'Подробное описание греческой скульптуры, включая работы Фидия, Мирона, Поликлета и Праксителя. Анализируется влияние античных произведений на ренессансных мастеров, а также их отражение в современном искусстве.', '2024-02-25', 2);

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
  `Full_desc` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `museums`
--

INSERT INTO `museums` (`Id`, `Name`, `Short_desc`, `Full_desc`) VALUES
(1, 'Лувр', 'Один из самых известных музеев мира.', 'Лувр — крупнейший художественный музей в мире, расположенный в Париже. Он содержит десятки тысяч произведений искусства, включая \"Монну Лизу\", \"Венеру Милосскую\" и \"Крылатую победу Самофракийскую\". Ежегодно музей посещают миллионы туристов.'),
(2, 'Эрмитаж', 'Величайший музей России с уникальной коллекцией.', 'Эрмитаж — крупнейший музей России, расположенный в Санкт-Петербурге. В его коллекции представлены произведения Рембрандта, Рубенса, Микеланджело, Ван Гога и Пикассо. Основной комплекс музея занимает Зимний дворец, бывшую резиденцию российских императоров.'),
(3, 'Метрополитен', 'Главный художественный музей США.', 'Метрополитен-музей в Нью-Йорке обладает одной из самых обширных коллекций мирового искусства. Здесь представлены экспонаты от древних египетских артефактов до работ современных художников, включая картины импрессионистов и экспрессионистов.');

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
(2, 'Выставка Ренессанса', 'Открытие крупнейшей выставки эпохи Возрождения.', 'В музее пройдет уникальная выставка, посвященная великим мастерам эпохи Возрождения, таким как Леонардо да Винчи, Микеланджело, Рафаэль, Тициан и Боттичелли. Экспозиция включает подлинные картины, скульптуры и редкие архивные материалы.', 'Все подробности на официальном сайте музея.', '2024-02-27'),
(3, 'Арт-фестиваль', 'Масштабный фестиваль современного искусства.', 'Фестиваль объединяет художников, скульпторов и дизайнеров со всего мира. В программе — выставки, лекции, мастер-классы и перформансы, посвященные новейшим тенденциям в искусстве. Ожидаются знаменитые гости и кураторы ведущих музеев.', 'Следите за обновлениями на нашем портале.', '2024-02-26'),
(4, 'Лекция о Да Винчи', 'Эксклюзивная интерактивная лекция.', 'На лекции будут обсуждаться загадки картин Леонардо да Винчи, его влияние на современное искусство и научные открытия. Участники смогут задать вопросы экспертам и поучаствовать в дискуссии.', 'Запись лекции будет доступна онлайн.', '2024-02-25');

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
  `Available` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`Id`, `Name`, `Short_desc`, `Full_desc`, `Price`, `Available`) VALUES
(1, 'Картина Ван Гога', 'Репродукция \"Звездная ночь\" с высокой детализацией.', 'Высококачественная копия знаменитого произведения Ван Гога \"Звездная ночь\". Картина выполнена с точным соблюдением цветовой гаммы и мазков, передавая атмосферу оригинала. Отличный выбор для ценителей искусства и эстетов.', '5000', 'Yes'),
(2, 'Статуэтка Давида', 'Мраморная копия знаменитой скульптуры Микеланджело.', 'Точная миниатюрная копия скульптуры Давида, выполненная из искусственного мрамора. Подходит для интерьера, коллекционирования и подарков любителям искусства. Отражает величие и анатомическую точность оригинального произведения.', '3000', 'Yes'),
(3, 'Книга об искусстве', 'Обширный анализ искусства XX века.', 'Эта книга представляет собой глубокий анализ ключевых направлений искусства XX века, включая кубизм, футуризм, дадаизм, сюрреализм, поп-арт и постмодернизм. Богато иллюстрированное издание идеально подходит для студентов и любителей искусства.', '1500', 'No');

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
(1, 'admin1', 'pass1234', 'admin1@example.com', 1, NULL),
(2, 'editor1', 'pass5678', 'editor1@example.com', NULL, 1),
(3, 'user1', 'pass9876', 'user1@example.com', NULL, NULL),
(7, 'Zakhar', '$2y$10$y1SFU80ULveZ2DvmhfwBR.OXorngvLJasb3GXMb2/mO0bJbbEmJiK', 'Zakhar@gmail.com', 1, 1),
(9, 'logout', '$2y$10$Gm7iXd7IuO91ddFkByvGX./O/RciGjYooFiUlhxc8m57RQ0qknRZS', 'logout@gmail.com', NULL, 1),
(10, 'UserLocal', '$2y$10$9WRE70qkDz4KxQQ5rxPByOekR8my1FA.dxsTtws7Bg4QZFSyFg/rW', 'UserLocal@gmail.copm', NULL, NULL);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

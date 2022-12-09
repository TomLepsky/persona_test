-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2022 г., 14:03
-- Версия сервера: 5.7.29
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `name`) VALUES
(1, 'chat_1'),
(2, 'chat_2'),
(3, 'chat_3');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `chat_id`, `user_id`, `message`, `date`) VALUES
(1, 1, 1, 'Alex msg 1', '2022-12-09 12:20:20'),
(2, 1, 1, 'Alex msg 2', '2022-12-09 12:20:50'),
(3, 1, 2, 'Tom msg 1', '2022-12-09 12:21:11'),
(4, 1, 2, 'Tom msg 3', '2022-12-09 12:21:50'),
(5, 1, 2, 'Tom msg 4', '2022-12-09 12:21:53'),
(6, 1, 2, 'Tom msg 5', '2022-12-09 12:22:01'),
(7, 2, 3, 'Sam msg 1', '2022-12-09 12:28:41'),
(8, 2, 3, 'Sam msg 2', '2022-12-09 12:28:46'),
(9, 2, 3, 'Sam msg 3', '2022-12-09 12:28:48'),
(10, 1, 3, 'Sam msg 4', '2022-12-09 12:28:53'),
(11, 3, 3, 'Sam msg 6', '2022-12-09 12:29:02'),
(12, 3, 3, 'Sam msg 7', '2022-12-09 12:29:05'),
(13, 3, 4, 'Alice msg 1', '2022-12-09 12:29:17'),
(14, 3, 4, 'Alice msg 2', '2022-12-09 12:29:19'),
(17, 1, 5, 'Bob message 1', '2022-12-09 13:33:32');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'Alex'),
(4, 'Alice'),
(5, 'Bob'),
(3, 'Sam'),
(2, 'Tom');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

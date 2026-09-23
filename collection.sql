-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2025 г., 16:58
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `collection`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `image` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `image`) VALUES
(1, 'img/banner1.jpg'),
(2, 'img/banner2.jpg'),
(3, 'img/banner3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `user` int NOT NULL,
  `post` int NOT NULL,
  `text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `date`, `user`, `post`, `text`) VALUES
(2, '2024-12-08', 7, 2, '1332'),
(3, '2024-12-08', 7, 2, 'Хочу купить ура'),
(4, '2024-12-09', 7, 2, 'lkjhgf87654');

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE `item` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int NOT NULL,
  `in_stock` int NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `type` int NOT NULL,
  `recommend` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `name`, `price`, `in_stock`, `description`, `image`, `type`, `recommend`) VALUES
(1, 'Ticket to Ride: Европа', 3990, 1, '\"Билет на поезд: Европа\", как и базовое издание \"Билета на поезд\" – это игра о конкуренции нескольких железнодорожных компаний, одной из которых управляете вы, а другими – остальные игроки. Как и в базовой версии, ваша задача – прокладывать маршруты между городами (причём выгоду приносят наиболее длинные), выполнять специальные задания, подбирать оптимальные пути для потока товаров – и срывать планы конкурентов. Если железные дороги станут похожими на сплетение морских узлов и будут неудобны пассажирам – это не беда, ведь главное для вас – чистая прибыль и отсутствие конкуренции хотя бы в некоторых уголках Европы.', 'img/20241212100041tickettoride.jpg', 1, 1),
(2, 'Имаджинариум', 1990, 1, '«Имаджинариум» — это очень простая и очень интересная игра, в которой нужно придумывать ассоциации к необычным картинкам из коробки. Картинки рисовали сумасшедшие художники, поэтому ассоциаций — от самых простых, вроде «любовь», «зима», «принципиальность», до самых сложных и безумных, в духе «Всё правильно сделал», «Где драма? Опять нет драмы!», «Чак-чак! Беги быстрее!», может быть просто море.', 'img/20241212100222imagine.jpg', 1, 1),
(3, 'Манчкин', 1290, 1, 'Вот она — колода для реальных бойцов, суровых чистильщиков подземелий. Пафосные речи? Отыгрыш персонажа? Внутренняя логика мира? Кому ты паришь мозги! Мы-то с тобой знаем, зачем нормальные люди приходят в РПГ — мы приходим прокачивать уровень, мочить монстров и доказывать, что мы здесь круче. Мы — манчкины, и это наша колода.', 'img/20241212100346manchkin.jpg', 1, 0),
(5, 'Фигурка ARTFX J: Devil My Cry: Неро', 5200, 1, 'Фигурка любимого персонажа украсит интерьер и станет отличным подарком как для друзей, так и для себя.', 'img/20241212100508nero.jpg', 2, 1),
(6, 'World of Warcraft: Король-лич', 4800, 1, 'Персонаж: Артас Менетил (Король-лич)', 'img/20241212100640lich.jpg', 2, 1),
(7, 'Красный Among us', 70, 1, 'Значки — неубиваемая временем классика. Ещё в первобытном обществе человек, желающий выделяться из толпы, мог привязать к шкуре красивый камешек или звериный клык, а спустя какое-то время появились нагрудные знаки \"за доблесть\", витиеватые брошки, и, собственно, значки с картинками, к которым мы все так привыкли', 'img/20241212100819amogus.jpg', 3, 1),
(8, 'Nazrin FumoFumo', 4500, 1, 'Фумо', 'img/20241212101033nazrin.jpg', 4, 1),
(9, 'Стикерпак NKS PACK CYBERPUNK 2077', 250, 1, 'Уникальные суперклассные арты созданные российскими авторами на самые разнообразные темы — вот что такое стикеры NKS', 'img/20241212101429cybersticker.jpg', 6, 0),
(10, 'Набор плакатов А1 \"Атака на титанов\" в тубусе', 990, 1, 'В наборе вы найдете 3 плаката формата А1 (59×84 см).', 'img/20241212101537aotposter.jpg', 8, 0),
(11, 'Сумка Гримуар: Черный', 2200, 1, 'Размер: 25х20х7 см', 'img/20241212101709bag.jpg', 10, 0),
(12, 'Хаори \"Tokyo Revengers\"', 1000, 1, 'Вес 250 г', 'img/20241212101823cape.jpg', 12, 0),
(13, 'Ужас Аркхэма. Карточная игра', 2990, 1, '\"Ужас Аркхэма. Карточная игра\" – это кооперативная Живая Карточная Игра в сеттинге мифов Лавкрафта, в которой 1-2 сыщика (а со вторым набором – 3-4) совместно познакомятся с миром оккультизма, древних богов и тайн, параллельно борясь и с внутренними демонами из своего прошлого.\r\n\r\nКаждый игрок берет на себя роль одного из сыщиков и собирает собственную колоду, опираясь на способности своего персонажа. В основе игрового процесса находятся взаимосвязанные между собой сценарии, которые задают игре темп и создают художественное повествование. Партии в этой игре безумно атмосферные! Набор сценариев превращается в кампанию. В каждом сценарии сыщики попадают в различные локации и исследуют их в поисках улик, которые необходимы для продвижения расследования и открытия тайн.\r\n\r\nВ процессе игры сыщики сталкиваются с противниками и проклятиями, пытаются преодолеть все невзгоды и победить врагов Мифа. По ходу кампании каждый сыщик получает опыт, что позволяет игроку улучшать способности и получать новые возможности, добавляя более сильные карты в свою колоду.\r\n\r\nЧем дальше и глубже вы погружаетесь в мир непознанного, тем ближе ваше безумие! Игроки должны следить за рассудком своих сыщиков, защищать их от ужаса и монстров, встречающихся на пути, и раскрыть тайну Аркхэма!', 'img/20250513020403аркхэм.jpg', 1, 0),
(14, 'CATAN: 3D Edition', 29990, 1, 'Поселения образуются среди плодородных полей, а большие города комфортно располагаются у подножия величавых гор. Кажется, вот-вот раздастся блеяние овец с зелёных пастбищ.\r\n\r\nДолгожданное трёхмерное издание классической игры CATAN создано на основе рельефных тайлов, вручную смоделированных самим Клаусом Тойбером. Все элементы ландшафта аккуратно раскрашены вручную, а фигурки игроков детализированы и искусственно состарены, что придаёт им особый характер и ощущение глубокой истории.', 'img/202505130206133DBox_CATAN_3D_side_en.png', 1, 0),
(15, 'Каркассон: Туманы и призраки', 2490, 1, 'то свершилось! Представляем вам кооперативную игру из серии \"Каркассон\" – \"Туманы и призраки\"! С этого момента увеличивать свои владения вы будете не соревнуясь с другими игроками, а сообща. А ещё вам предстоит бороться с потусторонними силами и исследовать загадочные мрачные замки. Ещё \"Каркассон: Туманы и призраки\" примечательны тем, что вас ждёт не просто игра, а целая кампания из 6 партий! Более того, после каждой из них в игру будут добавляться новые элементы, которые сделают её сложнее и ещё насыщеннее. Постоите за родной Каркассон и вытурите с окружных земель непрошенных гостей, пока ещё не стало слишком поздно!', 'img/20250513020734tumani-i-prizraki-00-1000x416-wm.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `text` varchar(10000) NOT NULL,
  `image` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `text`, `image`) VALUES
(1, 'Магазин открыт', '2024-12-03', '   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n   Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'img/20241212104533opened.jpg'),
(2, 'Сайт работает', '2024-12-06', 'Почему новость о магазине была раньше??', 'img/20241212104945news2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Ожидает обработки',
  `phone` varchar(15) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `totalprice` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `phone`, `fullname`, `totalprice`) VALUES
(1, 7, '2025-05-09 11:42:09', 'Отказано', '132', 'крс', 6790),
(2, NULL, '2025-05-09 11:45:14', 'Подтверждено', '2131', 'кккк', 6790),
(3, 7, '2025-05-09 12:50:08', 'Отказано', '124545', 'Фиоооо', 3280),
(4, 7, '2025-05-10 11:09:38', 'Отказано', '123', 'qwerty', 15200),
(7, 15, '2025-05-27 19:05:49', 'Подтверждено', '+79607656799', 'Селютин Кирилл Дмитриевич', 10180);

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`) VALUES
(1, 1, 2, 1),
(2, 1, 6, 1),
(3, 2, 2, 1),
(4, 2, 6, 1),
(5, 3, 2, 1),
(6, 3, 3, 1),
(7, 4, 5, 2),
(8, 4, 6, 1),
(15, 7, 1, 1),
(16, 7, 7, 3),
(17, 7, 13, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `creation_date` date NOT NULL,
  `text` varchar(10000) NOT NULL,
  `author` int NOT NULL,
  `image` varchar(512) NOT NULL,
  `redact_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `creation_date`, `text`, `author`, `image`, `redact_date`) VALUES
(2, 'Пример поста 1', '2024-12-08', 'Это пример текста для поста ', 7, 'img/20250513020938Без названия.png', '2025-05-13'),
(5, 'Тестовый пост 2', '2025-05-13', 'Тестовый пост для демонстрации функционала веб-приложения', 10, 'img/202505130216152cab34e1c676211347ee6f4baad175.png', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `stock`
--

CREATE TABLE `stock` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stock`
--

INSERT INTO `stock` (`id`, `name`) VALUES
(1, 'В наличии'),
(2, 'Нет в наличии');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `popular` int NOT NULL DEFAULT '0',
  `image` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `name`, `popular`, `image`) VALUES
(1, 'Настольные игры', 1, 'img/20241212094956nastolnie.jpg'),
(2, 'Фигурки', 1, 'img/20241212095007figurine.jpg'),
(3, 'Значки', 1, 'img/20241212095013badge.jpg'),
(4, 'Мягкие игрушки', 1, 'img/20241212095020plush.jpg'),
(6, 'Стикеры', 1, 'img/20241212095029stickers.jpg'),
(8, 'Плакаты и постеры', 1, 'img/20241212095047posters.jpg'),
(10, 'Сумки, рюкзаки и кошельки', 0, 'img/20241212095105bags.jpg'),
(12, 'Одежда', 0, 'img/20241212095114clothes.jpg'),
(15, 'Комиксы и манга', 0, 'img/20241212103632manga.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `login`, `role`) VALUES
(6, '1@gmail.com', '$2y$10$3dUpqxe7LROyZE59cp5iheJlJJykpDqbwuAmm.YowiuatPb9QCylm', '123', 'user'),
(7, 'admin@admin.ru', '$2y$10$LnG/2ay/1Ux1tpWykxWGjuYYzGHkszbOY5jKNS.lq84INAtMWiOvq', 'admin', 'admin'),
(8, 'test@test', '$2y$10$S5OGfFWRSs80GriuABYsz.6bWOFJgRa/fqWCTE4SGHMegffSnSXmy', 'test', 'user'),
(9, 'newacc@newacc', '$2y$10$6Kp1SZ0.2eoQYHe0DSO6.O6BVXbsoMC7/Px44gwYlNH7LydNob8/C', 'newacc', 'user'),
(10, 'diplom@test.ru', '$2y$10$S9mw9TSRKwX2ZIKXG1mV2eTexDm9I7B0.BH8iho1z5eKb9tWmxnpO', 'DiplomAccount', 'user'),
(11, 'test@email', '$2y$10$ets.DqJbKWovy/B4/m/eWOgEThJktAS709ChdLmbxVLjcI6.Nx/ae', 'Testing', 'user'),
(15, 'flerpz1@gmail.com', '$2y$10$iwq52ACB1EKF3NBYNRX5NubkvpTkO4tTCslKQNgc0HwUN2UCFdVvC', 'NewLogin', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`,`post`),
  ADD KEY `post` (`post`);

--
-- Индексы таблицы `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_stock` (`in_stock`,`type`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `item`
--
ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post`) REFERENCES `posts` (`id`);

--
-- Ограничения внешнего ключа таблицы `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`in_stock`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`type`) REFERENCES `types` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

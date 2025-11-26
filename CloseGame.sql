-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 26 2025 г., 09:51
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
-- База данных: `CloseGame`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-11-21 07:13:06', '2025-11-21 07:13:06'),
(2, 2, '2025-11-25 00:47:38', '2025-11-25 00:47:38');

-- --------------------------------------------------------

--
-- Структура таблицы `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `game_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'Шутеры', 'sutery', '2025-11-21 08:53:51', '2025-11-21 08:53:51'),
(6, 'Хорроры', 'xorrory', '2025-11-26 03:27:50', '2025-11-26 03:27:50'),
(7, 'RPG', 'rpg', '2025-11-26 03:28:28', '2025-11-26 03:28:28'),
(8, 'Приключения', 'prikliuceniia', '2025-11-26 03:35:00', '2025-11-26 03:35:00');

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id`, `title`, `description`, `price`, `discount_price`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(9, 'Battlefield 6', 'Battlefield 6 — компьютерная игра в жанре шутера от первого лица, разработанная Battlefield Studios и изданная Electronic Arts. Вышла 10 октября 2025 года для Windows, PlayStation 5 и Xbox Series X/S.Сюжет игры разворачивается в будущем, между 2027 и 2028 годами. Центральное место занимает конфликт между НАТО и частной военной корпорацией Pax Armata, финансируемой бывшими государствами-членами альянса. Эта компания представляет угрозу, которая ставит под вопрос будущее мирового порядка.', '3500.00', '2999.00', 3, 'games/YLOp1uhe8J9kaSP7lxmNEpAsiDQRNtYEuw27GyZz.jpg', '2025-11-26 03:32:13', '2025-11-26 03:32:13'),
(10, 'Red Dead Redemption 2', 'Red Dead Redemption 2 (RDR2) — компьютерная игра в жанрах action-adventure и шутера от третьего лица с открытым миром, разработанная Rockstar Studios. Вышла для консолей PlayStation 4 и Xbox One 26 октября 2018 года, для персональных компьютеров под управлением Windows — 5 ноября 2019 года. Является третьей игрой в серии Red Dead и приквелом к Red Dead Redemption 2010 года. Сюжет: Игра построена вокруг приключений банды Датча Ван дер Линде. Под управлением игрока находится один из членов банды — Артур Морган, а после прохождения сюжетной линии до эпилога — другой член банды, Джон Марстон.', '990.00', NULL, 8, 'games/jqwsV4PIICEyUEZ4vfU1a5Bs3nVBl6yz0iaLQeN6.webp', '2025-11-26 03:36:23', '2025-11-26 03:36:23'),
(11, 'Hollow Knight: Silksong', 'Hollow Knight: Silksong — компьютерная игра в жанре метроидвании, разработанная студией Team Cherry. Релиз состоялся 4 сентября 2025 года. Действие игры происходит в увядающем королевстве Фарлуме. Игрок управляет Хорнет, инсектоидным существом, использующей иглу для борьбы с врагами.', '950.00', '1000.00', 8, 'games/MZ7ueDiMfHUU3HatW56Z3gspdVwo8EvSbUPT5H69.webp', '2025-11-26 03:39:01', '2025-11-26 03:39:01'),
(12, 'Half-Life Alyx', 'Half-Life: Alyx — шутер от первого лица в виртуальной реальности (VR), разработанный компанией Valve. Выпущен 23 марта 2020 года. Сюжет: Действие происходит между событиями Half-Life и Half-Life 2 — в тот период, когда Гордон Фримен, главный герой предыдущих частей, находится в стазисе вне пространства и времени.', '1999.00', NULL, 3, 'games/ENT9qiBl3aH5DFmfcokohhqQp6T2h2F6R0erXXiy.webp', '2025-11-26 03:41:06', '2025-11-26 03:41:06'),
(14, 'Dark Souls III', 'Dark Souls III — компьютерная игра в жанре Action/RPG, разработанная компанией FromSoftware и изданная компанией Bandai Namco в 2016 году. Выпускалась для консолей PlayStation 4, Xbox One и персональных компьютеров.Сюжет происходит в королевстве Лотрик. Первое Пламя, источник жизни, поддерживающий Эру Огня в королевствах, угасает. Тьма начинает порождать нежить и Полых — проклятых существ, которые воскресают после смерти и теряют разум. Спасти мир может ритуал, в котором великие лорды и герои жертвуют своими душами, чтобы поддерживать Первое Пламя как можно дольше. Избранный принц Лотрик отказался от исполнения своего долга и предпочёл издалека наблюдать, как животворящее пламя угасает само собой.', '1099.00', NULL, 7, 'games/8OD2MEsczpHdUq8YAK0EviLmQJk7YQHpZfQ0IZpt.webp', '2025-11-26 03:44:42', '2025-11-26 03:44:42'),
(15, 'The Elder Scrolls V: Skyrim', 'The Elder Scrolls V: Skyrim (дословно с англ. — «Древние свитки 5: Скайрим») — компьютерная игра в жанре action/RPG с открытым миром, пятая часть в серии The Elder Scrolls. Вышла 11 ноября 2011 года для Windows, PlayStation 3 и Xbox 360. Сюжет: Действие происходит в провинции Скайрим на материке Тамриэль спустя двести лет после событий предыдущей игры серии — The Elder Scrolls IV: Oblivion. Основная сюжетная линия связана с появлением в Скайриме могущественного дракона Алдуина. На главного героя, «Драконорождённого», возложена задача остановить возвращение драконов и сразить Алдуина.', '499.00', '449.00', 8, 'games/sIA09ECvOWka8qIoy1jwEfOwQb4fjw4eSoyMA4cL.webp', '2025-11-26 03:46:51', '2025-11-26 03:46:51'),
(16, 'Grand Theft Auto V', 'Grand Theft Auto V (GTA V) — компьютерная игра в жанре action-adventure с открытым миром, разработанная компанией Rockstar North и изданная компанией Rockstar Games. Сюжет: В однопользовательском режиме сюжет строится вокруг приключений троих грабителей, которые устраивают всё более дерзкие ограбления и противостоят как организованной преступности, так и правоохранительным ведомствам.', '750.00', NULL, 8, 'games/tx5E4ducKTg0KwQ34wKXswqoDKtriqeXfqjF5szG.webp', '2025-11-26 03:48:58', '2025-11-26 03:48:58'),
(17, 'Escape from Tarkov', 'Escape from Tarkov («Побег из Таркова») — многопользовательская онлайн-игра в жанре тактического шутера от первого лица с элементами RPG и MMO, разработанная российской компанией Battlestate Games. Полноценный релиз игры запланирован на 15 ноября 2025 года. Сюжет: действие игры происходит в вымышленном российском городе Тарков, охваченном анархией. Город и его окрестности изолированы от внешнего мира миротворческими силами ООН и ВС России после политического кризиса, вызванного незаконной деятельностью транснациональной корпорации TerraGroup. В городе идёт вооружённый конфликт между двумя частными военными компаниями: USEC защищает интересы корпорации, BEAR — формально нанятая властями Норвинской области, по слухам, созданная Правительством России. Игрок берёт роль бывшего наёмника, которому предстоит найти выход из осаждённого Таркова, чтобы выжить.', '1500.00', NULL, 7, 'games/dqDfmBYg2AOLpV6eujJoG1YkFoQw3tQ6xdyUCwIJ.webp', '2025-11-26 03:50:48', '2025-11-26 03:50:48');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_11_20_092038_create_categories_table', 1),
(4, '2025_11_21_091409_create_games_table', 1),
(5, '2025_11_21_100952_create_carts_table', 2),
(6, '2025_11_21_101020_create_cart_items_table', 2),
(7, '2025_11_25_041737_create_tickets_table', 3),
(8, '2025_11_25_041853_create_tickets_table', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `status` enum('open','answered','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `message`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, NULL, '123123', 'че ты пизданул там?', 'answered', '2025-11-25 03:00:05', '2025-11-25 03:00:32');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.ru', '$2y$12$jFNoo/xmQyx7fm/ABMzHWu201glMJ7SFX8ZSDEfiLHCp7ztfcCMZO', 1, 'O9Y9xqaRoQrGDISSOnrUWy6yScSoecqV6Bl4yXZXdQ2kcOR865lejbs4QROV', '2025-11-21 06:26:57', '2025-11-21 06:26:57'),
(2, 'test', 'test@examole.com', '$2y$12$8Lg0IQQCYLnDde3960J.VeGhA/kBLDb5lhs8VE5JGKXDYq3c5SrLO', 0, 'MQfL8fT1hNckgaR9CDFLfSUwwWXM8ItZv7oFg7mcq82Lj4dP1TqUN72anvI0', '2025-11-21 09:42:59', '2025-11-21 09:42:59'),
(3, 'Maksik', 'Maksik@mail.ru', '$2y$12$GjDQgQ2i83v4RwpRmawzke1YmioATzySpa.KI9tlSSUAd9u8wxm.6', 0, NULL, '2025-11-25 02:07:36', '2025-11-25 02:07:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_game_id_foreign` (`game_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

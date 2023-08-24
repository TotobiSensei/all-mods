-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 24 2023 г., 13:21
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `all_mods`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `obj_type` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `obj_id`, `obj_type`, `user_id`, `message`, `date`, `updated`) VALUES
(1, 53, 'mod', 15, 'aboba', '2023-06-22', NULL),
(2, 55, 'mod', 15, '123', '2023-06-22', NULL),
(3, 53, 'mod', 15, 'rabotaem', '2023-06-22', NULL),
(4, 53, 'mod', 15, 'rabotaem', '2023-06-22', NULL),
(5, 53, 'mod', 15, '213', '2023-06-22', NULL),
(6, 53, 'mod', 15, 'ne rabotaem\r\n', '2023-06-22', NULL),
(7, 4, 'theme', 15, 'hgdhdhdf', '2023-06-27', NULL),
(8, 4, 'theme', 15, 'fsdgsdfdhjj', '2023-06-27', NULL),
(9, 4, 'theme', 15, 'test', '2023-06-27', NULL),
(10, 4, 'theme', 15, 'aboba', '2023-06-27', NULL),
(11, 4, 'theme', 17, 'аячячсми', '2023-06-28', NULL),
(12, 4, 'theme', 17, 'aboba', '2023-06-28', NULL),
(13, 5, 'theme', 15, 'fsdgsdfgsdf', '2023-06-29', NULL),
(14, 7, 'theme', 15, 'rgdfgdfsgsdfgsd', '2023-06-30', NULL),
(15, 7, 'theme', 17, 'dfgnbxfgnb', '2023-06-30', NULL),
(26, 53, 'mod', 15, '?', '2023-07-24', NULL),
(27, 53, 'mod', 15, 'nice', '2023-07-24', NULL),
(28, 54, 'mod', 15, 'test\r\n', '2023-07-24', NULL),
(29, 54, 'mod', 15, 'not test', '2023-07-24', NULL),
(30, 54, 'mod', 15, '1234', '2023-07-24', NULL),
(31, 54, 'mod', 15, '54', '2023-07-24', NULL),
(32, 54, 'mod', 15, '12', '2023-07-24', NULL),
(33, 54, 'mod', 15, '5', '2023-07-24', NULL),
(35, 35, 'theme', 15, 'dfs', '2023-08-16', NULL),
(36, 35, 'theme', 15, 'ыавпывапыв', '2023-08-17', NULL),
(37, 35, 'theme', 15, 'ыапывапыавпып', '2023-08-17', NULL),
(38, 35, 'theme', 15, 'ыапвывпыв', '2023-08-17', NULL),
(39, 35, 'theme', 15, 'рпаыврырыварывары', '2023-08-17', NULL),
(40, 35, 'theme', 15, '5he6', '2023-08-17', NULL),
(41, 35, 'theme', 15, '5he6', '2023-08-17', NULL),
(42, 35, 'theme', 15, 'nghfd ', '2023-08-17', NULL),
(43, 36, 'theme', 15, '123', '2023-08-21', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decription` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id`, `name`, `decription`) VALUES
(1, 'game_1', NULL),
(3, 'game_2', NULL),
(4, 'game_3', NULL),
(5, 'game_4', NULL),
(6, 'game_5', NULL),
(7, 'game_6', NULL),
(8, 'game_7', NULL),
(9, 'game_8', NULL),
(10, 'game_9', NULL),
(11, 'game_10', NULL),
(12, 'game_11', NULL),
(13, 'game_12', NULL),
(14, 'game_13', NULL),
(15, 'game_14', NULL),
(16, 'game_15', NULL),
(17, 'game_16', NULL),
(18, 'game_17', NULL),
(19, 'game_18', NULL),
(20, 'game_19', NULL),
(21, 'game_20', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `obj_id` int(11) NOT NULL,
  `obj_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`obj_id`, `obj_type`, `img`) VALUES
(17, 'user', '/assets/img/users_logo/aboba_64afc9798870e.jpeg'),
(15, 'user', '/assets/img/users_logo/15_64d0e697a487b.jpeg'),
(16, 'user', '/assets/img/users_logo/16_64b79b7f30297.jpeg'),
(1, 'game', '/assets/img/game_img/tes_skyrim.jpg.jpg'),
(18, 'user', '/assets/img/users_logo/18_64ca12de4436d.jpeg'),
(20, 'user', '/assets/img/users_logo/20_64d0ea7852672.jpeg'),
(1, 'mod', '/assets/img/mod_img/64e72e1ab0e33_sticker.jpg'),
(2, 'mod', '/assets/img/mod_img/64e72e24b885a_1316921.jpg'),
(3, 'mod', '/assets/img/mod_img/64e72e7356041_look-vector-art-tears-aqua-hd-wallpaper-preview.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mods`
--

CREATE TABLE `mods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `category_id` int(11) NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `upload` date NOT NULL,
  `updated` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mods`
--

INSERT INTO `mods` (`id`, `name`, `description`, `category_id`, `file_name`, `upload`, `updated`, `user_id`, `game_id`) VALUES
(1, 'aboba', 'фапфвафв', 1, 'https://www.youtube.com/watch?v=LQArLobRrt8&list=RDJLeuGeIwXL0&index=27&ab_channel=Portwave-Topic', '2023-08-24', NULL, 15, 1),
(2, 'learn', 'апывапыв', 3, 'https://www.youtube.com/watch?v=LQArLobRrt8&list=RDJLeuGeIwXL0&index=27&ab_channel=Portwave-Topic', '2023-08-24', NULL, 15, 1),
(3, 'tupo_mod', 'adfadfas', 1, 'https://www.youtube.com/watch?v=LQArLobRrt8&list=RDJLeuGeIwXL0&index=27&ab_channel=Portwave-Topic', '2023-08-24', NULL, 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mods_categories`
--

CREATE TABLE `mods_categories` (
  `id` int(11) NOT NULL,
  `name` char(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mods_categories`
--

INSERT INTO `mods_categories` (`id`, `name`) VALUES
(1, 'gameplay'),
(3, 'texture'),
(4, 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `obj_type` char(100) CHARACTER SET utf8 NOT NULL,
  `reporting_user_id` int(11) NOT NULL,
  `report_date` date DEFAULT NULL,
  `report_type` varchar(500) CHARACTER SET utf8 NOT NULL,
  `addition` text CHARACTER SET utf8,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `obj_id`, `obj_type`, `reporting_user_id`, `report_date`, `report_type`, `addition`, `status`) VALUES
(15, 36, 'theme', 15, NULL, 'Насилие и угрозы безопасности/Нарушение авторских прав', '', 1),
(16, 36, 'theme', 15, NULL, 'Оскорбления и домогательства/Спам и нежелательная реклама/Насилие и угрозы безопасности/Насилие и экстремизм', '', 1),
(17, 36, 'theme', 15, NULL, 'Нарушение авторских прав/Нарушение правил сообщества/Насилие и экстремизм', '', 1),
(18, 36, 'theme', 15, NULL, 'Насилие и экстремизм', '', 1),
(19, 43, 'comment', 20, NULL, 'Оскорбления и домогательства/Спам и нежелательная реклама', '', 1),
(20, 36, 'theme', 20, NULL, 'Насилие и угрозы безопасности/Нарушение авторских прав/Нарушение правил сообщества', '', 1),
(21, 37, 'theme', 15, NULL, 'Спам и нежелательная реклама', '123', 1),
(22, 37, 'theme', 15, NULL, 'Оскорбления и домогательства/Насилие и экстремизм', '54', 1),
(23, 37, 'theme', 15, NULL, 'Спам и нежелательная реклама/Насилие и угрозы безопасности', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `obj_id` int(11) NOT NULL,
  `obj_type` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_creator_id` int(11) DEFAULT NULL,
  `rating` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`obj_id`, `obj_type`, `user_id`, `post_creator_id`, `rating`) VALUES
(53, 'mod', 15, NULL, 5),
(54, 'mod', 16, NULL, 3),
(55, 'mod', 16, NULL, 2),
(56, 'mod', 16, NULL, 5),
(57, 'mod', 16, NULL, 1),
(53, 'mod', 17, NULL, 2),
(54, 'mod', 17, NULL, 5),
(55, 'mod', 17, NULL, 1),
(56, 'mod', 17, NULL, 2),
(57, 'mod', 17, NULL, 5),
(74, 'mod', 15, NULL, 3),
(3, 'comment', 15, 15, -1),
(4, 'comment', 15, 15, 1),
(1, 'comment', 15, 15, 1),
(35, 'theme', 15, 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `topic` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `text` text CHARACTER SET utf8mb4 NOT NULL,
  `date` date NOT NULL,
  `updated` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `header`, `topic`, `text`, `date`, `updated`, `user_id`) VALUES
(35, 'sdfg', 'sdfgsd', 'Lorem, ipsum dolor sit amet \n\n\n\nLorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus hic iste necessitatibus vel magnam sequi exercitationem libero voluptates odio consequuntur impedit quia nisi veniam nam, porro laborum error corporis quae?consectetur adipisicing elit. Ex, nemo ea iusto dolore, id quas hic ullam quasi mollitia officia alias ut. Impedit iusto iure aut pariatur cumque. Dolorum, ad?', '2023-08-07', '2023-08-17', 15),
(36, 'adsfas', 'asdfasasdf', 'adsfas', '2023-08-07', NULL, 15),
(37, 'sfgd', 'sdfgsdfggsdf', 'gsdfgs', '2023-08-07', NULL, 15),
(38, 'sfgd', 'sdfgsdfggsdf', 'gsdfgs', '2023-08-07', NULL, 15),
(39, 'asdf', 'adsfasdf', 'asdfas', '2023-08-07', NULL, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psw_hash` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `reg_date` date NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `full_name`, `about_me`, `email`, `psw_hash`, `birthday`, `reg_date`, `role_id`) VALUES
(1, 'admin', NULL, '', 'admin', '$2y$10$WAGkjOtDVzJUT/sXQrVqeuRQlaVnOwKwLw1Jnsh.ulp6C.Zyv1que', NULL, '2023-05-01', 1),
(6, 'abobik', NULL, '', 'abobik@mail.com', '$2y$10$IHiQtPX1CNab0aZPu8fp7ueQxUkTSmWW61uMLBGRDVx4/Lh6uS7/G', NULL, '2023-05-04', 3),
(10, 'biba', NULL, '', 'biba@mail.ru', '$2y$10$6fQ3iyv3TLH6YTJhTy0vfuOxnhw1iclzvUhvO2SnYzpkTLstKlNam', NULL, '2023-05-04', 3),
(11, 'mavpa', NULL, '', 'mavap@urk.ua', '$2y$10$LDJBipX4Hi0qoPYOdbXtT.hReEaEQ4vb4DuQYu5cIIesppqmVPlZi', NULL, '2023-05-04', 3),
(12, 'mavpa123456', NULL, '', 'mavpa6@mail.ru', '$2y$10$TZ.9zvuj8el/9EIvOstK.uuToHIhRvyR2f87CUby0rNduZImfB3mi', NULL, '2023-05-18', 3),
(13, 'mavpa6', NULL, '', 'mavpa7@gmail.com', '$2y$10$Fw3CCVq8lxK2.AbF29IP8.1EFyDayWQ9oov5rkwLrjhZbpfag.xWu', NULL, '2023-05-18', 3),
(14, 'mavpa7', NULL, '', 'mavpa77@mail.ru', '$2y$10$FgJKDJluX4hKqZgpE6312.9RhqVRuobTCtLKcEhtaCZuxy1y0n2Hy', NULL, '2023-05-18', 3),
(15, 'fisher', 'Jhon1/Jhonson2', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam obcaecati expedita voluptatum, dolorem nobis optio itaque vel odio velit voluptas totam ducimus sapiente consequatur ullam explicabo maiores! Rerum', 'fisher@gmail.com', '$2y$10$4MivxvJ6uv7.545x8tKmdeARHdLpSwr5O7BZdSvR/4Q52Ss8x3l3m', '1995-05-08', '2023-05-22', 1),
(16, 'user223', 'Chunga/Changa', NULL, 'user2@mail.ru', '$2y$10$i456MqS3CTAYcLlYUWCqQu.eXBZe.Uh9mngjrORTepWAXNNr8i9ge', '1993-07-20', '2023-05-24', 3),
(17, 'aboba', 'Arnold/atomicgun', NULL, 'user3@mail.ru', '$2y$10$1CvNHQm3KrpdbUU5A6WS6OtBvvvuS3bfO/lte8.XyP8QZ.u7/Wbue', NULL, '2023-05-24', 3),
(18, 'malfa', 'user_854', NULL, 'malfa@mail.ru', '$2y$10$Mq0RhIr8zazj2FCB54QBFexmG4BZelQSrKcgDiqAUnPU44bAJKbl6', NULL, '2023-08-02', 3),
(19, 'user2', 'user_490', NULL, 'bachu2@mail.ua', '$2y$10$mLgRCBqL0ZuF2Zn5/UOPX.QlEQpBhMT91jZz9dN1iaUZ.tiaO14SW', NULL, '2023-08-02', 3),
(20, 'user5', 'user_749', NULL, 'user5@mail.ru', '$2y$10$YjhgebquQT/UZT0LKPqMXuxkuWPMZm73cBAhsvemqhZp9p4svSAWi', NULL, '2023-08-07', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE `views` (
  `obj_id` int(11) NOT NULL,
  `obj_type` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `views`
--

INSERT INTO `views` (`obj_id`, `obj_type`, `user_id`, `count`) VALUES
(53, 'mod', 15, 500),
(54, 'mod', 15, 28),
(55, 'mod', 15, 10),
(56, 'mod', 15, 10),
(57, 'mod', 15, 8),
(67, 'mod', 15, 2),
(74, 'mod', 16, 5),
(71, 'mod', 15, 7),
(35, 'theme', 15, 641),
(36, 'theme', 15, 36),
(37, 'theme', 15, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obj_id` (`obj_id`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mods`
--
ALTER TABLE `mods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Индексы таблицы `mods_categories`
--
ALTER TABLE `mods_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `obj_id` (`obj_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `mods`
--
ALTER TABLE `mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mods_categories`
--
ALTER TABLE `mods_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

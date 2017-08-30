-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2017 г., 10:36
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `group_list`
--
CREATE DATABASE IF NOT EXISTS `group_list` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci;
USE `group_list`;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `kod` varchar(3) NOT NULL,
  `facult` varchar(100) NOT NULL,
  `starosta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`kod`, `facult`, `starosta`) VALUES
('301', 'Факультет комп''ютерних наук', 'Петрова');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `kod` int(11) DEFAULT NULL,
  `fio` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `sex` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`kod`, `fio`, `year`, `sex`) VALUES
(1, 'Іванов', 1985, 'чол'),
(2, 'Петрова', 1986, 'жін'),
(3, 'Сидоров', 1984, 'чол');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

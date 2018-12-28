-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.38 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

-- Дамп структуры для таблица test.organizations
CREATE TABLE IF NOT EXISTS `organizations` (
  `organization_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayName` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ogrn` bigint(20) NOT NULL,
  `oktmo` bigint(20) NOT NULL,
  PRIMARY KEY (`organization_id`),
  UNIQUE KEY `organizations_ogrn_unique` (`ogrn`),
  UNIQUE KEY `organizations_oktmo_unique` (`oktmo`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица test.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `role` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица test.WorkerOrganization
CREATE TABLE IF NOT EXISTS `WorkerOrganization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL DEFAULT '0',
  `id_worker` int(11) NOT NULL DEFAULT '0',
  `rate` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_organization` (`organization_id`),
  KEY `id_worker` (`id_worker`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица test.workers
CREATE TABLE IF NOT EXISTS `workers` (
  `id_worker` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `inn` bigint(20) NOT NULL,
  `snils` bigint(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_worker`),
  UNIQUE KEY `workers_inn_unique` (`inn`),
  UNIQUE KEY `workers_snils_unique` (`snils`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

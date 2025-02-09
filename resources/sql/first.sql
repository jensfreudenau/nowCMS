-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 10. Dez 2024 um 11:23
-- Server-Version: 10.11.10-MariaDB-deb12
-- PHP-Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Datenbank: `xa197_db1_test`
--
CREATE DATABASE IF NOT EXISTS `xa197_db1_test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `xa197_db1_test`;

-- --------------------------------------------------------

--
-- Daten für Tabelle `cache`
--


--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `parent_id`) VALUES
(5, 'Reisen', '2024-03-09 16:45:50', '2024-03-12 10:07:43', 0),
(6, 'Architektur', '2024-03-09 16:47:40', '2024-03-12 10:07:37', 0),
(10, 'Italien', '2024-04-06 07:14:38', '2024-04-08 14:08:35', 5),
(11, 'Frankreich', '2024-04-06 07:14:45', '2024-04-08 14:08:43', 5),
(13, 'Spanien', '2024-04-08 12:21:43', '2024-04-08 14:22:31', 5),
(14, 'Deutschland', '2024-04-08 12:21:48', '2024-04-08 14:22:31', 5),
(15, 'Peru', '2024-04-08 12:21:53', '2024-04-08 14:22:31', 5),
(16, 'Schweiz', '2024-04-08 12:21:53', '2024-04-08 14:22:31', 5),
(17, 'Park', '2024-11-09 14:25:36', '2024-11-09 15:25:36', NULL),
(18, 'Night', '2024-11-09 15:00:21', '2024-11-09 16:00:21', NULL),
(19, 'Rieselfelder', '2024-11-22 12:31:08', '2024-11-22 13:31:08', NULL),
(20, 'signs', '2024-11-26 08:47:56', '2024-11-26 09:47:56', NULL),
(21, 'street', '2024-11-27 14:54:47', '2024-11-27 15:54:47', NULL);

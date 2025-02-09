# ************************************************************
# Sequel Ace SQL dump
# Version 20078
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 9.1.0)
# Datenbank: xa197_db1
# Verarbeitungszeit: 2024-12-11 10:52:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Tabellen-Dump media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`),
  CONSTRAINT `media_chk_1` CHECK (json_valid(`manipulations`)),
  CONSTRAINT `media_chk_2` CHECK (json_valid(`custom_properties`)),
  CONSTRAINT `media_chk_3` CHECK (json_valid(`generated_conversions`)),
  CONSTRAINT `media_chk_4` CHECK (json_valid(`responsive_images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;

INSERT INTO `media` (`model_type`, `model_id`, `meta`, `date`, `headline`, `website`, `description`, `keywords`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`)
VALUES
    ('App\\Models\\Journey', '12', NULL, NULL, NULL, NULL, NULL, NULL, 'eb5d8d4a-3fcc-4a8c-a1fa-3aafe42279a0', 'images', 'DSC07013', 'DSC07013.jpg', 'image/jpeg', 'public', 'public', '762213', '[]', '[]', '{\"thumb\":true,\"preview\":true,\"square\":true}', '[]', '1'),
    ('App\\Models\\Journey', '12', NULL, NULL, NULL, NULL, NULL, NULL, 'd0f9c6c0-afda-4280-a91d-07dcd6f43f25', 'images', 'DSC07018', 'DSC07018.jpg', 'image/jpeg', 'public', 'public', '813326', '[]', '{\"DateTimeOriginal\":\"2023:10:04 09:04:45\",\"address\":\"\",\"lat\":\"+47.445670\",\"lon\":\"+7.155670\"}', '{\"thumb\":true,\"preview\":true,\"square\":true}', '[]', '2'),
    ('App\\Models\\Journey', '12', NULL, NULL, NULL, NULL, NULL, NULL, '2c29d52e-746e-4035-a3e0-52e1599b9e55', 'images', 'DSC07006', 'DSC07006.jpg', 'image/jpeg', 'public', 'public', '643867', '[]', '{\"DateTimeOriginal\":\"2023:10:03 15:37:32\",\"address\":\"Rte dAlle 31, 2943 Vendlincourt, Switzerland\",\"lat\":\"+47.552080\",\"lon\":\"+7.593254\"}', '{\"thumb\":true,\"preview\":true,\"square\":true}', '[]', '3'),
    ('App\\Models\\Journey', '12', NULL, NULL, NULL, NULL, NULL, NULL, '3219e240-3f2d-4f58-8d6a-a98840ece8f1', 'gpx', 'activity_12163176123', 'activity_12163176123.gpx', 'text/xml', 'public', 'public', '2844159', '[]', '{\"start_time\":\"2023-10-03T13\",\"lat\":\"51\",\"lon\":\"16.000Z\"}', '[]', '[]', '4'),
    ('App\\Models\\Journey', '12', NULL, NULL, NULL, NULL, NULL, NULL, 'aeaaf78f-e14c-45de-8dbe-47f92d23cb7f', 'gpx', 'activity_12170998296', 'activity_12170998296.gpx', 'text/xml', 'public', 'public', '7303601', '[]', '{\"start_time\":\"2023-10-04T07\",\"lat\":\"01\",\"lon\":\"38.000Z\"}', '[]', '[]', '5');

INSERT INTO `media` (`model_type`, `model_id`, `meta`, `date`, `headline`, `website`, `description`, `keywords`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`)
VALUES
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '91154776-449e-4ad7-aaf5-39ceb979eda4', 'images', 'IMG_6891', 'IMG_6891.jpg', 'image/jpeg', 'public', 'public', '431407', '[]', '[]', '{\"thumb\":true,\"preview\":true,\"square\":true}', '[]', '1'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '2bca38b0-3277-4b29-8716-892ff663efc3', 'gpx', 'activity_111400650', 'activity_111400650.gpx', 'text/xml', 'public', 'public', '370830', '[]', '{\"start_time\":\"2011-09-01T09\",\"lat\":\"44\",\"lon\":\"31.000Z\"}', '[]', '[]', '18'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '50ff601e-8a24-48fc-8b4c-aa0dfabdfdb0', 'gpx', 'activity_111400644', 'activity_111400644.gpx', 'text/xml', 'public', 'public', '1595296', '[]', '{\"start_time\":\"2011-09-02T06\",\"lat\":\"10\",\"lon\":\"00.000Z\"}', '[]', '[]', '20'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '7f42f350-5282-4048-a08e-8f07dc6c5b8a', 'gpx', 'activity_111400651', 'activity_111400651.gpx', 'text/xml', 'public', 'public', '531327', '[]', '{\"start_time\":\"2011-09-01T06\",\"lat\":\"33\",\"lon\":\"51.000Z\"}', '[]', '[]', '19'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'd4e1e2d6-faae-4596-b625-0b5f96628b63', 'gpx', 'activity_111400661', 'activity_111400661.gpx', 'text/xml', 'public', 'public', '880648', '[]', '{\"start_time\":\"2011-08-31T06\",\"lat\":\"23\",\"lon\":\"23.000Z\"}', '[]', '[]', '17'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '640f1ac3-7de6-4cf6-b260-82c87dad5ecc', 'gpx', 'activity_111400670', 'activity_111400670.gpx', 'text/xml', 'public', 'public', '818700', '[]', '{\"start_time\":\"2011-08-30T06\",\"lat\":\"56\",\"lon\":\"00.000Z\"}', '[]', '[]', '16'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '9b5dd58c-9952-45ce-bb81-5da3817d7977', 'gpx', 'activity_111400679', 'activity_111400679.gpx', 'text/xml', 'public', 'public', '528914', '[]', '{\"start_time\":\"2011-08-29T06\",\"lat\":\"50\",\"lon\":\"57.000Z\"}', '[]', '[]', '15'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '4264c615-b7bd-4b6e-b49e-a083047e914e', 'gpx', 'activity_111400680', 'activity_111400680.gpx', 'text/xml', 'public', 'public', '412904', '[]', '{\"start_time\":\"2011-08-28T12\",\"lat\":\"55\",\"lon\":\"06.000Z\"}', '[]', '[]', '14'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'b929d1a2-ca97-41de-8adc-dd47bbfe8256', 'gpx', 'activity_111400697', 'activity_111400697.gpx', 'text/xml', 'public', 'public', '959229', '[]', '{\"start_time\":\"2011-08-28T07\",\"lat\":\"02\",\"lon\":\"52.000Z\"}', '[]', '[]', '13'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '90e4dcc4-0878-420a-8bd8-ca2254bed4ec', 'gpx', 'activity_111400712', 'activity_111400712.gpx', 'text/xml', 'public', 'public', '774309', '[]', '{\"start_time\":\"2011-08-27T10\",\"lat\":\"41\",\"lon\":\"58.000Z\"}', '[]', '[]', '12'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'a6b66ccb-1595-4acc-b36b-9166401176f3', 'gpx', 'activity_111400727', 'activity_111400727.gpx', 'text/xml', 'public', 'public', '629908', '[]', '{\"start_time\":\"2011-08-27T06\",\"lat\":\"52\",\"lon\":\"01.000Z\"}', '[]', '[]', '11'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '59f64c00-3010-4ec6-960c-54cd7fa07ba3', 'gpx', 'activity_111400737', 'activity_111400737.gpx', 'text/xml', 'public', 'public', '414104', '[]', '{\"start_time\":\"2011-08-25T06\",\"lat\":\"42\",\"lon\":\"18.000Z\"}', '[]', '[]', '9'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '013a2f5d-2e98-4e62-a282-91a69fbf63a6', 'gpx', 'activity_111400742', 'activity_111400742.gpx', 'text/xml', 'public', 'public', '822611', '[]', '{\"start_time\":\"2011-08-26T05\",\"lat\":\"02\",\"lon\":\"30.000Z\"}', '[]', '[]', '10'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '7f9504c0-343a-471b-a942-ccffc870b3de', 'gpx', 'activity_111400747', 'activity_111400747.gpx', 'text/xml', 'public', 'public', '182795', '[]', '{\"start_time\":\"2011-08-25T05\",\"lat\":\"29\",\"lon\":\"39.000Z\"}', '[]', '[]', '8'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '8806f16f-8e88-4927-996f-229f30b2484e', 'gpx', 'activity_111400760', 'activity_111400760.gpx', 'text/xml', 'public', 'public', '225392', '[]', '{\"start_time\":\"2011-08-23T08\",\"lat\":\"45\",\"lon\":\"46.000Z\"}', '[]', '[]', '6'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '82c9268a-5f46-469a-8e1c-2d0b591c71fe', 'gpx', 'activity_111400765', 'activity_111400765.gpx', 'text/xml', 'public', 'public', '977815', '[]', '{\"start_time\":\"2011-08-24T05\",\"lat\":\"08\",\"lon\":\"54.000Z\"}', '[]', '[]', '7'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'd9b041f3-7956-45e4-bb65-e0527a5c321b', 'gpx', 'activity_111400770', 'activity_111400770.gpx', 'text/xml', 'public', 'public', '651745', '[]', '{\"start_time\":\"2011-08-23T04\",\"lat\":\"56\",\"lon\":\"27.000Z\"}', '[]', '[]', '5'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'a39020ba-cc40-468b-b800-ac12ea633cc6', 'gpx', 'activity_111400781', 'activity_111400781.gpx', 'text/xml', 'public', 'public', '772238', '[]', '{\"start_time\":\"2011-08-22T07\",\"lat\":\"20\",\"lon\":\"04.000Z\"}', '[]', '[]', '4'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, 'ba7203b7-3e19-422a-9ec9-b2ced214e220', 'gpx', 'activity_111400779', 'activity_111400779.gpx', 'text/xml', 'public', 'public', '269183', '[]', '{\"start_time\":\"2011-08-22T06\",\"lat\":\"01\",\"lon\":\"37.000Z\"}', '[]', '[]', '3'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '60ac62e9-d548-4be8-ae3a-25c1b45a31d5', 'gpx', 'activity_111400794', 'activity_111400794.gpx', 'text/xml', 'public', 'public', '840779', '[]', '{\"start_time\":\"2011-08-21T06\",\"lat\":\"15\",\"lon\":\"19.000Z\"}', '[]', '[]', '2'),
    ('App\\Models\\Journey', '10', NULL, NULL, NULL, NULL, NULL, NULL, '957b726b-9bab-46df-95f5-72549d05a60d', 'gpx', 'activity_111400799', 'activity_111400799.gpx', 'text/xml', 'public', 'public', '442219', '[]', '{\"start_time\":\"2011-08-20T10\",\"lat\":\"34\",\"lon\":\"37.000Z\"}', '[]', '[]', '1');


INSERT INTO `media` (`model_type`, `model_id`, `meta`, `date`, `headline`, `website`, `description`, `keywords`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`)
VALUES
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '1ff67c2f-04f0-42e1-a9ce-1e1f81f3c24b', 'gpx', 'activity_12170998296', 'activity_12170998296.gpx', 'text/xml', 'public', 'public', '7303601', '[]', '{\"start_time\":\"2023-10-04T07\",\"lat\":\"01\",\"lon\":\"38.000Z\"}', '[]', '[]', '1'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, 'd56f5207-a895-4ffb-a755-7d94bf832cc6', 'gpx', 'activity_12196846503', 'activity_12196846503.gpx', 'text/xml', 'public', 'public', '668964', '[]', '{\"start_time\":\"2023-10-06T06\",\"lat\":\"17\",\"lon\":\"55.000Z\"}', '[]', '[]', '3'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '34de74a1-59f3-4518-998d-00826a922d2c', 'gpx', 'activity_12198308976', 'activity_12198308976.gpx', 'text/xml', 'public', 'public', '7501745', '[]', '{\"start_time\":\"2023-10-06T07\",\"lat\":\"16\",\"lon\":\"36.000Z\"}', '[]', '[]', '4'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '551f0823-7eda-4bad-b3d3-d1ce0ee9ba6f', 'gpx', 'activity_12213048396', 'activity_12213048396.gpx', 'text/xml', 'public', 'public', '7536005', '[]', '{\"start_time\":\"2023-10-07T07\",\"lat\":\"36\",\"lon\":\"50.000Z\"}', '[]', '[]', '5'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, 'de6d400a-60b1-46cd-a767-2010cec62d42', 'gpx', 'activity_12227996933', 'activity_12227996933.gpx', 'text/xml', 'public', 'public', '5131506', '[]', '{\"start_time\":\"2023-10-08T06\",\"lat\":\"52\",\"lon\":\"18.000Z\"}', '[]', '[]', '6'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '85a0b190-fb6d-4f1c-9a0e-ccd128337cdb', 'gpx', 'activity_12240692565', 'activity_12240692565.gpx', 'text/xml', 'public', 'public', '6448344', '[]', '{\"start_time\":\"2023-10-09T07\",\"lat\":\"09\",\"lon\":\"43.000Z\"}', '[]', '[]', '7'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '098e490d-820d-4f6f-b8df-548637326348', 'gpx', 'activity_12257301870', 'activity_12257301870.gpx', 'text/xml', 'public', 'public', '6340458', '[]', '{\"start_time\":\"2023-10-10T07\",\"lat\":\"23\",\"lon\":\"27.000Z\"}', '[]', '[]', '8'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '08b6441d-b725-4fa8-98f3-4ccb5916e5ed', 'gpx', 'activity_12273575636', 'activity_12273575636.gpx', 'text/xml', 'public', 'public', '8052528', '[]', '{\"start_time\":\"2023-10-11T07\",\"lat\":\"02\",\"lon\":\"07.000Z\"}', '[]', '[]', '9'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '35ff245c-e549-4614-972a-d34b9517fecc', 'gpx', 'activity_12184852672', 'activity_12184852672.gpx', 'text/xml', 'public', 'public', '8670697', '[]', '{\"start_time\":\"2023-10-05T06\",\"lat\":\"31\",\"lon\":\"19.000Z\"}', '[]', '[]', '2'),
    ('App\\Models\\Journey', '11', NULL, NULL, NULL, NULL, NULL, NULL, '0d98ee07-93ce-4c40-85a3-a3c5ea3dbc37', 'images', 'DSC07136', 'DSC07136.jpg', 'image/jpeg', 'public', 'public', '311269', '[]', '{\"DateTimeOriginal\":\"2023:10:07 10:32:02\",\"address\":\"3 Rue du Merle, 38680 Pont-en-Royans, France\",\"lat\":\"+45.060170\",\"lon\":\"+5.346297\"}', '{\"thumb\":true,\"preview\":true,\"square\":true}', '[]',1);


UNLOCK TABLES;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
LOCK TABLES `journeys` WRITE;
INSERT INTO `journeys` (`name_of_route`, `start_date`, `description`,  `slug`, `active`, `user_id`)
VALUES
    ('simple mit gps', '2024-12-12', NULL,  'simple-mit-gps', NULL, '1');

UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

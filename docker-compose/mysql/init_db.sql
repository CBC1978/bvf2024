-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 11 fév. 2025 à 09:12
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bvf`
--

-- --------------------------------------------------------

--
-- Structure de la table `brand_car`
--

CREATE TABLE `brand_car` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `brand_car`
--

INSERT INTO `brand_car` (`id`, `libelle`, `created_at`, `updated_at`, `created_by`) VALUES
(1, '4Stroke', NULL, NULL, 0),
(2, 'Acrea', NULL, NULL, 0),
(3, 'Acura', NULL, NULL, 0),
(4, 'Alpha Romeo', NULL, NULL, 0),
(5, 'Alpina', NULL, NULL, 0),
(6, 'Ashok Leyland', NULL, NULL, 0),
(7, 'Audi', NULL, NULL, 0),
(8, 'Beiben', NULL, NULL, 0),
(9, 'Blum Hardt', NULL, NULL, 0),
(10, 'BMW', NULL, NULL, 0),
(11, 'Brillance', NULL, NULL, 0),
(12, 'Cadillac', NULL, NULL, 0),
(13, 'Caterham', NULL, NULL, 0),
(14, 'Catterpillar', NULL, NULL, 0),
(15, 'Chang\'an Motors', NULL, NULL, 0),
(16, 'Chery', NULL, NULL, 0),
(17, 'Chevrolet', NULL, NULL, 0),
(18, 'Chrysler', NULL, NULL, 0),
(19, 'Citroen', NULL, NULL, 0),
(20, 'Cobra Cars', NULL, NULL, 0),
(21, 'Dacia', NULL, NULL, 0),
(22, 'Daewoo', NULL, NULL, 0),
(23, 'DAF', NULL, NULL, 0),
(24, 'Daihatsu', NULL, NULL, 0),
(25, 'Derways', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(255) NOT NULL,
  `registration` varchar(255) DEFAULT NULL,
  `fk_type_car` int(11) DEFAULT '0',
  `fk_brand_car` int(11) DEFAULT '0',
  `model` varchar(255) DEFAULT NULL,
  `payload` float DEFAULT '0',
  `image` varchar(100) DEFAULT NULL,
  `fk_carrier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `registration`, `fk_type_car`, `fk_brand_car`, `model`, `payload`, `image`, `fk_carrier_id`, `created_at`, `updated_at`) VALUES
(1, '11gh6598', 1, 23, 'ACTROS', 60, '11gh65981706615317.jpg', 3, '2024-01-30 11:48:37', '2024-01-30 11:48:37'),
(3, '11TY6543', 28, 11, 'ACTROS', 100, '11TY65431706691468.png', 3, '2024-01-31 08:57:48', '2024-01-31 08:58:11'),
(4, '11GT6754', 39, 25, 'ATEGO', 60, NULL, 3, '2024-02-12 13:06:27', '2024-02-12 13:06:27'),
(5, '11GH5698', 32, 23, 'ACTROS', 50, NULL, 5, '2024-10-01 10:14:32', '2024-10-01 10:14:32'),
(6, '23RT6578', 1, 4, 'ACTROS', 0, NULL, 5, '2024-10-03 10:12:39', '2024-10-03 10:12:39'),
(7, '09UJ7654', 3, 4, 'ACTROS', 0, NULL, 5, '2024-10-03 10:38:15', '2024-10-03 10:38:15'),
(8, '11GH5434', 1, 1, 'ACTROS', 0, NULL, 5, '2024-10-03 10:38:48', '2024-10-03 10:38:48');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE `carrier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `email` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifu` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rccm` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut_juridique` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `company_name`, `address`, `phone`, `city`, `email`, `ifu`, `rccm`, `statut_juridique`, `name`, `signature`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'BOURSE VIRTUELLE DE FRET', 'OUAGA', '4567890', 2, 'arduino1024@gmail.com', 'arduino1024@gmail.com', 'arduino1024@gmail.com', 1, '', 'Claude', 0, '2024-01-30 09:04:09', '2024-10-17 14:57:20'),
(4, 'AKATransport', 'YAKRO', '897654', 2, 'admin@cbc.bf', 'UY67TR54', 'TY45VF', 1, NULL, NULL, 94, '2024-09-25 15:31:06', '2024-09-25 15:31:06'),
(5, 'STANE TRANSIT', 'dakola', '9876543', 2, 'dolidev2.0@gmail.com', 'test', 'test', 1, 'Claude', 'img3.jpg', 0, '2024-10-01 09:30:09', '2024-12-05 14:42:43');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(255) NOT NULL DEFAULT '0',
  `fk_offer_id` int(255) DEFAULT NULL,
  `fk_user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contract_details`
--

CREATE TABLE `contract_details` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `cars_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contract_details`
--

INSERT INTO `contract_details` (`id`, `contract_id`, `driver_id`, `cars_id`, `created_at`, `updated_at`, `created_by`) VALUES
(3, 1, 1, 1, '2024-03-26', '2024-03-26', 97),
(4, 1, 1, 1, '2024-03-26', '2024-03-26', 97),
(9, 3, 2, 5, '2024-10-03', '2024-10-03', 96);

-- --------------------------------------------------------

--
-- Structure de la table `contract_transport`
--

CREATE TABLE `contract_transport` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_code` int(255) DEFAULT NULL,
  `created_by` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_freight_offert_id` int(11) NOT NULL,
  `fk_transport_offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contract_transport`
--

INSERT INTO `contract_transport` (`id`, `contract_code`, `created_by`, `created_at`, `updated_at`, `fk_freight_offert_id`, `fk_transport_offer_id`) VALUES
(2, 0, 98, '2024-09-25 15:33:25', '2024-09-25 15:33:25', 0, 1),
(3, 0, 95, '2024-10-01 12:42:15', '2024-10-01 12:42:15', 0, 3),
(4, 0, 95, '2024-10-09 09:02:41', '2024-10-09 09:02:41', 0, 4),
(5, 0, 95, '2024-10-09 09:12:48', '2024-10-09 09:12:48', 0, 2),
(8, 0, 95, '2024-12-05 10:21:25', '2024-12-05 10:21:25', 0, 5),
(9, 0, 95, '2024-12-05 10:34:10', '2024-12-05 10:34:10', 0, 6),
(10, 0, 96, '2024-12-05 10:54:36', '2024-12-05 10:54:36', 7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `licence` varchar(100) NOT NULL,
  `date_issue` date DEFAULT NULL,
  `place_issue` varchar(255) DEFAULT NULL,
  `fk_carrier_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `driver`
--

INSERT INTO `driver` (`id`, `first_name`, `last_name`, `licence`, `date_issue`, `place_issue`, `fk_carrier_id`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Jean', 'Claude', '234576IDP', '2023-02-01', 'Ouaga', 3, '2024-02-15', '2024-02-15', 97),
(2, 'DABONE', 'Jean Claude', '12RTNB', '2022-10-12', 'OUAGA', 5, '2024-10-03', '2024-10-03', 96),
(3, 'DABONE', 'Jean Claude', '12RTNB', '2022-10-12', 'OUAGA', 5, '2024-10-03', '2024-10-03', 96),
(4, 'DABONE', 'Jean Claude', '12RTNB', '2022-10-12', 'OUAGA', 5, '2024-10-03', '2024-10-03', 96),
(5, 'TAPSOBA', 'Claude', '12RTNB56789', '2022-10-12', 'OUAGA', 5, '2024-10-03', '2024-10-03', 96),
(6, 'TEST1', 'TEST1', '12RTNB56789', '2022-10-12', 'OUAGA', 5, '2024-10-03', '2024-10-03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `freight_announcement`
--

CREATE TABLE `freight_announcement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `origin` int(1) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `limit_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `weight` decimal(8,2) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `volume` decimal(8,2) DEFAULT '0.00',
  `price` int(255) DEFAULT '0',
  `type_price` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(255) DEFAULT '0',
  `status` int(255) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_shipper_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `freight_announcement`
--

INSERT INTO `freight_announcement` (`id`, `origin`, `destination`, `limit_date`, `weight`, `duration`, `volume`, `price`, `type_price`, `description`, `created_by`, `status`, `created_at`, `updated_at`, `fk_shipper_id`) VALUES
(1, 90, 2, '2024-03-29', 54.00, 0, 50.00, 42500, 0, 'LINTERS DE COTONS', 98, 0, '2024-02-09 13:52:13', '2024-03-15 09:35:33', 2),
(3, 10, 8, '2024-03-30', 54.00, 0, 50.00, 39000, 1, 'POISSON SURGELE', 98, 0, '2024-02-15 08:14:57', '2024-02-15 08:14:57', 2),
(4, 16, 91, '2024-03-30', 78.00, 0, NULL, 32500, 1, 'Pomme de terre', 98, 0, '2024-02-15 08:15:59', '2024-02-15 08:15:59', 2),
(5, 87, 17, '2024-03-30', 350.00, 0, NULL, 35000, 0, 'RIZ', 98, 0, '2024-03-14 08:33:22', '2024-03-14 08:33:22', 2),
(7, 1, 8, '2024-10-30', 54.00, 3, NULL, 50000, 0, 'POISSON SECS', 95, 0, '2024-10-01 11:49:06', '2024-10-09 10:52:10', 2),
(8, 1, 4, '2024-10-31', 54.00, 3, NULL, 50000, 1, 'POISSON SEC', 95, 0, '2024-10-01 11:49:54', '2024-10-09 10:55:24', 2),
(9, 4, 1, '2024-12-21', 500.00, 10, NULL, 40000, 1, 'POISSON FRAIS', 95, 0, '2024-12-05 10:12:00', '2024-12-05 10:12:00', 2),
(10, 1, 4, '2024-12-27', 54.00, 7, NULL, 50000, 1, 'Marchandises en vrac', 95, 0, '2024-12-10 15:54:19', '2024-12-10 15:54:19', 2);

-- --------------------------------------------------------

--
-- Structure de la table `freight_offer`
--

CREATE TABLE `freight_offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_transport_announcement_id` bigint(20) UNSIGNED NOT NULL,
  `fk_shipper_id` bigint(20) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `weight` double(8,2) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `freight_offer`
--

INSERT INTO `freight_offer` (`id`, `fk_transport_announcement_id`, `fk_shipper_id`, `price`, `weight`, `duration`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 50000, 54.00, 0, 'je prend tout', 0, 98, '2024-02-12 11:17:23', '2024-02-12 11:17:23'),
(2, 4, 2, 45000, 1000.00, 5, 'clenker', 0, 95, '2024-10-09 09:37:19', '2024-10-09 09:37:19'),
(3, 4, 2, 45000, 1000.00, 5, 'clenker', 0, 95, '2024-10-09 09:37:25', '2024-10-09 09:37:25'),
(4, 4, 2, 45000, 1000.00, 5, 'clenker', 0, 95, '2024-10-09 09:37:26', '2024-10-09 09:37:26'),
(5, 4, 2, 45000, 1000.00, 5, 'clenker', 0, 95, '2024-10-09 09:37:26', '2024-10-09 09:37:26'),
(6, 4, 2, 42500, 350.00, 3, 'ciment', 0, 95, '2024-10-09 09:38:17', '2024-10-09 09:38:17'),
(7, 7, 2, 750000, 500.00, 6, 'ANACADE', 1, 95, '2024-12-05 10:53:58', '2024-12-05 10:54:42');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `action`, `description`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ajout', 'Camions de transport ajoutés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-30 11:48:37', '2024-01-30'),
(2, 'Ajout', 'Camions de transport ajoutés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-30 12:01:00', '2024-01-30'),
(3, 'Modification', 'Camions de transport modifiés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-31 08:53:16', '2024-01-31'),
(4, 'Modification', 'Camions de transport modifiés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-31 08:54:05', '2024-01-31'),
(5, 'Ajout', 'Camions de transport ajoutés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-31 08:57:48', '2024-01-31'),
(6, 'Modification', 'Camions de transport modifiés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-01-31 08:58:11', '2024-01-31'),
(7, 'Ajout', 'Offre de transport ajoutée par BOLLORE TRANSPORT dont le prix est 42500 et la description est Marchandises en vrac', 'Claude ', 0, '2024-02-09 10:05:42', '2024-02-09'),
(8, 'Ajout', 'Offre de transport ajoutée par BOLLORE TRANSPORT dont le prix est 5000000 et la description est Marchandises en vrac', 'Claude ', 0, '2024-02-09 10:21:06', '2024-02-09'),
(9, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 42500 et la description est LINTERS DE COTON', 'Jean ', 0, '2024-02-09 13:52:13', '2024-02-09'),
(10, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est je prend tout', 'Jean ', 2, '2024-02-12 11:17:23', '2024-02-12'),
(11, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est tout serq fait', 'Jean ', 2, '2024-02-12 11:17:49', '2024-02-12'),
(12, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 575000 et la description est bien recu', 'Claude ', 3, '2024-02-12 11:18:46', '2024-02-12'),
(13, 'Ajout', 'Contrat de transport ajouté entre BOLLORE TRANSPORT et EKOF IMPORT EXPORT', 'Jean ', 0, '2024-02-12 11:27:11', '2024-02-12'),
(14, 'Ajout', 'Camions de transport ajoutés par BOLLORE TRANSPORT', 'Claude ', 3, '2024-02-12 13:06:27', '2024-02-12'),
(15, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac', 'Claude ', 0, '2024-02-14 21:45:38', '2024-02-14'),
(16, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac', 'Claude ', 0, '2024-02-14 21:49:47', '2024-02-14'),
(17, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 39000 et la description est FER', 'Jean ', 0, '2024-02-14 22:31:13', '2024-02-14'),
(18, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 39000 et la description FER', 'Jean ', 0, '2024-02-15 01:01:04', '2024-02-15'),
(19, 'Modification', 'Contrat de transport, ajout de camions par BOURSE VIRTUELLE DE FRET', 'Claude ', 3, '2024-02-15 01:03:46', '2024-02-15'),
(20, 'Modification', 'Contrat de transport, ajout de camions par BOURSE VIRTUELLE DE FRET', 'Claude ', 3, '2024-02-15 01:04:47', '2024-02-15'),
(21, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 39000 et la description est POISSON SURGELE', 'Jean ', 0, '2024-02-15 08:15:00', '2024-02-15'),
(22, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 32500 et la description est Pomme de terre', 'Jean ', 0, '2024-02-15 08:16:02', '2024-02-15'),
(23, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 35000 et la description est RIZ', 'Jean ', 0, '2024-03-14 08:33:28', '2024-03-14'),
(24, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 42500 et la description LINTERS DE COTONS', 'Jean ', 0, '2024-03-15 09:35:33', '2024-03-15'),
(25, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac', 'Claude ', 0, '2024-03-18 16:28:52', '2024-03-18'),
(26, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-18 16:29:19', '2024-03-18'),
(27, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-18 16:30:48', '2024-03-18'),
(28, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-18 16:32:58', '2024-03-18'),
(29, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-19 10:15:48', '2024-03-19'),
(30, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-19 10:19:30', '2024-03-19'),
(31, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-19 10:25:25', '2024-03-19'),
(32, 'Modification', 'Offre de transport mise à jour par BOURSE VIRTUELLE DE FRET dont le prix est 5000000 et la description Marchandises en vrac updated', 'Claude ', 0, '2024-03-19 10:25:42', '2024-03-19'),
(33, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 4500000 et la description est ANACARDE', 'Jean ', 2, '2024-03-20 08:33:26', '2024-03-20'),
(34, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 350000 et la description est riz', 'Jean ', 2, '2024-03-20 09:16:01', '2024-03-20'),
(35, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 600000 et la description est TEST', 'Jean ', 2, '2024-03-20 09:22:41', '2024-03-20'),
(36, 'Modification', 'Contrat de transport, ajout de camions par BOURSE VIRTUELLE DE FRET', 'Claude ', 3, '2024-03-26 09:19:22', '2024-03-26'),
(37, 'Ajout', 'Contrat de transport ajouté entre BOURSE VIRTUELLE DE FRET et EKOF IMPORT EXPORT', 'Jean ', 0, '2024-09-25 15:33:32', '2024-09-25'),
(38, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est RIZ', 'Claude ', 0, '2024-10-01 09:26:47', '2024-10-01'),
(39, 'Ajout', 'Offre de transport ajoutée par STANE TRANSIT dont le prix est 50000 et la description est CONVENTIONNEL', 'DABONE ', 0, '2024-10-01 09:32:40', '2024-10-01'),
(40, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 52500 et la description est RAS', 'DABONE ', 5, '2024-10-01 09:33:34', '2024-10-01'),
(41, 'Ajout', 'Camions de transport ajoutés par STANE TRANSIT', 'DABONE ', 5, '2024-10-01 10:14:32', '2024-10-01'),
(42, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est POISSON SEC', 'Claude ', 0, '2024-10-01 11:49:11', '2024-10-01'),
(43, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est POISSON SEC', 'Claude ', 0, '2024-10-01 11:49:57', '2024-10-01'),
(44, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 52500 et la description est RAS', 'DABONE ', 5, '2024-10-01 11:53:17', '2024-10-01'),
(45, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'Claude ', 0, '2024-10-01 12:42:22', '2024-10-01'),
(46, 'Ajout', 'Camions de transport ajoutés par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 10:12:39', '2024-10-03'),
(47, 'Ajout', 'Camions de transport ajoutés par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 10:38:15', '2024-10-03'),
(48, 'Ajout', 'Camions de transport ajoutés par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 10:38:48', '2024-10-03'),
(49, 'Modification', 'Contrat de transport, ajout de camions par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 11:39:21', '2024-10-03'),
(50, 'Modification', 'Contrat de transport, ajout de camions par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 11:56:48', '2024-10-03'),
(51, 'Modification', 'Contrat de transport, ajout de camions par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 13:32:42', '2024-10-03'),
(52, 'Modification', 'Contrat de transport, ajout de camions par STANE TRANSIT', 'DABONE ', 5, '2024-10-03 13:36:15', '2024-10-03'),
(53, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 52500 et la description est CAMION NEUF', 'DABONE ', 5, '2024-10-09 09:01:55', '2024-10-09'),
(54, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'Claude ', 0, '2024-10-09 09:02:47', '2024-10-09'),
(55, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'Claude ', 0, '2024-10-09 09:12:53', '2024-10-09'),
(56, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 45000 et la description est clenker', 'Claude ', 2, '2024-10-09 09:37:19', '2024-10-09'),
(57, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 45000 et la description est clenker', 'Claude ', 2, '2024-10-09 09:37:25', '2024-10-09'),
(58, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 45000 et la description est clenker', 'Claude ', 2, '2024-10-09 09:37:26', '2024-10-09'),
(59, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 45000 et la description est clenker', 'Claude ', 2, '2024-10-09 09:37:26', '2024-10-09'),
(60, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 42500 et la description est ciment', 'Claude ', 2, '2024-10-09 09:38:17', '2024-10-09'),
(61, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 50000 et la description POISSON SEC', 'thami ', 0, '2024-10-09 10:31:16', '2024-10-09'),
(62, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 50000 et la description POISSON SECS', 'thami ', 0, '2024-10-09 10:31:30', '2024-10-09'),
(63, 'Ajout', 'Offre de transport ajoutée par STANE TRANSIT dont le prix est  et la description est DIVERS', 'DABONE ', 0, '2024-10-09 10:43:39', '2024-10-09'),
(64, 'Modification', 'Offre de transport mise à jour par STANE TRANSIT dont le prix est 50000 et la description CONVENTIONNEL', 'DABONE ', 0, '2024-10-09 10:51:53', '2024-10-09'),
(65, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 50000 et la description POISSON SECS', 'thami ', 0, '2024-10-09 10:52:10', '2024-10-09'),
(66, 'Modification', 'Offre de fret mise à jour par EKOF IMPORT EXPORT dont le prix est 50000 et la description POISSON SEC', 'thami ', 0, '2024-10-09 10:55:24', '2024-10-09'),
(67, 'Modification', 'Offre de transport mise à jour par STANE TRANSIT dont le prix est  et la description DIVERS', 'DABONE ', 0, '2024-10-09 10:56:02', '2024-10-09'),
(68, 'Ajout', 'Offre de transport ajoutée par STANE TRANSIT dont le prix est  et la description est CONTENEUR', 'PROSPER ', 0, '2024-12-05 10:11:23', '2024-12-05'),
(69, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 40000 et la description est POISSON FRAIS', 'thami ', 0, '2024-12-05 10:12:03', '2024-12-05'),
(70, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 41000 et la description est Je peux gérer la marchandise', 'PROSPER ', 5, '2024-12-05 10:12:45', '2024-12-05'),
(71, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'thami ', 0, '2024-12-05 10:14:49', '2024-12-05'),
(72, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'thami ', 0, '2024-12-05 10:20:30', '2024-12-05'),
(73, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'thami ', 0, '2024-12-05 10:21:31', '2024-12-05'),
(74, 'Ajout', 'Proposition d\'offre de transport ajoutée par EKOF IMPORT EXPORT dont le prix est 40500 et la description est ras', 'PROSPER ', 5, '2024-12-05 10:32:56', '2024-12-05'),
(75, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'thami ', 0, '2024-12-05 10:34:16', '2024-12-05'),
(76, 'Ajout', 'Offre de transport ajoutée par STANE TRANSIT dont le prix est 850000 et la description est CONTENEUR COMPATIBLE', 'PROSPER ', 0, '2024-12-05 10:52:50', '2024-12-05'),
(77, 'Ajout', 'Proposition d\'offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 750000 et la description est ANACADE', 'thami ', 2, '2024-12-05 10:53:58', '2024-12-05'),
(78, 'Ajout', 'Contrat de transport ajouté entre STANE TRANSIT et EKOF IMPORT EXPORT', 'PROSPER ', 0, '2024-12-05 10:54:42', '2024-12-05'),
(79, 'Modification', 'Offre de transport mise à jour par STANE TRANSIT dont le prix est 850000 et la description CONTENEUR COMPATIBLE', 'PROSPER ', 0, '2024-12-05 11:01:48', '2024-12-05'),
(80, 'Ajout', 'Offre de fret ajoutée par EKOF IMPORT EXPORT dont le prix est 50000 et la description est Marchandises en vrac', 'thami ', 0, '2024-12-10 15:54:25', '2024-12-10'),
(81, 'Ajout', 'Offre de transport ajoutée par STANE TRANSIT dont le prix est 908888 et la description est RIZ', 'PROSPER ', 0, '2024-12-10 16:15:16', '2024-12-10'),
(82, 'Modification', 'Offre de transport mise à jour par STANE TRANSIT dont le prix est 850000 et la description CONTENEUR COMPATIBLE', 'PROSPER ', 0, '2024-12-10 16:15:36', '2024-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `libelle`, `updated_at`, `created_at`) VALUES
(1, 'COTE D\'IVOIRE', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(2, 'TOGO', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(3, 'BENIN', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(4, 'GHANA', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(5, 'BURKINA-FASO', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(6, 'NIGERIA', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(7, 'GAMBIE', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(8, 'SENEGAL', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(9, 'GUINEE', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(10, 'MALI', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(11, 'NIGER', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(12, 'CAP-VERT', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(13, 'GUINEE- BISSAU', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(14, 'LIBERIA', '2024-09-26 10:42:14', '2024-09-26 10:42:14'),
(15, 'SIERRA LEONE', '2024-09-26 10:42:14', '2024-09-26 10:42:14');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Structure de la table `shipper`
--

CREATE TABLE `shipper` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rccm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut_juridique` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shipper`
--

INSERT INTO `shipper` (`id`, `company_name`, `address`, `phone`, `city`, `email`, `ifu`, `rccm`, `statut_juridique`, `name`, `signature`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'EdoGroup', 'Avenue des arts', '0987654', '70', 'arduino1024@gmail.com', '0', '0', 2, 'Jean', NULL, 0, '2024-01-30 08:37:17', '2024-10-17 13:46:16'),
(2, 'EKOF IMPORT EXPORT', 'Avenue des arts', '0987654', '9', 'dolidev2.0@gmail.com', 'dolidev2.0@gmail.com', 'dolidev2.0@gmail.com', 1, 'Jean', '1734078793.png', 0, '2024-01-30 14:48:54', '2024-12-13 08:33:13'),
(3, 'STANE SHOP', 'OUAGA', '09876523', '8', 'edofigma1024@gmail.com', 'edofigma1024@gmail.com', 'edofigma1024@gmail.com', 2, NULL, NULL, 0, '2024-02-12 10:26:58', '2024-10-17 14:48:38'),
(4, 'ABTest', 'BOBO', '234567898765', '80', 'ab@cbc.bf', 'ab@cbc.bf', 'ab@cbc.bf', 1, NULL, NULL, 94, '2024-09-25 15:01:44', '2024-09-25 15:13:53');

-- --------------------------------------------------------

--
-- Structure de la table `transport_announcement`
--

CREATE TABLE `transport_announcement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `origin` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `duration` int(11) DEFAULT '0',
  `type_price` int(11) DEFAULT NULL,
  `limit_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(255) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_carrier_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transport_announcement`
--

INSERT INTO `transport_announcement` (`id`, `origin`, `destination`, `price`, `duration`, `type_price`, `limit_date`, `description`, `created_by`, `status`, `created_at`, `updated_at`, `fk_carrier_id`) VALUES
(3, 1, 18, 5000000, 0, 1, '2024-09-24', 'Marchandises en vrac updated', 97, 0, '2024-02-09 10:17:29', '2024-03-19 10:25:42', 3),
(4, 13, 1, 50000, 0, 0, '2024-10-26', 'CONVENTIONNEL', 96, 0, '2024-10-01 09:32:36', '2024-10-09 10:51:53', 5),
(5, 1, 2, NULL, 4, 1, '2024-11-09', 'DIVERS', 96, 0, '2024-10-09 10:43:36', '2024-10-09 10:56:02', 5),
(6, 1, 2, NULL, 6, 1, '2024-12-25', 'CONTENEUR', 96, 0, '2024-12-05 10:11:20', '2024-12-05 10:11:20', 5),
(7, 1, 4, 850000, 4, 1, '2024-12-21', 'CONTENEUR COMPATIBLE', 96, 0, '2024-12-05 10:52:47', '2024-12-10 16:15:36', 5),
(8, 3, 10, 908888, 9, 1, '2024-12-27', 'RIZ', 96, 0, '2024-12-10 16:15:16', '2024-12-10 16:15:16', 5);

-- --------------------------------------------------------

--
-- Structure de la table `transport_car`
--

CREATE TABLE `transport_car` (
  `id` int(11) NOT NULL,
  `fk_transport` int(11) DEFAULT NULL,
  `fk_car` int(11) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transport_car`
--

INSERT INTO `transport_car` (`id`, `fk_transport`, `fk_car`, `qte`, `created_at`, `updated_at`) VALUES
(17, 3, 3, 5, '2024-03-19 10:25:42', '2024-03-19 10:25:42'),
(18, 3, 4, 1, '2024-03-19 10:25:42', '2024-03-19 10:25:42'),
(19, 3, 3, 1, '2024-03-19 10:25:42', '2024-03-19 10:25:42'),
(20, 4, 1, 2, '2024-10-09 10:51:53', '2024-10-09 10:51:53'),
(21, 4, 3, 4, '2024-10-09 10:51:53', '2024-10-09 10:51:53'),
(22, 5, 6, 1, '2024-10-09 10:56:02', '2024-10-09 10:56:02'),
(26, 7, 5, 4, '2024-12-10 16:15:36', '2024-12-10 16:15:36');

-- --------------------------------------------------------

--
-- Structure de la table `transport_offer`
--

CREATE TABLE `transport_offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `weight` double(8,2) DEFAULT '0.00',
  `duration` int(11) NOT NULL DEFAULT '0',
  `description` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(255) NOT NULL DEFAULT '0',
  `created_by` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_freight_announcement_id` bigint(20) UNSIGNED NOT NULL,
  `fk_carrier_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transport_offer`
--

INSERT INTO `transport_offer` (`id`, `price`, `weight`, `duration`, `description`, `status`, `created_by`, `created_at`, `updated_at`, `fk_freight_announcement_id`, `fk_carrier_id`) VALUES
(1, 575000, NULL, 0, 'bien recu', 1, 97, '2024-02-12 11:18:46', '2024-09-25 15:33:32', 1, 3),
(3, 52500, NULL, 5, 'RAS', 1, 96, '2024-10-01 11:53:17', '2024-10-03 08:52:20', 7, 5),
(5, 41000, 40.00, 7, 'Je peux gérer la marchandise', 1, 96, '2024-12-05 10:12:45', '2024-12-05 10:21:31', 9, 5),
(6, 40500, 45.00, 7, 'ras', 1, 96, '2024-12-05 10:32:56', '2024-12-05 10:34:16', 9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `type_car`
--

CREATE TABLE `type_car` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_car`
--

INSERT INTO `type_car` (`id`, `libelle`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Tracteur', NULL, NULL, 0),
(2, 'Berline', NULL, NULL, 0),
(3, 'Break', NULL, NULL, 0),
(4, 'Cabriolet', NULL, NULL, 0),
(5, 'Coupe', NULL, NULL, 0),
(6, 'Ludospace', NULL, NULL, 0),
(7, 'Monospace', NULL, NULL, 0),
(8, 'Pick-up', NULL, NULL, 0),
(9, 'Utilitaire porteur', NULL, NULL, 0),
(10, 'Berline', NULL, NULL, 0),
(11, 'Cabriolet', NULL, NULL, 0),
(12, 'Coupe', NULL, NULL, 0),
(13, 'Ludospace', NULL, NULL, 0),
(14, 'Monospace', NULL, NULL, 0),
(15, 'Pick-up', NULL, NULL, 0),
(16, 'Utilitaire porteur', NULL, NULL, 0),
(17, 'Camion à 2 essieux', NULL, NULL, 0),
(18, 'Camion à 3 essieux', NULL, NULL, 0),
(19, 'Semi Remorque à 3 essieux', NULL, NULL, 0),
(20, 'Semi Remorque à 4 essieux', NULL, NULL, 0),
(21, 'Semi Remorque à 5 essieux', NULL, NULL, 0),
(22, 'Semi Remorque à 6 essieux', NULL, NULL, 0),
(23, 'Camion à 4 essieux', NULL, NULL, 0),
(24, 'Camion Benne', NULL, NULL, 0),
(25, 'Camion Frigo', NULL, NULL, 0),
(26, 'Camion Ampli Roll', NULL, NULL, 0),
(27, 'Camion Plateau', NULL, NULL, 0),
(28, 'Camion Fourgon', NULL, NULL, 0),
(29, 'Camion Porte Char', NULL, NULL, 0),
(30, 'Bus', NULL, NULL, 0),
(31, 'Fourgonnette', NULL, NULL, 0),
(32, 'Ensemble articulé/carrosserie rigide', NULL, NULL, 0),
(33, 'Ensemble articulé/porte char', NULL, NULL, 0),
(34, 'Ensemble articulé/frigorifique', NULL, NULL, 0),
(35, 'Camion Citerne', NULL, NULL, 0),
(36, 'Tracteur', NULL, NULL, 0),
(37, 'BUS', NULL, NULL, 0),
(38, 'Camion Citerne', NULL, NULL, 0),
(39, 'BREAK', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `fk_carrier_id` int(255) NOT NULL DEFAULT '0',
  `fk_shipper_id` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified` int(11) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `user_phone`, `email`, `code`, `username`, `password`, `role`, `status`, `fk_carrier_id`, `fk_shipper_id`, `created_at`, `updated_at`, `email_verified`, `remember_token`) VALUES
(94, 'admin', 'admin', '098765', 'admin@cbc.bf', '7883', 'admin', '$2y$10$homnGztPnbu9.AA8TUvHiOJNyyA.CfvXGnCOXZZ8kwakkTJDcYH4.', 'admin', 3, 0, 0, '2024-01-18 13:45:17', '2024-01-18 13:45:36', 0, NULL),
(95, 'thami', 'Claude', '4567890', 'arduino1024@gmail.com', '9112', NULL, '$2y$10$9BoDI6Gvr486arF/H8nyNemSZ9SpYlHKEEYH.6IHAXnWBVLrZd1ou', 'chargeur', 3, 0, 2, '2024-09-30 13:54:35', '2024-12-05 11:26:42', 0, NULL),
(96, 'PROSPER', 'DABONE', '9876543', 'dolidev2.0@gmail.com', '145', NULL, '$2y$10$ZEWEWPMjNRq88Com01D30.KUevxhqNKjeUy9CUB730g/daewxobl6', 'transporteur', 2, 5, 0, '2024-10-01 09:30:14', '2024-10-01 09:31:24', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `fk_pays` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `libelle`, `fk_pays`, `updated_at`, `created_at`) VALUES
(1, 'BOBO-DIOULASSO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(2, 'DAKOLA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(3, 'FO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(4, 'OUAGADOUGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(5, 'HAMELE', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(6, 'TEKORADI', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(7, 'KAMPTI', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(8, 'NIANGOLOKO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(9, 'FARAMANA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(10, 'COTONOU', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(11, 'PORT NOVO', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(12, 'SEME TERMINAL', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(13, 'ABIDJAN', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(14, 'YAMOUSSOUKRO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(15, 'ASSINIE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(16, 'BOUBELE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(17, 'BONDOUKOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(18, 'BOUAKE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(19, 'DALOA', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(20, 'FRESCO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(21, 'GRAND BASAM', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(22, 'GRAND LAHOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(23, 'KORHOGO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(24, 'JABOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(25, 'JACQUIVILLE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(26, 'ODIENNE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(27, 'KOSAO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(28, 'MAN', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(29, 'ABENGOUROU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(30, 'PORT BOUET', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(31, 'SAN PEDRO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(32, 'TABOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(33, 'SASSANDRA', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(34, 'ACCRA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(35, 'ADA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(36, 'AURA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(37, 'AXIM', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(38, 'CAPE COAST', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(39, 'KETA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(40, 'KUMASI', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(41, 'KPANDU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(42, 'KOTOKA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(43, 'SUNYANI', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(44, 'SEKONDI', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(45, 'SHAMA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(46, 'SALTPOND', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(47, 'TEMA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(48, 'TAKORADI', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(49, 'WINNEBA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(50, 'BANJUL', 22, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(51, 'SEREKUNDA', 22, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(52, 'BENTY', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(53, 'CONAKRY', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(54, 'PORT KAMSAR', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(55, 'ANNOBON ISLAND', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(56, 'BATA', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(57, 'BUTUKU-LUBA', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(58, 'COGO', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(59, 'FERNANDO PO ISLND', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(60, 'LUBA', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(61, 'MBINI', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(62, 'SANTA ISABEL', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(63, 'MALABO', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(64, 'BOLAMA', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(65, 'CACHEU', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(66, 'BISSAU', 77, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(67, 'CAPE MOUNT', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(68, 'CAPE PALMAS', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(69, 'FIMIBO', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(70, 'FOYA', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(71, 'GRAND BASSA', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(72, 'GRAND CESS', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(73, 'GREENVILLE', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(74, 'HARPER', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(75, 'HARBEL', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(76, 'LOWER BUCHANAN', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(77, 'MARSHALL', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(78, 'MONROVIA', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(79, 'NIMBA', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(80, 'ROBERTSPORT', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(81, 'RIVERCESS', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(82, 'SARIOE BAY', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(83, 'SASSTOWN', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(84, 'SINOE', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(85, 'TCHIEN', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(86, 'TRADE TOWN', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(87, 'BUCHANAN', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(88, 'VOINJAMA', 155, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(89, 'BAMAKO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(90, 'GAO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(91, 'KOUTIALA', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(92, 'KAYES', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(93, 'MOPTI', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(94, 'NIORO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(95, 'NARA', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(96, 'AGADES', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(97, 'ARLIT', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(98, 'TAHOUA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(99, 'ZINDER', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(100, 'ABONNEMA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(101, 'ADO', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(102, 'ANTAN TERMINAL', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(103, 'APAPA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(104, 'BADAGRI', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(105, 'BENIN CITY', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(106, 'BONNY', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(107, 'BRASS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(108, 'BURUTU', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(109, 'CALABAR', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(110, 'DENEMA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(111, 'EKET', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(112, 'ENUGU', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(113, 'ESCRAVOS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(114, 'FORCADOS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(115, 'GREEK PORT', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(116, 'IBADAN', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(117, 'JOS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(118, 'KADUNA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(119, 'KANO', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(120, 'KOKO', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(121, 'KULA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(122, 'LAGOS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(123, 'MAIDUGURI', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(124, 'MOUDI TERMINAL', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(125, 'QUE OBOE TERMINAL', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(126, 'OKRIKA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(127, 'ONNE', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(128, 'ORON', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(129, 'PENNINGTON', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(130, 'PORT HARCOURT', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(131, 'RIO DEL REY', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(132, 'SOKOTO', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(133, 'SAPELE', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(134, 'TIKO', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(135, 'TINCAN/LAGOS', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(136, 'WARRI', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(137, 'YOLA', 21, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(138, 'BAKEL', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(139, 'CAP SKIRRING', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(140, 'DAKAR', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(141, 'FOUNDIOUGNE', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(142, 'KEDOUGOU', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(143, 'KAOLACK', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(144, 'LYNDIANE', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(145, 'MATAM', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(146, 'M\'BAO TERMINAL', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(147, 'RICHARD TOLL', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(148, 'SIMENTI', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(149, 'TAMBACOUNDA', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(150, 'ST LOUIS', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(151, 'ZIGUINCHOR', 26, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(152, 'ANECHO', 2, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(153, 'KPEME', 2, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(154, 'LOME', 2, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(155, 'FERKESSEDOUGOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(156, 'CINKANSE-TOGO', 2, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(157, 'NATITINGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(158, 'KUMASSI', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(159, 'PAGA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(160, 'NADIAGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(161, 'BITTOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(162, 'BOBO-DIOULASSO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(163, 'POOLE', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(164, 'OUESSA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(165, 'HOUNDE', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(166, 'BANFORA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(167, 'KOUDOUGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(168, 'KADIOGO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(169, 'PARAKOU', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(170, 'OUAHIGOUYA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(171, 'BOROMO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(172, 'CINKANSSE', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(173, 'KOLOKO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(174, 'GAOUA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(175, 'NIAMEY', 81, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(176, 'MARADI', 81, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(177, 'SIKASSO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(178, 'KULUGUGU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(179, 'SAVALOU', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(180, 'PORGA', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(181, 'FADA N\'GOURMA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(182, 'KANTCHARI', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(183, 'NOBERE', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(184, 'KOMBISSIRI', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(185, 'TIOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(186, 'TENKODOGO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(187, 'KOUPELA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(188, 'BAKOU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(189, 'KOULGOUGOU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(190, 'KORO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(191, 'THIOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(192, 'POUYTENGA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(193, 'BOUGOUNI', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(194, 'HERMAKONO', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(195, 'SEGOU', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(196, 'KOURY', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(197, 'OUANGOLODOUGOU', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(198, 'ABOISSO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(199, 'NOE', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(200, 'DIMBOKRO', 1, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(201, 'DEDOUGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(202, 'DIEBOUGOU', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(203, 'KAYA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(204, 'N\'DOROLA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(205, 'BAWKU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(206, 'DIBOLI', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(207, 'TORODI', 81, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(208, 'NOUNA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(209, 'DJIBASSO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(210, 'DJIBASSO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(211, 'BENENA', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(212, 'OUESSA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(213, 'PAMA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(214, 'SOLENZO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(215, 'OUELA', 80, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(216, 'SEYTENGA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(217, 'DJOUGOU', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(218, 'SONAHOULOU', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(219, 'KONDJI', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(220, 'ILLA', 3, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(221, 'KASOA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(222, 'BOLGATANGA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(223, 'BAKIKU', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(224, 'ZENDER', 81, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(225, 'MAKOLONI', 81, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(226, 'TERRA', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(227, 'TABLIGO', 2, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(228, 'TCHEIMA', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(229, 'NAMO', 4, '2024-09-26 11:06:09', '2024-09-26 11:06:09'),
(230, 'ZECCO', 6, '2024-09-26 11:06:09', '2024-09-26 11:06:09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brand_car`
--
ALTER TABLE `brand_car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contract_details`
--
ALTER TABLE `contract_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contract_transport`
--
ALTER TABLE `contract_transport`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `freight_announcement`
--
ALTER TABLE `freight_announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freight_announcement_fk_shipper_id_foreign` (`fk_shipper_id`);

--
-- Index pour la table `freight_offer`
--
ALTER TABLE `freight_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freight_offer_fk_transport_announcement_id_foreign` (`fk_transport_announcement_id`),
  ADD KEY `freight_offer_fk_shipper_id_foreign` (`fk_shipper_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transport_announcement`
--
ALTER TABLE `transport_announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_announcement_fk_carrier_id_foreign` (`fk_carrier_id`);

--
-- Index pour la table `transport_car`
--
ALTER TABLE `transport_car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transport_offer`
--
ALTER TABLE `transport_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_offer_fk_freight_announcement_id_foreign` (`fk_freight_announcement_id`),
  ADD KEY `transport_offer_fk_carrier_id_foreign` (`fk_carrier_id`);

--
-- Index pour la table `type_car`
--
ALTER TABLE `type_car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brand_car`
--
ALTER TABLE `brand_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contract_details`
--
ALTER TABLE `contract_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `contract_transport`
--
ALTER TABLE `contract_transport`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `freight_announcement`
--
ALTER TABLE `freight_announcement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `freight_offer`
--
ALTER TABLE `freight_offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `transport_announcement`
--
ALTER TABLE `transport_announcement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `transport_car`
--
ALTER TABLE `transport_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `transport_offer`
--
ALTER TABLE `transport_offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_car`
--
ALTER TABLE `type_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `freight_announcement`
--
ALTER TABLE `freight_announcement`
  ADD CONSTRAINT `freight_announcement_fk_shipper_id_foreign` FOREIGN KEY (`fk_shipper_id`) REFERENCES `shipper` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `freight_offer`
--
ALTER TABLE `freight_offer`
  ADD CONSTRAINT `freight_offer_fk_shipper_id_foreign` FOREIGN KEY (`fk_shipper_id`) REFERENCES `shipper` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `freight_offer_fk_transport_announcement_id_foreign` FOREIGN KEY (`fk_transport_announcement_id`) REFERENCES `transport_announcement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transport_announcement`
--
ALTER TABLE `transport_announcement`
  ADD CONSTRAINT `transport_announcement_fk_carrier_id_foreign` FOREIGN KEY (`fk_carrier_id`) REFERENCES `carrier` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transport_offer`
--
ALTER TABLE `transport_offer`
  ADD CONSTRAINT `transport_offer_fk_carrier_id_foreign` FOREIGN KEY (`fk_carrier_id`) REFERENCES `carrier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transport_offer_fk_freight_announcement_id_foreign` FOREIGN KEY (`fk_freight_announcement_id`) REFERENCES `freight_announcement` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

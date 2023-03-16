-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 15 mars 2023 à 10:33
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonement`
--

DROP TABLE IF EXISTS `abonement`;
CREATE TABLE IF NOT EXISTS `abonement` (
  `id_abonnement` varchar(50) NOT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_abonnement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` varchar(50) NOT NULL,
  `id_receveur` varchar(50) DEFAULT NULL,
  `date_mes` datetime DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `id_envoye` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` varchar(50) NOT NULL,
  `message` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `likes` varchar(50) DEFAULT NULL,
  `commantaires` varchar(50) DEFAULT NULL,
  `nomcrea` varchar(50) DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `publique` binary(50) DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `adressemail` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `roll` varchar(50) DEFAULT NULL,
  `promo` varchar(50) DEFAULT NULL,
  `datedenaissance` date DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
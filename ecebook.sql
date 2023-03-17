-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 mars 2023 à 09:24
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

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
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adressemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `roll` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `datedenaissance` date DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`) VALUES
(3, 'abdulhalim', 'sami', 'https://www.fine-s.fr/9959/test.jpg', 'Paris', 'sami.abdulhalim@edu.ece.fr', '$2y$10$uY9kbIEtrPZbPrpeNjFyleAa93rJawd5oo1ZeBtAEvzQu8leykjE2', 'Etudiant', 'ING1', '2000-01-30', 'sqdqsdqsdqsdqsdd', 'aboalsim114'),
(4, 'test', 'tesst', 'https://www.fine-s.fr/9959/test.jpg', 'Paris', 'test@edu.ece.fr', '$2y$10$bsL/LUBeh5OoUK4KW8WbBeHpY8ErMzRWDzOciNojEpMxKOfI9bIsq', 'Enseignant', 'ING4', '2000-01-30', 'dsqdqs', 'kilwa-*75'),
(5, 'tegsdgdfg', 'gdfgdfgdfgdfg', 'https://www.fine-s.fr/9959/test.jpg', 'Paris', 'jfdsfj@edu.ece.fr', '$2y$10$Rs083YWNQIqskgpaqnQlvuBplQEQazD1j65GgsrmlvKIi7W5EI9cm', 'Etudiant', 'ING1', '2000-01-30', 'dqsdqsdsqdqsdqsdqsd', 'ragico1281');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

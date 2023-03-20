-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 mars 2023 à 20:18
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
  `id_abonnement` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_abonnement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_like`),
  UNIQUE KEY `unique_like` (`id_post`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
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
  `id_post` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `commantaires` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nomcrea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `publique` binary(1) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `message`, `image`, `commantaires`, `nomcrea`, `titre`, `id_user`, `pseudo`, `publique`, `date`) VALUES
(6, 'je test', NULL, NULL, NULL, NULL, 90, 'test', NULL, NULL),
(9, 'sami', NULL, NULL, NULL, NULL, 92, 'abdulhalim', NULL, NULL),
(10, 'fgswtgs', NULL, NULL, NULL, 'eqdgbs', 93, 'Jerbi', NULL, NULL),
(11, 'dhgndfh', NULL, NULL, NULL, 'jghuhzr', 93, 'Jerbi', NULL, NULL),
(12, 'fgdghdf', NULL, NULL, NULL, 'fgsxghbgv', 93, 'Jerbi', NULL, NULL),
(13, 'srfhegdfgsf', NULL, NULL, NULL, 'rfyghesr', 93, 'Jerbi', NULL, NULL),
(14, 'hfgdxhxd', NULL, NULL, NULL, 'hgfedx', 93, 'Jerbi', NULL, '2023-03-20 13:15:29'),
(15, 'etyhgdfyghdt', NULL, NULL, NULL, 'thdrfgchtdg', 93, 'Jerbi', NULL, '2023-03-20 13:15:38'),
(16, 'dghf', NULL, NULL, NULL, 'ffgd', 93, 'Jerbi', NULL, '2023-03-20 13:15:51'),
(17, 'gfddgdf', NULL, NULL, NULL, 'test', 92, 'abdulhalim', NULL, '2023-03-20 16:51:20'),
(18, '2 eme post description', NULL, NULL, NULL, '2 eme post titre', 92, 'abdulhalim', NULL, '2023-03-20 16:51:38'),
(19, 'fdsfsdf', NULL, NULL, NULL, 'fds', 92, 'abdulhalim', NULL, '2023-03-20 19:10:39');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adressemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `roll` enum('etudiant','professeur','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'etudiant',
  `promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `datedenaissance` date DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `code_confirmation` varchar(255) NOT NULL,
  `confirmer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`, `code_confirmation`, `confirmer`) VALUES
(90, 'test', 'testt', 'Acer_Wallpaper_01_5000x2814.jpg', 'Paris', 'test.pro@edu.ece.fr', '$2y$10$5XZKylRdm602RJw5y4GybeNKG7tjZndfKt02HB3X6LB1e4J.Muqp6', 'etudiant', '', '2023-03-16', 'dsqdqsqsdqsdqsdqsdqsdqs', 'kilwa-*75', '6416560e08ca1', 1),
(92, 'abdulhalim', 'sami', 'sami.jpg', 'Paris', 'sami.abdulhalim@edu.ece.fr', '$2y$10$fEqfMsIC9GmtIuZvLw.H4..P1d.5XwVin2SnWt98NlTb9tH8/h8O2', 'etudiant', '', '2023-03-22', 'je suis un développeur full stack ', 'aboalsim114', '5e0249a51a910f64a49b83f4012146fd', 1),
(93, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Cannes', 'rayane.jerbi@edu.ece.fr', '$2y$10$5kSvYS3AJn3MIAmDnszTMO7s1HCXqwTSfDb.f1TGkUaykzZtvHgFu', 'etudiant', '', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '1cfb4fbe48a980c2374020df6a547064', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `id_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

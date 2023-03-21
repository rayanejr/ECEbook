-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 21 mars 2023 à 11:45
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
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id_abonnement` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  PRIMARY KEY (`id_abonnement`),
  UNIQUE KEY `uc_Abonnement` (`user1_id`,`user2_id`),
  KEY `user1_id` (`user1_id`),
  KEY `user2_id` (`user2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `commentaire_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
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
  UNIQUE KEY `unique_like` (`id_post`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `expediteur_id` int NOT NULL,
  `destinataire_id` int NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`),
  KEY `fk_expediteur` (`expediteur_id`),
  KEY `fk_destinataire` (`destinataire_id`)
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
  `nomcrea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `publique` binary(1) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `message`, `image`, `nomcrea`, `titre`, `id_user`, `pseudo`, `publique`, `date`) VALUES
(6, 'je test', NULL, NULL, NULL, 90, 'test', NULL, NULL),
(9, 'sami', NULL, NULL, NULL, 92, 'abdulhalim', NULL, NULL),
(10, 'fgswtgs', NULL, NULL, 'eqdgbs', 93, 'Jerbi', NULL, NULL),
(11, 'dhgndfh', NULL, NULL, 'jghuhzr', 93, 'Jerbi', NULL, NULL),
(12, 'fgdghdf', NULL, NULL, 'fgsxghbgv', 93, 'Jerbi', NULL, NULL),
(13, 'srfhegdfgsf', NULL, NULL, 'rfyghesr', 93, 'Jerbi', NULL, NULL),
(14, 'hfgdxhxd', NULL, NULL, 'hgfedx', 93, 'Jerbi', NULL, '2023-03-20 13:15:29'),
(15, 'etyhgdfyghdt', NULL, NULL, 'thdrfgchtdg', 93, 'Jerbi', NULL, '2023-03-20 13:15:38'),
(16, 'dghf', NULL, NULL, 'ffgd', 93, 'Jerbi', NULL, '2023-03-20 13:15:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`, `code_confirmation`, `confirmer`) VALUES
(90, 'test', 'testt', 'Acer_Wallpaper_01_5000x2814.jpg', 'Paris', 'test.pro@edu.ece.fr', '$2y$10$5XZKylRdm602RJw5y4GybeNKG7tjZndfKt02HB3X6LB1e4J.Muqp6', 'etudiant', '', '2023-03-16', 'dsqdqsqsdqsdqsdqsdqsdqs', 'kilwa-*75', '6416560e08ca1', 1),
(92, 'abdulhalim', 'sami', 'sami.jpg', 'Paris', 'sami.abdulhalim@edu.ece.fr', '$2y$10$2uaLj8XH.F/wv3W2oZuuNOhZ5Fpva2Q689WCxriyK22pWsTno7FIW', 'etudiant', '', '2023-03-22', 'je suis un développeur full stack ', 'aboalsim114', '641679f04f224', 1),
(93, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Cannes', 'rayane.jerbi@edu.ece.fr', '$2y$10$5kSvYS3AJn3MIAmDnszTMO7s1HCXqwTSfDb.f1TGkUaykzZtvHgFu', 'etudiant', '', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '1cfb4fbe48a980c2374020df6a547064', 1),
(96, 'chatel', 'andreas', 'bonk.jpg', 'paris', 'andreas.chatel@edu.ece.fr', '$2y$10$AM6bU.DNzb8jCEl7PiZRheHOtSNd0x1oJ/j4IBXWTkI.fNKDfDL1e', 'etudiant', '', '2003-05-20', 'test', 'andreas', '6419973ad8d96', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

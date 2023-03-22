-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 mars 2023 à 16:46
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id_abonnement`, `user1_id`, `user2_id`) VALUES
(15, 106, 92);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire`),
  KEY `fk_commentaires_posts` (`id_post`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `contenu`, `id_post`, `id_user`, `time_stamp`) VALUES
(1, 'dsfgdsfg', 9, 106, '2023-03-22 16:44:32');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `id_like` int NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_like`),
  UNIQUE KEY `unique_like` (`id_post`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_post`, `id_user`, `id_like`, `type`) VALUES
(10, 93, 17, 0),
(6, 90, 22, 1);

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
  `publique` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `message`, `image`, `nomcrea`, `titre`, `id_user`, `pseudo`, `publique`, `date`) VALUES
(6, 'je test', NULL, NULL, NULL, 90, 'test', 0, '2023-03-21 22:48:55'),
(10, 'fgswtgs', NULL, NULL, 'eqdgbs', 93, 'Jerbi', 0, '2023-03-21 22:48:55'),
(31, 'premier post publique', NULL, NULL, 'sdkfjklm', 106, 'test', 1, '2023-03-22 09:34:22'),
(32, '', NULL, NULL, 'sdfqsdfsqdf', 106, 'test', 1, '2023-03-22 11:52:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`, `code_confirmation`, `confirmer`) VALUES
(90, 'test', 'testt', 'Acer_Wallpaper_01_5000x2814.jpg', 'Paris', 'test.pro@edu.ece.fr', '$2y$10$5XZKylRdm602RJw5y4GybeNKG7tjZndfKt02HB3X6LB1e4J.Muqp6', 'etudiant', '', '2023-03-16', 'dsqdqsqsdqsdqsdqsdqsdqs', 'kilwa-*75', '6416560e08ca1', 1),
(92, 'abdulhalim', 'sami', 'sami.jpg', 'Paris', 'sami.abdulhalim@edu.ece.fr', '$2y$10$2uaLj8XH.F/wv3W2oZuuNOhZ5Fpva2Q689WCxriyK22pWsTno7FIW', 'etudiant', '', '2023-03-22', 'je suis un développeur full stack ', 'aboalsim114', '641679f04f224', 1),
(93, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Cannes', 'rayane.jerbi@edu.ece.fr', '$2y$10$5kSvYS3AJn3MIAmDnszTMO7s1HCXqwTSfDb.f1TGkUaykzZtvHgFu', 'etudiant', '', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '1cfb4fbe48a980c2374020df6a547064', 1),
(98, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Cannes', 'rayane@admin.fr', '$2y$10$lm3Ff8lgR23GzvuyqDD.LuyMO2y5TbXLxIkW3i.8bW9800X.OGomO', 'admin', '', '2003-04-17', 'Développeur d\'ECEBook', 'Rayane_jrb', '641948dbdda76', 1),
(102, 'Jerbi', 'Rayane', 'photo rayane cv.jpg', 'Cannes', 'rayane.jerbi@edu.ece.fr', '$2y$10$Uu4i3v7QhOCbsLC170t3D.gAxuoACdOfQCOl69eZgV6DHflLhXpeq', 'etudiant', '', '2003-04-17', 'Développeur SI et IT', 'rayane_jrb', '182c05631c88aee7ee33178ff455d605', 1),
(106, 'test', 'tset', 'Capture d\'écran_20221027_234213.png', 'paris', 'andreas.chatel@edu.ece.fr', '$2y$10$dgwNPI4BDXLm0WRpns0u.u2GRx4poC7LZtsiQKSeyvTZgVTg5I5oW', 'etudiant', '', '0456-06-20', 'tsetsesesetsetsetsetstsets', 'andreas', '641ad2541ff6f', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_posts` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_posts_utilisateur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

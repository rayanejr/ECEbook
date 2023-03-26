-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 23 mars 2023 à 09:39
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
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  KEY `fk_commentaires_posts` (`id_post`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_comment`, `contenu`, `id_post`, `id_user`, `time_stamp`) VALUES
(1, 'dsfgdsfg', 9, 106, '2023-03-22 16:44:32'),
(2, 'sqgfdsgsd', 54, 122, '2023-03-23 09:02:27'),
(3, 'sdfqs', 54, 122, '2023-03-23 09:04:30'),
(4, 'retezrt', 54, 122, '2023-03-23 09:19:50'),
(5, 'retezrt', 54, 122, '2023-03-23 09:23:18');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `like` int DEFAULT '1',
  PRIMARY KEY (`id_post`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_post`, `id_user`, `like`) VALUES
(50, 119, 1),
(51, 119, 1);

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
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nomcrea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `publique` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `message`, `image`, `nomcrea`, `titre`, `id_user`, `nom`, `publique`, `date`) VALUES
(50, 'ersdcgvsfx', NULL, NULL, 'efzrgsfgvrs', 120, NULL, NULL, '2023-03-22 16:43:13'),
(51, 'efdqfwsdf', NULL, NULL, 'efdgfvsd', 121, 'Jerbi', NULL, '2023-03-22 20:17:34'),
(53, 'tset', '', NULL, 'sdfsq', 122, 'test', 0, '2023-03-23 07:57:14'),
(54, 'tset', '', NULL, 'sdfsq', 122, 'test', 1, '2023-03-23 07:58:26'),
(55, 'test', '', NULL, 'sqdf', 122, NULL, 0, '2023-03-23 08:30:08'),
(56, 'sdqfsdf', '', NULL, 'sfsqdf', 122, 'test', 0, '2023-03-23 08:31:00'),
(57, 'qsdfqsd', '', NULL, 'qsdfqsf', 122, 'test', 0, '2023-03-23 08:34:00'),
(58, 'sdfs', '', NULL, 'sqdfsq', 122, 'test', 0, '2023-03-23 08:35:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`, `code_confirmation`, `confirmer`) VALUES
(120, 'Jerbi', 'rayane', 'download-removebg-preview (1).jpg', 'Paris', 'rayane@admin.fr', '$2y$10$mXbbkOvM.5BrWugDRxhvROseSXl3lLax0Czf7LGkoU8f1Fepo1EYO', 'admin', 'Promo', '2003-04-17', 'qedfgfvzfsgv', 'rayane', '641b3d583ea79', 1),
(121, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Paris', 'rayane.jerbi@edu.ece.fr', '$2y$10$kSdgm3kzwOHVVeT9nSzGm.Zu3FDPVq0ZdzbKGCI1aDxfTDdh6Sukq', 'etudiant', 'Bachelor 2', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '641b6c98bd272', 1),
(122, 'test', 'tset', 'Capture d\'écran 2023-03-08 163003.png', 'paris', 'andreas.chatel@edu.ece.fr', '$2y$10$08SSmTXGNXc3BiQgGdoivu6kIl/OHZzqyuGLxqMHNGg0AWFQhXK0.', 'etudiant', 'B2', '2003-05-20', 'qsodifuhqoisldfuyh', 'didi', '5e090eb240861398d21fe9402202cae0', 1);

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

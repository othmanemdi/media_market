-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 juin 2022 à 23:14
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `media_market`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Ordinateur Portable'),
(2, 'Ordinateur Bureau'),
(3, 'Téléphones'),
(4, 'Tablettes'),
(5, 'Montres');

-- --------------------------------------------------------

--
-- Structure de la table `couleurs`
--

CREATE TABLE `couleurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `couleurs`
--

INSERT INTO `couleurs` (`id`, `nom`) VALUES
(1, 'bleu'),
(2, 'rouge'),
(3, 'noir'),
(4, 'blanc'),
(5, 'jaune'),
(6, 'gris'),
(7, 'vert'),
(8, 'mauve'),
(9, 'orange'),
(10, 'rose'),
(11, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `montant` double(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `nom`, `montant`) VALUES
(1, 'test', 0.00),
(2, 'abobakr', 1000.00);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `nom`) VALUES
(1, 'appel'),
(2, 'samsunge'),
(3, 'hp'),
(4, 'asus'),
(5, 'dell'),
(6, 'msi'),
(7, 'razer'),
(8, 'lenovo'),
(22, 'razer');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`) VALUES
(1, 'admin'),
(2, 'fournisseur'),
(3, 'client'),
(4, 'commercial');

-- --------------------------------------------------------

--
-- Structure de la table `status_commande`
--

CREATE TABLE `status_commande` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `status_commande`
--

INSERT INTO `status_commande` (`id`, `nom`) VALUES
(1, 'en attente'),
(2, 'en cours'),
(3, 'livree'),
(4, 'retour');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `telephone`, `email`, `password`, `role_id`, `activated`) VALUES
(1, 'othmane', 'mdi', '0606060606', 'othmane@gmail.com', '$2y$10$RG7XksMHbKIICIyhYOVG6.caDWVgyQC5pXYkC3TnCgTfL4rvQSqAK', 1, 1),
(9, 'maryam', 'bouchuariti', NULL, 'maryam@gmail.com', '$2y$10$RG7XksMHbKIICIyhYOVG6.caDWVgyQC5pXYkC3TnCgTfL4rvQSqAK', 3, 1),
(10, 'hind', 'ohc', NULL, 'hind@gmail.com', '$2y$10$fcUBADotqb1l3lKPgf3ujenPww3I/o4BKmXxzKdedr5br8zgU3gue', 3, 1),
(11, 'mehdi', 'mansouri', '0655447799', 'mehdi@gmail.com', '$2y$10$h1BlKsvx5YnWEhrfKrg.felgF/vvYxJS4vEfUi1NF/wobF/SHpEle', 3, 0),
(12, 'mohcine', 'elg', '0606060606', 'mohcine@gmail.com', '123456', 3, 1),
(13, 'mohammed', 'kitea', '0655447788', 'mohamed@gmail.com', '123456', 2, 1),
(14, 'abo', 'maghrati', '0622443355', 'abo@gmail.com', '123456', 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couleurs`
--
ALTER TABLE `couleurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status_commande`
--
ALTER TABLE `status_commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `couleurs`
--
ALTER TABLE `couleurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `status_commande`
--
ALTER TABLE `status_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

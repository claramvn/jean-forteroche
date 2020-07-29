-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db5000443314.hosting-data.io
-- Généré le : mer. 29 juil. 2020 à 17:33
-- Version du serveur :  5.7.30-log
-- Version de PHP : 7.0.33-0+deb9u8

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs423865`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users`
(
  `id_user` int
(11) NOT NULL,
  `pseudo_user` varchar
(255) NOT NULL,
  `email_user` varchar
(255) NOT NULL,
  `pass_user` varchar
(255) NOT NULL,
  `avatar_user` varchar
(255) NOT NULL,
  `rank_user` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`
id_user`,
`pseudo_user
`, `email_user`, `pass_user`, `avatar_user`, `rank_user`) VALUES
(1, 'jeanftrc', 'jeanftrc@gmail.com', '$2y$10$OS9j7yYYGxeQ.eMRPdyR/e.y2ymKwsZG9Q9UIBtUubQyU4v.34xkC', 'thumbnail1.png', 1),
(2, 'clap', 'claramvn@hotmail.fr', '$2y$10$l2a6AZUyhWgJ9fTffGQ0xOB/.jCJrn.hXp0yj6U8qX/3.BJMq7.Qa', 'thumbnail5.png', 1),
(3, 'mentor', 'mentor@oc.fr', '$2y$10$eTAfMEuuYiFjqGxM2DdUhO4H.kv.O5AXYSr1Kt9ZLw6RXUhojmEc2', 'thumbnail6.png', 1),
(4, 'bolg', 'bolg@hotmail.fr', '$2y$10$ukjZWbsggL1FPiWuCmTnl.v1wWzawleAvQZ0bAr/5LSOPzu6CB7wm', 'thumbnail2.png', 0),
(5, 'rollo', 'rollo@gmail.com', '$2y$10$KvGPVo4fuFmNLSXyeIZGxOoj61q0gYedJCLmJ0Sc.pIt9XwkdqWKe', 'thumbnail4.png', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

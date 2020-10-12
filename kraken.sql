-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 12 Octobre 2020 à 11:53
-- Version du serveur :  10.3.25-MariaDB-1:10.3.25+maria~bionic-log
-- Version de PHP :  7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kraken`
--

-- --------------------------------------------------------

--
-- Structure de la table `kraken`
--

CREATE TABLE `kraken` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `kraken_power`
--

CREATE TABLE `kraken_power` (
  `id` int(11) NOT NULL,
  `kraken_id` int(11) NOT NULL,
  `power_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `power`
--

CREATE TABLE `power` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `power`
--

INSERT INTO `power` (`id`, `name`) VALUES
(1, 'Blast'),
(2, 'Plague'),
(3, 'Plague'),
(4, 'Mind control'),
(5, 'Ink fog'),
(6, 'Force shield'),
(7, 'Regeneration');

-- --------------------------------------------------------

--
-- Structure de la table `tentacle`
--

CREATE TABLE `tentacle` (
  `id` int(11) NOT NULL,
  `kraken_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `life_points` int(11) NOT NULL,
  `forcee` int(11) NOT NULL,
  `dexterity` int(11) NOT NULL,
  `constitution` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `kraken`
--
ALTER TABLE `kraken`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `kraken_power`
--
ALTER TABLE `kraken_power`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kraken_id` (`kraken_id`),
  ADD KEY `power_id` (`power_id`);

--
-- Index pour la table `power`
--
ALTER TABLE `power`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tentacle`
--
ALTER TABLE `tentacle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kraken_id` (`kraken_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `kraken`
--
ALTER TABLE `kraken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `kraken_power`
--
ALTER TABLE `kraken_power`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `power`
--
ALTER TABLE `power`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `tentacle`
--
ALTER TABLE `tentacle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `kraken_power`
--
ALTER TABLE `kraken_power`
  ADD CONSTRAINT `kraken_power_ibfk_1` FOREIGN KEY (`kraken_id`) REFERENCES `kraken` (`id`),
  ADD CONSTRAINT `kraken_power_ibfk_2` FOREIGN KEY (`power_id`) REFERENCES `power` (`id`);

--
-- Contraintes pour la table `tentacle`
--
ALTER TABLE `tentacle`
  ADD CONSTRAINT `tentacle_ibfk_1` FOREIGN KEY (`kraken_id`) REFERENCES `kraken` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 16 sep. 2018 à 14:59
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `tel` int(16) NOT NULL,
  `date_n` date NOT NULL,
  `cin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom`, `prenom`, `adresse`, `tel`, `date_n`, `cin`) VALUES
(39, 'Driowya', 'Abdelghafour', 'Talaa 10', 626720424, '1996-08-03', 'AD303845');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `foreign_id` int(11) DEFAULT NULL,
  `date_rdv` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`foreign_id`, `date_rdv`) VALUES
(1, '2018-09-03 08:00:00'),
(1, '2018-08-30 09:00:00'),
(1, '2018-08-30 09:30:00'),
(1, '2018-08-30 10:00:00'),
(1, '2018-08-30 10:30:00'),
(1, '2018-08-30 11:00:00'),
(1, '2018-08-31 08:00:00'),
(1, '2018-08-26 08:30:00'),
(1, '2018-08-28 08:30:00'),
(1, '2018-08-30 08:30:00'),
(1, '2018-08-30 11:30:00'),
(1, '2018-08-30 12:00:00'),
(1, '2018-08-30 12:30:00'),
(1, '2018-08-30 13:00:00'),
(1, '2018-08-30 13:30:00'),
(1, '2018-08-30 14:00:00'),
(2, '0000-00-00 00:00:00'),
(2, '2018-09-20 00:00:00'),
(2, '2018-09-27 08:30:00'),
(2, '2018-09-27 08:00:00'),
(2, '2018-09-27 09:30:00'),
(2, '2018-09-27 09:00:00'),
(2, '2018-09-27 10:00:00'),
(2, '2018-09-27 10:30:00'),
(2, '2018-09-27 11:00:00'),
(2, '2018-09-27 11:30:00'),
(2, '2018-09-27 12:00:00'),
(2, '2018-09-27 13:30:00'),
(2, '2018-09-27 12:30:00'),
(2, '2018-09-27 13:00:00'),
(2, '2018-09-27 14:00:00'),
(2, '2018-09-28 08:30:00'),
(2, '2018-09-28 08:00:00'),
(2, '2018-09-28 10:30:00'),
(2, '2018-09-28 14:00:00'),
(2, '2018-09-28 09:00:00'),
(2, '2018-09-28 11:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int(10) NOT NULL,
  `titre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `titre`) VALUES
(1, 'specialite1'),
(2, 'specialite2'),
(3, 'specialite3'),
(4, 'specialite4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`),
  ADD UNIQUE KEY `cin` (`cin`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD UNIQUE KEY `date_rdv` (`date_rdv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

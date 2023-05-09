-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 09 mai 2023 à 08:59
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1-log
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_Bois_Du_Roy`
--
CREATE DATABASE IF NOT EXISTS `bdd_Bois_Du_Roy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdd_Bois_Du_Roy`;

-- --------------------------------------------------------

--
-- Structure de la table `COMPTE`
--

CREATE TABLE `COMPTE` (
  `ID_COMPTE` int(11) NOT NULL,
  `MATRICULE` varchar(5) NOT NULL,
  `NOM_UTILISATEUR` varchar(40) DEFAULT NULL,
  `MOT_DE_PASSE` varchar(255) DEFAULT NULL,
  `MOT_DE_PASSE_BACK` tinyint(1) NOT NULL COMMENT 'Si 1 -> Mdp modifé en back office\r\nSi 0 mdp utilisateur',
  `QUESTION_SECRETE` varchar(255) DEFAULT NULL,
  `REPONSE` varchar(255) DEFAULT NULL,
  `EST_RESPONSABLE` tinyint(1) DEFAULT NULL,
  `ADMINISTRATEUR` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `COMPTE`
--

INSERT INTO `COMPTE` (`ID_COMPTE`, `MATRICULE`, `NOM_UTILISATEUR`, `MOT_DE_PASSE`, `MOT_DE_PASSE_BACK`, `QUESTION_SECRETE`, `REPONSE`, `EST_RESPONSABLE`, `ADMINISTRATEUR`) VALUES
(1, 'E4230', 'dmartin', '$2a$11$adFavT7P87dMAeFjjIJ7S.H659I2qqzF/4rWlbne2sJJgSSMFDSGW', 0, NULL, NULL, 0, 0),
(2, 'E4231', 'jdubois', '$2y$10$CIWFo6Z2hBrHYiCF1J2IN.vaYjb/iC4/bF48LS43N7AakkZv.idZG', 0, NULL, NULL, 0, 0),
(3, 'E4232', 'smarcel', '$2a$11$naIaNMvbU5wgrNaF6a2Y3ezrFWibO/TzS4/VPaxLfxZ40Ls6QTaIW', 1, NULL, NULL, 0, 0),
(4, 'E4233', 'ccorine', '$2a$11$IfjoL5MGNXBrGtdFGKAFx.rjRaGYq8.vloaxED6I/qSiX68a7OCqu', 1, NULL, NULL, 0, 0),
(5, 'E4234', 'mjean', '$2a$11$GJAqDAe301RCYi3tJpXeyep36Myyj7S7xVoMHXeIEAPMv9GAxmXz6', 1, NULL, NULL, 0, 0),
(6, 'E4235', 'fjulie', '$2a$11$Ha35EofH7ChPEpleJO03beTU4OV67nvBPyXdd/f.BI4iu6QVqof3C', 1, NULL, NULL, 0, 0),
(7, 'E4236', 'bmathilde', '$2a$11$OcW/liuB5gyPWM1P6mY0Lu0ApUAUncAmdkCh86mzUyuMaDXfbAcHm', 1, NULL, NULL, 0, 0),
(8, 'E4237', 'cmonsard', '$2y$10$Fe/YC459QIm1/1f2lvdduekRId11j2wxVMiCrnHN83lndEcy/sITO', 0, NULL, NULL, 1, 0),
(9, 'E4238', 'lthibault', '$2a$11$f5LgQQiX9lD3yzlWRCnJYOtn66.u.qIRGqUx975AIqlvfXQFg7CPi', 1, NULL, NULL, 1, 1),
(10, 'E4239', 'gkevin', '$2a$11$HlVvSe2uIbjlAh0X6BFpse136p6q.MHnzAGFe/UMHOtlojcMIxL3u', 1, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `CONGE`
--

CREATE TABLE `CONGE` (
  `MATRICULE` varchar(5) NOT NULL,
  `ID_TYPE_CONGE` int(11) NOT NULL,
  `CONGE_RESTANT` decimal(10,2) DEFAULT NULL,
  `CONGE_ACQUIS` decimal(10,2) DEFAULT NULL,
  `ANNEE` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CONGE`
--

INSERT INTO `CONGE` (`MATRICULE`, `ID_TYPE_CONGE`, `CONGE_RESTANT`, `CONGE_ACQUIS`, `ANNEE`) VALUES
('E4230', 1, '2.00', '1.00', 2022),
('E4230', 2, '22.00', '25.00', 2022),
('E4231', 1, '0.00', '1.50', 2022),
('E4231', 2, '9.00', '25.00', 2022),
('E4232', 1, '1.00', '3.00', 2022),
('E4232', 2, '10.00', '25.00', 2022),
('E4233', 1, '2.00', '5.00', 2022),
('E4233', 2, '20.00', '25.00', 2022),
('E4234', 1, '0.00', '1.00', 2022),
('E4234', 2, '15.00', '25.00', 2022),
('E4235', 1, '2.50', '5.00', 2022),
('E4235', 2, '25.00', '25.00', 2022),
('E4236', 1, '1.00', '1.00', 2022),
('E4236', 2, '20.00', '25.00', 2022),
('E4237', 1, '5.00', '100.00', 2022),
('E4237', 2, '6.00', '100.00', 2022),
('E4238', 1, '7.50', '8.00', 2022),
('E4238', 2, '14.00', '25.00', 2022),
('E4239', 1, '1.00', '1.00', 2022),
('E4239', 2, '25.00', '25.00', 2022);

-- --------------------------------------------------------

--
-- Structure de la table `DEMANDE_CONGE`
--

CREATE TABLE `DEMANDE_CONGE` (
  `ID_DEMANDE_CONGE` int(5) NOT NULL,
  `MATRICULE` varchar(5) NOT NULL,
  `DATE_DEMANDE` date NOT NULL,
  `DATE_DEBUT` date NOT NULL,
  `DATE_FIN` date NOT NULL,
  `MOTIF_DEMANDE` varchar(255) NOT NULL,
  `MOTIF_DECISION` varchar(255) DEFAULT NULL,
  `STATUT_DEMANDE_CONGE` int(2) NOT NULL,
  `TYPE_CONGE_DEMANDE` int(2) NOT NULL,
  `VALIDATEUR` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `DEMANDE_CONGE`
--

INSERT INTO `DEMANDE_CONGE` (`ID_DEMANDE_CONGE`, `MATRICULE`, `DATE_DEMANDE`, `DATE_DEBUT`, `DATE_FIN`, `MOTIF_DEMANDE`, `MOTIF_DECISION`, `STATUT_DEMANDE_CONGE`, `TYPE_CONGE_DEMANDE`, `VALIDATEUR`) VALUES
(117, 'E4230', '0000-00-00', '2023-05-09', '2023-05-13', 'Paon de côte', 'Plus assez de congé payé', 3, 2, 'E4237'),
(201, 'E4231', '0000-00-00', '2023-05-02', '2023-05-05', 'vacances', NULL, 2, 2, 'E4237'),
(250, 'E4231', '2023-05-08', '2023-05-08', '2023-05-08', 'Rdv médical', NULL, 1, 2, 'E4237'),
(251, 'E4231', '2023-05-08', '2023-05-08', '2023-05-09', 'Motif personnel', NULL, 1, 1, NULL),
(252, 'E4231', '2023-05-08', '2023-05-11', '2023-05-11', 'Rdv Personnel\r\n', NULL, 1, 2, NULL),
(253, 'E4231', '2023-05-08', '2023-05-15', '2023-05-16', 'Garde enfant', NULL, 1, 2, NULL),
(115, 'E4238', '0000-00-00', '2023-06-06', '2023-06-13', 'Vacances', '', 2, 2, 'E4237');

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYE`
--

CREATE TABLE `EMPLOYE` (
  `MATRICULE` varchar(5) NOT NULL,
  `MATRICULE_RESPONSABLE` varchar(5) DEFAULT NULL,
  `ID_SERVICE` int(11) DEFAULT NULL,
  `ID_FONCTION` int(11) DEFAULT NULL,
  `NOM` varchar(40) DEFAULT NULL,
  `PRENOM` varchar(30) DEFAULT NULL,
  `MAIL` varchar(50) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `NUM_SECU` varchar(15) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `DATE_EMBAUCHE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `EMPLOYE`
--

INSERT INTO `EMPLOYE` (`MATRICULE`, `MATRICULE_RESPONSABLE`, `ID_SERVICE`, `ID_FONCTION`, `NOM`, `PRENOM`, `MAIL`, `TELEPHONE`, `NUM_SECU`, `DATE_NAISSANCE`, `DATE_EMBAUCHE`) VALUES
('E4230', 'E4239', 1, 1, 'Dupont', 'Martin', 'DMartin@broy.com', '21230', '180114949188325', '1980-11-12', '2005-11-13'),
('E4231', 'E4237', 2, 2, 'Dubois', 'Karine', 'KDubois@broy.com', '21231', '287044949193272', '1987-04-05', '2010-04-15'),
('E4232', 'E4239', 1, 1, 'Simon', 'Marcel', 'SMarcel@broy.com', '21232', '190094949160211', '1990-09-04', '2012-08-15'),
('E4233', 'E4237', 3, 3, 'Cuistot', 'Corine', 'CCorine@broy.com', '21233', '272124949142008', '1972-12-05', '2001-01-15'),
('E4234', 'E4239', 1, 1, 'Marquerie', 'Jean', 'MJean@broy.com', '21234', '198124949133254', '1998-12-02', '2020-12-01'),
('E4235', 'E4237', 4, 4, 'Frémond', 'Julie', 'FJulie@broy.com', '21235', '289094949113852', '1989-09-02', '2020-12-01'),
('E4236', 'E4239', 1, 1, 'Breger', 'Mathilde', 'BMathilde@broy.com', '21236', '286114949187006', '1986-12-11', '2020-12-01'),
('E4237', NULL, 5, 5, 'Monsard', 'Camille', 'CMonsard@broy.com', '21237', '200014949110156', '2000-01-12', '2020-12-01'),
('E4238', 'E4237', 6, 6, 'Liohthard', 'Thibault', 'LThibault@broy.com', '21238', '102054949100612', '2002-05-29', '2020-12-01'),
('E4239', 'E4237', 1, 1, 'Grasset', 'Kevin', 'GKevin@broy.com', '21239', '101124949166663', '2001-07-06', '2020-12-12');

-- --------------------------------------------------------

--
-- Structure de la table `FONCTION`
--

CREATE TABLE `FONCTION` (
  `ID_FONCTION` int(11) NOT NULL,
  `NOM_FONCTION` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `FONCTION`
--

INSERT INTO `FONCTION` (`ID_FONCTION`, `NOM_FONCTION`) VALUES
(1, 'Menuisier'),
(2, 'Agent de Maintenance'),
(3, 'Agent de Traitement'),
(4, 'Controleur Qualite'),
(5, 'Direction Ressources Humaines'),
(6, 'Responsable Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `SERVICE`
--

CREATE TABLE `SERVICE` (
  `ID_SERVICE` int(11) NOT NULL,
  `NOM_SERVICE` varchar(128) DEFAULT NULL,
  `MATRICULE_RESPONSABLE` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SERVICE`
--

INSERT INTO `SERVICE` (`ID_SERVICE`, `NOM_SERVICE`, `MATRICULE_RESPONSABLE`) VALUES
(1, 'Production', NULL),
(2, 'Entretien', NULL),
(3, 'Expédition', NULL),
(4, 'Qualité', NULL),
(5, 'RH', 'E4237'),
(6, 'DSI', 'E4238');

-- --------------------------------------------------------

--
-- Structure de la table `STATUT_DEMANDE`
--

CREATE TABLE `STATUT_DEMANDE` (
  `ID_STATUT` int(11) NOT NULL,
  `LIBELLE_STATUT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `STATUT_DEMANDE`
--

INSERT INTO `STATUT_DEMANDE` (`ID_STATUT`, `LIBELLE_STATUT`) VALUES
(1, 'En attente'),
(2, 'Validé'),
(3, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_CONGE`
--

CREATE TABLE `TYPE_CONGE` (
  `ID_TYPE_CONGE` int(11) NOT NULL,
  `NOM_TYPE_CONGE` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TYPE_CONGE`
--

INSERT INTO `TYPE_CONGE` (`ID_TYPE_CONGE`, `NOM_TYPE_CONGE`) VALUES
(1, 'RTT'),
(2, 'Congé Payé');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `COMPTE`
--
ALTER TABLE `COMPTE`
  ADD PRIMARY KEY (`ID_COMPTE`),
  ADD KEY `I_FK_COMPTE_EMPLOYE` (`MATRICULE`);

--
-- Index pour la table `CONGE`
--
ALTER TABLE `CONGE`
  ADD PRIMARY KEY (`MATRICULE`,`ID_TYPE_CONGE`),
  ADD KEY `I_FK_CONGE_EMPLOYE` (`MATRICULE`),
  ADD KEY `I_FK_CONGE_TYPE_CONGE` (`ID_TYPE_CONGE`);

--
-- Index pour la table `DEMANDE_CONGE`
--
ALTER TABLE `DEMANDE_CONGE`
  ADD PRIMARY KEY (`MATRICULE`,`ID_DEMANDE_CONGE`) USING BTREE,
  ADD KEY `FK_VALIDER_STATUT_DEMANDE` (`STATUT_DEMANDE_CONGE`),
  ADD KEY `FK_VALIDER_TYPE_CONGE` (`TYPE_CONGE_DEMANDE`),
  ADD KEY `ID_VALIDATION_CONGE` (`ID_DEMANDE_CONGE`),
  ADD KEY `I_FK_RESPONSABLE` (`VALIDATEUR`) USING BTREE;

--
-- Index pour la table `EMPLOYE`
--
ALTER TABLE `EMPLOYE`
  ADD PRIMARY KEY (`MATRICULE`),
  ADD KEY `I_FK_EMPLOYE_SERVICE` (`ID_SERVICE`),
  ADD KEY `I_FK_EMPLOYE_FONCTION` (`ID_FONCTION`),
  ADD KEY `I_FK_EMPLOYE_EMPLOYE` (`MATRICULE_RESPONSABLE`) USING BTREE;

--
-- Index pour la table `FONCTION`
--
ALTER TABLE `FONCTION`
  ADD PRIMARY KEY (`ID_FONCTION`);

--
-- Index pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  ADD PRIMARY KEY (`ID_SERVICE`);

--
-- Index pour la table `STATUT_DEMANDE`
--
ALTER TABLE `STATUT_DEMANDE`
  ADD PRIMARY KEY (`ID_STATUT`);

--
-- Index pour la table `TYPE_CONGE`
--
ALTER TABLE `TYPE_CONGE`
  ADD PRIMARY KEY (`ID_TYPE_CONGE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `COMPTE`
--
ALTER TABLE `COMPTE`
  MODIFY `ID_COMPTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `DEMANDE_CONGE`
--
ALTER TABLE `DEMANDE_CONGE`
  MODIFY `ID_DEMANDE_CONGE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT pour la table `FONCTION`
--
ALTER TABLE `FONCTION`
  MODIFY `ID_FONCTION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  MODIFY `ID_SERVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `STATUT_DEMANDE`
--
ALTER TABLE `STATUT_DEMANDE`
  MODIFY `ID_STATUT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `TYPE_CONGE`
--
ALTER TABLE `TYPE_CONGE`
  MODIFY `ID_TYPE_CONGE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `COMPTE`
--
ALTER TABLE `COMPTE`
  ADD CONSTRAINT `FK_COMPTE_EMPLOYE` FOREIGN KEY (`MATRICULE`) REFERENCES `EMPLOYE` (`MATRICULE`);

--
-- Contraintes pour la table `CONGE`
--
ALTER TABLE `CONGE`
  ADD CONSTRAINT `FK_CONGE_EMPLOYE` FOREIGN KEY (`MATRICULE`) REFERENCES `EMPLOYE` (`MATRICULE`),
  ADD CONSTRAINT `FK_CONGE_TYPE_CONGE` FOREIGN KEY (`ID_TYPE_CONGE`) REFERENCES `TYPE_CONGE` (`ID_TYPE_CONGE`);

--
-- Contraintes pour la table `DEMANDE_CONGE`
--
ALTER TABLE `DEMANDE_CONGE`
  ADD CONSTRAINT `FK_VALIDER_EMPLOYE` FOREIGN KEY (`MATRICULE`) REFERENCES `EMPLOYE` (`MATRICULE`),
  ADD CONSTRAINT `FK_VALIDER_STATUT_DEMANDE` FOREIGN KEY (`STATUT_DEMANDE_CONGE`) REFERENCES `STATUT_DEMANDE` (`ID_STATUT`),
  ADD CONSTRAINT `FK_VALIDER_TYPE_CONGE` FOREIGN KEY (`TYPE_CONGE_DEMANDE`) REFERENCES `TYPE_CONGE` (`ID_TYPE_CONGE`),
  ADD CONSTRAINT `FK_VALIDER_VALIDATEUR` FOREIGN KEY (`VALIDATEUR`) REFERENCES `EMPLOYE` (`MATRICULE`);

--
-- Contraintes pour la table `EMPLOYE`
--
ALTER TABLE `EMPLOYE`
  ADD CONSTRAINT `FK_EMPLOYE_EMPLOYE` FOREIGN KEY (`MATRICULE_RESPONSABLE`) REFERENCES `EMPLOYE` (`MATRICULE`),
  ADD CONSTRAINT `FK_EMPLOYE_FONCTION` FOREIGN KEY (`ID_FONCTION`) REFERENCES `FONCTION` (`ID_FONCTION`),
  ADD CONSTRAINT `FK_EMPLOYE_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `SERVICE` (`ID_SERVICE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

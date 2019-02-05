-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 05 fév. 2019 à 10:29
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `urcroller`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id_adherent` int(11) NOT NULL AUTO_INCREMENT,
  `sexe` varchar(1000) DEFAULT NULL,
  `nom` varchar(1000) DEFAULT NULL,
  `prenom` varchar(1000) DEFAULT NULL,
  `datenaiss` date DEFAULT NULL,
  `nationalite` varchar(1000) DEFAULT NULL,
  `telephone` int(100) DEFAULT NULL,
  `adresse` varchar(1000) DEFAULT NULL,
  `cp` int(100) DEFAULT NULL,
  `ville` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) NOT NULL,
  `mdp` varchar(1000) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `infosup` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_adherent`),
  KEY `infosup` (`infosup`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `sexe`, `nom`, `prenom`, `datenaiss`, `nationalite`, `telephone`, `adresse`, `cp`, `ville`, `email`, `mdp`, `date_creation`, `infosup`, `iduser`) VALUES
(49, '12', '12', '12', '2014-01-01', '12', 12, '12', 12, '12', '12', '121', '2014-01-01 00:00:00', 14, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `mdp`) VALUES
(1, 'aze', 'aze');

-- --------------------------------------------------------

--
-- Structure de la table `cotisation`
--

DROP TABLE IF EXISTS `cotisation`;
CREATE TABLE IF NOT EXISTS `cotisation` (
  `id_adherent` int(11) NOT NULL AUTO_INCREMENT,
  `type_cotisation` int(11) NOT NULL,
  `datedebutcoti` int(11) NOT NULL,
  `datefincoti` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `montantrestant` int(11) NOT NULL,
  PRIMARY KEY (`id_adherent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `informationsup`
--

DROP TABLE IF EXISTS `informationsup`;
CREATE TABLE IF NOT EXISTS `informationsup` (
  `id_infosup` int(11) NOT NULL AUTO_INCREMENT,
  `type_mailing` varchar(100) NOT NULL,
  `accident` varchar(100) NOT NULL,
  `droitimage` varchar(100) NOT NULL,
  `infocomplem` varchar(100) NOT NULL,
  `assurance` varchar(100) NOT NULL,
  `optionassurance` int(11) NOT NULL,
  `type_paiement` int(11) NOT NULL,
  `niveau_technique` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL,
  `demande_facture` varchar(100) NOT NULL,
  `pass_jeune` varchar(100) NOT NULL,
  `dossier_complet` varchar(100) NOT NULL,
  PRIMARY KEY (`id_infosup`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `informationsup`
--

INSERT INTO `informationsup` (`id_infosup`, `type_mailing`, `accident`, `droitimage`, `infocomplem`, `assurance`, `optionassurance`, `type_paiement`, `niveau_technique`, `date_creation`, `demande_facture`, `pass_jeune`, `dossier_complet`) VALUES
(13, '12', '12', '12', '12', '12', 12, 12, '12', '2014-01-01 00:00:00', '12', '12', '12'),
(14, '145', '12', '12', '12', '12', 12, 12, '12', '2014-01-01 00:00:00', '12', '12', '12');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20190122125132'),
('20190129160237'),
('20190129161603');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `type_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`type_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`type_paiement`, `libelle`) VALUES
(1, 'Espèces'),
(2, 'Coupon Sport'),
(3, 'Par chèques à l\'ordre : URC Draveil'),
(4, 'Je demande une facture');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'ghislain@urc.com', '[\"ROLE_ADMINISTRATEUR\"]', '$2y$13$s3cZQrYyXR6w40Aj3kX1WuRUXFYpd44Y5tyVtzqC9R4/YlGVdohKy'),
(2, 'a', '[\"ROLE_USER\"]', '$2y$13$s3cZQrYyXR6w40Aj3kX1WuRUXFYpd44Y5tyVtzqC9R4/YlGVdohKy'),
(3, 'b', '[\"ROLE_ADMINISTRATEUR\"]', '$2y$13$s3cZQrYyXR6w40Aj3kX1WuRUXFYpd44Y5tyVtzqC9R4/YlGVdohKy');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_ibfk_1` FOREIGN KEY (`infosup`) REFERENCES `informationsup` (`id_infosup`),
  ADD CONSTRAINT `adherent_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

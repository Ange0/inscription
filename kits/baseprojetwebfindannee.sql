-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 juil. 2019 à 14:48
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
-- Base de données :  `baseprojetwebfindannee`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `matAg` varchar(10) NOT NULL,
  `nomAg` varchar(10) DEFAULT NULL,
  `preAg` varchar(10) DEFAULT NULL,
  `telAg` varchar(10) DEFAULT NULL,
  `codeser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`matAg`),
  KEY `fk_code_service` (`codeser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `codeClas` varchar(10) NOT NULL,
  `libClas` varchar(60) DEFAULT NULL,
  `codefil` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codeClas`),
  KEY `fk_code_codeclasse` (`codefil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `numDos` varchar(10) NOT NULL,
  `libDOS` varchar(20) DEFAULT NULL,
  `matEtu` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`numDos`),
  KEY `fk_matricul_etudiant` (`matEtu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `matEtu` varchar(10) NOT NULL,
  `nomEtu` varchar(15) DEFAULT NULL,
  `prenomEtu` varchar(25) DEFAULT NULL,
  `genreEtu` char(1) DEFAULT NULL,
  `telEtu` int(8) DEFAULT NULL,
  `photoDestEtu` varchar(60) DEFAULT NULL,
  `photoNomEtu` varchar(60) DEFAULT NULL,
  `niveauEtu` varchar(60) DEFAULT NULL,
  `statutEtu` varchar(20) DEFAULT NULL,
  `emailEtu` varchar(30) DEFAULT NULL,
  `dateNaissEtu` date DEFAULT NULL,
  `natEtu` varchar(15) DEFAULT NULL,
  `sitMatEtu` varchar(15) DEFAULT NULL,
  `lieuHabEtu` varchar(15) DEFAULT NULL,
  `nomParEtu` varchar(15) DEFAULT NULL,
  `prenomParEtu` varchar(25) DEFAULT NULL,
  `villeParEtu` varchar(25) DEFAULT NULL,
  `professionParEtu` varchar(20) DEFAULT NULL,
  `telParEtu` int(8) DEFAULT NULL,
  `nomCoresEtu` varchar(10) DEFAULT NULL,
  `prenomCoresEtu` varchar(25) DEFAULT NULL,
  `villeCoresEtu` varchar(25) DEFAULT NULL,
  `professionCoresEtu` varchar(25) DEFAULT NULL,
  `telCoresEtu` varchar(8) DEFAULT NULL,
  `codeFil` varchar(10) DEFAULT NULL,
  `codeClas` varchar(10) DEFAULT NULL,
  `codePers` varchar(10) DEFAULT NULL,
  `keyEtu` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`matEtu`),
  KEY `fk_code_filiere` (`codeFil`),
  KEY `fk_code_classe` (`codeClas`),
  KEY `fk_code_personnel` (`codePers`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`matEtu`, `nomEtu`, `prenomEtu`, `genreEtu`, `telEtu`, `photoDestEtu`, `photoNomEtu`, `niveauEtu`, `statutEtu`, `emailEtu`, `dateNaissEtu`, `natEtu`, `sitMatEtu`, `lieuHabEtu`, `nomParEtu`, `prenomParEtu`, `villeParEtu`, `professionParEtu`, `telParEtu`, `nomCoresEtu`, `prenomCoresEtu`, `villeCoresEtu`, `professionCoresEtu`, `telCoresEtu`, `codeFil`, `codeClas`, `codePers`, `keyEtu`) VALUES
('10149748S', 'Yao', 'Kouassi Ange', 'M', 57085100, 'imgetudiant/angelo.jpg', 'angelo.jpg', '2 eme annee', 'Affecte', 'kouassiangey@gmail.com', '2016-10-28', 'Ivoirienne', 'Celibataire', 'Morofé', 'N\'Zue', 'Yao Denis', 'Yamoussoukro', 'Tradi-Praticien', 7779231, 'Yao', 'Chantal', 'Abidjan', 'Menagere', '05114153', 'IDA', 'Ida2', '1234', '1234'),
('10149748R', 'Kouassi', 'Kouame Elise', 'M', 76724206, 'imgetudiant/elise.jpg', 'elise.jpg', '2 eme année', 'Celibataire', 'kouassi@gmail.com', '1995-02-21', 'Ivoirienne', 'Celibataire', '220 logement', 'Kouassi', 'Koffi Hurberson', 'Yamossoukro', 'Professeur', 4562314, 'Blegnon', 'Sylvain', 'Bouke', 'Professeur', '09231456', 'RIT', 'rit1', '1234', '1243');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `codeFil` varchar(10) NOT NULL,
  `libFil` varchar(100) DEFAULT NULL,
  `typeFil` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`codeFil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`codeFil`, `libFil`, `typeFil`) VALUES
('IDA', 'Informatique Developpeur D\' Application', 'Industrielle'),
('2MA', 'Moteur Mécanique Automobile', 'Industrielle'),
('MSP', 'Maintenance de Systeme de Production', 'Industrielle'),
('RIT', 'Reseau Informatique Telecommunication', 'Industrielle'),
('FCGE', 'Finance Comptabilité et Gestion d\'Entreprises', 'Tertiaire'),
('GEC', 'Gestion Commercial', 'Tertiaire'),
('RHCOM', 'Ressources Humaine Communication', 'Tertiaire');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `codePaie` varchar(15) NOT NULL,
  `libPaie` varchar(20) DEFAULT 'Droit d''inscription',
  `naturePaie` varchar(20) DEFAULT NULL,
  `numTelTransac` varchar(8) DEFAULT NULL,
  `datePaie` datetime DEFAULT NULL,
  `montantPaie` int(6) DEFAULT '0',
  `montantRestPaie` int(10) DEFAULT '0',
  `montantTotalPaie` int(6) DEFAULT '85000',
  `matEtu` varchar(10) DEFAULT NULL,
  `codePe` int(1) DEFAULT NULL,
  `statutPaie` int(1) DEFAULT '0',
  PRIMARY KEY (`codePaie`),
  KEY `fk_matricul_etudiant` (`matEtu`),
  KEY `fk_code_periode` (`codePe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `numPeri` varchar(1) NOT NULL,
  `libPeri` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`numPeri`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`numPeri`, `libPeri`) VALUES
('1', 'premier versement'),
('2', 'deuxieme  versement');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `numPie` varchar(10) NOT NULL,
  `naturePie` varchar(10) DEFAULT NULL,
  `numDos` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`numPie`),
  KEY `fk_numero_dossier` (`numDos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recu`
--

DROP TABLE IF EXISTS `recu`;
CREATE TABLE IF NOT EXISTS `recu` (
  `numRe` int(10) DEFAULT NULL,
  `dateRe` datetime DEFAULT NULL,
  `montRe` int(15) DEFAULT NULL,
  `matEtu` varchar(10) DEFAULT NULL,
  KEY `fk_matricul_etudiant` (`matEtu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recu`
--

INSERT INTO `recu` (`numRe`, `dateRe`, `montRe`, `matEtu`) VALUES
(1, '2019-07-15 00:00:00', 25000, '10149748S');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `numSer` int(2) NOT NULL,
  `libSer` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`numSer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

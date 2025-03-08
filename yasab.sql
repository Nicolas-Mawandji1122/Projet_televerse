
CREATE DATABASE `yasab` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `yasab`;

DROP TABLE IF EXISTS `t_contrat`;
CREATE TABLE `t_contrat` (
  `id_cont` int(11) NOT NULL AUTO_INCREMENT,
  `datesign_cont` datetime NOT NULL,
  `datevig_cont` date DEFAULT NULL,
  `datefin_cont` date DEFAULT NULL,
  `salaire_cont` varchar(100) NOT NULL,
  `duree_cont` varchar(100) DEFAULT NULL,
  `clause_cont` longtext NOT NULL,
  `menag_cont` int(11) NOT NULL,
  `trav_cont` int(11) NOT NULL,
  `statut_cont` varchar(64) NOT NULL,
  PRIMARY KEY (`id_cont`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_demande`;
CREATE TABLE `t_demande` (
  `id_dmd` int(11) NOT NULL AUTO_INCREMENT,
  `date_dmd` date NOT NULL,
  `desc_dmd` varchar(100) NOT NULL,
  `men_dmd` int(11) NOT NULL,
  `etat_dmd` varchar(64) NOT NULL,
  PRIMARY KEY (`id_dmd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_menage`;
CREATE TABLE `t_menage` (
  `id_men` int(11) NOT NULL AUTO_INCREMENT,
  `nom_men` varchar(100) NOT NULL,
  `img_men` varchar(100) NOT NULL,
  `tel_men` varchar(100) NOT NULL,
  `adress_men` varchar(100) NOT NULL,
  PRIMARY KEY (`id_men`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_menager`;
CREATE TABLE `t_menager` (
  `id_ger` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ger` varchar(100) NOT NULL,
  `genre_ger` varchar(20) NOT NULL,
  `date_ger` varchar(100) NOT NULL,
  `tel_ger` varchar(20) NOT NULL,
  `adress_ger` varchar(100) NOT NULL,
  `img_ger` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ger`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_offre`;
CREATE TABLE `t_offre` (
  `id_off` int(11) NOT NULL AUTO_INCREMENT,
  `date_off` datetime NOT NULL,
  `desc_off` varchar(100) NOT NULL,
  `men_off` int(11) NOT NULL,
  `etat_off` varchar(64) NOT NULL,
  PRIMARY KEY (`id_off`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_rapport`;
CREATE TABLE `t_rapport` (
  `id_rap` int(11) NOT NULL AUTO_INCREMENT,
  `date_rap` date NOT NULL,
  `men_rap` varchar(100) NOT NULL,
  `ger_rap` varchar(100) NOT NULL,
  `desc_rap` longtext NOT NULL,
  `etat_rap` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id_us` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `font` int(11) NOT NULL,
  PRIMARY KEY (`id_us`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `t_user` (`id_us`, `name`, `mdp`, `font`) VALUES
(1, 'dan',  '1234', 1),
(2, 'chris',  '1234', 2);

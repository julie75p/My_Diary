-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 08 Mai 2016 à 17:32
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mydiary`
--
CREATE DATABASE IF NOT EXISTS `mydiary` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mydiary`;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `id_user`, `title`, `message`, `file`, `date`) VALUES
(3, 2, 'Ceci est un test', 'J\\''aime parler toute seule', '3.jpg', '2016-05-08 16:22:13'),
(4, 2, 'Aujourd\\''hui', 'Aujourd\\''hui j\\''ai mangÃ© une pomme.', '4.jpg', '2016-05-08 16:24:03'),
(5, 2, 'Chat', 'Pixel le plus beau', '5.jpg', '2016-05-08 16:30:45'),
(6, 2, 'Titi aussi', '<3 !!', '6.jpg', '2016-05-08 16:32:17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `file` varchar(250) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `email`, `password`, `file`) VALUES
(1, 'Julie', 'Planque', 'julie.planque@epitech.eu', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '1.jpg'),
(2, 'TEST', 'TEST', 'test@test.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '2.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

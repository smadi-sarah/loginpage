-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Juillet 2021 à 12:02
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mon_mini_chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pseudo` int(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date-creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `utilisateurs`
--

/*INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `dateNaissance`, `email`, `mdp`, `date-creation`) VALUES
(24, 'Belle', 'bella', '2012-12-22', 'blabla-test@hotmail.fr', '$2y$13$CuWZgGDZCfQNp0OMtKQ8Ce4G6/N/t9gPtUs3ktyoLobFG5jPJsgv.','2021-07-08 11:53:55'),
(25, 'Dupont', 'Bibi', '2013-02-08', 'test-bonjour@gmail.com', '$2y$13$tLNGvFqyRbyH2QRFWa9GDe.GwVo1UGpc4yu3FdOUqtFd4iVys2fm2','2021-07-08 12:01:28');
*/
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

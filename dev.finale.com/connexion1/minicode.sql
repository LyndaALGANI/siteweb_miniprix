-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Juillet 2022 à 22:26
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `minicode`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'accueil'),
(2, 'nouveautes'),
(3, 'chambre'),
(4, 'salon'),
(5, 'table'),
(6, 'accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `itemsmini`
--

CREATE TABLE IF NOT EXISTS `itemsmini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `itemsmini`
--

INSERT INTO `itemsmini` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(5, 'Salon de jardin', 'Salon de jardin 4 fauteuils et 2 tables basses', '145000', 'salon1.PNG', 4),
(7, 'CanapÃ© 2 places', 'CanapÃ© convertible 2 places en tissu', '50000', 'CANAPER BLANC2.PNG', 4),
(10, 'Chambre Ã  coucher', 'PEGANE Chambre Ã€ Coucher ComplÃ¨te Adulte', '210000', 'chambre1.jpg', 3),
(11, 'Armoire Ã  bijoux', 'Armoire Ã  bijoux avec miroir', '90000', 'accessoire bijoux.PNG', 6),
(12, 'Plantes artificielles', 'Plante artificielle Palmera Areca - SKLUM', '35000', 'plant.jpg', 6),
(14, 'Meuble TV', 'Meuble TV 180 industriel Blanc / chÃªne', '25000', 'meubleTV.jpg', 2),
(15, 'Fauteuil de bureau', 'Fauteuil de bureau KEVIN HARVEY Noir', '17500', 'FTB.jpg', 2),
(16, 'CanapÃ© 3 places', 'CanapÃ© 3 places convertible GIULIA tissu gris', '65000', 'canape3.jpg', 4),
(17, 'Fauteuil De Relaxation', 'Fauteuil De Relaxation Et Massage Ã‰lectrique', '78000', 'massage.jpg', 2),
(18, 'Chambre Enfant', 'Cosmos Chambre Enfant Complete 2 Pieces - Lit + Bureau - Style Essentie', '75000', 'chambre2.jpg', 3),
(19, 'Matelas + sommier', 'Matelas + sommier 140x190 cm + pack textile DREAMEA HELIOS', '58000', 'matelas.jpg', 3),
(20, 'Table relevable', 'Table relevable 2 en 1 LILIAN Imitation chÃªne et chrome', '40000', 'table.jpg', 5),
(21, 'Tables Ã  manger', 'table Ã  manger + 4 chaises OWEN blanc (Coin repas)', '60000', 'table2.jpg', 5),
(22, 'Table basse', 'Table basse ronde en chÃªne double plateau 80 cm - Nazca', '45000', 'tbb.jpg', 5),
(23, 'Buffet 2 portes', 'Buffet 2 portes papier dÃ©cor pin foncÃ©', '24000', 'buffet.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `telephone` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `admin_user` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `adresse`, `telephone`, `nom`, `prenom`, `admin_user`) VALUES
(1, 'moh@gmail.com', '12345678', 'Home', 672332634, 'moh', 'benouareth', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `itemsmini`
--
ALTER TABLE `itemsmini`
  ADD CONSTRAINT `itemsmini_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 25 avr. 2018 à 08:48
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `algobreizh_v2`
--

-- --------------------------------------------------------

--
-- Structure de la table `tCities`
--

CREATE TABLE `tCities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `id_tSalesman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tCities`
--

INSERT INTO `tCities` (`id`, `name`, `id_tSalesman`) VALUES
(1, 'Rennes', 1),
(2, 'Paris', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tCustomers`
--

CREATE TABLE `tCustomers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `rights` int(11) DEFAULT NULL,
  `id_tCities` int(11) NOT NULL,
  `lastMeetingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tCustomers`
--

INSERT INTO `tCustomers` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `enabled`, `rights`, `id_tCities`, `lastMeetingDate`) VALUES
(9, 'qmz', 'Quentin', 'Martinez', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'qmz@algobreizh.fr', 1, 0, 1, '2018-04-22 11:24:00'),
(10, 'bst', 'Paul', 'Besret', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'bst@algobreizh.fr', 1, 0, 2, '2018-03-14 10:30:00'),
(11, 'dpe', 'Dorian', 'Pilorge', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'dpe@algobreizh.fr', 1, 0, 1, '2018-04-23 06:28:00'),
(12, 'adm', 'Admin', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'adm@algobreizh.fr', 1, 1, 1, '2018-06-22 11:13:00');

-- --------------------------------------------------------

--
-- Structure de la table `tMeetings`
--

CREATE TABLE `tMeetings` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `meetingDate` timestamp NULL DEFAULT NULL,
  `id_tSalesman` int(11) NOT NULL,
  `id_tCustomers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tMeetings`
--

INSERT INTO `tMeetings` (`id`, `description`, `contact`, `telephone`, `meetingDate`, `id_tSalesman`, `id_tCustomers`) VALUES
(23, 'Près de l\'église', 'Quentin Martinez', '0648566700', '2018-04-22 11:24:00', 1, 9),
(24, 'RAS', 'Dorian Pilorge', '3615', '2018-04-23 06:28:00', 1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `tOrders`
--

CREATE TABLE `tOrders` (
  `id` int(11) NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `id_tCustomers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tOrders_products`
--

CREATE TABLE `tOrders_products` (
  `quantity` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `id_tOrders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tProducts`
--

CREATE TABLE `tProducts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tSalesman`
--

CREATE TABLE `tSalesman` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(3) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tSalesman`
--

INSERT INTO `tSalesman` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Harry', 'Potter', 'phy', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2, 'Jean', 'Paul', 'pjn', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tCities`
--
ALTER TABLE `tCities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tCities_id_tSalesman` (`id_tSalesman`);

--
-- Index pour la table `tCustomers`
--
ALTER TABLE `tCustomers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tCustomers_id_tCities` (`id_tCities`);

--
-- Index pour la table `tMeetings`
--
ALTER TABLE `tMeetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tMeetings_id_tSalesman` (`id_tSalesman`),
  ADD KEY `FK_tMeetings_id_tCustomers` (`id_tCustomers`);

--
-- Index pour la table `tOrders`
--
ALTER TABLE `tOrders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tOrders_id_tCustomers` (`id_tCustomers`);

--
-- Index pour la table `tOrders_products`
--
ALTER TABLE `tOrders_products`
  ADD PRIMARY KEY (`id`,`id_tOrders`),
  ADD KEY `FK_tOrders_products_id_tOrders` (`id_tOrders`);

--
-- Index pour la table `tProducts`
--
ALTER TABLE `tProducts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tSalesman`
--
ALTER TABLE `tSalesman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tCities`
--
ALTER TABLE `tCities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tCustomers`
--
ALTER TABLE `tCustomers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `tMeetings`
--
ALTER TABLE `tMeetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `tOrders`
--
ALTER TABLE `tOrders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tProducts`
--
ALTER TABLE `tProducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tSalesman`
--
ALTER TABLE `tSalesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tCities`
--
ALTER TABLE `tCities`
  ADD CONSTRAINT `FK_tCities_id_tSalesman` FOREIGN KEY (`id_tSalesman`) REFERENCES `tSalesman` (`id`);

--
-- Contraintes pour la table `tCustomers`
--
ALTER TABLE `tCustomers`
  ADD CONSTRAINT `FK_tCustomers_id_tCities` FOREIGN KEY (`id_tCities`) REFERENCES `tCities` (`id`);

--
-- Contraintes pour la table `tMeetings`
--
ALTER TABLE `tMeetings`
  ADD CONSTRAINT `FK_tMeetings_id_tCustomers` FOREIGN KEY (`id_tCustomers`) REFERENCES `tCustomers` (`id`),
  ADD CONSTRAINT `FK_tMeetings_id_tSalesman` FOREIGN KEY (`id_tSalesman`) REFERENCES `tSalesman` (`id`);

--
-- Contraintes pour la table `tOrders`
--
ALTER TABLE `tOrders`
  ADD CONSTRAINT `FK_tOrders_id_tCustomers` FOREIGN KEY (`id_tCustomers`) REFERENCES `tCustomers` (`id`);

--
-- Contraintes pour la table `tOrders_products`
--
ALTER TABLE `tOrders_products`
  ADD CONSTRAINT `FK_tOrders_products_id` FOREIGN KEY (`id`) REFERENCES `tProducts` (`id`),
  ADD CONSTRAINT `FK_tOrders_products_id_tOrders` FOREIGN KEY (`id_tOrders`) REFERENCES `tOrders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

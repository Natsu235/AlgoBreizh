-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 13 mars 2018 à 16:21
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Algobreizh_1.1`
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
(1, 'Rennes', 1);

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
  `id_tCities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tCustomers`
--

INSERT INTO `tCustomers` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `enabled`, `rights`, `id_tCities`) VALUES
(1, 'qmz', 'Quentin', 'Martinez', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'qmz@algobreizh.fr', 1, 0, 1),
(2, 'bst', 'Paul', 'Besret', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'bst@algobreizh.fr', 1, 0, 1),
(3, 'dpe', 'Dorian', 'Pilorge', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'dpe@algobreizh.fr', 1, 0, 1),
(4, 'adm', 'Admin', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'adm@algobreizh.fr', 1, 1, 1);

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

--
-- Déchargement des données de la table `tProducts`
--

INSERT INTO `tProducts` (`id`, `name`, `price`, `reference`) VALUES
(1, 'Chondrus crispus', 10, 'P001'),
(2, 'Conserves', 8, 'P002'),
(3, 'Court bouillon', 12, 'P003'),
(4, 'Émietté de thon Wakamé', 10, 'P004'),
(5, 'Épices marines', 9, 'P005'),
(6, 'Haricots de mer en saumure (500g)', 19, 'P006'),
(7, 'Haricots marins', 12.5, 'P007'),
(8, 'Laitue de mer en feuilles', 11.9, 'P008'),
(9, 'Laitue de mer en paillettes', 18.5, 'P009'),
(10, 'Moutarde à la salicorne', 15.5, 'P010'),
(11, 'Nori en feuilles', 15.1, 'P011'),
(12, 'Nori en paillettes', 7.5, 'P012'),
(13, 'Nori saupoudreur aromate (10g)', 5, 'P013'),
(14, 'Pates aux algues', 8, 'P014'),
(15, 'Salicornes au naturel', 9.5, 'P015'),
(16, 'Salicornes au vinaigre', 13.8, 'P016'),
(17, 'Sels aux algues', 17, 'P017'),
(18, 'Tisane aux algues', 7, 'P018'),
(19, 'Wakamé en feuilles', 5, 'P019'),
(20, 'Wakamé en paillettes', 8, 'P020');

-- --------------------------------------------------------

--
-- Structure de la table `tSalesman`
--

CREATE TABLE `tSalesman` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tSalesman`
--

INSERT INTO `tSalesman` (`id`, `firstname`, `lastname`) VALUES
(1, 'John', 'Dee');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tCustomers`
--
ALTER TABLE `tCustomers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tOrders`
--
ALTER TABLE `tOrders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tProducts`
--
ALTER TABLE `tProducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `tSalesman`
--
ALTER TABLE `tSalesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tCities`
--
ALTER TABLE `tCities`
  ADD CONSTRAINT `FK_tCities_id_tSalesman` FOREIGN KEY (`id_tSalesman`) REFERENCES `tsalesman` (`id`);

--
-- Contraintes pour la table `tCustomers`
--
ALTER TABLE `tCustomers`
  ADD CONSTRAINT `FK_tCustomers_id_tCities` FOREIGN KEY (`id_tCities`) REFERENCES `tcities` (`id`);

--
-- Contraintes pour la table `tOrders`
--
ALTER TABLE `tOrders`
  ADD CONSTRAINT `FK_tOrders_id_tCustomers` FOREIGN KEY (`id_tCustomers`) REFERENCES `tcustomers` (`id`);

--
-- Contraintes pour la table `tOrders_products`
--
ALTER TABLE `tOrders_products`
  ADD CONSTRAINT `FK_tOrders_products_id` FOREIGN KEY (`id`) REFERENCES `tproducts` (`id`),
  ADD CONSTRAINT `FK_tOrders_products_id_tOrders` FOREIGN KEY (`id_tOrders`) REFERENCES `torders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

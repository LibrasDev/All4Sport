-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 15 nov. 2020 à 10:50
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `all4stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `com_id` int(11) NOT NULL,
  `com_date` varchar(45) NOT NULL,
  `com_quantite` varchar(45) NOT NULL,
  `fk_produit` int(11) NOT NULL,
  `fk_stock` int(11) NOT NULL,
  `fk_utilisateur` int(11) NOT NULL,
  `fk_etats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`com_id`, `com_date`, `com_quantite`, `fk_produit`, `fk_stock`, `fk_utilisateur`, `fk_etats`) VALUES
(1, '2020/11/09', '1', 1, 1, 1, 1),
(2, '2020/11/09', '2', 3, 2, 1, 3),
(3, '2020/11/01', '4', 1, 2, 2, 4),
(4, '2020/10/31', '1', 2, 1, 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `est_associe`
--

CREATE TABLE `est_associe` (
  `quantite` int(11) NOT NULL,
  `fk_stock` int(11) NOT NULL,
  `fk_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `est_associe`
--

INSERT INTO `est_associe` (`quantite`, `fk_stock`, `fk_produit`) VALUES
(50, 1, 2),
(6, 2, 2),
(150, 1, 1),
(60, 1, 3),
(3, 2, 3),
(2, 4, 3),
(20, 2, 1),
(18, 3, 1),
(50, 1, 4),
(4, 2, 4),
(6, 4, 4),
(200, 1, 6),
(30, 2, 6),
(35, 3, 6),
(500, 1, 5),
(30, 3, 5),
(40, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `et_id` int(11) NOT NULL,
  `et_nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`et_id`, `et_nom`) VALUES
(1, 'transmise'),
(2, 'validée'),
(3, 'en prépartion'),
(4, 'expédiée'),
(5, 'livrée'),
(6, 'retiré');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `pr_id` int(11) NOT NULL,
  `pr_nom` varchar(45) NOT NULL,
  `pr_cout` double NOT NULL,
  `pr_description` varchar(255) NOT NULL,
  `pr_image` varchar(45) NOT NULL,
  `fk_rayon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`pr_id`, `pr_nom`, `pr_cout`, `pr_description`, `pr_image`, `fk_rayon`) VALUES
(1, 'raquette de tennis', 107.99, 'ergonomique', 'm1.png', 3),
(2, 'ski', 799.99, 'Ski Atomic G7 et bâtons de ski au design BWT.', 'm2.png', 1),
(3, 'bateau de rafting', 569.99, 'Léger et facile à ranger, le Fisherpro 260 est conçu en PVC d’une épaisseur de 0,9 mm, celui-ci est parfaitement résistant et solide à basse température, résistant également aux UV.', 'm3.png', 1),
(4, 'Parachute', 139.99, 'Le sac PARA de la marque Dimatex est de couleur Bleu nuit et possède un volume de 28L.', 'm4.png', 1),
(5, 'Ballon de football', 15.99, 'Ballon en cuire de qualité sous norme française. Circonérence : 63,5 cm. Poids : 340g. Différents coloris.', 'ballon.png', 2),
(6, 'Maillot', 24.99, 'Maillot officiel de l\'équipe de football du Real Madrid. Tailles : S, M, L, XL.', 'maillot.png', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rayon`
--

CREATE TABLE `rayon` (
  `ra_id` int(11) NOT NULL,
  `ra_nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rayon`
--

INSERT INTO `rayon` (`ra_id`, `ra_nom`) VALUES
(1, 'sport extreme'),
(2, 'football'),
(3, 'tennis');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `sto_id` int(11) NOT NULL,
  `sto_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`sto_id`, `sto_type`) VALUES
(1, 'Internet'),
(2, 'Magasin n°1'),
(3, 'Magasin n°2'),
(4, 'Magasin n°3');

-- --------------------------------------------------------

--
-- Structure de la table `typeutilisateur`
--

CREATE TABLE `typeutilisateur` (
  `ty_id` int(11) NOT NULL,
  `ty_libelle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeutilisateur`
--

INSERT INTO `typeutilisateur` (`ty_id`, `ty_libelle`) VALUES
(1, 'SALARIE'),
(2, 'CLIENT'),
(3, 'MAGASIN');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ut_id` int(11) NOT NULL,
  `ut_surnom` varchar(45) NOT NULL,
  `ut_nom` varchar(45) NOT NULL,
  `ut_adresse` varchar(45) DEFAULT 'AUCUN',
  `ut_email` varchar(45) DEFAULT 'AUCUN',
  `ut_mdp` varchar(45) NOT NULL,
  `fk_typeUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ut_id`, `ut_surnom`, `ut_nom`, `ut_adresse`, `ut_email`, `ut_mdp`, `fk_typeUtilisateur`) VALUES
(0, 'Magasin', 'MAGASIN', 'AUCUN', 'AUCUN', 'aLl4SpoRT', 3),
(1, 'Yoh', 'CARVALHO', '30 rue de Lesdain CREVECOEUR SUR L\'ESCAUT', 'yohan.carvalho.59@gmail.com', '1234', 1),
(2, 'Libra', 'CHILLARD', 'une adresse JE-NE-SAIS-PAS-OU', 'dylan.chillard@ltpdampierre.fr', '2468', 2),
(3, 'ravageur', 'GIERA', 'une adresse JE-NE-SAIS-PAS-OU', 'maxime.giera@ltpdampierre.fr', '6789', 2),
(4, 'yo', 'CARVALHO', 'rue là', 'yo@hotmail.com', 'yohp', 2),
(5, 'roger2.0', 'ROGER', 'rue de Roger', 'roger@gmail.com', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `ve_id` int(11) NOT NULL,
  `ve_date` varchar(45) NOT NULL,
  `ve_quantite` varchar(45) NOT NULL,
  `fk_stock` int(11) NOT NULL,
  `fk_utilisateur` int(11) DEFAULT NULL,
  `fk_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`ve_id`, `ve_date`, `ve_quantite`, `fk_stock`, `fk_utilisateur`, `fk_produit`) VALUES
(1, '2020/11/14', '1', 2, 0, 3),
(2, '2020/11/14', '2', 2, 2, 1),
(3, '2020/11/14', '1', 3, 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `khu_idx` (`fk_produit`),
  ADD KEY `etats` (`fk_etats`),
  ADD KEY `stock` (`fk_stock`),
  ADD KEY `utilisateur_idx` (`fk_utilisateur`);

--
-- Index pour la table `est_associe`
--
ALTER TABLE `est_associe`
  ADD KEY `fk_sto_idx` (`fk_stock`),
  ADD KEY `fk_prod_idx` (`fk_produit`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`et_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `fk_ph_idx` (`pr_image`),
  ADD KEY `fk_ra_idx` (`fk_rayon`);

--
-- Index pour la table `rayon`
--
ALTER TABLE `rayon`
  ADD PRIMARY KEY (`ra_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`sto_id`);

--
-- Index pour la table `typeutilisateur`
--
ALTER TABLE `typeutilisateur`
  ADD PRIMARY KEY (`ty_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ut_id`),
  ADD KEY `typeUtilisateur_idx` (`fk_typeUtilisateur`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`ve_id`),
  ADD KEY `stock_vente` (`fk_stock`),
  ADD KEY `utilisateur_vente` (`fk_utilisateur`),
  ADD KEY `produit_vente` (`fk_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `ve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `etats` FOREIGN KEY (`fk_etats`) REFERENCES `etats` (`et_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `produit` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `utilisateur` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`ut_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `est_associe`
--
ALTER TABLE `est_associe`
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sto` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_ra` FOREIGN KEY (`fk_rayon`) REFERENCES `rayon` (`ra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `typeUtilisateur` FOREIGN KEY (`fk_typeUtilisateur`) REFERENCES `typeutilisateur` (`ty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `produit_vente` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock_vente` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `utilisateur_vente` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`ut_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

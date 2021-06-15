-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 15 juin 2021 à 09:46
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ape`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(1, 'PS / MS'),
(2, 'GS / CP'),
(3, 'CP / CE1'),
(4, 'CE2 / CM1'),
(5, 'CM1 / CM2');

-- --------------------------------------------------------

--
-- Structure de la table `conseils_ecole`
--

CREATE TABLE `conseils_ecole` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `date` varchar(150) NOT NULL,
  `fichier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conseils_ecole`
--

INSERT INTO `conseils_ecole` (`id`, `nom`, `date`, `fichier`) VALUES
(1, 'Toussaint Kencker', 'Décembres 2020', '01d9d353c9c73b0b40bbb99c87ba8e1d0b61c17b2bf53c549972e33a402692d2.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `date` varchar(110) NOT NULL,
  `fichier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id`, `nom`, `date`, `fichier`) VALUES
(1, 'Programme 2019', 'Janvier 2019', 'programme.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date` varchar(110) NOT NULL,
  `description` text NOT NULL,
  `fichier` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom`, `date`, `description`, `fichier`, `image`) VALUES
(45, 'Pâques', 'Mars 2021', 'Chers Parents, Le 20 décembre prochain aura lieu la Fête de Noël organisée par les enseignants de l’école et l’équipe de l’Alaé. Après le spectacle, l’Association des Parents d’Elèves propose de passer ensemble un temps de convivialité. Des activités de dessin, des jeux seront disponibles et un concours de construction sera organisé. GRAND MERCI.', 'cb42eb041383e827c7730a10eb475b57fbec01dc38637e4ea9b3d0e310a323a6.pdf', '1fb465c35ad58961b8dd7b825080802fe92ed9981444690be5a66a46ddcae863.jpeg'),
(46, 'Noël', 'Décembres 2020', 'Chers Parents, Le 20 décembre prochain aura lieu la Fête de Noël organisée par les enseignants de l’école et l’équipe de l’Alaé. Après le spectacle, l’Association des Parents d’Elèves propose de passer ensemble un temps de convivialité. Des activités de dessin, des jeux seront disponibles et un concours de construction sera organisé. GRAND MERCI.', '01d9d353c9c73b0b40bbb99c87ba8e1d0b61c17b2bf53c549972e33a402692d2.pdf', 'c184ad512c89a0d36e38a2d25b376d0e654c68fc2d2d9179cf84cbef61b743d8.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `fonctions_parents_delegues`
--

CREATE TABLE `fonctions_parents_delegues` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fonctions_parents_delegues`
--

INSERT INTO `fonctions_parents_delegues` (`id`, `nom`) VALUES
(1, 'Titulaire'),
(2, 'Suppléant');

-- --------------------------------------------------------

--
-- Structure de la table `image_accueil`
--

CREATE TABLE `image_accueil` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image_accueil`
--

INSERT INTO `image_accueil` (`id`, `image`, `nom`) VALUES
(12, 'IMG-20210505-WA0007.jpg', 'image 3'),
(49, 'c9fc14034927b77006b501e9c0c706448544374dd53d8615b885f10997cf5e8a.jpeg', 'image12'),
(50, 'b06a77d9a2d84df8976b60d8d503a45d6cf8dd9d09ba9b4b4b8c5000e993014b.jpeg', 'image4'),
(52, 'd1c8ed7b96b4d24dfc54bbf3a405de69540109f6dbf31b5acb6abfc78582dd69.jpeg', 'image4'),
(54, 'IMG-20210505-WA0004.jpg', 'Toussaint Kencker');

-- --------------------------------------------------------

--
-- Structure de la table `organigramme`
--

CREATE TABLE `organigramme` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `date` varchar(150) NOT NULL,
  `fichier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `organigramme`
--

INSERT INTO `organigramme` (`id`, `nom`, `date`, `fichier`) VALUES
(23, 'Organigramme', '2021 2022', '7f86806906411d93b295754be1687b1cd3578e178dec51bfbf0913012cd59098.png');

-- --------------------------------------------------------

--
-- Structure de la table `parents_delegues`
--

CREATE TABLE `parents_delegues` (
  `id` int(11) NOT NULL,
  `nom` varchar(110) NOT NULL,
  `prenom` varchar(110) NOT NULL,
  `fonction` varchar(110) NOT NULL,
  `classe` varchar(110) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parents_delegues`
--

INSERT INTO `parents_delegues` (`id`, `nom`, `prenom`, `fonction`, `classe`, `image`) VALUES
(13, 'YAMADA', 'Anne', 'Titulaire', 'PS / MS', 'femme.png'),
(14, 'SIEGEL POURCET', 'Karine', 'Suppléant', 'PS / MS', 'femme1.png'),
(17, 'ROUFFIAC', 'Carine', 'Titulaire', 'CP / CE1', 'femme4.png'),
(18, 'CHAMAYOU', 'Emilie', 'Suppléant', 'CP / CE1', 'femme5.png'),
(20, 'PERES', 'Emily', 'Titulaire', 'CE2 / CM1', 'homme1.png'),
(21, 'RAMIREZ', 'Cendra', 'Suppléant', 'CE2 / CM1', 'homme.png'),
(22, 'ANIQUANT', 'Tiphaine', 'Titulaire', 'GS / CP', 'femme2.png'),
(23, 'PEROCHEAU', 'Caroline', 'Suppléant', 'GS / CP', 'femme3.png'),
(24, 'SAINT OMER', 'Emilie', 'Titulaire', 'CM1 / CM2', 'homme3.png'),
(25, 'POUSTHOMIS', 'Laure', 'Suppléant', 'CM1 / CM2', 'homme2.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `secret` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `blocked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `secret`, `creation_date`, `blocked`) VALUES
(4, 'test@test.com', 'aq17288edd0fc3ffcbe93a0cf06e3568e28521687bc25', '5732e80c3c6ee891240933e645bcbc2d3d680cc61623068388', '2021-06-07 14:19:48', 0),
(5, 'test2@test.com', 'aq17288edd0fc3ffcbe93a0cf06e3568e28521687bc25', '80ca3e0723db00b5f5598adc03beb191f1bf2a3a1623068461', '2021-06-07 14:21:01', 0),
(6, 'Sandrinekencker@hotmail.com', 'aq17288edd0fc3ffcbe93a0cf06e3568e28521687bc25', '9ab92f66a5ac4a981dc0a57a53be77245343c74f1623070630', '2021-06-07 14:57:10', 0),
(7, 'sandr@gmail.com', 'aq17288edd0fc3ffcbe93a0cf06e3568e28521687bc25', '5074c289bee3d263513cdf62eac1fc8afacb3ece1623070700', '2021-06-07 14:58:20', 0),
(8, 'test3@gmail.com', 'aq17288edd0fc3ffcbe93a0cf06e3568e28521687bc25', 'aab671db3b94ae644b9a115849fd522d85838e7f1623072342', '2021-06-07 15:25:42', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conseils_ecole`
--
ALTER TABLE `conseils_ecole`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonctions_parents_delegues`
--
ALTER TABLE `fonctions_parents_delegues`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image_accueil`
--
ALTER TABLE `image_accueil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `organigramme`
--
ALTER TABLE `organigramme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parents_delegues`
--
ALTER TABLE `parents_delegues`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `conseils_ecole`
--
ALTER TABLE `conseils_ecole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `fonctions_parents_delegues`
--
ALTER TABLE `fonctions_parents_delegues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image_accueil`
--
ALTER TABLE `image_accueil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `organigramme`
--
ALTER TABLE `organigramme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `parents_delegues`
--
ALTER TABLE `parents_delegues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

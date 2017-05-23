-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mar 23 Mai 2017 à 12:18
-- Version du serveur :  5.6.34
-- Version de PHP :  7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `cinems`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `age` date NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  `short_description` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `photo_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `actor`
--

INSERT INTO `actor` (`id`, `firstname`, `lastname`, `age`, `slug`, `short_description`, `description`, `photo_id`, `active`, `created`, `updated`) VALUES
(1, 'testman', 'testman', '2017-04-09', 'ghj', 'sgfshfg', 'dfghgsf', 1, 0, '2017-04-09 00:27:30', '2017-04-09 00:27:31'),
(2, 'testtest', 'estest', '2017-04-09', 'fghfgh', 'fghfghfg', 'fghfgh', 1, 0, '2017-04-09 00:28:13', '2017-04-09 00:28:15');

-- --------------------------------------------------------

--
-- Structure de la table `actor_has_film`
--

CREATE TABLE `actor_has_film` (
  `actor_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `actor_has_film`
--

INSERT INTO `actor_has_film` (`actor_id`, `film_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `note` tinyint(4) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `title`, `content`, `note`, `valid`, `active`, `user_id`, `film_id`, `created`, `updated`) VALUES
(4, 'test', 'test', 5, 1, 1, 6, 5, '2017-04-05 01:19:27', '2017-04-05 01:19:29'),
(21, 'test', 'content', 5, 1, 0, 6, 1, '2017-04-08 17:29:02', '2017-04-08 17:29:02');

-- --------------------------------------------------------

--
-- Structure de la table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `age` date NOT NULL,
  `slug` varchar(100) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `photo_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `send` tinyint(1) NOT NULL,
  `subject` text NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `email`
--

INSERT INTO `email` (`id`, `send`, `subject`, `content`, `user_id`, `created`, `updated`) VALUES
(3, 1, 'Mail oublie de mots de pass', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous avez fait une demande de mots de pass oublié</p>\\n        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>\\n        <p>Si le lien n\'ai plus valable recommançais la demarche.</p>\\n        <a href=\'http://localhost:8888/cinems/user/changepass/b5e1e4691e8aabbc44b9ddb67afff5a2\'>Lien pour changer de mots de pass</a>\\n        ', 6, '2017-05-23 10:56:18', '2017-05-23 10:56:20'),
(4, 1, 'Mail oublie de mots de pass', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous avez fait une demande de mots de pass oublié</p>\\n        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>\\n        <p>Si le lien n\'ai plus valable recommançais la demarche.</p>\\n        <a href=\'http://localhost:8888/cinems/user/changepass/e330ab3f4cf4ac9e4e2be92a287110d7\'>Lien pour changer de mots de pass</a>\\n        ', 6, '2017-05-23 11:01:06', '2017-05-23 11:01:07'),
(5, 1, 'Mail oublie de mots de pass', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous avez fait une demande de mots de pass oublié</p>\\n        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>\\n        <p>Si le lien n\'ai plus valable recommançais la demarche.</p>\\n        <a href=\'http://localhost:8888/cinems/user/checkmail/d669cd380c99d807004d2f49357bd00f\'>Lien pour changer de mots de pass</a>\\n        ', 9, '2017-05-23 11:59:57', '2017-05-23 11:59:58'),
(6, 1, 'Confirme email', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous venez de vous inscrire sur le site CineMS</p>\\n        <p>Nous vous envoyons un lien valable pour confirmer votre compte</p>\\n        <p>Si le lien n\'ai plus contacter l\'admin du site.</p>\\n        <a href=\'http://localhost:8888/cinems/user/checkmail/287614affa1e6983a8922c3de54803ec\'>Lien pour comfirmer votre compte</a>\\n        ', 10, '2017-05-23 12:02:06', '2017-05-23 12:02:07');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  `short_description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `winter_note` tinyint(4) NOT NULL,
  `release_date` date NOT NULL,
  `director_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id`, `title`, `slug`, `short_description`, `content`, `winter_note`, `release_date`, `director_id`, `user_id`, `image_id`, `active`, `created`, `updated`) VALUES
(1, 'testest', 'testset', 'estsetset', 'estsetsetset', 2, '2017-04-09', 1, 6, 1, 1, '2017-04-09 00:29:26', '2017-04-09 14:00:56');

-- --------------------------------------------------------

--
-- Structure de la table `film_has_category`
--

CREATE TABLE `film_has_category` (
  `film_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `title`, `name`, `url`, `created`, `updated`) VALUES
(1, 'test', 'test', '/test/test', '2017-04-02 21:35:53', '2017-04-02 21:35:56'),
(2, 'test2', 'test2', 'test/test', '2017-04-02 22:34:23', '2017-04-02 22:34:25');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `short_description` text NOT NULL,
  `content` text NOT NULL,
  `thumbnail_id` int(11) NOT NULL,
  `winter_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `age` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `roles` varchar(100) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `token_email` varchar(150) NOT NULL,
  `token_password` varchar(150) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pseudo`, `password`, `firstname`, `lastname`, `age`, `status`, `roles`, `active`, `image_id`, `created`, `updated`, `token_email`, `token_password`, `token_expiration`) VALUES
(6, 'cam.laurent@outlook.com', 'camille', '$2y$10$YKu.9fuXQPoa4WURWAOmy.nSOHy.y1Bswws985fnzC0b5oxO0QsG.', 'camille', 'camille', '1990-12-12', 0, '[\"user\"]', 1, 1, '2017-04-01 20:12:41', '2017-05-23 11:01:47', '0', 'e330ab3f4cf4ac9e4e2be92a287110d7', '2017-05-23 11:16:06'),
(7, 'camilletest@mdpcommemail.com', 'campsx', '$2y$10$LMDExot4zDvfzAE3XyOHh.5J/BAdnGkIxVfAs2r2SWbq/5YiYlvEu', 'camille', 'laurent', '1990-12-14', 0, '[\"user\", \"admin\"]', 1, NULL, '2017-05-02 18:56:40', '2017-05-05 12:40:54', '0', 'f145a226383b50b83bf551895712cca6', '2017-05-05 12:55:52'),
(8, 'camille1990@hotildsf.fr', 'camps', '$2y$10$P0jtGBncJN3BQ5oIscRmyOt4vl1DJGHWb1yi.iZXQHvgeKmTOLKRC', 'camille', 'laurent', '1990-12-14', 1, '[\"user\"]', 1, NULL, '2017-05-03 12:41:23', '2017-05-03 14:28:30', '9c695e30b6c8e5b03edc570affab5df7', NULL, NULL),
(10, 'camille1990@hotmail.fr', 'campsxx', '$2y$10$OF0UnxTuzi6f5dz4W2NPxOzTdR02CzhuXmj8m6L/WL4NwulXSg5T6', 'camille', 'laurent', '1990-12-14', 1, '[\"user\"]', 1, NULL, '2017-05-23 12:02:06', '2017-05-23 12:10:44', '287614affa1e6983a8922c3de54803ec', NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Index pour la table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
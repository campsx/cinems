-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mar 13 Juin 2017 à 10:31
-- Version du serveur :  5.6.34
-- Version de PHP :  7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `cinems`
--
CREATE DATABASE IF NOT EXISTS `cinems` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cinems`;

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
  `short_description` text CHARACTER SET utf8,
  `description` text CHARACTER SET utf8,
  `photo_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `actor`
--

TRUNCATE TABLE `actor`;
--
-- Contenu de la table `actor`
--

INSERT INTO `actor` (`id`, `firstname`, `lastname`, `age`, `slug`, `short_description`, `description`, `photo_id`, `active`, `created`, `updated`) VALUES
(5, 'camilllolo', 'laurento', '2017-06-07', 'camiloolo', 'sdfsdfsdf', '<p style=\"text-align:center\">edit un truck</p>\\r\\n', 23, 1, '2017-06-08 17:42:22', '2017-06-09 19:02:56'),
(6, 'koko', 'lemalin', '1990-02-07', 'koko-lemaline', 'spodfjdsmkfqslfjvojna', '<p style=\"text-align:center\"><u><strong>fodsjfmjnd</strong></u></p>\\r\\n\\r\\n<p>c un bon</p>\\r\\n', 11, 1, '2017-06-08 20:46:51', '2017-06-08 20:48:16'),
(7, 'le new', 'le new', '2017-06-06', 'le-new', 'test', '<p>test</p>\\r\\n', 13, 1, '2017-06-09 17:06:53', '2017-06-09 17:09:12'),
(9, 'truetrue', 'truetrue', '2017-06-06', 'truetrue', 'test', NULL, NULL, 1, '2017-06-10 18:11:36', '2017-06-10 18:11:36'),
(10, 'sdhf', 'oisdf', '2017-06-07', 'sdf-sdf', NULL, NULL, NULL, 1, '2017-06-10 18:12:06', '2017-06-10 18:12:06'),
(11, 'tuio', 'ghjk', '2017-06-08', 'ghjkl', NULL, NULL, NULL, 1, '2017-06-10 18:12:21', '2017-06-10 18:12:21'),
(12, 'ftgbjkl', 'rdrtghui', '2017-06-08', 'tfyhi', NULL, NULL, NULL, 1, '2017-06-10 18:12:31', '2017-06-10 18:12:31'),
(13, 'ytgiupk', 'uyhuoijoy', '2017-06-14', 'sdfjsdpofj', NULL, NULL, NULL, 1, '2017-06-10 18:12:42', '2017-06-10 18:12:42'),
(14, 'dijsldfjpo', 'posdjfosidf', '2017-06-07', 'posdfksd', NULL, NULL, NULL, 1, '2017-06-10 18:12:52', '2017-06-10 18:12:52'),
(15, 'sdpfjsdpf', 'pdsojfposd', '2017-06-07', 'posdfsdf', NULL, NULL, NULL, 1, '2017-06-10 18:13:09', '2017-06-10 18:13:09'),
(16, 'oqskdok', 'sqdlk', '2017-06-22', 'sdlfsdfmk', NULL, NULL, NULL, 1, '2017-06-10 18:13:22', '2017-06-10 18:13:22');

-- --------------------------------------------------------

--
-- Structure de la table `actor_has_film`
--

CREATE TABLE `actor_has_film` (
  `actor_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `actor_has_film`
--

TRUNCATE TABLE `actor_has_film`;
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
  `active` smallint(6) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `category`
--

TRUNCATE TABLE `category`;
--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `title`, `active`, `created`, `updated`) VALUES
(1, 'horreur', 1, '2017-06-12 14:31:14', '2017-06-12 14:31:14'),
(2, 'biteeee', 0, '2017-06-12 14:31:52', '2017-06-12 14:31:57');

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
-- Vider la table avant d'insérer `comment`
--

TRUNCATE TABLE `comment`;
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

--
-- Vider la table avant d'insérer `director`
--

TRUNCATE TABLE `director`;
--
-- Contenu de la table `director`
--

INSERT INTO `director` (`id`, `lastname`, `firstname`, `age`, `slug`, `short_description`, `description`, `photo_id`, `active`, `created`, `updated`) VALUES
(1, 'directorman', 'le directoro', '2017-06-15', 'ledirector-man', 'test', '<p style=\"text-align:center\">test</p>\\r\\n', 21, 1, '2017-06-09 18:40:01', '2017-06-09 19:08:04'),
(2, 'lolo', 'didi', '2017-06-07', 'koko', 'dsqsd', '<p>qsd</p>\\r\\n', 24, 1, '2017-06-09 19:09:00', '2017-06-09 19:09:00');

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
-- Vider la table avant d'insérer `email`
--

TRUNCATE TABLE `email`;
--
-- Contenu de la table `email`
--

INSERT INTO `email` (`id`, `send`, `subject`, `content`, `user_id`, `created`, `updated`) VALUES
(3, 1, 'Mail oublie de mots de pass', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous avez fait une demande de mots de pass oublié</p>\\n        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>\\n        <p>Si le lien n\'ai plus valable recommançais la demarche.</p>\\n        <a href=\'http://localhost:8888/cinems/user/changepass/b5e1e4691e8aabbc44b9ddb67afff5a2\'>Lien pour changer de mots de pass</a>\\n        ', 6, '2017-05-23 10:56:18', '2017-05-23 10:56:20'),
(4, 1, 'Mail oublie de mots de pass', '\\n        <h1>Bonjour camille,</h1>\\n        <p>Vous avez fait une demande de mots de pass oublié</p>\\n        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>\\n        <p>Si le lien n\'ai plus valable recommançais la demarche.</p>\\n        <a href=\'http://localhost:8888/cinems/user/changepass/e330ab3f4cf4ac9e4e2be92a287110d7\'>Lien pour changer de mots de pass</a>\\n        ', 6, '2017-05-23 11:01:06', '2017-05-23 11:01:07'),
(6, 1, 'Confirme email de la vie', '<h1>Bonjour camille,</h1>\\r\\n\\r\\n<p>Vous venez de vous inscrire sur le site CineMS</p>\\r\\n\\r\\n<p>Nous vous envoyons un lien valable pour confirmer votre compte</p>\\r\\n\\r\\n<p>Si le lien n&#39;ai plus contacter l&#39;admin du site.</p>\\r\\n\\r\\n<p><a href=\"http://localhost:8888/cinems/user/checkmail/287614affa1e6983a8922c3de54803ec\">Lien pour comfirmer votre compte</a></p>\\r\\n', 10, '2017-05-23 12:02:06', '2017-06-10 17:11:15');

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
-- Vider la table avant d'insérer `film`
--

TRUNCATE TABLE `film`;
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

--
-- Vider la table avant d'insérer `film_has_category`
--

TRUNCATE TABLE `film_has_category`;
-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `media` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `image`
--

TRUNCATE TABLE `image`;
--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `title`, `name`, `url`, `media`, `created`, `updated`) VALUES
(23, 'camiloolo', 'Logo-AH-fond-perdu.png', 'c09acee08bc78081b49a634b7669ace3.png', 0, '2017-06-09 19:02:03', '2017-06-09 19:02:03'),
(11, 'title', 'esgi_paris.jpg', '5cefba5bccd163db7426fd4884162394.jpg', 0, '2017-06-08 20:47:22', '2017-06-08 20:47:22'),
(13, 'title', 'Logo-AH-fond-perdu.png', 'd21426f1e12e2ee4169186c8c97e2518.png', 0, '2017-06-09 17:09:12', '2017-06-09 17:09:12'),
(21, 'ledirector-man', 'Logo-AH-fond-perdu.png', '6c9364c06535325ec3b51f2b72a2db71.png', 0, '2017-06-09 18:40:01', '2017-06-09 18:40:01'),
(19, 'esgi', 'esgi_paris.jpg', '58999fedfdf2e3cfe3815362aa45d46c.jpg', 1, '2017-06-09 18:04:22', '2017-06-09 18:04:22'),
(24, 'koko', 'Logo-AH-fond-perdu.png', 'e86c034290897816d7fd2f6f0e4f3b27.png', 0, '2017-06-09 19:09:00', '2017-06-09 19:09:00'),
(25, 'la-premier-page', 'esgi_paris.jpg', '864e9d0291e6a9316b447460d619236a.jpg', 0, '2017-06-13 10:16:41', '2017-06-13 10:16:41');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `short_description` text,
  `content` text,
  `thumbnail_id` int(11) DEFAULT NULL,
  `winter_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vider la table avant d'insérer `page`
--

TRUNCATE TABLE `page`;
--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `title`, `slug`, `short_description`, `content`, `thumbnail_id`, `winter_id`, `active`, `created`, `updated`) VALUES
(1, 'la premiere page', 'la-premier-page', 'c\'est la premiere page quoi', '<p style=\"text-align:center\">La premier page</p>\\r\\n\\r\\n<p>Tout le monde sais que la premiere page est la meilleure.</p>\\r\\n', 25, 7, 1, '2017-06-13 10:16:41', '2017-06-13 10:16:41');

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
-- Vider la table avant d'insérer `user`
--

TRUNCATE TABLE `user`;
--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pseudo`, `password`, `firstname`, `lastname`, `age`, `status`, `roles`, `active`, `image_id`, `created`, `updated`, `token_email`, `token_password`, `token_expiration`) VALUES
(6, 'cam.laurent@outlook.com', 'camille', '$2y$10$YKu.9fuXQPoa4WURWAOmy.nSOHy.y1Bswws985fnzC0b5oxO0QsG.', 'camille', 'camille', '1990-12-12', 1, '[\"user\", \"admin\"]', 1, NULL, '2017-04-01 20:12:41', '2017-05-23 11:01:47', '0', 'e330ab3f4cf4ac9e4e2be92a287110d7', '2017-05-23 11:16:06'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
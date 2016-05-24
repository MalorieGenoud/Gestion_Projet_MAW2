-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Mai 2016 à 12:34
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bones`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comments_tasks1_idx` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `durations_tasks`
--

DROP TABLE IF EXISTS `durations_tasks`;
CREATE TABLE IF NOT EXISTS `durations_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
  `user_task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_durations_tasks_users_tasks1_idx` (`user_task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `url` varchar(45) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_files_projects1_idx` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(45) NOT NULL,
  `statut` varchar(45) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invitations_users1_idx` (`guest_id`),
  KEY `fk_invitations_users2_idx` (`host_id`),
  KEY `fk_invitations_projects1_idx` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `update_at`) VALUES
(1, 'Web Framework', 'Projet semestriel de framework 2016', '2016-03-11 12:00:00', '2016-03-11 12:00:00'),
(2, 'Graphisme 2', 'Projet semestriel graphisme s2', '2016-02-01 14:00:00', '2016-02-01 14:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `projects_users`
--

DROP TABLE IF EXISTS `projects_users`;
CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_has_users_users1_idx` (`user_id`),
  KEY `fk_projects_has_users_projects_idx` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-02-07 00:00:00', '2016-02-07 00:00:00'),
(2, 1, 2, '2016-02-21 00:00:00', '2016-02-21 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Eleve'),
(2, 'Prof');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `date_jalon` date DEFAULT NULL,
  `statut` varchar(15) NOT NULL,
  `priority` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tasks_projects1_idx` (`project_id`),
  KEY `fk_tasks_tasks1_idx` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `duration`, `date_jalon`, `statut`, `priority`, `project_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(16, 'Analyse', '08:39', '2016-03-03', '', 0, 1, NULL, '2016-05-24 12:04:07', '2016-05-24 12:04:07'),
(17, 'Conception', '11:00', '2016-03-11', '', 0, 1, NULL, '2016-05-24 12:04:29', '2016-05-24 12:04:29'),
(18, 'Rendu', '23:00', '2016-03-11', '', 0, 1, NULL, '2016-05-24 12:06:28', '2016-05-24 12:06:28'),
(19, 'Tests divers', '01:00', '2016-06-12', '', 0, 1, NULL, '2016-05-24 12:06:57', '2016-05-24 12:06:57'),
(20, 'Analyse marketing', '01:40', '2016-03-14', '', 0, 1, 16, '2016-05-24 12:07:34', '2016-05-24 12:07:34'),
(21, 'Analyse 1 concurrent', '01:20', '2016-03-14', '', 0, 1, 16, '2016-05-24 12:10:02', '2016-05-24 12:10:02'),
(22, 'Analyse 2ème concurrent', '01:20', '2016-02-15', '', 0, 1, 16, '2016-05-24 12:10:34', '2016-05-24 12:10:34'),
(23, 'Conception maquettes', '01:00', '2016-02-15', '', 0, 1, 17, '2016-05-24 12:11:13', '2016-05-24 12:11:13'),
(24, 'Conception maquette accueil', '00:30', '2016-02-16', '', 0, 1, 17, '2016-05-24 12:12:02', '2016-05-24 12:12:02'),
(25, 'Conception maquette articles', '00:30', '2016-02-16', '', 0, 1, 17, '2016-05-24 12:12:27', '2016-05-24 12:12:27'),
(26, 'Conception logo', '03:00', '2016-02-21', '', 0, 1, 17, '2016-05-24 12:13:01', '2016-05-24 12:13:01'),
(27, 'Documentation avec CD', '01:00', '2016-06-06', '', 0, 1, 18, '2016-05-24 12:13:38', '2016-05-24 12:13:38'),
(28, 'Conception Controllers/Models', '03:00', '2016-02-22', '', 0, 1, 17, '2016-05-24 12:14:37', '2016-05-24 12:14:37'),
(29, 'Conception Routes', '02:00', '2016-02-22', '', 0, 1, 17, '2016-05-24 12:15:32', '2016-05-24 12:15:32'),
(30, 'Conception view accueil', '08:00', '2016-04-04', '', 0, 1, 17, '2016-05-24 12:16:05', '2016-05-24 12:16:05'),
(31, 'Conception view articles', '12:00', '2016-04-18', '', 0, 1, 17, '2016-05-24 12:16:36', '2016-05-24 12:16:36');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_role1_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `role_id`, `password`, `remember_token`) VALUES
(1, 'Mick', 'Lacombe', 'mick@mick.com', 1, '$2y$10$TY1RuSfyCxs08Y5YYWNCbedFsGWFE5vm5raiJThrR1Fi7hrn2Kd9u', 'SHMTYA0gBULef7qfujVqa13vtAmUGkXzLPemZBIE4j1jX'),
(2, 'Christouf', 'kalmouf', '', 1, '$2y$10$TY1RuSfyCxs08Y5YYWNCbedFsGWFE5vm5raiJThrR1Fi7hrn2Kd9u', 'SHMTYA0gBULef7qfujVqa13vtAmUGkXzLPemZBIE4j1jX'),
(3, 'test', 'test', 'test', 1, '$2y$10$TY1RuSfyCxs08Y5YYWNCbedFsGWFE5vm5raiJThrR1Fi7hrn2Kd9u', 'SHMTYA0gBULef7qfujVqa13vtAmUGkXzLPemZBIE4j1jX');

-- --------------------------------------------------------

--
-- Structure de la table `users_tasks`
--

DROP TABLE IF EXISTS `users_tasks`;
CREATE TABLE IF NOT EXISTS `users_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_has_tasks_tasks1_idx` (`task_id`),
  KEY `fk_users_has_tasks_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  ADD CONSTRAINT `fk_durations_tasks_users_tasks1` FOREIGN KEY (`user_task_id`) REFERENCES `users_tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `fk_invitations_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invitations_users1` FOREIGN KEY (`guest_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invitations_users2` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projects_users`
--
ALTER TABLE `projects_users`
  ADD CONSTRAINT `fk_projects_has_users_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_tasks1` FOREIGN KEY (`parent_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD CONSTRAINT `fk_users_has_tasks_tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_tasks_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

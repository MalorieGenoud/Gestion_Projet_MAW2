-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 04 Mai 2016 à 09:08
-- Version du serveur :  10.1.9-MariaDB
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
-- Structure de la table `durations_tasks`
--

CREATE TABLE `durations_tasks` (
  `id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `user_task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `url` varchar(45) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `token` varchar(45) NOT NULL,
  `statut` varchar(45) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `invitations`
--

INSERT INTO `invitations` (`id`, `token`, `statut`, `guest_id`, `host_id`, `project_id`) VALUES
(3, 'bloup', 'En cours', NULL, 2, 1),
(4, 'bloup', 'En cours', 6, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `startdate` datetime NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `startdate`, `description`) VALUES
(1, 'Gestion de projet', '2016-03-06 00:00:00', 'Création d''une plateforme de gestion de projet avec l''affichage des différents projets, des utilisateurs propres à un projet, etc...'),
(2, 'Robot Rovio', '2015-04-19 00:00:00', 'Contrôle du robot Rovio avec une manette de XBOX 360');

-- --------------------------------------------------------

--
-- Structure de la table `projects_users`
--

CREATE TABLE `projects_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Eleve'),
(2, 'Professeur');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `date_jalon` date DEFAULT NULL,
  `statut` varchar(15) NOT NULL,
  `priority` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `duration`, `date_jalon`, `statut`, `priority`, `project_id`, `parent_id`) VALUES
(1, 'Analyse de sites web', '120 minutes', NULL, 'En cours', 120, 1, NULL),
(2, 'Réunion avec le groupe', '60 minutes', '2016-05-10', 'En attente', 200, 1, 1),
(3, 'Révision du planning', '30 minutes', '2016-05-10', 'En attente', 30, 1, 2),
(4, 'Révision des tâches effectuées', '20 minutes', '2016-05-10', 'En attente', 20, 1, 2),
(5, 'Répartition des nouvelles tâches', '10 minutes', '2016-05-10', 'En attente', 20, 1, 2),
(6, 'Étude de la librairie', '120 minutes', NULL, 'En cours', 50, 2, NULL),
(7, 'Création des maquettes', '160 minutes', '2016-05-11', 'En cours', 40, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `role_id`, `password`) VALUES
(1, 'Yann', 'Saison', 'yann.saison@cpnv.ch', 2, '$2y$10$YGcEU4qbSSsnR9lMyzCCXeTNScmbcG7e7CkEUxPx/OxizOPEO83B2'),
(2, 'Mickaël', 'Lacombe', 'mickael.lacombe@cpnv.ch', 1, '$2y$10$HGxSzCa91.B5MlnsTZmWOe80clN3K84Z2Wm4gOLsuHxyqjW.FQsce'),
(3, 'Aida', 'Sejmenovic', 'aida.sejmenovic@cpnv.ch', 1, '$2y$10$PWUso.nt50E1I5Rbb4o8vOcabTnnuW.aP5.viSIHK44q7w5oz3FJS'),
(4, 'Malorie', 'Genoud', 'malorie.genoud@cpnv.ch', 1, '$2y$10$imFk66G6W79bwj9SAoU6euON0/RYk9vDhoJwMBmwY7edz9VeIUZ2m'),
(5, 'Pascal', 'Hurni', 'pascal.hurni@cpnv.ch', 2, '$2y$10$F2bQH84lHRBDr8xSa/iY4ehFmTMZ4PgIrBhODHBbhl5irGO1QlH5i'),
(6, 'Christophe', 'Kalman', 'christophe.kalman@cpnv.ch', 1, '$2y$10$N91elFMAV6hLdJcja2E2BeSyAzUUVow6jDYdVZlpSFWPalYwEyMQi');

-- --------------------------------------------------------

--
-- Structure de la table `users_tasks`
--

CREATE TABLE `users_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users_tasks`
--

INSERT INTO `users_tasks` (`id`, `user_id`, `task_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 2, 3),
(4, 4, 3),
(5, 4, 6),
(6, 4, 7);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_durations_tasks_users_tasks1_idx` (`user_task_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_files_projects1_idx` (`project_id`);

--
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invitations_users1_idx` (`guest_id`),
  ADD KEY `fk_invitations_users2_idx` (`host_id`),
  ADD KEY `fk_invitations_projects1_idx` (`project_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projects_users`
--
ALTER TABLE `projects_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_has_users_users1_idx` (`user_id`),
  ADD KEY `fk_projects_has_users_projects_idx` (`project_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks_projects1_idx` (`project_id`),
  ADD KEY `fk_tasks_tasks1_idx` (`parent_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role1_idx` (`role_id`);

--
-- Index pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_tasks_tasks1_idx` (`task_id`),
  ADD KEY `fk_users_has_tasks_users1_idx` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `projects_users`
--
ALTER TABLE `projects_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

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

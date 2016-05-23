-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Mai 2016 à 14:49
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
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `users_tasks_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `durations_tasks`
--

CREATE TABLE `durations_tasks` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `update_at`) VALUES
(1, 'Gestion de projet', NULL, '2016-02-01 00:00:00', '2016-05-17 00:00:00'),
(2, 'Robot ROVIO', NULL, '2015-04-12 00:00:00', '2015-06-11 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `projects_users`
--

CREATE TABLE `projects_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2016-02-21 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 4, '2016-02-21 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 5, '2016-02-21 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 3, '2015-04-19 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 6, '2016-05-17 12:34:12', '2016-05-17 12:34:12');

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
(1, 'Professeur'),
(2, 'Eleve');

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
  `parent_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `role_id`, `password`, `remember_token`) VALUES
(1, 'Pascal', 'Hurni', 'pascal.hurni@cpnv.ch', 1, '$2y$10$XC4OPSPsZdTt/COmdVeX0ucwBCNEntKPrzT8VCGGTZBEM8c2Wg9Le\r\n', ''),
(2, 'Yann', 'Saison', 'yann.saison@cpnv.ch', 1, '$2y$10$SSfNLxb9Vt/vWZnVviQ8.e48cRjzIt2JjV5PmRhE4VnJyNFFm9HSm', ''),
(3, 'Malorie', 'Genoud', 'malorie.genoud@cpnv.ch', 2, '$2y$10$oj8U37pWVtmXWelrrccsjuLp5KZy3cktcQgOA.Abe4R/45iKZerXu', 'R84bpNMKv6aM08sPnq2twNB2vPvyBsZHHjowANgqZFd3P'),
(4, 'Mickaël', 'Lacombe', 'mickael.lacombe@cpnv.ch', 2, '$2y$10$EkE1XO5Ad9WEW2WsMkVzeuZF0qhjZMYFbmEH6kEjQzwOUvgz66Yiq', ''),
(5, 'Aida', 'Sejmenovic', 'aida.sejmenovic@cpnv.ch', 2, '$2y$10$ZfFWZdr0o7lh1Pq5iW.OweMQ09bWvJzQdRi0sAzBCXy.nx2uQXYi6', ''),
(6, 'Christophe', 'Kalman', 'christophe.kalman@cpnv.ch', 2, '$2y$10$MqUPJ4R2/3KpH820uSecPOsPUqC7HzGnN6gHahdogu3oCP/.rTYeW', '');

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
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`,`users_tasks_id`),
  ADD KEY `fk_comments_users_tasks1_idx` (`users_tasks_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `projects_users`
--
ALTER TABLE `projects_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_users_tasks1` FOREIGN KEY (`users_tasks_id`) REFERENCES `users_tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

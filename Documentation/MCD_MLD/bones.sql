-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Juin 2016 à 13:40
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
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `durations_tasks`
--

CREATE TABLE `durations_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_task_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ended_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `host_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_06_13_121255_roles', 1),
('2016_06_13_121323_users', 1),
('2016_06_13_121355_projects', 1),
('2016_06_13_121421_tasks', 1),
('2016_06_13_121500_projects_users', 1),
('2016_06_13_121521_users_tasks', 1),
('2016_06_13_121557_durations_tasks', 1),
('2016_06_13_121622_comments', 1),
('2016_06_13_121628_events', 1),
('2016_06_13_121633_files', 2),
('2016_06_13_121639_invitations', 2),
('2016_06_13_121645_targets', 2);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Web Framework', 'Projet semestriel de framework 2016', '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(2, 'Graphisme 2', 'Projet semestriel graphisme s2', '2016-01-31 22:00:00', '2016-01-31 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `projects_users`
--

CREATE TABLE `projects_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `projects_users`
--

INSERT INTO `projects_users` (`id`, `user_id`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(2, 2, 1, '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(3, 3, 2, '2016-01-31 22:00:00', '2016-01-31 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Eleve', NULL, NULL),
(2, 'Prof', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `targets`
--

CREATE TABLE `targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `date_jalon` datetime NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `duration`, `date_jalon`, `status`, `priority`, `project_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Analyse', 1, '2016-06-13 00:00:00', 'en cours', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Conception', 2, '0000-00-00 00:00:00', 'en cours', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Rendu', 1, '0000-00-00 00:00:00', '', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Analyse marketing', 5, '2016-04-26 00:00:00', 'en cours', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Analyse 1 concurent', 10, '0000-00-00 00:00:00', 'en cours', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Analyse 2ème concurent', 12, '0000-00-00 00:00:00', '', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Conception maquettes', 1, '0000-00-00 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Conception maquette accueil', 8, '0000-00-00 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Conception maquette articles', 14, '0000-00-00 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Conception logo', 9, '0000-00-00 00:00:00', '', 3, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Conception Controllers/Models', 15, '0000-00-00 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Conception Routes', 2, '0000-00-00 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Conception view accueil', 1, '0000-00-00 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Conception view articles', 1, '0000-00-00 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Tests divers utilisation', 6, '0000-00-00 00:00:00', '', 3, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'bmhm', 56, '2016-05-04 00:00:00', '', 0, 1, NULL, '2016-06-08 07:43:03', '2016-06-08 07:43:03');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` longtext COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `role_id`, `password`, `remember_token`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Mickael', 'Lacombe', 'lacombe@cpnv.ch', 1, '$2y$10$uDGjD2Pn7mCyEmYzHiL2Q.AlSuOdZlXhvRsat3Q.b2Ml4X.CNJBAK', '96VVElBbfO8qoLknm2bkvKpcssvpa9PVKOfhNPo228qaK', '451443dbcd5da1f4aa1ef42f299b0fd0.jpg', NULL, NULL),
(2, 'Aida', 'Sejmenovic', 'sejmenovic@cpnv.ch', 1, '$2y$10$pyGUmqJ3B7O8XyS/liSGvunTLgJa17bd0LLRPaWkZXDoyff0/0hCK', 'vGyTiTsDwSXtzsMHTXNmf8UtJ5GQBVDWsif7jqTpg7uF0', '', NULL, NULL),
(3, 'Malorie', 'Genoud', 'genoud@cpnv.ch', 1, '$2y$10$q8uc/qM6uqxPYRZO8aFJ8.Cnlz9wN8t3LMlREF36mSxiXVAg6fX1m', 'gKzsUWewDcGFKyKjAjVF4jMzhd1qdzpG13mmceXmjvXfz', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_tasks`
--

CREATE TABLE `users_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_tasks`
--

INSERT INTO `users_tasks` (`id`, `user_id`, `task_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 2, 10, NULL, NULL),
(11, 2, 12, NULL, NULL),
(12, 1, 11, NULL, NULL),
(13, 2, 12, NULL, NULL),
(14, 1, 13, NULL, NULL),
(15, 2, 14, NULL, NULL),
(16, 1, 15, NULL, NULL),
(17, 2, 15, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_id_index` (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_task_id_foreign` (`task_id`);

--
-- Index pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `durations_tasks_id_index` (`id`),
  ADD KEY `durations_tasks_user_task_id_foreign` (`user_task_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_id_index` (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_project_id_foreign` (`project_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_id_index` (`id`),
  ADD KEY `files_project_id_foreign` (`project_id`);

--
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitations_id_index` (`id`),
  ADD KEY `invitations_guest_id_foreign` (`guest_id`),
  ADD KEY `invitations_host_id_foreign` (`host_id`),
  ADD KEY `invitations_project_id_foreign` (`project_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_id_index` (`id`);

--
-- Index pour la table `projects_users`
--
ALTER TABLE `projects_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_users_id_index` (`id`),
  ADD KEY `projects_users_user_id_foreign` (`user_id`),
  ADD KEY `projects_users_project_id_foreign` (`project_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id_index` (`id`);

--
-- Index pour la table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targets_id_index` (`id`),
  ADD KEY `targets_project_id_foreign` (`project_id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_id_index` (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_parent_id_foreign` (`parent_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_index` (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Index pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_tasks_id_index` (`id`),
  ADD KEY `users_tasks_user_id_foreign` (`user_id`),
  ADD KEY `users_tasks_task_id_foreign` (`task_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `projects_users`
--
ALTER TABLE `projects_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `durations_tasks`
--
ALTER TABLE `durations_tasks`
  ADD CONSTRAINT `durations_tasks_user_task_id_foreign` FOREIGN KEY (`user_task_id`) REFERENCES `users_tasks` (`id`);

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Contraintes pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invitations_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invitations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Contraintes pour la table `projects_users`
--
ALTER TABLE `projects_users`
  ADD CONSTRAINT `projects_users_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `projects_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `targets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD CONSTRAINT `users_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `users_tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

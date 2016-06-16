--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Eleve', NULL, NULL),
(2, 'Prof', NULL, NULL);

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `role_id`, `password`, `remember_token`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Mickael', 'Lacombe', 'lacombe@cpnv.ch', 1, '$2y$10$uDGjD2Pn7mCyEmYzHiL2Q.AlSuOdZlXhvRsat3Q.b2Ml4X.CNJBAK', '9epV5kIvB2MUUxdoPoKuCmPOwJculmQWyDbCf7WDLB6NLYiYTkL5jcEwqZsW', '451443dbcd5da1f4aa1ef42f299b0fd0.jpg', NULL, NULL),
(2, 'Aida', 'Sejmenovic', 'sejmenovic@cpnv.ch', 1, '$2y$10$pyGUmqJ3B7O8XyS/liSGvunTLgJa17bd0LLRPaWkZXDoyff0/0hCK', 'vGyTiTsDwSXtzsMHTXNmf8UtJ5GQBVDWsif7jqTpg7uF0', '', NULL, NULL),
(3, 'Malorie', 'Genoud', 'genoud@cpnv.ch', 1, '$2y$10$q8uc/qM6uqxPYRZO8aFJ8.Cnlz9wN8t3LMlREF36mSxiXVAg6fX1m', 'LAJfktKsO6glZzPappmyaIKTNdKEXbFu6wmJNdGtN9ot2AhEJCityW2oe3uO', '', NULL, NULL),
(4, 'Pascal', 'Hurni', 'hurni@cpnv.ch', 2, '$2y$10$d1Fx3qQgWq0SnMPCGKwmtuYma.oZpm0jfvWbJ6vDOeCdT6dtDUS9G', '8ChcMIzgL5uHBccEVZcqpz4nnCPF6FZGUxYL8fb1pgaCWPGb9r560wMRRAsB', '', NULL, NULL);

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `startDate`, `created_at`, `updated_at`) VALUES
(1, 'Web Framework', 'Projet semestriel de framework 2016', '2016-03-10 22:00:00', '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(2, 'Graphisme 2', 'Projet semestriel graphisme s2', '2016-01-31 22:00:00', '2016-01-31 22:00:00', '2016-01-31 22:00:00'),
(3, 'erf', 'gjut', '2016-01-01 00:00:00', '2016-06-15 09:34:55', '2016-06-15 09:34:55');

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `duration`, `date_jalon`, `status`, `priority`, `project_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Analyse', 1, '2016-02-13 00:00:00', 'en cours', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Conception', 2, '2016-03-02 00:00:00', 'en cours', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Rendu', 1, '2016-05-24 00:00:00', '', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Analyse marketing', 5, '2016-04-26 00:00:00', 'en cours', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Analyse 1 concurent', 10, '2016-02-14 00:00:00', 'en cours', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Analyse 2ème concurent', 12, '2016-01-31 00:00:00', '', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Conception maquettes', 1, '2016-02-19 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Conception maquette accueil', 8, '2016-05-01 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Conception maquette articles', 14, '2016-06-13 00:00:00', '', 2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Conception logo', 9, '2016-03-20 00:00:00', '', 3, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Conception Controllers/Models', 15, '2016-02-13 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Conception Routes', 2, '2016-04-23 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Conception view accueil', 1, '2016-06-13 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Conception view articles', 1, '2016-06-13 00:00:00', '', 1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Tests divers utilisation', 6, '2016-06-13 00:00:00', '', 3, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'bmhm', 56, '2016-05-04 00:00:00', '', 0, 1, NULL, '2016-06-08 07:43:03', '2016-06-08 07:43:03');

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
-- Contenu de la table `projects_users`
--

INSERT INTO `projects_users` (`id`, `user_id`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(2, 2, 1, '2016-03-10 22:00:00', '2016-03-10 22:00:00'),
(3, 3, 2, '2016-01-31 22:00:00', '2016-01-31 22:00:00'),
(4, 3, 3, '2016-06-15 09:34:55', '2016-06-15 09:34:55');
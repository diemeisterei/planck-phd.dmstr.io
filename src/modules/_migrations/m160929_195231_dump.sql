INSERT INTO `app_settings` (`id`, `type`, `section`, `key`, `value`, `active`, `created`, `modified`)
VALUES
	(3, 'string', 'docs', 'markdownUrl', 'https://raw.githubusercontent.com/phundament/docs/master', 1, '2016-01-08 16:29:35', '2016-09-29 02:45:33'),
	(4, 'string', 'docs', 'defaultIndexFile', '1-introduction/about.md', 1, '2016-01-08 16:30:35', '2016-09-29 02:45:42'),
	(5, 'string', 'docs', 'forkUrl', 'https://github.com/phundament/docs/edit/master', 1, '2016-01-08 16:31:30', '2016-09-29 02:45:48'),
	(6, 'string', 'docs', 'htmlUrl', 'http://docs.phundament.com/5.0.0-beta3/', 1, '2016-09-29 02:46:55', NULL);

INSERT INTO `app_settings` (`id`, `type`, `section`, `key`, `value`, `active`, `created`, `modified`)
VALUES
	(7, 'string', 'help', 'markdownUrl', 'https://raw.githubusercontent.com/dmstr/docs-phd5/master/help', 1, '2016-10-05 17:06:24', NULL),
	(8, 'string', 'help', 'defaultIndexFile', 'index.md', 1, '2016-10-05 17:07:00', NULL),
	(9, 'string', 'help', 'forkUrl', 'https://github.com/dmstr/docs-phd5/edit/master/help', 1, '2016-10-05 17:08:47', NULL);

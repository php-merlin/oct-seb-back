
CREATE TABLE IF NOT EXISTS `#__cck_more_processings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `type` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(5120) NOT NULL DEFAULT '',
  `options` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `published` tinyint(3) NOT NULL DEFAULT 0,
  `scriptfile` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


INSERT INTO `#__cck_more_processings` (`id`, `title`, `name`, `folder`, `type`, `description`, `options`, `ordering`, `published`, `scriptfile`, `checked_out`, `checked_out_time`) VALUES
(1, 'Core > Site: Customize (Store)', 'customize', 3, 'onCckPostBeforeStore', '', '{"output":"","output_path":"tmp\\/","output_extension":"txt","output_filename_date":"","content_types":"seb_site","manager":{"email":"seb_site_manager_email","password":"seb_site_manager_password","username":"","name":"seb_site_manager_name","first_name":"seb_site_manager_first_name","last_name":"seb_site_manager_last_name","bridge":"0","force_password":"0","set_author":"1"},"type":"6"}', 0, 1, '/media/cck/processings/site/customize/customize.php', 0, '0000-00-00 00:00:00'),
(2, 'Core > Site: Complete', 'complete', 3, 'onCckConstructionBeforeSave', '', '{"output":"","output_path":"tmp\\/","output_extension":"txt","output_filename_date":""}', 0, 1, '/media/cck/processings/site/complete/complete.php', 0, '0000-00-00 00:00:00'),
(3, 'Core > Site: Customize (Import)', 'customize', 3, 'onCckPostBeforeImport', '', '{"output":"","output_path":"tmp\\/","output_extension":"txt","output_filename_date":"","content_types":"seb_site","manager":{"email":"seb_site_manager_email","password":"seb_site_manager_password","username":"","name":"seb_site_manager_name","first_name":"seb_site_manager_first_name","last_name":"seb_site_manager_last_name","bridge":"0","force_password":"0","set_author":"1"},"type":"6"}', 0, 1, '/media/cck/processings/site/customize/customize.php', 0, '0000-00-00 00:00:00'),
(4, 'Base > Nav: Sync', 'sync', 3, 'onContentAfterSave', '', '{}', 0, 1, '/media/cck/processings/nav/sync/sync.php', 0, '0000-00-00 00:00:00'),
(5, 'Core > Item: Watch', 'watch', 3, 'onCckPostBeforeStore', '', '{}', 0, 1, '/media/cck/processings/item/watch/watch.php', 0, '0000-00-00 00:00:00'),
(6, 'Base > Language: Install', 'install', 3, 'onInstallerAfterInstaller', '', '{}', 0, 1, '/media/cck/processings/language/install/install.php', 0, '0000-00-00 00:00:00'),
(7, 'Base > Language: Update', 'update', 3, '0', '', '{}', 0, 1, '/media/cck/processings/language/install/update.php', 0, '0000-00-00 00:00:00'),
(8, 'Core > Site: Delete', 'delete', 3, 'onCckConstructionAfterDelete', '', '{}', 0, 0, '/media/cck/processings/site/delete/delete.php', 0, '0000-00-00 00:00:00');


CREATE TABLE IF NOT EXISTS `#__cck_more_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `type` varchar(50) NOT NULL DEFAULT '',
  `options` text NOT NULL,
  `published` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_extension` (`extension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;

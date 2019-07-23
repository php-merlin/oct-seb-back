
ALTER TABLE `#__cck_core_folders` DROP `asset_id`;

CREATE TABLE IF NOT EXISTS `#__cck_store_item_menu` (
  `id` int(10) unsigned NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `item_request` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `children_type` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cck_store_item_usergroups` (
  `id` int(10) unsigned NOT NULL,
  `visibility_admin` tinyint(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 0,
  `visibility_manager` tinyint(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cck_store_item_viewlevels` (
  `id` int(10) unsigned NOT NULL,
  `access` int(11) NOT NULL DEFAULT 1,
  `content_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
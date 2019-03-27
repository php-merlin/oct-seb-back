
ALTER TABLE `#__cck_core_folders` ADD `params` VARCHAR(1024) NOT NULL AFTER `home`;

ALTER TABLE `#__cck_store_item_content` ADD `archived_mode` TINYINT(3) NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `#__cck_store_item_content` ADD `aliases` TEXT NOT NULL AFTER `archived_mode`;
# TODO ;
ALTER TABLE `#__cck_store_item_content` ADD `snippets` TEXT NOT NULL AFTER `aliases`;
ALTER TABLE `#__cck_store_item_content` ADD `texts` TEXT NOT NULL AFTER `snippets`;
ALTER TABLE `#__cck_store_item_content` ADD `titles` TEXT NOT NULL AFTER `texts`;

ALTER TABLE `#__cck_store_item_categories` ADD `aliases` TEXT NOT NULL AFTER `id`;
# TODO ;
ALTER TABLE `#__cck_store_item_categories` ADD `snippets` TEXT NOT NULL AFTER `aliases`;
ALTER TABLE `#__cck_store_item_categories` ADD `texts` TEXT NOT NULL AFTER `snippets`;
ALTER TABLE `#__cck_store_item_categories` ADD `titles` TEXT NOT NULL AFTER `texts`;


ALTER TABLE `#__cck_core_folders` ADD `params` VARCHAR(1024) NOT NULL AFTER `home`;

ALTER TABLE `#__cck_store_item_content` ADD `archived_mode` TINYINT(3) NOT NULL DEFAULT 0;
ALTER TABLE `#__cck_store_item_content` ADD `aliases` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `meta_desc` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `meta_desc_auto` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `page_title` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `page_title_auto` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `snippets` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `texts` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_content` ADD `titles` TEXT NOT NULL;

ALTER TABLE `#__cck_store_item_categories` ADD `aliases` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `meta_desc` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `meta_desc_auto` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `page_title` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `page_title_auto` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `snippets` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `texts` TEXT NOT NULL;
ALTER TABLE `#__cck_store_item_categories` ADD `titles` TEXT NOT NULL;
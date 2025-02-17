
CREATE TABLE IF NOT EXISTS `#__cck_core` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cck` varchar(50) NOT NULL DEFAULT '',
  `pk` int(10) unsigned NOT NULL DEFAULT 0,
  `pkb` int(10) unsigned NOT NULL DEFAULT 0,
  `storage_location` varchar(50) NOT NULL DEFAULT '',
  `storage_table` varchar(100) NOT NULL DEFAULT '',
  `author_id` int(10) unsigned NOT NULL DEFAULT 0,
  `author_session` varchar(191) NOT NULL DEFAULT '',
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `store_id` int(10) unsigned NOT NULL DEFAULT 0,
  `download_hits` int(10) unsigned NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `app` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_cck` (`cck`),
  KEY `idx_pk` (`pk`),
  KEY `idx_pkb` (`pkb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_downloads` (
  `id` int(10) unsigned NOT NULL,
  `field` varchar(50) NOT NULL DEFAULT '',
  `collection` varchar(50) NOT NULL DEFAULT '',
  `x` int(11) NOT NULL DEFAULT 0,
  `hits` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`field`,`collection`,`x`),
  KEY `idx_contentid` (`id`),
  KEY `idx_item` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `type` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(5120) NOT NULL DEFAULT '',
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `label` varchar(50) NOT NULL DEFAULT '',
  `language` char(7) NOT NULL DEFAULT '*',
  `selectlabel` varchar(50) NOT NULL DEFAULT '',
  `display` int(11) NOT NULL DEFAULT 0,
  `required` varchar(50) NOT NULL DEFAULT '',
  `validation` varchar(50) NOT NULL DEFAULT '',
  `defaultvalue` text NOT NULL,
  `options` text NOT NULL COMMENT 'string-formated options',
  `options2` text NOT NULL COMMENT 'json-formated options',
  `minlength` int(11) NOT NULL DEFAULT 0,
  `maxlength` int(11) NOT NULL DEFAULT 255,
  `size` int(11) NOT NULL DEFAULT 32,
  `cols` int(11) NOT NULL DEFAULT 0,
  `rows` int(11) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `sorting` int(11) NOT NULL DEFAULT 0,
  `divider` varchar(50) NOT NULL DEFAULT '',
  `bool` tinyint(3) NOT NULL DEFAULT 0,
  `location` varchar(1024) NOT NULL DEFAULT '',
  `extended` varchar(50) NOT NULL DEFAULT '',
  `style` varchar(512) NOT NULL DEFAULT '',
  `script` text NOT NULL,
  `bool2` tinyint(3) NOT NULL DEFAULT 0,
  `bool3` tinyint(3) NOT NULL DEFAULT 0,
  `bool4` tinyint(3) NOT NULL DEFAULT 0,
  `bool5` tinyint(3) NOT NULL DEFAULT 0,
  `bool6` tinyint(3) NOT NULL DEFAULT 0,
  `bool7` tinyint(3) NOT NULL DEFAULT 0,
  `bool8` tinyint(3) NOT NULL DEFAULT 1,
  `css` varchar(255) NOT NULL DEFAULT '',
  `attributes` varchar(512) NOT NULL DEFAULT '',
  `storage` varchar(50) NOT NULL DEFAULT '',
  `storage_cck` varchar(50) NOT NULL DEFAULT '',
  `storage_location` varchar(50) NOT NULL DEFAULT '',
  `storage_table` varchar(100) NOT NULL DEFAULT '',
  `storage_field` varchar(50) NOT NULL DEFAULT '',
  `storage_field2` varchar(50) NOT NULL DEFAULT '',
  `storage_filter` varchar(50) NOT NULL DEFAULT '',
  `storage_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `storage_mode` tinyint(3) NOT NULL DEFAULT 0,
  `storages` varchar(2048) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_type` (`type`),
  KEY `idx_folder` (`folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5000 ;


INSERT INTO `#__cck_core_fields` (`id`, `title`, `name`, `folder`, `type`, `description`, `published`, `label`, `language`, `selectlabel`, `display`, `required`, `validation`, `defaultvalue`, `options`, `options2`, `minlength`, `maxlength`, `size`, `cols`, `rows`, `ordering`, `sorting`, `divider`, `bool`, `location`, `extended`, `style`, `script`, `bool2`, `bool3`, `bool4`, `bool5`, `bool6`, `bool7`, `bool8`, `css`, `attributes`, `storage`, `storage_cck`, `storage_location`, `storage_table`, `storage_field`, `storage_field2`, `storage_filter`, `storage_key`, `storage_mode`, `storages`, `checked_out`, `checked_out_time`) VALUES
(1, 'Core Content Type', 'cck', 3, 'select_dynamic', '', 1, 'Type', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(2, 'Core Object', 'cck_storage_location', 3, 'select_dynamic', '', 1, 'Storage Location', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__extensions\",\"name\":\"element\",\"where\":\"folder=\\\"cck_storage_location\\\" AND enabled=1\",\"value\":\"element\",\"orderby\":\"element\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'storage_location', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(3, 'Core Table', 'cck_storage_table', 3, 'text', '', 1, '', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'standard', '', 'free', '#__cck_core', 'storage_table', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(4, 'Core Author ID', 'cck_author_id', 3, 'text', '', 1, 'Author ID', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'standard', '', 'free', '#__cck_core', 'author_id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(5, 'Core Parent ID', 'cck_parent_id', 3, 'text', '', 1, 'Parent ID', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'standard', '', 'free', '#__cck_core', 'parent_id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(6, 'Core Date Time', 'cck_date_time', 3, 'text', '', 1, 'Date Time', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'standard', '', 'free', '#__cck_core', 'date_time', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(7, 'Core Content Type (2)', 'cck_2', 3, 'select_dynamic', '', 1, 'Type', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(8, 'Core Content Type (3)', 'cck_3', 3, 'select_dynamic', '', 1, 'Type', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(9, 'Core ID', 'cck_id', 3, 'text', '', 1, 'ID', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'standard', '', 'free', '#__cck_core', 'id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(10, 'Core Label', 'core_label', 3, 'text', '', 0, 'Label', '*', '', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'label', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(11, 'Core Size', 'core_size', 3, 'text', '', 0, 'Size', '*', '', 3, '', '', '32', '', '', 0, 3, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'size', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(12, 'Core DefaultValue', 'core_defaultvalue', 3, 'text', '', 0, 'Default Value', '*', '', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'defaultvalue', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(13, 'Core Minlength', 'core_minlength', 3, 'text', '', 0, 'Minlength', '*', '', 3, '', '', '0', '', '', 0, 50, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'minlength', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(14, 'Core Maxlength', 'core_maxlength', 3, 'text', '', 0, 'Maxlength', '*', ' ', 3, '', '', '255', '', '', 0, 50, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'maxlength', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(15, 'Core Sorting', 'core_sorting', 3, 'select_simple', '', 0, 'Ordering', '*', ' ', 3, '', '', '0', 'Following Options=0||Alphabetical AZ=1||Alphabetical ZA=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'sorting', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(16, 'Core Selectlabel', 'core_selectlabel', 3, 'text', '', 0, 'Select Label', '*', '', 3, '', '', 'Select', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'selectlabel', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(17, 'Core Options', 'core_options', 3, 'field_x', '', 0, 'Options', '*', ' ', 3, '', '', '', '', '', 1, 255, 32, 0, 2, 0, 0, '', 0, '', 'core_option', '', '', 1, 1, 1, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'string[options]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(18, 'Core Rows', 'core_rows', 3, 'text', '', 0, 'Rows', '*', ' ', 3, '', '', '0', '', '', 0, 50, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'rows', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(19, 'Core Columns', 'core_columns', 3, 'text', '', 0, 'Columns', '*', ' ', 3, '', '', '25', '', '', 0, 50, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'cols', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(20, 'Core Options Format', 'core_options_format', 3, 'text', '', 0, 'Format', '*', ' ', 3, 'required', '', 'Y-m-d', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][format]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(21, 'Core Color', 'core_color', 3, 'colorpicker', '', 0, 'Color', '*', ' ', 3, '', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(22, 'Core Colorchar', 'core_colorchar', 3, 'colorpicker', '', 0, 'Character Color', '*', ' ', 3, '', '', '#ffffff', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'colorchar', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(23, 'Core Introchar', 'core_introchar', 3, 'text', '', 0, 'Character', '*', '', 3, '', '', '', '', '', 0, 2, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'introchar', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(24, 'Core Type (Template)', 'core_type_template', 3, 'select_simple', '', 0, 'Type', '*', ' ', 3, '', '', '0', 'Content Form=0||List=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'tabindex=\"3\"', 'dev', '', '', '', 'mode', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(25, 'Core Extended', 'core_extended', 3, 'text', '', 0, 'Field', '*', '', 3, 'required', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'extended', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(26, 'Core Required', 'core_required', 3, 'select_simple', '', 0, 'Required', '*', ' ', 3, '', '', '0', 'No=||Yes=required', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'required', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(27, 'Core Title (Field)', 'core_title_field', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 80, 28, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(29, 'Core Storage Table', 'core_storage_table', 3, 'select_dynamic', '', 0, 'Table', '*', 'Select a Table', 3, '', '', '', 'Aka Join Tables for Search=optgroup||Placeholder Table1=aka_table1||Placeholder Table2=aka_table2||Placeholder Table3=aka_table3', '{}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 2, 0, 2, 0, 0, 0, 1, '', 'style=\"max-width:200px;\"', 'dev', '', '', '', 'storage_table', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(30, 'Core Validation Alert', 'core_validation_alert', 3, 'text', '', 0, 'Alert', '*', '', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'alert', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(31, 'Core Validation Field', 'core_validation_field', 3, 'text', '', 0, 'Field', '*', '', 3, 'required', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(32, 'Core Script', 'core_script', 3, 'textarea', '', 0, 'Script', '*', ' ', 3, '', '', '', '', '', 0, 0, 32, 100, 5, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'script', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(33, 'Core Storage', 'core_storage', 3, 'storage', '', 0, 'Storage', '*', '', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'storage', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(34, 'Core Storage Field', 'core_storage_field', 3, 'text', '', 0, 'Field', '*', ' ', 3, '', '', '', '', '', 0, 50, 26, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'storage_field', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(35, 'Core Name (Template)', 'core_name_template', 3, 'select_dynamic', '', 0, 'Name', '*', 'Select Template', 3, 'required', '', '', '', '{\"query\":\"\",\"table\":\"#__extensions\",\"name\":\"name\",\"where\":\"type=\\\"template\\\" AND name NOT IN (\\\"atomic\\\",\\\"beez5\\\",\\\"beez_20\\\",\\\"bluestork\\\",\\\"hathor\\\")\",\"value\":\"name\",\"orderby\":\"name\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'tabindex=\"2\"', 'dev', '', '', '', 'name', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(36, 'Core Name (Field)', 'core_name_field', 3, 'text', '', 0, 'Name', '*', ' ', 3, 'required', '', '', '', '', 0, 80, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"2\"', 'dev', '', '', '', 'name', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(37, 'Core Title (Template)', 'core_title_template', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 28, 0, 0, 0, 0, '', 0, '', '', '', 'if(!$(\"#title\").val()){ $(\"#title\").focus(); }', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"1\"', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(38, 'Core Title (Type)', 'core_title_type', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 28, 0, 0, 0, 0, '', 0, '', '', '', '$(\"#title\").on(\"change\", function() {\r\n  if ( !$(\"#name\").val() ) {\r\n    JCck.DevHelper.transliterateName();\r\n  }\r\n}); if( !$(\"#title\").val() ) { $(\"#title\").focus(); }', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"1\"', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(39, 'Core Title (Search)', 'core_title_search', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 80, 28, 0, 0, 0, 0, '', 0, '', '', '', '$(\"#title\").on(\"change\", function() {\r\n  if ( !$(\"#name\").val() ) {\r\n    JCck.DevHelper.transliterateName();\r\n  }\r\n}); if( !$(\"#title\").val() ) { $(\"#title\").focus(); }', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"1\"', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(40, 'Core Description', 'core_description', 3, 'wysiwyg_editor', '', 0, 'Description', '*', ' ', 3, '', '', '', '', '{\"editor\":\"tinymce\",\"width\":\"100%\",\"height\":\"167\",\"import\":\"\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'description', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(42, 'Core State Filter', 'core_state_filter', 3, 'select_simple', '', 0, 'Status', '*', ' ', 3, '', '', '', 'All Status SL=-1||On=1||Off=0', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'onchange=\"this.form.submit()\"', 'dev', '', '', '', 'filter_state', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(43, 'Core State', 'core_state', 3, 'radio', '', 0, 'clear', '*', ' ', 3, '', '', '', 'On=1||Off=0', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 'btn-group btn-group-yesno', '', 'dev', '', '', '', 'published', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(44, 'Core Attributes', 'core_attributes', 3, 'textarea', '', 0, 'Attributes', '*', ' ', 3, '', '', '', '', '', 0, 512, 32, 92, 1, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'attributes', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(47, 'Core Type Filter (Template)', 'core_type_filter_template', 3, 'select_simple', '', 0, 'Type', '*', ' ', 3, '', '', '', 'All Types SL=||Content Form=0||List=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'onchange=\"this.form.submit()\"', 'dev', '', '', '', 'filter_mode', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(51, 'Core Title (Folder)', 'core_title_folder', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 28, 0, 0, 0, 0, '', 0, '', '', '', 'if(!$(\"#title\").val()){ $(\"#title\").focus(); }', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"1\"', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(52, 'Core Template Admin', 'core_template_admin', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_admin', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(53, 'Core Template Site', 'core_template_site', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_site', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(54, 'Core Template Content', 'core_template_content', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_content', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(55, 'Core Template Params', 'core_template_params', 3, 'text', '', 0, 'Params', '*', '', 3, '', '', '', '', '', 0, 0, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'template_params', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(56, 'Core Template', 'core_template', 3, 'select_dynamic', '', 0, 'Template', '*', ' ', 3, '', '', '', '', '{\"query\":\"SELECT DISTINCT a.template AS value, CONCAT(b.title,\\\" - \\\",b.name) AS text FROM #__template_styles AS a LEFT JOIN #__cck_core_templates AS b ON b.name = a.template WHERE b.id AND b.published !=-44 AND b.mode=0 ORDER BY b.title\",\"table\":\"\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, '', 'onchange=\"JCck.DevHelper.doSubmit();\" style=\"max-width:190px;\"', 'dev', '', '', '', 'template', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(58, 'Core Content Type', 'core_content_type', 3, 'select_dynamic', '', 0, 'Content Type', '*', 'Select', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published = 1 AND location NOT IN(\\\"admin\\\",\\\"none\\\",\\\"collection\\\")\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', 'var e=\"type\"; var elem=\"#jform_trigger_\"+e;\r\nvar file=\"file=administrator/components/com_cck/helpers/scripts/list_live.php\";\r\n$(elem).change(function() {\r\nif (!$(\"#jform_title\").val()) {\r\n$(\"#jform_title\").val($(elem+\" option[value=\\\'\"+$(elem).val()+\"\\\']\").text());\r\n}\r\nvar type = \"&e_name=\"+$(elem).val();\r\nvar live = \"&live=\"+$(\"#jform_params_live\").val();\r\nvar variat = \"&variat=\"+$(\"#jform_params_variation\").val();\r\n $.ajax({\r\n  cache: false, data: file+\"&referrer=component.com_cck\"+type+live+variat+\"&elem=\"+e, type: \"POST\",\r\n  url: \"index.php?option=com_cck&task=ajax&format=raw&\"+Joomla.getOptions(\"csrf.token\")+\"=1\",\r\n  success: function(response){ $(\"#list_live_show\").html(response); } });\r\n});\r\nvar type = \"&e_name=\"+$(elem).val();\r\nvar live = \"&live=\"+$(\"#jform_params_live\").val();\r\nvar variat = \"&variat=\"+$(\"#jform_params_variation\").val();\r\n $.ajax({\r\n  cache: false, data: file+\"&referrer=component.com_cck\"+type+live+variat+\"&elem=\"+e, type: \"POST\",\r\n  url: \"index.php?option=com_cck&task=ajax&format=raw&\"+Joomla.getOptions(\"csrf.token\")+\"=1\",\r\n  success: function(response){ $(\"#list_live_show\").html(response); } });', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(59, 'Core Search Type', 'core_search_type', 3, 'select_dynamic', '', 0, 'Search Type', '*', 'Select', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_searchs\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', 'var e=\"search\"; var elem=\"#jform_trigger_\"+e;\r\nvar file=\"file=administrator/components/com_cck/helpers/scripts/list_live.php\";\r\n$(elem).change(function() {\r\nif (!$(\"#jform_title\").val()) {\r\n$(\"#jform_title\").val($(elem+\" option[value=\\\'\"+$(elem).val()+\"\\\']\").text());\r\n}\r\nvar type = \"&e_name=\"+$(elem).val();\r\nvar live = \"&live=\"+$(\"#jform_params_live\").val();\r\nvar variat = \"&variat=\"+$(\"#jform_params_variation\").val();\r\n $.ajax({\r\n  cache: false, data: file+\"&referrer=component.com_cck\"+type+live+variat+\"&elem=\"+e, type: \"POST\",\r\n  url: \"index.php?option=com_cck&task=ajax&format=raw&\"+Joomla.getOptions(\"csrf.token\")+\"=1\",\r\n  success: function(response){ $(\"#list_live_show\").html(response); } });\r\n});\r\nvar type = \"&e_name=\"+$(elem).val();\r\nvar live = \"&live=\"+$(\"#jform_params_live\").val();\r\nvar variat = \"&variat=\"+$(\"#jform_params_variation\").val();\r\n $.ajax({\r\n  cache: false, data: file+\"&referrer=component.com_cck\"+type+live+variat+\"&elem=\"+e, type: \"POST\",\r\n  url: \"index.php?option=com_cck&task=ajax&format=raw&\"+Joomla.getOptions(\"csrf.token\")+\"=1\",\r\n  success: function(response){ $(\"#list_live_show\").html(response); } });', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'search', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(60, 'Core Options Math', 'core_options_math', 3, 'select_simple', '', 0, 'Math', '*', ' ', 3, '', '', '0', 'Sum=0||Product=1||Difference=2||Quotient=3', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][math]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(61, 'Core Options Last', 'core_options_last', 3, 'text', '', 0, 'Last Optional', '*', ' ', 3, '', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][last]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(62, 'Core Options End', 'core_options_end', 3, 'text', '', 0, 'End', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][end]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(63, 'Core Options Step', 'core_options_step', 3, 'text', '', 0, 'Step', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][step]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(64, 'Core Options Start', 'core_options_start', 3, 'text', '', 0, 'Start', '*', ' ', 3, 'required', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][start]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(65, 'Core Options First', 'core_options_first', 3, 'text', '', 0, 'First Optional', '*', ' ', 3, '', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][first]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(69, 'Core Elements', 'core_elements', 3, 'checkbox', '', 0, 'Elements', '*', ' ', 3, '', '', 'type,field,search,template', 'Content Type=type||Field=field||Search Type=search||Template=template', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'elements', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(70, 'Core Depth Filter', 'core_depth_filter', 3, 'select_numeric', '', 0, 'Depth', '*', ' ', 3, '', '', '', '', '{\"math\":\"0\",\"first\":\"#\",\"start\":\"1\",\"step\":\"1\",\"end\":\"10\",\"last\":\"\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'onchange=\"this.form.submit()\"', 'dev', '', '', '', 'filter_depth', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(71, 'Core Bool', 'core_bool', 3, 'select_simple', '', 0, 'clear', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(72, 'Core Bool2', 'core_bool2', 3, 'select_simple', '', 0, 'clear', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool2', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(73, 'Core Bool3', 'core_bool3', 3, 'select_simple', '', 0, 'clear', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool3', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(74, 'Core Bool4', 'core_bool4', 3, 'select_simple', '', 0, 'clear', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool4', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(75, 'Core Storage Alter', 'core_storage_alter', 3, 'checkbox', '', 0, 'Alter', '*', ' ', 3, '', '', '0', 'Alter Table=1', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'storage_alter', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(76, 'Core Storage Alter Type', 'core_storage_alter_type', 3, 'select_simple', '', 0, 'Alter', '*', 'Select', 3, '', '', 'VARCHAR(255)', 'Boolean=BOOLEAN||Date=DATE||Datetime=DATETIME||Decimal 10 2=DECIMAL(10,2)||Decimal 10 3=DECIMAL(10,3)||Decimal 10 4=DECIMAL(10,4)||Decimal 10 8=DECIMAL(10,8)||Decimal 11 8=DECIMAL(11,8)||Int 11=INT(11)||Varchar 7=VARCHAR(7)||Varchar 38=VARCHAR(38)||Varchar 50=VARCHAR(50)||Varchar 255=VARCHAR(255)||Varchar 512=VARCHAR(512)||Varchar 1024=VARCHAR(1024)||Varchar 2048=VARCHAR(2048)||Text=TEXT||Timestamp=TIMESTAMP||Tinyint 3=TINYINT(3)', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'storage_alter_type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(77, 'Core Options Value', 'core_options_value', 3, 'text', '', 0, 'Options Value', '*', ' ', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][value]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(78, 'Core Options Name', 'core_options_name', 3, 'text', '', 0, 'Options Name', '*', ' ', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][name]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(79, 'Core Options Where', 'core_options_where', 3, 'text', '', 0, 'Where', '*', ' ', 3, '', '', '', '', '', 0, 0, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][where]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(80, 'Core Options Table', 'core_options_table', 3, 'text', '', 0, 'Table', '*', ' ', 3, '', '', '#__content', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][table]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(81, 'Core Query', 'core_query', 3, 'select_simple', '', 0, 'Query', '*', ' ', 3, '', '', '0', 'Construction=0||Free=1||Function=optgroup||Query getTableList=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool2', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(82, 'Core Options Query', 'core_options_query', 3, 'textarea', '', 0, 'SQL Query', '*', ' ', 3, '', '', '', '', '', 0, 0, 50, 92, 8, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[options2][query]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(83, 'Core Orientation', 'core_orientation', 3, 'select_simple', '', 0, 'Orientation', '*', ' ', 3, '', '', '0', 'Horizontal=0||Vertical=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(84, 'Core Option', 'core_option', 3, 'text', '', 0, 'Option', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 2, 0, 0, '', 0, '', 'core_options', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(85, 'Core Separator', 'core_separator', 3, 'text', '', 0, 'Separator', '*', ' ', 3, '', '', ',', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'divider', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(86, 'Core Field Orientation', 'core_field_orientation', 3, 'select_simple', '', 0, 'Orientation', '*', ' ', 3, '', '', 'vertical', 'Horizontal=horizontal||Vertical=vertical', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_orientation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(87, 'Core Field Label Width', 'core_field_label_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '145px', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_label_width', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(88, 'Core Background Color', 'core_background_color', 3, 'colorpicker', '', 0, 'Background Color', '*', ' ', 3, '', '', 'none', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'background_color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(89, 'Core Border Color', 'core_border_color', 3, 'colorpicker', '', 0, 'Border Color', '*', ' ', 3, '', '', '#dedede', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'border_color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(90, 'Core Border Size', 'core_border_size', 3, 'select_numeric', '', 0, 'Border Size', '*', ' ', 3, '', '', '0', '', '{\"math\":\"0\",\"first\":\"0\",\"start\":\"1\",\"step\":\"1\",\"end\":\"10\",\"last\":\"\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'border_size', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(91, 'Core Border Radius', 'core_border_radius', 3, 'select_numeric', '', 0, 'Border Radius', '*', ' ', 3, '', '', '5', '', '{\"math\":\"0\",\"first\":\"0\",\"start\":\"1\",\"step\":\"1\",\"end\":\"10\",\"last\":\"\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'border_radius', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(92, 'Core Legend Align', 'core_legend_align', 3, 'select_simple', '', 0, 'Align', '*', ' ', 3, '', '', 'left', 'Center=center||Left=left||Right=right', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', 'joomla_article', '', 'legend_align', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(93, 'Core Legend Typo', 'core_legend_typo', 3, 'select_simple', '', 0, 'Typo', '*', 'Default', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', 'joomla_article', '#__content', 'legend_typo', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(94, 'Core Position Left', 'core_position_left', 3, 'text', '', 0, 'Left Column Width', '*', ' ', 3, '', '', '0', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_left', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(95, 'Core Position Right', 'core_position_right', 3, 'text', '', 0, 'Right Column Width', '*', ' ', 3, '', '', '400', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_right', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(96, 'Core Position Top', 'core_position_top', 3, 'select_simple', '', 0, 'Top Line', '*', ' ', 3, '', '', '1', 'No=0||Height=optgroup||Auto=1||Deepest=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'position_top', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(97, 'Core Position Bottom', 'core_position_bottom', 3, 'select_simple', '', 0, 'Bottom Line', '*', ' ', 3, '', '', '1', 'No=0||Height=optgroup||Auto=1||Deepest=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'position_bottom', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(98, 'Core Position Header', 'core_position_header', 3, 'select_simple', '', 0, 'Header Line', '*', ' ', 3, '', '', '0', 'No=0||Height=optgroup||Auto=1||Deepest=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'position_header', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(99, 'Core Position Footer', 'core_position_footer', 3, 'select_simple', '', 0, 'Footer Line', '*', ' ', 3, '', '', '0', 'No=0||Height=optgroup||Auto=1||Deepest=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'position_footer', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(100, 'Core Position Left Variation', 'core_position_left_variation', 3, 'text', '', 0, 'Left Column Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_left_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(101, 'Core Position Right Variation', 'core_position_right_variation', 3, 'text', '', 0, 'Right Column Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_right_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(102, 'Core Position Top Variation', 'core_position_top_variation', 3, 'text', '', 0, 'Top Line Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_top_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(103, 'Core Position Bottom Variation', 'core_position_bottom_variation', 3, 'text', '', 0, 'Bottom Line Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_bottom_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(104, 'Core Position Header Variation', 'core_position_header_variation', 3, 'text', '', 0, 'Header Line Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_header_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(105, 'Core Positon Footer Variation', 'core_position_footer_variation', 3, 'text', '', 0, 'Position Footer Variation', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_footer_variation', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(108, 'Core Options Editor', 'core_options_editor', 3, 'select_dynamic', '', 0, 'Editor', '*', 'Use Default', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__extensions\",\"name\":\"element\",\"where\":\"type = \\\"plugin\\\" AND folder = \\\"editors\\\"\",\"value\":\"element\",\"orderby\":\"element\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][editor]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(109, 'Core Place', 'core_place', 3, 'select_simple', '', 0, 'Mode', '*', ' ', 3, '', '', '1', 'Default=1||Modal Box=0', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(110, 'Core Options Path', 'core_options_path', 3, 'text', '', 0, 'Folder', '*', ' ', 3, '', '', 'images/', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][path]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(111, 'Core Options Path (Content)', 'core_options_path_content', 3, 'select_simple', '', 0, 'Path per Content', '*', ' ', 3, '', '', '1', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][path_content]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(112, 'Core Options Path (User)', 'core_options_path_user', 3, 'select_simple', '', 0, 'Path per User', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][path_user]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(113, 'Core Options Preview Image', 'core_options_preview_image', 3, 'select_simple', '', 0, 'Show Preview', '*', ' ', 3, '', '', '0', 'Hide=-1||Show=optgroup||Filename Title=0||Icon=1||Image=2||Thumb1=3||Thumb2=4||Thumb3=5||Thumb4=6||Thumb5=7||Thumb6=8||Thumb7=9||Thumb8=10||Thumb9=11||Thumb10=12', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][preview]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(114, 'Core Options Legal Extensions Image', 'core_options_legal_extensions_image', 3, 'text', '', 0, 'Legal Extensions', '*', ' ', 3, '', '', 'gif,jpg,png,GIF,JPG,PNG', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][legal_extensions]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(115, 'Core Options Max Size', 'core_options_max_size', 3, 'text', '', 0, 'Maximum Size', '*', ' ', 3, '', '', '5', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][max_size]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(116, 'Core Options Delete Box', 'core_options_delete_box', 3, 'select_simple', '', 0, 'Delete Box', '*', ' ', 3, '', '', '1', 'Hide=0||Show=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][delete_box]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(117, 'Core Options Thumb Process', 'core_options_thumb_process', 3, 'select_simple', '', 0, 'Thumb', '*', ' ', 3, '', '', 'maxfit', 'No Process=0||Resized=optgroup||Crop Center=crop||Shrink=shrink||Stretch=stretch||Resized Dynamic=optgroup||Crop Dynamic=crop_dynamic||Max Fit=maxfit||Shrink=shrink_dynamic||Stretch=stretch_dynamic', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'max-width-190', '', 'dev', '', '', '', 'json[options2][thumb1_process]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(118, 'Core Options Thumb Width', 'core_options_thumb_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '150', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'style=\"text-align: center\"', 'dev', '', '', '', 'json[options2][thumb1_width]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(119, 'Core Options Thumb Height', 'core_options_thumb_height', 3, 'text', '', 0, 'Height', '*', ' ', 3, '', '', '150', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'style=\"text-align: center\"', 'dev', '', '', '', 'json[options2][thumb1_height]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(120, 'Core Options Image Process', 'core_options_image_process', 3, 'select_simple', '', 0, 'Image', '*', 'Original', 3, '', '', '', 'Resized=optgroup||Crop Center=crop||Shrink=shrink||Stretch=stretch||Resized Dynamic=optgroup||Crop Dynamic=crop_dynamic||Max Fit=maxfit||Shrink=shrink_dynamic||Stretch=stretch_dynamic', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'max-width-190', '', 'dev', '', '', '', 'json[options2][image_process]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(121, 'Core Options Image Width', 'core_options_image_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '200', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'style=\"text-align: center\"', 'dev', '', '', '', 'json[options2][image_width]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(122, 'Core Options Image Height', 'core_options_image_height', 3, 'text', '', 0, 'Height', '*', ' ', 3, '', '', '200', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'style=\"text-align: center\"', 'dev', '', '', '', 'json[options2][image_height]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(123, 'Core Options Send', 'core_options_send', 3, 'select_simple', '', 0, 'Send Email', '*', ' ', 3, '', '', '0', 'Never=0||Always=3||Workflow=optgroup||Add=1||Edit=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][send]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(124, 'Core Options From', 'core_options_from', 3, 'select_simple', '', 0, 'From', '*', 'Use Global', 3, '', '', '', 'Email=1||Field=3', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][from]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(125, 'Core Options To Admin', 'core_options_to_admin', 3, 'select_dynamic', '', 0, 'To Admin', '*', ' ', 3, '', '', '', '', '{\"query\":\"SELECT us.username AS text, us.id AS value FROM #__users us, #__user_usergroup_map gr WHERE gr.group_id = 8 AND gr.user_id = us.id\",\"table\":\"#__content\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 6, 0, 0, ',', 0, '', '', '', '', 1, 1, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][to_admin]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(126, 'Core Options To', 'core_options_to', 3, 'textarea', '', 0, 'To', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[options2][to]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(127, 'Core Options To Field', 'core_options_to_field', 3, 'textarea', '', 0, 'To Field', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[options2][to_field]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(128, 'Core Options Message', 'core_options_message', 3, 'wysiwyg_editor', '', 0, 'Message', '*', ' ', 3, '', '', '', '', '{\"editor\":\"tinymce\",\"width\":\"100%\",\"height\":\"167\",\"import\":\"\"}', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][message]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(129, 'Core Options Subject', 'core_options_subject', 3, 'text', '', 0, 'Subject', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][subject]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(130, 'Core Options From Param', 'core_options_from_param', 3, 'text', '', 0, 'From Param', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][from_param]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(131, 'Core Options Legal Extensions', 'core_options_legal_extensions', 3, 'text', '', 0, 'Legal Extensions', '*', ' ', 3, '', '', 'doc,pdf,ppt,xls,zip,DOC,PDF,PPT,XLS,ZIP', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][legal_extensions]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(132, 'Core Options Preview', 'core_options_preview', 3, 'select_simple', '', 0, 'Show Preview', '*', ' ', 3, '', '', '0', 'Hide=-1||Show=optgroup||Filename Title=0||Icon=1||Show No Link=optgroup||Filename Title=8', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][preview]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(133, 'Core Options Import', 'core_options_import', 3, 'select_simple', '', 0, 'Importer', '*', 'None', 3, '', '', '', 'Wysiwyg Auto=1||Wysiwyg Specific=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][import]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(134, 'Core Options Categories', 'core_options_categories', 3, 'select_dynamic', '', 0, 'Categories', '*', ' ', 3, '', '', '', '', '{\"query\":\"SELECT id AS value, CONCAT(REPEAT(\\\"- \\\",level - 1), title) AS text\\r\\nFROM #__categories\\r\\nWHERE published=1\\r\\n AND access IN ($user->getAuthorisedViewLevels())\\r\\n AND extension = \\\"com_content\\\"\\r\\n ORDER BY lft\",\"table\":\"\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 50, 32, 0, 6, 0, 0, ',', 0, '', '', '', '', 1, 1, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'string[options]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(135, 'Core Options Size Unit', 'core_options_size_unit', 3, 'select_simple', '', 0, 'Unit', '*', ' ', 3, '', '', '2', 'B=0||KB=1||MB=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][size_unit]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(136, 'Core Template Intro', 'core_template_intro', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_intro', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(137, 'Core Template Search', 'core_template_search', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_search', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(138, 'Core Template List', 'core_template_list', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_list', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(139, 'Core Border Style', 'core_border_style', 3, 'select_simple', '', 0, 'Border Style', '*', 'Select a Style', 3, '', '', 'solid', 'dashed||dotted||double||groove||hidden||inherit||inset||none||outset||ridge||solid', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'border_style', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(140, 'Core Field Label Align', 'core_field_label_align', 3, 'select_simple', '', 0, 'Align', '*', ' ', 3, '', '', 'left', 'Left=left||Right=right', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_label_align', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(141, 'Core Field Label Padding Left', 'core_field_label_padding_left', 3, 'select_numeric', '', 0, 'Field Label Padding Left', '*', ' ', 3, '', '', '0', '', '{\"math\":\"0\",\"first\":\"\",\"start\":\"0\",\"step\":\"1\",\"end\":\"100\",\"last\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_label_padding_left', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(142, 'Core Field Label Padding Right', 'core_field_label_padding_right', 3, 'select_numeric', '', 0, 'Field Label Padding Right', '*', ' ', 3, '', '', '0', '', '{\"math\":\"0\",\"first\":\"\",\"start\":\"0\",\"step\":\"1\",\"end\":\"100\",\"last\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_label_padding_right', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(143, 'Core Social', 'core_social', 3, 'checkbox', '', 0, 'Social', '*', ' ', 3, '', '', '', 'Complete=all,google,technorati,yahoo,delicious,stumbleupon,digg,facebook,reddit,myspace,live,twitter,recommand||All=all||Google=google||Technorati=technorati||Yahoo=yahoo||Delicious=delicious||Stumbleupon=stumbleupon||Digg=digg||Facebook=facebook||Reddit=reddit||Myspace=myspace||Live=live||Twitter=twitter||Recommand=recommand', '', 0, 50, 32, 0, 3, 0, 0, ',', 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'string[options]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(144, 'Core Options Video Width', 'core_options_video_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '320', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][video_width]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(145, 'Core Options Video Height', 'core_options_video_height', 3, 'text', '', 0, 'Height', '*', ' ', 3, '', '', '240', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][video_height]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(146, 'Core Options Video Preview', 'core_options_video_preview', 3, 'select_simple', '', 0, 'Show Preview', '*', ' ', 3, '', '', '0', 'Hide=0||Show=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][video_preview]', '', '', '', 0, '', 0, '0000-00-00 00:00:00');
INSERT INTO `#__cck_core_fields` (`id`, `title`, `name`, `folder`, `type`, `description`, `published`, `label`, `language`, `selectlabel`, `display`, `required`, `validation`, `defaultvalue`, `options`, `options2`, `minlength`, `maxlength`, `size`, `cols`, `rows`, `ordering`, `sorting`, `divider`, `bool`, `location`, `extended`, `style`, `script`, `bool2`, `bool3`, `bool4`, `bool5`, `bool6`, `bool7`, `bool8`, `css`, `attributes`, `storage`, `storage_cck`, `storage_location`, `storage_table`, `storage_field`, `storage_field2`, `storage_filter`, `storage_key`, `storage_mode`, `storages`, `checked_out`, `checked_out_time`) VALUES
(147, 'Core Options Width', 'core_options_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '320', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][width]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(148, 'Core Options Height', 'core_options_height', 3, 'text', '', 0, 'Height', '*', ' ', 3, '', '', '240', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][height]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(149, 'Core Message', 'core_message', 3, 'textarea', '', 0, 'Message', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'options[message]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(150, 'Core Field Width', 'core_field_width', 3, 'text', '', 0, 'Width', '*', ' ', 3, '', '', '100%', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_width', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(151, 'Core Field Label Position', 'core_field_label_position', 3, 'select_simple', '', 0, 'Label Position', '*', ' ', 3, '', '', 'left', 'Above=top||Left=left', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_label_position', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(152, 'Core Display', 'core_display', 3, 'select_simple', '', 0, 'Display', '*', ' ', 3, '', '', '0', 'Intro=2||Link=0||Title=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(153, 'Core Field Label', 'core_field_label', 3, 'select_simple', '', 0, 'Show Label', '*', 'Inherited', 3, '', '', '', 'Hide=0||Show=1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_label', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(154, 'Core Field Description', 'core_field_description', 3, 'select_simple', '', 0, 'Show Description', '*', 'Inherited', 3, '', '', '', 'Hide=0||Show=optgroup||At the right of FormValue=4||Below Field=1||Below FormValue=2||Below Label=3||Popover=5', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_description', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(155, 'Core Position Margin', 'core_position_margin', 3, 'select_numeric', '', 0, 'Position Margin', '*', ' ', 3, '', '', '10', '', '{\"math\":\"0\",\"start\":\"0\",\"first\":\"\",\"step\":\"1\",\"last\":\"\",\"end\":\"20\",\"force_digits\":\"0\"}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_margin', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(156, 'Core Field Label Color', 'core_field_label_color', 3, 'colorpicker', '', 0, 'Color', '*', ' ', 3, '', '', '', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_label_color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(157, 'Core Typo', 'core_typo', 3, 'select_simple', '', 0, 'Use Typo', '*', ' ', 3, '', '', '1', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[typo]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(158, 'Core Legend Fieldname', 'core_legend_fieldname', 3, 'text', '', 0, 'Field Name', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'legend_fieldname', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(159, 'Core Field Label2', 'core_field_label2', 3, 'select_simple', '', 0, 'Show Label', '*', 'Use Global', 3, '', '', '', 'No=0||Yes=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'field_label2', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(160, 'Core Options Class', 'core_options_class', 3, 'text', '', 0, 'Default Class', '*', ' ', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][class]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(161, 'Core Options Target', 'core_options_target', 3, 'select_simple', '', 0, 'Target', '*', ' ', 3, '', '', '_blank', 'Target Blank=_blank||Target Self=_self||Target Parent=_parent||Target Top=_top', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][target]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(162, 'Core Featured', 'core_featured', 3, 'radio', '', 0, 'Featured', '*', ' ', 3, '', '', '0', 'No=0||Yes Featured=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'featured', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(163, 'Core Title', 'core_title', 3, 'text', '', 0, 'Override Title', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[title]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(164, 'Core Options Theme (Calendar)', 'core_options_theme_calendar', 3, 'select_simple', '', 0, 'Theme', '*', ' ', 3, '', '', 'steel', 'Gold=gold||Steel=steel||Win2k', '', 0, 50, 32, 0, 10, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][theme]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(165, 'Core Options Time Pos', 'core_options_time_pos', 3, 'select_simple', '', 0, 'Position', '*', ' ', 3, '', '', 'right', 'Left=left||Right=right', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][time_pos]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(166, 'Core Options Dates', 'core_options_dates', 3, 'select_simple', '', 0, 'Date Range', '*', ' ', 3, '', '', '0', 'All Dates=0||Past=1||Past Today=2||Today Future=3||Future=4', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][dates]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(167, 'Core Options Week Numbers', 'core_options_week_numbers', 3, 'select_simple', '', 0, 'Show Week Numbers', '*', ' ', 3, '', '', '0', 'Hide=0||Show=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][week_numbers]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(168, 'Core Options Time', 'core_options_time', 3, 'select_simple', '', 0, 'Time', '*', ' ', 3, '', '', '12', 'No=0||12=12||24=24', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][time]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(169, 'Core Position Padding', 'core_position_padding', 3, 'text', '', 0, 'Padding', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'position_padding', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(170, 'Core Video Markup', 'core_video_markup', 3, 'select_simple', '', 0, 'Markup', '*', ' ', 3, '', '', '0', 'Iframe=0||Embed=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool2', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(171, 'Core Dev Text', 'core_dev_text', 3, 'text', '', 0, 'clear', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'text', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(172, 'Core Pagination', 'core_pagination', 3, 'select_simple', '', 0, 'Pagination', '*', 'Use Global', 3, '', '', '', 'All Items=0||Standard=optgroup||1||2||3||4||5||6||8||9||10||12||15||20||24||25||30||48||50||100||Advanced=optgroup||200||300||400||500||600||700||800||900||1000||2000||3000||4000||5000||endgroup||Use Native=-1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[pagination]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(173, 'Core Limit', 'core_limit', 3, 'text', '', 0, 'Limit', '*', ' ', 3, '', '', '0', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[limit]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(174, 'Core Debug', 'core_debug', 3, 'select_simple', '', 0, 'Debug', '*', 'Use Global', 3, '', '', '', 'No=0||Search Full Debug=optgroup||Yes for Everyone=1||Yes for Super Admin=2||Search Light Debug=optgroup||Yes for Everyone=11||Yes for Super Admin=12||Config No Search=optgroup||Yes for Everyone=-1||Yes for Super Admin=-2', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[debug]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(175, 'Core Cache', 'core_cache', 3, 'select_simple', '', 0, 'Cache', '*', ' ', 3, '', '', '0', 'OFF=0||ON=optgroup||Global=1||Self=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[cache]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(176, 'Core Message Style', 'core_message_style', 3, 'select_simple', '', 0, 'Message Style', '*', ' ', 3, '', '', 'message', 'None=0||Page=-1||Joomla=optgroup||Error=error||Message=message||Notice=notice', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[message_style]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(177, 'Core SEF', 'core_sef', 3, 'select_simple', '', 0, 'SEF Urls', '*', 'Use Global', 3, '', '', '', 'Joomla=optgroup||Append Segment=10||Use Native=0||SEBLOD=optgroup||SEF Mode Alias=23||SEF Mode Id=22||SEF Mode Id Alias=2||SEBLOD Advanced=optgroup||SEF Mode Author Alias=53||SEF Mode Author Id=52||SEF Mode Author Id Alias=5||SEF Mode Parent Alias=43||SEF Mode Parent Id=42||SEF Mode Parent Id Alias=4||SEF Mode Parents Alias=83||SEF Mode Parents Id=82||SEF Mode Parents Id Alias=8||SEF Mode Type Alias=33||SEF Mode Type Id=32||SEF Mode Type Id Alias=3||SEBLOD Deprecated=optgroup||SEF Mode Alias Safe=24||Optimized=1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[sef]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(178, 'Core Template Item', 'core_template_item', 3, 'select_dynamic', '', 0, 'Style', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__template_styles\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:190px;\"', 'dev', '', '', '', 'template_item', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(179, 'Core Action', 'core_action', 3, 'select_simple', '', 0, 'Action', '*', ' ', 3, '', '', '0', 'None=0||Include File=file||Render Template=template', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[action]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(180, 'Core Redirection Url (No Access)', 'core_redirection_url_no_access', 3, 'text', '', 0, 'Redirection Url', '*', ' ', 3, '', '', 'index.php?option=com_users&view=login', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[redirection_url_no_access]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(181, 'Core Action No Access', 'core_action_no_access', 3, 'select_simple', '', 0, 'Action', '*', ' ', 3, '', '', 'redirection', 'None=0||Redirection=redirection', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[action_no_access]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(182, 'Core Options Format Date', 'core_options_format_date', 3, 'select_simple', '', 0, 'Format', '*', ' ', 3, '', '', '0', 'DATETIME=0||TIMESTAMP=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][format_date]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(183, 'Core Options Force Thumb Creation', 'core_options_force_thumb_creation', 3, 'select_simple', '', 0, 'Force Thumb Creation', '*', ' ', 3, '', '', '', 'On Upload=0||If Not Exist=1||Always=2', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][force_thumb_creation]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(184, 'Core Options Orderby', 'core_options_orderby', 3, 'text', '', 0, 'Order By', '*', ' ', 3, '', '', '', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][orderby]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(185, 'Core Options Language Codes', 'core_options_language_codes', 3, 'text', '', 0, 'Language Codes', '*', ' ', 3, '', '', 'EN,GB,US,FR', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][language_codes]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(186, 'Core Options Language Default', 'core_options_language_default', 3, 'text', '', 0, 'Default Language', '*', ' ', 3, '', '', 'EN', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][language_default]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(187, 'Core Options Language Detection', 'core_options_language_detection', 3, 'select_simple', '', 0, 'Language Detection', '*', ' ', 3, '', '', 'joomla', 'Joomla=joomla||GeoIP=geoip', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][language_detection]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(188, 'Core Redirection', 'core_redirection', 3, 'select_simple', '', 0, 'Redirection', '*', ' ', 3, '', '', 'current', 'Url=optgroup||Current=current||Current Full=current_full||Custom=url||View=optgroup||Content=content||Form=form||Form Edition=form_edition', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[redirection]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(189, 'Core Redirection Url', 'core_redirection_url', 3, 'text', '', 0, 'Redirection Url', '*', ' ', 3, 'required', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[redirection_url]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(190, 'Core Dev Select', 'core_dev_select', 3, 'select_simple', '', 0, 'clear', '*', 'Select', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'select', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(191, 'Core Field Focus Border Color', 'core_field_focus_border_color', 3, 'colorpicker', '', 0, 'Focus Border Color', '*', ' ', 3, '', '', '#888888', '', '', 0, 50, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_focus_border_color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(192, 'Core Storage Alter Table', 'core_storage_alter_table', 3, 'select_simple', '', 0, 'Alter', '*', ' ', 3, '', '', '0', 'Alter Original Type=0||Alter Original Field=2||Base Table=optgroup||Alter Original Table=1', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '#__assets', 'storage_alter_table', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(193, 'Core Options MultiValue Mode', 'core_options_multivalue_mode', 3, 'select_simple', '', 0, 'MultiValue Mode', '*', ' ', 3, '', '', '', 'No=0||Yes Multivalue Mode=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][multivalue_mode]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(194, 'Core Validation Scroll', 'core_validation_scroll', 3, 'select_simple', '', 0, 'Scroll', '*', 'Use Global', 3, '', '', '', 'Yes=1||No=0', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[validation_scroll]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(195, 'Core Validation Position', 'core_validation_position', 3, 'select_simple', '', 0, 'Position', '*', 'Use Global', 3, '', '', '', 'Position bottomLeft=bottomLeft||Position bottomRight=bottomRight||Position inline=inline||Position centerRight=centerRight||Position topLeft=topLeft||Position topRight=topRight', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[validation_position]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(196, 'Core Validation Style', 'core_validation_style', 3, 'select_simple', '', 0, 'Style', '*', ' ', 3, '', '', 'balloon', 'Balloon=balloon||Text=text', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[validation_style]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(197, 'Core Validation Color', 'core_validation_color', 3, 'colorpicker', '', 0, 'Color', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[validation_color]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(198, 'Core Validation Background Color', 'core_validation_background_color', 3, 'colorpicker', '', 0, 'Background Color', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[validation_background_color]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(199, 'Core Dev Textarea', 'core_dev_textarea', 3, 'textarea', '', 0, 'clear', '*', ' ', 3, '', '', '', '', '', 0, 512, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'textarea', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(200, 'Core Options Html', 'core_options_html', 3, 'textarea', '', 0, 'Html', '*', ' ', 3, '', '', '', '', '', 0, 0, 32, 92, 24, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[options2][html]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(201, 'Core Title (Site)', 'core_title_site', 3, 'text', '', 0, 'Title', '*', ' ', 3, 'required', '', '', '', '', 0, 255, 28, 0, 0, 0, 0, '', 0, '', '', '', 'if(!$(\"#title\").val()){ $(\"#title\").focus(); }', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"1\"', 'dev', '', '', '', 'title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(202, 'Core Name (Site)', 'core_name_site', 3, 'text', '', 0, 'Url', '*', ' ', 3, 'required', '', '', '', '', 0, 100, 28, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'tabindex=\"2\"', 'dev', '', '', '', 'name', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(203, 'Core Guest', 'core_guest', 3, 'select_dynamic', '', 0, 'Guest', '*', 'Select a User', 3, '', '', '', '', '{\"query\":\"SELECT \",\"table\":\"#__users\",\"name\":\"name\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"name\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'guest', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(204, 'Core Viewlevels', 'core_viewlevels', 3, 'select_dynamic', '', 0, 'Viewing Access Levels', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__viewlevels\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"title\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 1, 0, 0, 0, 0, 1, '', '', 'dev', '', 'joomla_article', '', 'viewlevels', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(205, 'Core Groups', 'core_groups', 3, 'select_dynamic', '', 0, 'User Groups', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__usergroups\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"lft\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 1, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'groups', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(206, 'Core Site Name', 'core_site_name', 3, 'text', '', 0, 'Site Name', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[configuration][sitename]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(207, 'Core Site Offline', 'core_site_offline', 3, 'radio', '', 0, 'Offline', '*', ' ', 3, '', '', '0', 'No=0||Yes=1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'btn-group', '', 'dev', '', '', '', 'json[configuration][offline]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(208, 'Core Site Metadesc', 'core_site_metadesc', 3, 'textarea', '', 0, 'Meta Description', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[configuration][metadesc]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(209, 'Core Site Metakeys', 'core_site_metakeys', 3, 'textarea', '', 0, 'Meta Keywords', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'json[configuration][metakeys]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(210, 'Core Site Pagetitles', 'core_site_pagetitles', 3, 'select_simple', '', 0, 'Include Site Name', '*', ' ', 3, '', '', '', 'In addition to the overall setup=optgroup||No=0||After Page Titles=2||Before Page Titles=1', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[configuration][sitename_pagetitles]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(211, 'Core Site Live Value', 'core_site_live_value', 3, 'text', '', 0, 'Live Value', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'live_value', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(212, 'Core Site Live Values', 'core_site_live_values', 3, 'field_x', '', 0, 'Live Values', '*', ' ', 3, '', '', '', '', '', 1, 10, 32, 0, 1, 0, 0, '', 0, '', 'core_site_live_value', '', '', 1, 1, 1, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'live_values', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(213, 'Core Guest Only (Viewlevel)', 'core_guest_only_viewlevel', 3, 'select_dynamic', '', 0, 'Guest Only Viewing Access Level', '*', 'Select a Viewing Access Level', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__viewlevels\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"title\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'guest_only_viewlevel', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(214, 'Core Site Template_style', 'core_site_template_style', 3, 'select_dynamic', '', 0, 'Template Style', '*', 'Use Default', 3, '', '', '', '', '{\"query\":\"SELECT a.title AS text, a.id AS value FROM #__template_styles AS a LEFT OUTER JOIN #__cck_core_templates AS b ON b.name = a.template WHERE a.client_id = 0 AND b.name IS NULL ORDER by a.title\",\"table\":\"#__content\",\"name\":\"title\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[configuration][template_style]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(215, 'Core Site Language', 'core_site_language', 3, 'select_dynamic', '', 0, 'Language', '*', 'Use Default', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__languages\",\"name\":\"title\",\"where\":\"\",\"value\":\"lang_code\",\"orderby\":\"title\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[configuration][language]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(216, 'Core Form', 'core_form', 3, 'select_dynamic', '', 0, 'Content Type Form', '*', 'Select', 3, 'required', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:200px;\"', 'dev', '', '', '', 'form', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(217, 'Core List', 'core_list', 3, 'select_dynamic', '', 0, 'Search Type List', '*', 'Select', 3, 'required', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_searchs\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:200px;\"', 'dev', '', '', '', 'list', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(218, 'Core Menuitem', 'core_menuitem', 3, 'jform_menuitem', '', 0, 'Menu Item', '*', 'Select', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 'max-width-200', '', 'dev', '', '', '', 'itemid', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(219, 'Core Site Homepage', 'core_site_homepage', 3, 'jform_menuitem', '', 0, 'Homepage', '*', 'Use Default', 3, '', '', '', '', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[configuration][homepage]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(220, 'Core Guest Only (Group)', 'core_guest_only_group', 3, 'select_dynamic', '', 0, 'Guest Only Group', '*', 'Select a Group', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__usergroups\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"lft\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'guest_only_group', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(221, 'Core App Elements', 'core_app_elements', 3, 'checkbox', '', 0, 'Elements', '*', ' ', 3, '', '', 'types,fields,searchs,templates,subfolders', 'Content Types=types||Fields=fields||Search Types=searchs||Templates=templates||Subfolders=subfolders', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'app_elements', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(222, 'Core App Dependencies (Categories)', 'core_app_dependencies', 3, 'radio', '', 0, 'Dependencies Categories', '*', ' ', 3, '', '', '1', 'No=0||Auto=1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, 'btn-group btn-group-yesno', '', 'dev', '', '', '', 'app_dependencies_categories', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(223, 'Core Options Limit', 'core_options_limit', 3, 'text', '', 0, 'Limit', '*', ' ', 3, '', '', '', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][limit]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(224, 'Core Options Orderby (Direction)', 'core_options_orderby_direction', 3, 'select_simple', '', 0, 'Direction', '*', ' ', 3, '', '', 'ASC', 'Ascending=ASC||Descending=DESC', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][orderby_direction]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(225, 'Core DefaultValue (Textarea)', 'core_defaultvalue_textarea', 3, 'textarea', '', 0, 'Default Value', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 25, 3, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 1, 0, '', '', 'dev', '', '', '', 'defaultvalue', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(226, 'Core Prepare Content', 'core_prepare_content', 3, 'select_simple', '', 0, 'Prepare Content', '*', 'Use Global', 3, '', '', '', 'No=0||Yes=1', '{\"options\":[]}', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[prepare_content]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(227, 'Core Field Label Padding', 'core_field_label_padding', 3, 'text', '', 0, 'Padding', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'field_label_padding', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(228, 'Core Dev Bool', 'core_dev_bool', 3, 'select_simple', '', 0, 'clear', '*', ' ', 3, '', '', '1', 'Yes=1||No=0', '', 0, 50, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(229, 'Core Class Pagination', 'core_class_pagination', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', 'pagination', '', '', 0, 255, 12, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_pagination', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(230, 'Core Tmpl', 'core_tmpl', 3, 'select_simple', '', 0, 'Tmpl', '*', 'None', 3, '', '', '', 'Auto=-1||Component=component||Raw=raw', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'tmpl', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(231, 'Core Position Sidebody', 'core_position_sidebody', 3, 'select_simple', '', 0, '', '*', ' ', 3, '', '', '0', 'Left=1||Right=0', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'position_sidebody', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(233, 'Core Dev Select Numeric', 'core_dev_select_numeric', 3, 'select_numeric', '', 0, 'clear', '*', ' ', 3, '', '', '1', '', '{\"math\":\"0\",\"start\":\"1\",\"first\":\"\",\"step\":\"1\",\"last\":\"\",\"end\":\"5\",\"force_digits\":\"0\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'select_numeric', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(234, 'Core Class Total', 'core_class_total', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', 'total', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_total', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(235, 'Core Class Table', 'core_class_table', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', 'o-table', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_table', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(236, 'Core Class Table Tr Odd', 'core_class_table_tr_odd', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_table_tr_odd', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(237, 'Core Class Table Tr Even', 'core_class_table_tr_even', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_table_tr_even', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(238, 'Core Class Title', 'core_class_title', 3, 'text', '', 0, 'Class', '*', ' ', 3, '', '', '', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'class_title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(239, 'Core Tag Title', 'core_tag_title', 3, 'select_simple', '', 0, 'Tag', '*', ' ', 3, '', '', 'h1', 'H1=h1||H2=h2||H3=h3', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'tag_title', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(240, 'Core Class Clear', 'core_class_clear', 3, 'select_simple', '', 0, 'Clear', '*', ' ', 3, '', '', '0', 'Yes=cck-clrfix||No=0', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'class_clear', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(241, 'Core Class Float', 'core_class_float', 3, 'select_simple', '', 0, 'Float', '*', ' ', 3, '', '', '0', 'Left=cck-fl||None=0', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'class_float', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(242, 'Core Show Hide', 'core_show_hide', 3, 'select_simple', '', 0, 'Show', '*', ' ', 3, '', '', '', 'Hide=0||Show=1', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'show', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(243, 'Core Label Total', 'core_label_total', 3, 'text', '', 0, 'Label', '*', ' ', 3, '', '', 'Results', '', '', 0, 255, 8, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'label_total', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(244, 'Core Show Pagination', 'core_show_pagination', 3, 'select_simple', '', 0, 'Show Pagination', '*', ' ', 3, '', '', '', 'Hide=-2||Standard=optgroup||Above=-1||Below=0||Both=1||Infinite=optgroup||Click=2||Load=8', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'show_pagination', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(245, 'Core Ordering', 'core_ordering', 3, 'select_simple', '', 0, 'Ordering', '*', ' ', 3, '', '', '', 'None=none||Basic=optgroup||Config Option Alphabetical=alpha||Config Option Most Popular=popular||Config Option Most Recent First=newest||Config Option Oldest First=oldest||Config Option Ordering=ordering||Advanced=optgroup||Ordering View Inherited=', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'ordering', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(246, 'Core Ordering2', 'core_ordering2', 3, 'select_simple', '', 0, 'Ordering', '*', ' ', 3, '', '', '', 'Basic=optgroup||Config Option Alphabetical=alpha||Config Option Most Popular=popular||Config Option Most Recent First=newest||Config Option Oldest First=oldest||Config Option Ordering=ordering||Advanced=optgroup||Custom=-1', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'ordering', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(247, 'Core Order By', 'core_order_by', 3, 'text', '', 0, 'Order By', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'order_by', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(248, 'Core Item Display', 'core_item_display', 3, 'select_simple', '', 0, 'Rendering', '*', ' ', 3, '', '', 'renderItem', 'Item Field Html=renderItemField_Html||Item Field Typo=renderItemField_Typo||Item Field Value=renderItemField_Value||Item=renderItem', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'display', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(249, 'Core Auto Custom', 'core_auto_custom', 3, 'select_simple', '', 0, 'Select', '*', ' ', 3, '', '', '', 'Auto=0||Custom=1', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'auto_custom', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(250, 'Core Auto Deepest', 'core_auto_deepest', 3, 'select_simple', '', 0, 'Select', '*', ' ', 3, '', '', '', 'Auto=0||Deepest=1', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'auto_deepest', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(251, 'Core Across Down', 'core_across_down', 3, 'select_simple', '', 0, 'Select', '*', ' ', 3, '', '', '', 'Across=0||Down=1', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'across_down', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(252, 'Core Numeric 6', 'core_numeric_6', 3, 'select_numeric', '', 0, 'Select', '*', ' ', 3, '', '', '', '', '{\"math\":\"0\",\"start\":\"1\",\"first\":\"\",\"step\":\"1\",\"last\":\"\",\"end\":\"6\",\"force_digits\":\"0\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'numeric', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(253, 'Core CSS Definitions', 'core_css_definitions', 3, 'select_simple', '', 0, 'clear', '*', 'None', 3, '', '', '', 'All=all||Custom=custom', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'css_definitions', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(254, 'Core CSS Definitions Custom', 'core_css_definitions_custom', 3, 'checkbox', '', 0, 'clear', '*', ' ', 3, '', '', '', 'Base=base||CSS Spacing=spacing||CSS Writing=writing', '', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'css_definitions_custom', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(255, 'Core Options Format File', 'core_options_format_file', 3, 'select_simple', '', 0, 'Storage Format', '*', ' ', 3, '', '', '0', 'Filename=1||Full Path=0', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][storage_format]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(256, 'Core Auto Redirection', 'core_auto_redirection', 3, 'select_simple', '', 0, 'Redirection', '*', ' ', 3, '', '', '', 'No=0||Redirection=optgroup||Content=1||Form=2', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'auto_redirect', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(257, 'Core Indexing', 'core_indexing', 3, 'select_simple', '', 0, 'Smart Search', '*', ' ', 3, '', '', 'none', 'None=none||Smart Search Indexing=optgroup||Content=content||Intro=intro', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'indexed', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(258, 'Core Version Type Filter', 'core_version_e_type_filter', 3, 'select_simple', '', 0, 'Type', '*', ' ', 3, '', '', 'type', 'Content Types=type||Search Types=search', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', ' onchange=\"this.form.submit();\"', 'dev', '', '', '', 'filter_e_type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(259, 'Core Version Location Filter', 'core_version_location_filter', 3, 'select_simple', '', 0, 'Location', '*', ' ', 3, '', '', '', 'Title=e_title||Name=e_name||IDS=e_id', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'filter_location', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(260, 'Core Note', 'core_note', 3, 'text', '', 0, 'Note', '*', ' ', 3, '', '', '', '', '', 0, 255, 69, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'note', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(261, 'Core Options Display', 'core_options_display', 3, 'select_simple', '', 0, 'Show Options', '*', ' ', 3, '', '', '0', 'Hide=-1||Show=optgroup||Following Options=0||Alphabetical AZ=1||Alphabetical ZA=2', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'sorting', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(262, 'Core Show Hide', 'core_show_hide2', 3, 'select_simple', '', 0, 'Show', '*', ' ', 3, '', '', '', 'Hide=0||Show=optgroup||Above=1||Below=2', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'show', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(263, 'Core Languages', 'core_languages', 3, 'select_dynamic', '', 0, 'Languages', '*', 'Select', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__languages\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"lang_code\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'languages', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(264, 'Core Variable Type', 'core_variable_type', 3, 'select_simple', '', 0, 'Type', '*', ' ', 3, '', '', 'string', 'Alphanumeric=alnum||Array=array||Float=float||Int=int||Integers=integers||String=string||Word=word', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(265, 'Core Computation Presets', 'core_computation_presets', 3, 'select_simple', '', 0, 'Presets', '*', 'Select', 3, 'required', '', '', 'Computation Presets 01=a + b||Computation Presets 02=a - b||Computation Presets 03=a * b||Computation Presets 04=a / b||Computation Presets 05=a - (b / c)||Computation Presets 06=a - (a * b) / 100||Computation Presets 07=(a + b).pow(2)||Computation Presets 08=a.sqrt() + b', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'presets', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(266, 'Core Computation Format', 'core_computation_format', 3, 'select_simple', '', 0, 'Format', '*', 'Auto', 3, '', '', '', 'Ceil=ceil||Floor=floor||Round=round||ToFixed=toFixed', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'format', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(267, 'Core Computation Precision', 'core_computation_precision', 3, 'text', '', 0, 'Precision', '*', ' ', 3, '', '', '', '', '', 0, 1, 3, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'style=\"text-align:center;\"', 'dev', '', '', '', 'precision', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(268, 'Core Computation Event', 'core_computation_event', 3, 'select_simple', '', 0, 'Trigger Event', '*', ' ', 3, '', '', '0', '_=||Event Change=change||Event Keyup=keyup||None=none', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'event', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(269, 'Core Conditional Event', 'core_conditional_event', 3, 'select_simple', '', 0, 'Event', '*', ' ', 3, '', '', 'change', 'Change=change||Keyup=keyup', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'event', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(270, 'Core Computation Recalc', 'core_computation_recalc', 3, 'select_simple', '', 0, 'Rule', '*', ' ', 3, '', '', 'global', 'Global=global||Self=0', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'recalc', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(271, 'Core JGrid Type', 'core_jgrid_type', 3, 'select_simple', '', 0, 'Type', '*', 'Select', 3, 'required', '', '', 'Joomla=optgroup||Activation=activation||Block=block||Checkbox=selection||Checkbox Label For=selection_label||Dropdown Menu=dropdown||Featured=featured||Increment=increment||Reordering=sort||Reordering Grip=sort_grip||Status=state||SEBLOD=optgroup||Form=form||Hidden=form_hidden||Form Number=form_custom_number||Form Disabled=form_disabled', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(272, 'Core Rules (Type)', 'core_rules_type', 3, 'jform_rules', '', 0, 'Permissions', '*', ' ', 3, '', '', '', '', '{\"extension\":\"com_cck\",\"section\":\"form\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'jform[rules]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(276, 'Core Location', 'core_location', 3, 'select_simple', '', 0, 'Content Creation', '*', ' ', 3, '', '', '', 'Allowed=||Allowed Hidden=hidden||As Collection=collection||Not Allowed=none||Location=optgroup||Administrator Only=admin||Site Only=site', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'location', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(277, 'Core Cache2', 'core_cache2', 3, 'select_simple', '', 0, 'Cache', '*', ' ', 3, '', '', '0', 'OFF=0||ON=optgroup||Global=1||Self=2', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[cache2]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(278, 'Core Stages', 'core_stages', 3, 'select_numeric', '', 0, 'Stages', '*', ' ', 3, '', '', '1', '', '{\"math\":\"0\",\"start\":\"1\",\"first\":\"\",\"step\":\"1\",\"last\":\"\",\"end\":\"6\",\"force_digits\":\"0\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'options[stages]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(279, 'Core Uri', 'core_uri', 3, 'select_simple', '', 0, 'Uri', '*', ' ', 3, '', '', 'current', 'Custom=custom||Path=path||Presets=optgroup||Base=base||Current=current||Root=root', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'uri', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(280, 'Core Uri Parts', 'core_uri_parts', 3, 'checkbox', '', 0, 'Parts', '*', ' ', 3, '', '', 'scheme,user,pass,host,port,path,query,fragment', 'Scheme=scheme||User=user||Password=pass||Host=host||Port=port||Path=path||Query=query||Fragment=fragment', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, ',', 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'parts', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(281, 'Core Dev Texts', 'core_dev_texts', 3, 'field_x', '', 0, 'Texts', '*', ' ', 3, '', '', '', '', '', 1, 10, 32, 0, 1, 0, 0, '', 0, '', 'core_dev_text', '', '', 1, 1, 1, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'texts', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(283, 'Core Alias', 'core_alias', 3, 'text', '', 0, 'Alias Optional', '*', ' ', 3, '', '', '', '', '', 0, 255, 28, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'alias', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(284, 'Core Location2', 'core_location2', 3, 'select_simple', '', 0, 'List Location', '*', ' ', 3, '', '', '', 'Both=||None=none||Location=optgroup||Administrator=admin||Site=site', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'location', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(285, 'Core Filter Go', 'core_filter_go', 3, 'button_submit', '', 0, 'Go', '*', ' ', 3, '', '', '', '', '{\"icon\":\"checkmark\",\"alt_link_text\":\"\",\"alt_link\":\"\",\"alt_link_options\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 1, '', '', '', '', 0, 1, 0, 0, 3, 1, 0, 'tip hasTooltip', 'onclick=\"this.form.submit();\"', 'none', '', '', '', 'core_filter_go', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(286, 'Core Filter Search', 'core_filter_search', 3, 'button_submit', '', 0, 'Search', '*', ' ', 3, '', '', '', '', '{\"icon\":\"search\",\"alt_link_text\":\"\",\"alt_link\":\"\",\"alt_link_options\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 1, '', '', '', '', 0, 1, 0, 0, 3, 0, 0, 'tip hasTooltip', 'onclick=\"this.form.submit();\"', 'none', '', '', '', 'core_filter_search', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(287, 'Core Filter Clear', 'core_filter_clear', 3, 'button_submit', '', 0, 'Clear', '*', ' ', 3, '', '', '', '', '{\"icon\":\"remove\",\"alt_link_text\":\"\",\"alt_link\":\"\",\"alt_link_options\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 1, '', '', '', '', 0, 1, 0, 0, 3, 0, 0, 'tip hasTooltip', 'onclick=\"this.form.submit();\"', 'none', '', '', '', 'core_filter_clear', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(288, 'Core Filter Input', 'core_filter_input', 3, 'text', '', 0, 'Search', '*', ' ', 3, '', '', '', '', '', 0, 255, 20, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'filter_search', '', '', '', 0, '', 0, '0000-00-00 00:00:00');
INSERT INTO `#__cck_core_fields` (`id`, `title`, `name`, `folder`, `type`, `description`, `published`, `label`, `language`, `selectlabel`, `display`, `required`, `validation`, `defaultvalue`, `options`, `options2`, `minlength`, `maxlength`, `size`, `cols`, `rows`, `ordering`, `sorting`, `divider`, `bool`, `location`, `extended`, `style`, `script`, `bool2`, `bool3`, `bool4`, `bool5`, `bool6`, `bool7`, `bool8`, `css`, `attributes`, `storage`, `storage_cck`, `storage_location`, `storage_table`, `storage_field`, `storage_field2`, `storage_filter`, `storage_key`, `storage_mode`, `storages`, `checked_out`, `checked_out_time`) VALUES
(289, 'Core Icons', 'core_icons', 3, 'select_simple', '', 0, 'Icon', '*', 'Select', 3, '', '', '', 'address||arrow-down||arrow-down-2||arrow-down-3||arrow-first||arrow-last||arrow-left||arrow-left-2||arrow-left-3||arrow-right||arrow-right-2||arrow-right-3||arrow-up||arrow-up-2||arrow-up-3||bars||basket||bookmark||bookmark-2||box-add||box-remove||briefcase||broadcast||brush||calendar||calendar-2||camera||camera-2||cancel||cart||chart||checkbox||checkbox-partial||checkbox-unchecked||checkmark||clock||cog||cogs||color-palette||comments||comments-2||compass||contract||contract-2||copy||crop||cube||delete||dashboard||database||download||drawer||drawer-2||edit||equalizer||expand||expand-2||eye||feed||file||file-check||file-minus||file-plus||file-remove||filter||first||flag||flag-2||folder-close||folder-open||grid-view||grid-view-2||health||help||home||impersonate||impersonate-2||key||lamp||last||leader||link||lightning||list-view||location||lock||loop||mail||mail-2||menu||menu-2||minus||minus-2||mobile||move||music||next||out||out-2||pencil||pencil-2||picture||pictures||pie||pin||play||play-2||plus||plus-2||power-cord||previous||print||puzzle||quote||quote-2||refresh||remove||screen||search||share||shuffle||sign||sign-2||star||star-2||star-empty||support||tablet||tags||thumbs-down||thumbs-up||tools||trash||undo||update||upload||user||users||vcard||wand||warning||wrench||zoom-in||zoom-out', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][icon]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(290, 'Core Joomla! Article Catid', 'core_joomla_article_catid', 3, 'select_dynamic', '', 0, 'Category', '*', 'Use Global', 3, '', '', '', '', '{\"query\":\"SELECT id AS value, CONCAT(REPEAT(\\\"- \\\",level - 1), title) AS text\\r\\nFROM #__categories\\r\\nWHERE published=1\\r\\n AND access IN ($user->getAuthorisedViewLevels())\\r\\n AND extension = \\\"com_content\\\"\\r\\n ORDER BY lft\",\"table\":\"\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, 'max-width-200', '', 'dev', '', '', '', 'values[catid]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(291, 'Core Joomla! Article Created By', 'core_joomla_article_created_by', 3, 'select_dynamic', '', 0, 'Author', '*', 'Use Global', 3, '', '', '', '', '{\"query\":\"SELECT id AS value, name AS text FROM #__users AS a LEFT JOIN #__user_usergroup_map AS b ON b.user_id = a.id WHERE b.group_id = 8 ORDER BY text\",\"table\":\"#__content\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'values[created_by]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(292, 'Core Joomla! Article State', 'core_joomla_article_state', 3, 'select_simple', '', 0, 'Status', '*', 'Use Global', 3, '', '', '', 'Published=1||Unpublished=0||Archived=2||Trashed=-2', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'values[state]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(295, 'Core Module Style', 'core_module_style', 3, 'select_simple', '', 0, 'Style', '*', 'Select', 3, '', '', '', 'None=none||Outline=outline||Rounded=rounded||Table=table||Xhtml=xhtml', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'style', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(296, 'Core Not Empty (File)', 'core_not_empty_file', 3, 'checkbox', '', 0, '', '*', ' ', 3, '', '', '', 'Only with File=1', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'none', '', '', '', 'core_not_empty_file', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(297, 'Core Not Empty (Image)', 'core_not_empty_image', 3, 'checkbox', '', 0, '', '*', ' ', 3, '', '', '', 'Only with Image=1', '', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'none', '', '', '', 'core_not_empty_image', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(450, 'Core Joomla! Category Created By', 'core_joomla_category_created_by', 3, 'select_dynamic', '', 0, 'Author', '*', 'Use Global', 3, '', '', '', '', '{\"query\":\"SELECT id AS value, name AS text FROM #__users AS a LEFT JOIN #__user_usergroup_map AS b ON b.user_id = a.id WHERE b.group_id = 8 ORDER BY text\",\"table\":\"#__content\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'values[created_user_id]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(451, 'Core Joomla! Category Parent ID', 'core_joomla_category_parent_id', 3, 'select_dynamic', '', 0, 'Parent', '*', 'Use Global', 3, '', '', '', '', '{\"query\":\"SELECT id AS value, CONCAT(REPEAT(\\\"- \\\",level - 1), title) AS text\\r\\nFROM #__categories\\r\\nWHERE published=1\\r\\n AND access IN ($user->getAuthorisedViewLevels())\\r\\n AND id != 1\\r\\n AND path != \\\"uncategorised\\\"\\r\\n ORDER BY lft\",\"table\":\"\",\"name\":\"\",\"where\":\"\",\"value\":\"\",\"orderby\":\"\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 1, 'max-width-200', '', 'dev', '', '', '', 'values[parent_id]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(452, 'Core Joomla! Category State', 'core_joomla_category_state', 3, 'select_simple', '', 0, 'Status', '*', 'Use Global', 3, '', '', '', 'Published=1||Unpublished=0||Archived=2||Trashed=-2', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'values[published]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(453, 'Core Joomla! User Groups', 'core_joomla_user_groups', 3, 'select_dynamic', '', 0, 'User Groups', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__usergroups\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"lft\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 9, 0, 0, ',', 0, '', '', '', '', 0, 1, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'values[groups]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(454, 'Core List Display', 'core_list_display', 3, 'select_simple', '', 0, 'Display', '*', ' ', 3, '', '', '0', 'Standard List View=0||Intermediate List View=2||Advanced Item View=1', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'max-width-180', 'onchange=\"JCck.DevHelper.switchDisplay(this); JCck.DevHelper.doSubmit();\"', 'dev', '', '', '', 'display', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(456, 'Core Access', 'core_access', 3, 'select_dynamic', '', 0, 'Access', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__viewlevels\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"ordering\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'access', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(458, 'Core Conditional Trigger Type', 'core_conditional_trigger_type', 3, 'select_simple', '', 0, '', '*', ' ', 3, '', '', 'isChanged', 'State Is Equal In=isEqual||State Is Different=isDifferent||State Is Filled=isFilled||State Is Empty=isEmpty||State Is Changed=isChanged', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', 'style=\"max-width:100px;\"', 'dev', '', '', '', 'trigger_type', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(459, 'Core Conditional Trigger Value', 'core_conditional_trigger_value', 3, 'text', '', 0, 'Value', '*', ' ', 3, '', '', '', '', '', 0, 255, 12, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'trigger_value', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(460, 'Core Dev Password', 'core_dev_password', 3, 'password', '', 0, 'clear', '*', ' ', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'password', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(461, 'Core Options Enctype', 'core_options_enctype', 3, 'select_simple', '', 0, 'Enctype', '*', ' ', 3, '', '', '', 'application/x-www-form-urlencoded||multipart/form-data||text/plain', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][enctype]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(462, 'Core Dev Radio', 'core_dev_radio', 3, 'radio', '', 0, 'clear', '*', ' ', 3, '', '', '', '', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'btn-group', '', 'dev', '', '', '', 'radio', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(463, 'Core Dev Color', 'core_dev_color', 3, 'colorpicker', '', 0, 'clear', '*', ' ', 3, '', '', '', '', '', 0, 255, 16, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'color', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(464, 'Core Orientation Vertical', 'core_orientation_vertical', 3, 'select_numeric', '', 0, 'clear', '*', 'Auto', 3, '', '', '1', '', '{\"math\":\"0\",\"start\":\"1\",\"first\":\"\",\"step\":\"1\",\"last\":\"\",\"end\":\"8\",\"force_digits\":\"0\",\"force_decimals\":\"0\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool2', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(465, 'Core Action2', 'core_action2', 3, 'select_simple', '', 0, 'Action', '*', ' ', 3, '', '', '', 'Always=||Workflow=optgroup||Add=add||Edit=edit', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'action', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(466, 'Core Method', 'core_method', 3, 'select_simple', '', 0, 'Method', '*', ' ', 3, '', '', 'get', 'GET=get||POST=post', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'json[options2][method]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(467, 'Core Easing', 'core_easing', 3, 'select_simple', '', 0, 'Easing', '*', ' ', 3, '', '', 'linear', 'linear=linear||swing=swing||easeInQuad=easeInQuad||easeOutQuad=easeOutQuad||easeInOutQuad=easeInOutQuad||easeInCubic=easeInCubic||easeOutCubic=easeOutCubic||easeInOutCubic=easeInOutCubic||easeInQuart=easeInQuart||easeOutQuart=easeOutQuart||easeInOutQuart=easeInOutQuart||easeInQuint=easeInQuint||easeOutQuint=easeOutQuint||easeInOutQuint=easeInOutQuint||easeInExpo=easeInExpo||easeOutExpo=easeOutExpo||easeInOutExpo=easeInOutExpo||easeInSine=easeInSine||easeOutSine=easeOutSine||easeInOutSine=easeInOutSine||easeInCirc=easeInCirc||easeOutCirc=easeOutCirc||easeInOutCirc=easeInOutCirc||easeInElastic=easeInElastic||easeOutElastic=easeOutElastic||easeInOutElastic=easeInOutElastic||easeInBack=easeInBack||easeOutBack=easeOutBack||easeInOutBack=easeInOutBack||easeInBounce=easeInBounce||easeOutBounce=easeOutBounce||easeInOutBounce=easeInOutBounce', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'dev', '', '', '', 'easing', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(468, 'Core App Dependencies (Menu)', 'core_app_dependencies_menu', 3, 'select_dynamic', '', 0, 'Dependencies Menu', '*', 'None', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__menu_types\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'app_dependencies_menu', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(469, 'Core Pane Behavior', 'core_pane_behavior', 3, 'select_simple', '', 0, 'Behavior', '*', 'Select', 3, '', '', '', 'Pane Start=0||Pane Panel=1||Pane End=2', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'bool', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(483, 'Core Button Style', 'core_button_style', 3, 'select_simple', '', 0, 'Style', '*', 'Default', 3, '', '', '', 'Info=info||Inverse=inverse||Link=link||Primary=primary||Success=success||Warning=warning', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'style', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(486, 'Core Task', 'core_task', 3, 'select_simple', '', 0, 'Task', '*', ' ', 3, '', '', 'save', 'Task Cancel=cancel||Task Reset=reset||Task Reset and Search=reset2save||Task Save=apply||Task Save and Close=save||Task Save and New=save2new||Task Save and Redirect=save2redirect||Task Save and Skip=save2skip||Task Save and View=save2view||Task Save as New=save2copy||SEBLOD Ecommerce Addon=optgroup||Task Save for later=save4later||SEBLOD Exporter Addon=optgroup||Task Export=export||Task Export Ajax=export_ajax||SEBLOD Toolbox Addon=optgroup||Task Process=process||Task Process Ajax=process_ajax', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][task]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(521, 'Core Task (Exporter)', 'core_task_exporter', 3, 'select_dynamic', '', 0, 'Session', '*', 'Select', 3, 'required', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_more_sessions\",\"name\":\"title\",\"where\":\"extension=\\\"com_cck_exporter\\\"\",\"value\":\"id\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'task_id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(522, 'Core Task (Processing)', 'core_task_processing', 3, 'select_dynamic', '', 0, 'Processing', '*', 'Select', 3, 'required', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_more_processings\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"id\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'task_id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(523, 'Core CSS Core', 'core_css_core', 3, 'select_simple', '', 0, 'CSS', '*', 'Use Global', 3, '', '', '', 'Base=8||None=0||All Views=optgroup||All=1||Specific=-1||Content Views Only=optgroup||All=2||Specific=-2||Form Views Only=optgroup||All=3||Specific=-3', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'css_core', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(531, 'Core Parent (Type)', 'core_parent_type', 3, 'select_dynamic', '', 0, 'Parent', '*', 'None', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"location NOT IN (\\\"none\\\",\\\"collection\\\") AND published != -44\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'parent', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(533, 'Core Session Extension', 'core_session_extension', 3, 'select_simple', '', 0, 'Extension', '*', 'Select', 3, 'required', '', '', 'Exporter=com_cck_exporter||Importer=com_cck_importer', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, 'max-width-150', '', 'dev', '', '', '', 'extension', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(534, 'Core Session Location Filter', 'core_session_location_filter', 3, 'select_simple', '', 0, 'Location', '*', ' ', 3, '', '', '', 'Title=title||Name=name||IDS=id', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'filter_location', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(542, 'Core List Display Alt', 'core_list_display_alt', 3, 'select_simple', '', 0, 'Display Alt', '*', ' ', 3, '', '', '0', 'Yes=1||No=0', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'display_alt', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(617, 'Core Public (Viewlevel)', 'core_public_viewlevel', 3, 'select_dynamic', '', 0, 'Public Viewing Access Level', '*', 'Select a Viewing Access Level', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__viewlevels\",\"name\":\"title\",\"where\":\"\",\"value\":\"id\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'public_viewlevel', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(619, 'Core Options Today', 'core_options_today', 3, 'select_simple', '', 0, 'Show Today', '*', ' ', 3, '', '', '1', 'Hide=0||Show=1', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'json[options2][today]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(620, 'Core Optimize Memory', 'core_optimize_memory', 3, 'select_simple', '', 0, '', '*', ' ', 3, '', '', '', 'PHP7_GT=optgroup||Yes=11||PHP7_LT=optgroup||Highest Level=3||Lowest Level=1||endgroup||No=0', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'optimize_memory', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(621, 'Core Author', 'core_author', 3, 'item_x', '', 0, 'Author', '*', '', 3, '', '', '', '', '{\"add_custom\":\"\",\"select_task\":\"search\",\"select_custom\":\"\"}', 0, 255, 32, 0, 0, 0, 0, '', 0, '||user_picker', 'user_item', '', '', -2, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'author', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(622, 'Core Content Type (List Output)', 'cck_list_output', 3, 'select_dynamic', '', 1, 'Type', '*', ' ', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_types\",\"name\":\"title\",\"where\":\"published=1\",\"value\":\"name\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\"}', 0, 50, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(623, 'Core Download Hits', 'cck_download_hits', 3, 'text', '', 1, '', '*', '', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'download_hits', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(628, 'Core MetaDesc', 'core_metadesc', 3, 'text', '', 0, 'Override MetaDesc', '*', '', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[metadesc]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(629, 'Core SEF Canonical', 'core_sef_canonical', 3, 'select_simple', '', 0, 'SEF Canonical List', '*', 'Use Global', 3, '', '', '', 'Canonical List All=0||Use Canonical=optgroup||Canonical List One=1||Canonical List Pages=2||Canonical List Pages Nav=3', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'options[sef_canonical]', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(715, 'Core Search Operators', 'core_search_operators', 3, 'select_simple', '', 0, 'Operator', '*', 'Select', 3, 'required', '', '', 'Search Operator Open Toggle=((||Search Operator Open=(||Search Operator AND=AND||Search Operator OR=OR||Search Operator Close=)||Search Operator Close Toggle=))', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'defaultvalue', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(861, 'Core Parent (Site)', 'core_parent_site', 3, 'select_dynamic', '', 0, 'Parent', '*', 'None', 3, '', '', '', '', '{\"query\":\"\",\"table\":\"#__cck_core_sites\",\"name\":\"title\",\"where\":\"id != $uri->getInt(\'id\') AND published != -44\",\"value\":\"id\",\"orderby\":\"title\",\"orderby_direction\":\"ASC\",\"limit\":\"\",\"language_detection\":\"joomla\",\"language_codes\":\"EN,GB,US,FR\",\"language_default\":\"EN\",\"attr1\":\"\",\"attr2\":\"\",\"attr3\":\"\",\"attr4\":\"\",\"attr5\":\"\",\"attr6\":\"\"}', 0, 255, 32, 0, 0, 0, 0, ',', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'dev', '', '', '', 'parent_id', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(862, 'Core ID (List Output)', 'core_id_list_output', 3, 'text', '', 1, 'ID', '*', '', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '', 'pid', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(863, 'Core Content Type (Text)', 'cck_text', 3, 'text', '', 1, 'clear', '*', '', 3, '', '', '', '', '', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00'),
(864, 'Core Content Type (User)', 'cck_user', 3, 'select_simple', '', 1, 'Type', '*', 'Any Type', 3, '', '', '', 'User Site=o_user', '{\"options\":[]}', 0, 255, 32, 0, 0, 0, 0, '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 1, '', '', 'standard', '', 'free', '#__cck_core', 'cck', '', '', '', 0, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  `introchar` varchar(2) NOT NULL DEFAULT '',
  `colorchar` varchar(50) NOT NULL DEFAULT '',
  `elements` varchar(255) NOT NULL DEFAULT '',
  `icon_path` varchar(100) NOT NULL DEFAULT '',
  `depth` int(11) NOT NULL DEFAULT 0,
  `lft` int(11) NOT NULL DEFAULT 0,
  `rgt` int(11) NOT NULL DEFAULT 0,
  `description` varchar(5120) NOT NULL,
  `app` varchar(50) NOT NULL DEFAULT '',
  `featured` tinyint(3) NOT NULL DEFAULT 0,
  `home` tinyint(3) NOT NULL DEFAULT 0,
  `params` varchar(1024) NOT NULL DEFAULT '',
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


INSERT IGNORE INTO `#__cck_core_folders` (`id`, `parent_id`, `path`, `title`, `name`, `color`, `introchar`, `colorchar`, `elements`, `icon_path`, `depth`, `lft`, `rgt`, `description`, `app`, `featured`, `home`, `params`, `published`, `checked_out`, `checked_out_time`) VALUES
(1, 0, '', 'Quick Folder', 'quick_folder', '#ffd700', '', '#ffffff', 'type,field,search,template', '', 0, 0, 0, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00'),
(2, 0, '', 'Top', 'PROJECT', '', '', '', '', '', 0, 1, 20, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00'),
(3, 2, 'core', 'Core', 'core', '#184d9d', '*', '#ffffff', 'type,field,search,template', '', 1, 4, 5, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00'),
(5, 2, 'base', 'Base', 'base', '#184d9d', '*', '#ffffff', 'type,field,search,template', '', 1, 2, 3, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00'),
(60, 2, 'more', 'More', 'more', '#613c97', '*', '#ffffff', 'type,field,search,template', '', 1, 6, 19, '', '', 0, 0, '{\"viewing_access_level\":{\"Admin\":7}}', 1, 0, '0000-00-00 00:00:00'),
(61, 60, 'more/classification', 'CLASSIFICATION', 'classification', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 9, 10, '', '', 0, 0, '{\"menu_item\":104,\"user_group\":11,\"viewing_access_level\":8}', 1, 0, '0000-00-00 00:00:00'),
(62, 60, 'more/content', 'CONTENT', 'content', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 11, 12, '', '', 0, 0, '{\"menu_item\":105,\"user_group\":12,\"viewing_access_level\":10}', 1, 0, '0000-00-00 00:00:00'),
(63, 60, 'more/identities', 'IDENTITIES', 'identities', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 13, 14, '', '', 0, 0, '{\"menu_item\":106,\"user_group\":13,\"viewing_access_level\":12}', 1, 0, '0000-00-00 00:00:00'),
(64, 60, 'more/system', 'SYSTEM', 'system', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 15, 16, '', '', 0, 0, '{\"menu_item\":107,\"user_group\":14,\"viewing_access_level\":14}', 1, 0, '0000-00-00 00:00:00'),
(65, 60, 'more/api', 'API', 'api', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 7, 8, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00'),
(66, 60, 'more/theming', 'THEMING', 'theming', '#613c97', '', '#ffffff', 'type,field,search,template', '', 2, 17, 18, '', '', 0, 0, '', 1, 0, '0000-00-00 00:00:00');


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `component` varchar(50) NOT NULL DEFAULT '',
  `context` varchar(50) NOT NULL DEFAULT '',
  `options` text NOT NULL,
  `vars` varchar(255) NOT NULL DEFAULT '',
  `view` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_component` (`component`),
  KEY `idx_view` (`view`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=50 ;


INSERT IGNORE INTO `#__cck_core_objects` (`id`, `title`, `name`, `component`, `context`, `options`, `vars`, `view`) VALUES
(1, 'Joomla! Article', 'joomla_article', 'com_content', 'com_content.article', '{"default_type":"article","add":"1","add_layout":"icon","add_alt":"2","add_redirect":"1","edit":"0","edit_alt":"1"}', '', ''),
(2, 'Joomla! Category', 'joomla_category', 'com_categories', 'com_categories.category', '{"default_type":"category","add":"1","add_layout":"icon","add_alt":"2","add_redirect":"1","edit":"0","edit_alt":"1","exclude":""}', '', ''),
(3, 'Joomla! User', 'joomla_user', 'com_users', '', '{"default_type":"user","add":"1","add_layout":"icon","add_alt":"2","add_redirect":"1","edit":"0","edit_alt":"1","registration":"1"}', '', 'users'),
(4, 'Joomla! User Group', 'joomla_user_group', 'com_users', '', '{"default_type":"user_group","add":"1","add_layout":"icon","add_alt":"2","add_redirect":"1","edit":"0","edit_alt":"1"}', '', 'groups'),
(6, 'SEBLOD Free', 'free', 'com_cck', 'com_cck.free', '{}', '', ''),
(10, 'Joomla! Module', 'joomla_module', 'com_modules', 'com_modules.module', '{"default_type":"module","add":"0","add_layout":"icon","add_alt":"2","add_redirect":"0","edit":"0","edit_alt":"0"}', '', ''),
(11, 'Joomla! Menu Item', 'joomla_menu_item', 'com_menus', 'com_menus.item', '{"default_type":"menu_item","add":"0","add_layout":"icon","add_alt":"2","add_redirect":"0","edit":"0","edit_alt":"0"}', '', ''),
(12, 'Joomla! Viewlevel', 'joomla_viewlevel', 'com_users', 'com_users.level', '{"default_type":"viewing_access_level","add":"1","add_layout":"icon","add_alt":"2","add_redirect":"1","edit":"0","edit_alt":"1"}', '', 'levels'),
(13, 'Joomla! Language', 'joomla_language', 'com_languages', 'com_languages.language', '{"default_type":"language","add":"0","add_layout":"icon","add_alt":"2","add_redirect":"0","edit":"0","edit_alt":"0"}', '', 'languages');


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_searchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `content` int(11) NOT NULL DEFAULT 0,
  `template_search` int(11) NOT NULL DEFAULT 0,
  `template_filter` int(11) NOT NULL DEFAULT 0,
  `template_list` int(11) NOT NULL DEFAULT 0,
  `template_item` int(11) NOT NULL DEFAULT 0,
  `description` varchar(5120) NOT NULL DEFAULT '',
  `access` int(10) unsigned NOT NULL DEFAULT 1,
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `options` text NOT NULL,
  `location` varchar(50) NOT NULL DEFAULT '',
  `sef_route` varchar(50) NOT NULL DEFAULT '',
  `sef_route_aliases` tinyint(3) NOT NULL DEFAULT 0,
  `storage_location` varchar(50) NOT NULL DEFAULT '',
  `stylesheets` varchar(5) NOT NULL DEFAULT '',
  `version` int(11) NOT NULL DEFAULT 1,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_folder` (`folder`),
  KEY `idx_template_search` (`template_search`),
  KEY `idx_template_filter` (`template_filter`),
  KEY `idx_template_list` (`template_list`),
  KEY `idx_template_item` (`template_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_search_field` (
  `searchid` int(11) NOT NULL,
  `fieldid` int(10) unsigned NOT NULL,
  `client` varchar(50) NOT NULL,
  `ordering` int(11) NOT NULL,
  `label` varchar(255) NOT NULL COMMENT 'search,list,item',
  `variation` varchar(50) NOT NULL COMMENT 'search',
  `variation_override` varchar(1024) NOT NULL COMMENT 'search',
  `required` varchar(50) NOT NULL COMMENT 'search',
  `required_alert` varchar(1024) NOT NULL COMMENT 'search',
  `validation` varchar(50) NOT NULL COMMENT 'search',
  `validation_options` varchar(1024) NOT NULL COMMENT 'search',
  `link` varchar(50) NOT NULL COMMENT 'list,item',
  `link_options` text NOT NULL COMMENT 'list,item',
  `live` varchar(50) NOT NULL COMMENT 'search',
  `live_options` varchar(1024) NOT NULL COMMENT 'search',
  `live_value` varchar(255) NOT NULL COMMENT 'search',
  `markup` varchar(50) NOT NULL COMMENT 'search,list,item',
  `markup_class` varchar(255) NOT NULL COMMENT 'list,item',
  `match_collection` varchar(50) NOT NULL COMMENT 'search',
  `match_mode` varchar(50) NOT NULL COMMENT 'search',
  `match_options` varchar(512) NOT NULL COMMENT 'search',
  `match_value` varchar(50) NOT NULL COMMENT 'search',
  `typo` varchar(50) NOT NULL COMMENT 'list,item',
  `typo_label` tinyint(3) NOT NULL COMMENT 'list,item',
  `typo_options` varchar(2048) NOT NULL COMMENT 'list,item',
  `stage` int(11) NOT NULL DEFAULT '0' COMMENT 'search',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'search,list,item',
  `restriction` varchar(512) NOT NULL COMMENT 'search,list,item',
  `restriction_options` text NOT NULL COMMENT 'search,list,item',
  `computation` varchar(512) NOT NULL COMMENT 'search',
  `computation_options` varchar(1024) NOT NULL COMMENT 'search',
  `conditional` varchar(2048) NOT NULL COMMENT 'search',
  `conditional_options` text NOT NULL COMMENT 'search',
  `position` varchar(50) NOT NULL COMMENT 'search,list,item',
  PRIMARY KEY (`searchid`,`fieldid`,`client`),
  KEY `searchid` (`searchid`),
  KEY `fieldid` (`fieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_search_position` (
  `searchid` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `legend` varchar(255) NOT NULL,
  `variation` varchar(50) NOT NULL,
  `variation_options` text NOT NULL,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `css` varchar(255) NOT NULL,
  PRIMARY KEY (`searchid`,`position`,`client`),
  KEY `position` (`position`),
  KEY `searchid` (`searchid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL,
  `context` varchar(50) NOT NULL,
  `aliases` varchar(512) NOT NULL,
  `guest` int(10) unsigned NOT NULL,
  `guest_only_group` int(10) unsigned NOT NULL,
  `guest_only_viewlevel` int(10) unsigned NOT NULL,
  `groups` varchar(255) NOT NULL,
  `users` varchar(255) NOT NULL,
  `public_viewlevel` int(10) unsigned NOT NULL DEFAULT '0',
  `viewlevels` varchar(255) NOT NULL,
  `configuration` varchar(1024) NOT NULL,
  `options` varchar(2048) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `description` varchar(5120) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `mode` tinyint(3) NOT NULL DEFAULT 0,
  `description` varchar(5120) NOT NULL DEFAULT '',
  `featured` tinyint(3) NOT NULL DEFAULT 0,
  `options` varchar(2048) NOT NULL DEFAULT '',
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_folder` (`folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


INSERT IGNORE INTO `#__cck_core_templates` (`id`, `title`, `name`, `folder`, `mode`, `description`, `featured`, `options`, `published`, `checked_out`, `checked_out_time`) VALUES
(3, 'Table', 'seb_table', 3, 2, '', 0, '', 1, 0, '0000-00-00 00:00:00'),
(11, 'Minima', 'seb_minima', 3, 0, '', 1, '', 1, 0, '0000-00-00 00:00:00'),
(12, 'List', 'seb_list', 3, 2, '', 0, '', 1, 0, '0000-00-00 00:00:00');


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT 0,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `relationships` varchar(1024) NOT NULL DEFAULT '',
  `folder` int(11) NOT NULL DEFAULT 1,
  `template_admin` int(11) NOT NULL DEFAULT 0,
  `template_site` int(11) NOT NULL DEFAULT 0,
  `template_content` int(11) NOT NULL DEFAULT 0,
  `template_intro` int(11) NOT NULL DEFAULT 0,
  `description` varchar(5120) NOT NULL DEFAULT '',
  `indexed` varchar(50) NOT NULL DEFAULT '',
  `language` CHAR(7) NOT NULL DEFAULT '*',
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `options_admin` text NOT NULL,
  `options_site` text NOT NULL,
  `options_content` text NOT NULL,
  `options_intro` text NOT NULL,
  `admin_form` tinyint(3) NOT NULL DEFAULT 0,
  `location` varchar(50) NOT NULL DEFAULT '',
  `locked` tinyint(3) NOT NULL DEFAULT 1,
  `parent` varchar(50) NOT NULL DEFAULT '',
  `parent_inherit` tinyint(3) NOT NULL DEFAULT 0,
  `permissions` varchar(255) NOT NULL DEFAULT '',
  `storage_location` varchar(50) NOT NULL DEFAULT '',
  `stylesheets` varchar(5) NOT NULL DEFAULT '',
  `version` int(11) NOT NULL DEFAULT 1,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT 3,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_folder` (`folder`),
  KEY `idx_template_admin` (`template_admin`),
  KEY `idx_template_site` (`template_site`),
  KEY `idx_template_content` (`template_content`),
  KEY `idx_template_intro` (`template_intro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_type_field` (
  `typeid` int(11) NOT NULL,
  `fieldid` int(10) unsigned NOT NULL,
  `client` varchar(50) NOT NULL,
  `ordering` int(11) NOT NULL,
  `label` varchar(255) NOT NULL COMMENT 'admin,site,intro,content',
  `variation` varchar(50) NOT NULL COMMENT 'admin,site',
  `variation_override` varchar(1024) NOT NULL COMMENT 'admin,site',
  `required` varchar(50) NOT NULL COMMENT 'admin,site',
  `required_alert` varchar(1024) NOT NULL COMMENT 'admin,site',
  `validation` varchar(50) NOT NULL COMMENT 'admin,site',
  `validation_options` varchar(1024) NOT NULL COMMENT 'admin,site',
  `link` varchar(50) NOT NULL COMMENT 'intro,content',
  `link_options` text NOT NULL COMMENT 'intro,content',
  `live` varchar(50) NOT NULL COMMENT 'admin,site',
  `live_options` varchar(1024) NOT NULL COMMENT 'admin,site',
  `live_value` varchar(255) NOT NULL COMMENT 'admin,site',
  `markup` varchar(50) NOT NULL COMMENT 'admin,site,intro,content',
  `markup_class` varchar(255) NOT NULL COMMENT 'intro,content',
  `typo` varchar(50) NOT NULL COMMENT 'intro,content',
  `typo_label` tinyint(3) NOT NULL COMMENT 'intro,content',
  `typo_options` varchar(2048) NOT NULL COMMENT 'intro,content',
  `stage` int(11) NOT NULL DEFAULT '0' COMMENT 'admin,site',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'admin,site,intro,content',
  `restriction` varchar(512) NOT NULL COMMENT 'admin,site,intro,content',
  `restriction_options` text NOT NULL COMMENT 'admin,site,intro,content',
  `computation` varchar(512) NOT NULL COMMENT 'admin,site',
  `computation_options` varchar(1024) NOT NULL COMMENT 'admin,site',
  `conditional` varchar(2048) NOT NULL COMMENT 'admin,site',
  `conditional_options` text NOT NULL COMMENT 'admin,site',
  `position` varchar(50) NOT NULL COMMENT 'admin,site,intro,content',
  PRIMARY KEY (`typeid`,`fieldid`,`client`),
  KEY `typeid` (`typeid`),
  KEY `fieldid` (`fieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_type_position` (
  `typeid` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `legend` varchar(255) NOT NULL,
  `variation` varchar(50) NOT NULL,
  `variation_options` text NOT NULL,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `css` varchar(255) NOT NULL,
  PRIMARY KEY (`typeid`,`position`,`client`),
  KEY `typeid` (`typeid`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_core_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `e_id` int(11) NOT NULL DEFAULT 0,
  `e_title` varchar(50) NOT NULL DEFAULT '',
  `e_name` varchar(50) NOT NULL DEFAULT '',
  `e_type` varchar(50) NOT NULL DEFAULT '',
  `e_version` int(11) NOT NULL DEFAULT 1,
  `e_core` longblob,
  `e_more` varchar(255) NOT NULL DEFAULT '',
  `e_more1` longblob,
  `e_more2` longblob,
  `e_more3` longblob,
  `e_more4` longblob,
  `e_more5` longblob,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `featured` tinyint(3) NOT NULL DEFAULT 0,
  `note` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(3) NOT NULL DEFAULT 1,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_id_version` (`e_id`,`e_type`,`e_version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=500 ;


-- --------------------------------------------------------



-- --------------------------------------------------------
-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_content` (
  `id` int(10) unsigned NOT NULL,
  `archived_mode` tinyint(3) NOT NULL DEFAULT 0,
  `aliases` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_desc_auto` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_title_auto` text NOT NULL,
  `page_titles` text NOT NULL,
  `snippets` text NOT NULL,
  `texts` text NOT NULL,
  `titles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_categories` (
  `id` int(10) unsigned NOT NULL,
  `archived_mode` tinyint(3) NOT NULL DEFAULT 0,
  `aliases` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_desc_auto` text NOT NULL,
  `nav_items` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_title_auto` text NOT NULL,
  `page_titles` text NOT NULL,
  `snippets` text NOT NULL,
  `texts` text NOT NULL,
  `titles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_language` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT 0,
  `access_live` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__cck_store_item_language` (`id`, `type`, `access_live`) VALUES
(1, 0, 1);


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_menu` (
  `id` int(10) unsigned NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `item_request` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `children_type` tinyint(3) NOT NULL DEFAULT 0,
  `children_content_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_menu_types` (
  `id` int(10) unsigned NOT NULL,
  `list_type` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_users` (
  `id` int(10) unsigned NOT NULL,
  `gender` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `about_me` text NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `postal_code` varchar(255) NOT NULL DEFAULT '',
  `region` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '',
  `birthdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `birthplace` varchar(255) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `company_vat_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_usergroups` (
  `id` int(10) unsigned NOT NULL,
  `visibility_admin` tinyint(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 0,
  `visibility_manager` tinyint(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_item_viewlevels` (
  `id` int(10) unsigned NOT NULL,
  `access` int(11) NOT NULL DEFAULT 1,
  `content_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `#__cck_store_join_o_nav_list_nav_items` (
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
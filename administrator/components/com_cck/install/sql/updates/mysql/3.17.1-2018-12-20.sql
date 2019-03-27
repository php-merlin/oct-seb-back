
UPDATE `#__extensions` SET `enabled` = '1' WHERE `type` = "plugin" AND `folder` = "cck_field" AND `element` IN ("cck_break");
UPDATE `#__extensions` SET `enabled` = '1' WHERE `type` = "plugin" AND `folder` = "cck_field_link" AND `element` IN ("item_to_wysiwyg_editor");
UPDATE `#__extensions` SET `enabled` = '1' WHERE `type` = "plugin" AND `folder` = "cck_field_restriction" AND `element` IN ("cck_fields","joomla_language");
UPDATE `#__extensions` SET `enabled` = '1' WHERE `type` = "plugin" AND `folder` = "cck_field_typo" AND `element` IN ("cck_item");
UPDATE `#__extensions` SET `enabled` = '1' WHERE `type` = "plugin" AND `folder` = "cck_storage_location" AND `element` IN ("joomla_menu");

UPDATE `#__cck_core_fields` SET `options` = 'No=0||Search Full Debug=optgroup||Yes for Everyone=1||Yes for Super Admin=2||Search Light Debug=optgroup||Yes for Everyone=11||Yes for Super Admin=12||Config No Search=optgroup||Yes for Everyone=-1||Yes for Super Admin=-2' WHERE `name` = 'core_debug';
UPDATE `#__cck_core_fields` SET `options` = 'Allowed=||Allowed Hidden=hidden||As Collection=collection||Not Allowed=none||Location=optgroup||Administrator Only=admin||Site Only=site' WHERE `name` = 'core_location';
UPDATE `#__cck_core_fields` SET `options` = 'No Process=0||Resized=optgroup||Crop Center=crop||Shrink=shrink||Stretch=stretch||Resized Dynamic=optgroup||Crop Dynamic=crop_dynamic||Max Fit=maxfit||Shrink=shrink_dynamic||Stretch=stretch_dynamic' WHERE `name` = 'core_options_thumb_process';
UPDATE `#__cck_core_fields` SET `options` = 'Resized=optgroup||Crop Center=crop||Shrink=shrink||Stretch=stretch||Resized Dynamic=optgroup||Crop Dynamic=crop_dynamic||Max Fit=maxfit||Shrink=shrink_dynamic||Stretch=stretch_dynamic' WHERE `name` = 'core_options_image_process';
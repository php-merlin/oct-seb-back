
UPDATE `#__cck_core_fields` SET `options2` = REPLACE( `options2`, '"task_id_process":', '"task_id":' ) WHERE `type` = "button_submit" AND `options2` LIKE '%"task":"process%';
UPDATE `#__cck_core_fields` SET `options2` = REPLACE( `options2`, '"task_id_export":', '"task_id":' ) WHERE `type` = "button_submit" AND `options2` LIKE '%"task":"export%';
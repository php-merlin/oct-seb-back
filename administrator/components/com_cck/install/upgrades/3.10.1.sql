
UPDATE `#__cck_core_fields` SET `bool4` = 2, `options` = 'Aka/Join Tables for Search=optgroup||Placeholder Table1=aka_table1||Placeholder Table2=aka_table2||Placeholder Table3=aka_table3' WHERE `id` = 29;

UPDATE `#__cck_core_fields` SET `options` = REPLACE( `options`, 'Prepend Segment', 'Append Segment' ) WHERE `id` = 177;
ALTER TABLE `stu_work_upload` 
ADD COLUMN `img_file` TINYINT(4) NULL DEFAULT 0 AFTER `file`;

CREATE or replace
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `work_wall_view` AS
    SELECT 
        `t`.`id` AS `id`,
        CONCAT('/uploads/', `u`.`file`) AS `simg`,
        `s`.`is_name` AS `is_name`,
        `it`.`it_name` AS `it_name`,
        `c`.`ic_name` AS `ic_name`
    FROM
        (((((`education`.`stu_work` `t`
        JOIN `education`.`stu_work_upload` `u` ON (((`t`.`id` = `u`.`stu_work_id`)
            AND (`u`.`img_file` = 1))))
        LEFT JOIN `education`.`homework` `h` ON ((`t`.`hid` = `h`.`id`)))
        LEFT JOIN `education`.`info_student` `s` ON ((`s`.`is_id` = `t`.`sid`)))
        LEFT JOIN `education`.`info_teacher` `it` ON ((`it`.`it_id` = `h`.`tid`)))
        LEFT JOIN `education`.`info_campus` `c` ON ((`it`.`campus_id` = `c`.`ic_id`)))
    WHERE
        (`t`.`score` >= 1)

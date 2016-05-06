drop table if exists `stu_work_upload`;
CREATE TABLE `stu_work_upload` (
  `stu_work_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `upload_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `education`.`stu_work_upload` 
ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY (`id`);


USE `education`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `work_wall_view` AS
    SELECT t.id as id, concat('/uploads/', u.file) as simg, s.is_name, it.it_name, c.ic_name
FROM stu_work t
inner join stu_work_upload u on t.id = u.stu_work_id
left join homework h on t.hid = h.id
left join info_student s on s.is_id = t.sid
left join info_teacher it on it.it_id = h.tid
left join info_campus c on it.campus_id = c.ic_id
order by t.score desc;


drop table if exists `stu_work_upload`;
CREATE TABLE `stu_work_upload` (
  `stu_work_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `upload_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `education`.`stu_work_upload` 
ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY (`id`);

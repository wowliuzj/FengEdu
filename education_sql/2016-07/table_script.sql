ALTER TABLE `stu_work_upload` 
ADD COLUMN `img_file` TINYINT(4) NULL DEFAULT 0 AFTER `file`;

ALTER TABLE `education`.`info_campus` ADD COLUMN `ic_school_id` INT NULL  AFTER `ic_tel` ;

CREATE  TABLE `education`.`info_school` (
  `is_id` INT NOT NULL ,
  `is_name` VARCHAR(200) NULL ,
  `is_address` VARCHAR(200) NULL ,
  `is_postcode` VARCHAR(45) NULL ,
  `is_tel` VARCHAR(45) NULL ,
  PRIMARY KEY (`is_id`) );

INSERT INTO `education`.`role` (`r_id`, `r_name`, `r_status`) VALUES ('9', '学校管理员', '0');
INSERT INTO `education`.`permission` (`p_name`, `p_alias`, `p_status`, `p_view`, `p_mid`, `p_style`) VALUES ('admin/school/index', '学校管理', '0', '1', '1', 'bg_lr');
INSERT INTO `education`.`access` (`r_id`, `p_id`, `ac_r`, `ac_w`) VALUES ('1', '36', '1', '0');
ALTER TABLE `education`.`info_school` CHANGE COLUMN `is_id` `is_id` INT(11) NOT NULL AUTO_INCREMENT  ;
ALTER TABLE `education`.`admin` ADD COLUMN `school_id` INT(11) NULL DEFAULT 0  AFTER `campus_id` ;



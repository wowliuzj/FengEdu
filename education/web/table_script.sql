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

INSERT INTO `education_release`.`admin` (`a_id`, `a_name`, `a_pwd`, `a_salt`, `r_id`, `a_ip`, `a_status`, `fid`, `ftype`, `campus_id`, `school_id`) VALUES ('326', 'info_hezhou', '5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8', 'r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"', '2', '127.0.0.1', '0', '0', '2', '0', '0');
INSERT INTO `education_release`.`admin` (`a_id`, `a_name`, `a_pwd`, `a_salt`, `r_id`, `a_ip`, `a_status`, `fid`, `ftype`, `campus_id`, `school_id`) VALUES ('327', 'hq_hezhou', '5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8', 'r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"', '7', '127.0.0.1', '0', '0', '7', '0', '2');
INSERT INTO `education_release`.`admin` (`a_id`, `a_name`, `a_pwd`, `a_salt`, `r_id`, `a_ip`, `a_status`, `fid`, `ftype`, `campus_id`, `school_id`) VALUES ('328', 'campus_hezhou', '5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8', 'r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"', '8', '127.0.0.1', '0', '0', '8', '1', '0');




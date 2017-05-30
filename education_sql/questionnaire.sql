CREATE  TABLE `questionnaire` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `type` INT NULL ,
  `option` INT NULL ,
  `teacher_id` INT NULL ,
  `campus_id` INT NULL ,
  `school_id` INT NULL ,
  `category` INT NULL ,
  PRIMARY KEY (`id`) );

  ALTER TABLE `questionnaire` ADD COLUMN `question` VARCHAR(255) NULL  AFTER `category` ;

CREATE  TABLE `question_title` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `questionnaire_id` INT NULL ,
  PRIMARY KEY (`id`) );

  CREATE  TABLE `replay` (
  `id` INT NOT NULL ,
  `category_id` INT NULL ,
  `question_id` INT NULL ,
  `user_id` INT NULL ,
  `user_name` VARCHAR(45) NULL ,
  `replay` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) );


ALTER TABLE `replay` ADD COLUMN `option_id` INT(11) NULL  AFTER `replay` ;
ALTER TABLE `replay` ADD COLUMN `status` INT(11) NULL  AFTER option_id ;
ALTER TABLE `replay` ADD COLUMN `question_style` INT(11) NULL  AFTER `status` ;
ALTER TABLE `replay` RENAME TO  `education`.`answer` ;

CREATE  TABLE `option` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `option1` VARCHAR(45) NULL ,
  `option2` VARCHAR(45) NULL ,
  `option3` VARCHAR(45) NULL ,
  `option4` VARCHAR(45) NULL ,
  `option5` VARCHAR(45) NULL ,
  `school_id` INT NULL ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) );

  INSERT INTO `education`.`access` (`r_id`, `p_id`, `ac_r`, `ac_w`) VALUES ('8', '37', '1', '0');


INSERT INTO `education_release`.`permission` (`p_name`, `p_alias`, `p_status`, `p_view`, `p_mid`, `p_style`) VALUES ('question/index', '问卷调查', '0', '1', '8', 'bg_lo');
INSERT INTO `education_release`.`permission` (`p_name`, `p_alias`, `p_status`, `p_view`, `p_mid`, `p_style`) VALUES ('answer/index', '问卷调查', '0', '1', '6', 'bg_lo');


INSERT INTO `education_release`.`access` (`r_id`, `p_id`, `ac_r`, `ac_w`) VALUES ('8', '37', '1', '0');
INSERT INTO `education_release`.`access` (`r_id`, `p_id`, `ac_r`, `ac_w`) VALUES ('6', '38', '1', '0');

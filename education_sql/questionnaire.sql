CREATE  TABLE `education`.`questionnaire` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `type` INT NULL ,
  `option` INT NULL ,
  `teacher_id` INT NULL ,
  `campus_id` INT NULL ,
  `school_id` INT NULL ,
  `category` INT NULL ,
  PRIMARY KEY (`id`) );

  ALTER TABLE `education`.`questionnaire` ADD COLUMN `question` VARCHAR(255) NULL  AFTER `category` ;

CREATE  TABLE `education`.`question_title` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `questionnaire_id` INT NULL ,
  PRIMARY KEY (`id`) );

  CREATE  TABLE `education`.`replay` (
  `id` INT NOT NULL ,
  `category_id` INT NULL ,
  `question_id` INT NULL ,
  `user_id` INT NULL ,
  `user_name` VARCHAR(45) NULL ,
  `replay` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) );


ALTER TABLE `education`.`replay` ADD COLUMN `option_id` INT(11) NULL  AFTER `replay` ;
ALTER TABLE `education`.`replay` ADD COLUMN `status` INT(11) NULL  AFTER option_id ;
ALTER TABLE `education`.`replay` ADD COLUMN `question_style` INT(11) NULL  AFTER `status` ;
ALTER TABLE `education`.`replay` RENAME TO  `education`.`answer` ;

CREATE  TABLE `education`.`option` (
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


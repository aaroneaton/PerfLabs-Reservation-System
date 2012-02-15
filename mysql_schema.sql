SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `reservation_system` DEFAULT CHARACTER SET utf8 ;
USE `reservation_system` ;

-- -----------------------------------------------------
-- Table `reservation_system`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `net_id` VARCHAR(128) NOT NULL COMMENT '	' ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`user_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`user_role` (
  `user_role_id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`user_role_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_location`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_location` (
  `equipment_location_id` INT NOT NULL AUTO_INCREMENT ,
  `bldg` VARCHAR(128) NOT NULL ,
  `room` VARCHAR(45) NOT NULL ,
  `area` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`equipment_location_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_type` (
  `equipment_type_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `icon_url` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`equipment_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment` (
  `equipment_id` INT NOT NULL AUTO_INCREMENT ,
  `custom_id` SMALLINT NOT NULL ,
  `name` VARCHAR(128) NOT NULL ,
  `desc` TEXT NOT NULL ,
  `qty` SMALLINT NOT NULL ,
  `manual` TEXT NULL DEFAULT NULL ,
  `image` TEXT NULL DEFAULT NULL ,
  `acq_date` DATE NOT NULL ,
  `equipment_location_id` INT NOT NULL ,
  `status` SMALLINT NOT NULL ,
  `user_id` INT NOT NULL ,
  `equipment_type_id` INT NOT NULL ,
  `user_role_id` INT NOT NULL ,
  PRIMARY KEY (`equipment_id`) ,
  INDEX `fk_equipment_users1` (`user_id` ASC) ,
  INDEX `fk_equipment_equipment_locations1` (`equipment_location_id` ASC) ,
  INDEX `fk_equipment_equipment_types1` (`equipment_type_id` ASC) ,
  INDEX `fk_equipment_user_role1` (`user_role_id` ASC) ,
  CONSTRAINT `fk_equipment_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_equipment_locations1`
    FOREIGN KEY (`equipment_location_id` )
    REFERENCES `reservation_system`.`equipment_location` (`equipment_location_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_equipment_types1`
    FOREIGN KEY (`equipment_type_id` )
    REFERENCES `reservation_system`.`equipment_type` (`equipment_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_user_role1`
    FOREIGN KEY (`user_role_id` )
    REFERENCES `reservation_system`.`user_role` (`user_role_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_type` (
  `request_type_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(128) NOT NULL ,
  PRIMARY KEY (`request_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`room`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`room` (
  `room_id` INT NOT NULL AUTO_INCREMENT ,
  `bldg` VARCHAR(45) NOT NULL ,
  `number` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`room_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request` (
  `request_id` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `user_id` INT NOT NULL ,
  `request_type_id` INT NOT NULL ,
  `date_start` DATE NOT NULL ,
  `date_end` DATE NOT NULL ,
  `time_start` TIME NOT NULL ,
  `time_end` TIME NOT NULL ,
  `room_id` INT NOT NULL ,
  `purpose` TEXT NULL ,
  `note` TEXT NULL ,
  `course` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`request_id`) ,
  INDEX `fk_requests_users` (`user_id` ASC) ,
  INDEX `fk_requests_request_types1` (`request_type_id` ASC) ,
  INDEX `fk_requests_rooms1` (`room_id` ASC) ,
  CONSTRAINT `fk_requests_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_request_types1`
    FOREIGN KEY (`request_type_id` )
    REFERENCES `reservation_system`.`request_type` (`request_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `reservation_system`.`room` (`room_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_history` (
  `equipment_history_id` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `action` VARCHAR(45) NOT NULL ,
  `equipment_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `request_id` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`equipment_history_id`) ,
  INDEX `fk_equipment_history_users1` (`user_id` ASC) ,
  INDEX `fk_equipment_history_equipment1` (`equipment_id` ASC) ,
  INDEX `fk_equipment_history_requests1` (`request_id` ASC) ,
  CONSTRAINT `fk_equipment_history_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_history_equipment1`
    FOREIGN KEY (`equipment_id` )
    REFERENCES `reservation_system`.`equipment` (`equipment_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_history_requests1`
    FOREIGN KEY (`request_id` )
    REFERENCES `reservation_system`.`request` (`request_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`room_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`room_history` (
  `room_history_id` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NULL DEFAULT NULL ,
  `room_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `request_id` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`room_history_id`) ,
  INDEX `fk_room_history_users1` (`user_id` ASC) ,
  INDEX `fk_room_history_rooms1` (`room_id` ASC) ,
  INDEX `fk_room_history_requests1` (`request_id` ASC) ,
  CONSTRAINT `fk_room_history_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_history_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `reservation_system`.`room` (`room_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_history_requests1`
    FOREIGN KEY (`request_id` )
    REFERENCES `reservation_system`.`request` (`request_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`studio_guest`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`studio_guest` (
  `studio_guest_id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `tamu_relationship` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`studio_guest_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_comment` (
  `request_comment_id` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NULL DEFAULT NULL ,
  `comment` TEXT NULL DEFAULT NULL ,
  `user_id` INT NOT NULL ,
  `request_id` INT NOT NULL ,
  PRIMARY KEY (`request_comment_id`) ,
  INDEX `fk_request_comments_users1` (`user_id` ASC) ,
  INDEX `fk_request_comments_requests1` (`request_id` ASC) ,
  CONSTRAINT `fk_request_comments_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_comments_requests1`
    FOREIGN KEY (`request_id` )
    REFERENCES `reservation_system`.`request` (`request_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_has_studio_guest`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_has_studio_guest` (
  `request_id` INT NOT NULL ,
  `studio_guest_id` INT NOT NULL ,
  PRIMARY KEY (`request_id`, `studio_guest_id`) ,
  INDEX `fk_requests_has_studio_guests_studio_guests1` (`studio_guest_id` ASC) ,
  INDEX `fk_requests_has_studio_guests_requests1` (`request_id` ASC) ,
  CONSTRAINT `fk_requests_has_studio_guests_requests1`
    FOREIGN KEY (`request_id` )
    REFERENCES `reservation_system`.`request` (`request_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_has_studio_guests_studio_guests1`
    FOREIGN KEY (`studio_guest_id` )
    REFERENCES `reservation_system`.`studio_guest` (`studio_guest_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_has_equipment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_has_equipment` (
  `request_id` INT NOT NULL ,
  `equipment_id` INT NOT NULL ,
  PRIMARY KEY (`request_id`, `equipment_id`) ,
  INDEX `fk_requests_has_equipment_equipment1` (`equipment_id` ASC) ,
  INDEX `fk_requests_has_equipment_requests1` (`request_id` ASC) ,
  CONSTRAINT `fk_requests_has_equipment_requests1`
    FOREIGN KEY (`request_id` )
    REFERENCES `reservation_system`.`request` (`request_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_has_equipment_equipment1`
    FOREIGN KEY (`equipment_id` )
    REFERENCES `reservation_system`.`equipment` (`equipment_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`user_meta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`user_meta` (
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(45) NULL DEFAULT NULL ,
  `last_name` VARCHAR(45) NULL DEFAULT NULL ,
  `email` VARCHAR(128) NULL DEFAULT NULL ,
  `phone` VARCHAR(12) NULL DEFAULT NULL ,
  `uin` INT NULL DEFAULT NULL ,
  `user_role_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_user_meta_users1` (`user_id` ASC) ,
  INDEX `fk_user_meta_user_roles1` (`user_role_id` ASC) ,
  CONSTRAINT `fk_user_meta_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `reservation_system`.`user` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_meta_user_roles1`
    FOREIGN KEY (`user_role_id` )
    REFERENCES `reservation_system`.`user_role` (`user_role_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`ci_session_44928`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`ci_session_44928` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT 0 ,
  `ip_address` VARCHAR(16) NOT NULL DEFAULT 0 ,
  `user_agent` VARCHAR(120) NOT NULL ,
  `last_activity` INT(10) NOT NULL DEFAULT 0 ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `reservation_system`.`user_role`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `reservation_system`;
INSERT INTO `reservation_system`.`user_role` (`user_role_id`, `name`) VALUES (10, 'Student');
INSERT INTO `reservation_system`.`user_role` (`user_role_id`, `name`) VALUES (20, 'Studio User');
INSERT INTO `reservation_system`.`user_role` (`user_role_id`, `name`) VALUES (30, 'Faculty/Staff');
INSERT INTO `reservation_system`.`user_role` (`user_role_id`, `name`) VALUES (40, 'Manager');
INSERT INTO `reservation_system`.`user_role` (`user_role_id`, `name`) VALUES (50, 'Administrator');

COMMIT;

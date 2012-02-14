SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `reservation_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `reservation_system` ;

-- -----------------------------------------------------
-- Table `reservation_system`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`users` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `net_id` VARCHAR(128) NOT NULL COMMENT '	' ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`user_roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`user_roles` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_locations` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `bldg` VARCHAR(128) NOT NULL ,
  `room` VARCHAR(45) NOT NULL ,
  `area` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_types` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `icon_url` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `custom_id` SMALLINT NOT NULL ,
  `name` VARCHAR(128) NOT NULL ,
  `desc` TEXT NOT NULL ,
  `qty` SMALLINT NOT NULL ,
  `manual` TEXT NULL ,
  `image` TEXT NULL ,
  `acq_date` DATE NOT NULL ,
  `equipment_locations_key` INT NOT NULL ,
  `status` SMALLINT NOT NULL ,
  `users_poss` INT NOT NULL ,
  `equipment_types_key` INT NOT NULL ,
  PRIMARY KEY (`key`) ,
  INDEX `fk_equipment_users1` (`users_poss` ASC) ,
  INDEX `fk_equipment_equipment_locations1` (`equipment_locations_key` ASC) ,
  INDEX `fk_equipment_equipment_types1` (`equipment_types_key` ASC) ,
  CONSTRAINT `fk_equipment_users1`
    FOREIGN KEY (`users_poss` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_equipment_locations1`
    FOREIGN KEY (`equipment_locations_key` )
    REFERENCES `reservation_system`.`equipment_locations` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_equipment_types1`
    FOREIGN KEY (`equipment_types_key` )
    REFERENCES `reservation_system`.`equipment_types` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_types` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(128) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`rooms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`rooms` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `bldg` VARCHAR(45) NOT NULL ,
  `number` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`requests`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`requests` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `users_key` INT NOT NULL ,
  `request_types_key` INT NOT NULL ,
  `date_start` DATE NOT NULL ,
  `date_end` DATE NOT NULL ,
  `time_start` TIME NOT NULL ,
  `time_end` TIME NOT NULL ,
  `rooms_key` INT NOT NULL ,
  `purpose` TEXT NOT NULL ,
  `course` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) ,
  INDEX `fk_requests_users` (`users_key` ASC) ,
  INDEX `fk_requests_request_types1` (`request_types_key` ASC) ,
  INDEX `fk_requests_rooms1` (`rooms_key` ASC) ,
  CONSTRAINT `fk_requests_users`
    FOREIGN KEY (`users_key` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_request_types1`
    FOREIGN KEY (`request_types_key` )
    REFERENCES `reservation_system`.`request_types` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_rooms1`
    FOREIGN KEY (`rooms_key` )
    REFERENCES `reservation_system`.`rooms` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`equipment_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`equipment_history` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `action` VARCHAR(45) NOT NULL ,
  `equipment_key` INT NOT NULL ,
  `users_key` INT NOT NULL ,
  `requests_key` INT NULL ,
  PRIMARY KEY (`key`) ,
  INDEX `fk_equipment_history_users1` (`users_key` ASC) ,
  INDEX `fk_equipment_history_equipment1` (`equipment_key` ASC) ,
  INDEX `fk_equipment_history_requests1` (`requests_key` ASC) ,
  CONSTRAINT `fk_equipment_history_users1`
    FOREIGN KEY (`users_key` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_history_equipment1`
    FOREIGN KEY (`equipment_key` )
    REFERENCES `reservation_system`.`equipment` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_history_requests1`
    FOREIGN KEY (`requests_key` )
    REFERENCES `reservation_system`.`requests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`room_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`room_history` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NULL ,
  `rooms_key` INT NOT NULL ,
  `users_key` INT NOT NULL ,
  `requests_key` INT NULL ,
  PRIMARY KEY (`key`) ,
  INDEX `fk_room_history_users1` (`users_key` ASC) ,
  INDEX `fk_room_history_rooms1` (`rooms_key` ASC) ,
  INDEX `fk_room_history_requests1` (`requests_key` ASC) ,
  CONSTRAINT `fk_room_history_users1`
    FOREIGN KEY (`users_key` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_history_rooms1`
    FOREIGN KEY (`rooms_key` )
    REFERENCES `reservation_system`.`rooms` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_history_requests1`
    FOREIGN KEY (`requests_key` )
    REFERENCES `reservation_system`.`requests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`studio_guests`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`studio_guests` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `tamu_relationship` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`key`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`request_comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`request_comments` (
  `key` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NULL ,
  `comment` TEXT NULL ,
  `users_key` INT NOT NULL ,
  `requests_key` INT NOT NULL ,
  PRIMARY KEY (`key`) ,
  INDEX `fk_request_comments_users1` (`users_key` ASC) ,
  INDEX `fk_request_comments_requests1` (`requests_key` ASC) ,
  CONSTRAINT `fk_request_comments_users1`
    FOREIGN KEY (`users_key` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_comments_requests1`
    FOREIGN KEY (`requests_key` )
    REFERENCES `reservation_system`.`requests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`requests_has_studio_guests`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`requests_has_studio_guests` (
  `requests_key` INT NOT NULL ,
  `studio_guests_key` INT NOT NULL ,
  PRIMARY KEY (`requests_key`, `studio_guests_key`) ,
  INDEX `fk_requests_has_studio_guests_studio_guests1` (`studio_guests_key` ASC) ,
  INDEX `fk_requests_has_studio_guests_requests1` (`requests_key` ASC) ,
  CONSTRAINT `fk_requests_has_studio_guests_requests1`
    FOREIGN KEY (`requests_key` )
    REFERENCES `reservation_system`.`requests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_has_studio_guests_studio_guests1`
    FOREIGN KEY (`studio_guests_key` )
    REFERENCES `reservation_system`.`studio_guests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`requests_has_equipment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`requests_has_equipment` (
  `requests_key` INT NOT NULL ,
  `equipment_key` INT NOT NULL ,
  PRIMARY KEY (`requests_key`, `equipment_key`) ,
  INDEX `fk_requests_has_equipment_equipment1` (`equipment_key` ASC) ,
  INDEX `fk_requests_has_equipment_requests1` (`requests_key` ASC) ,
  CONSTRAINT `fk_requests_has_equipment_requests1`
    FOREIGN KEY (`requests_key` )
    REFERENCES `reservation_system`.`requests` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_has_equipment_equipment1`
    FOREIGN KEY (`equipment_key` )
    REFERENCES `reservation_system`.`equipment` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`user_meta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`user_meta` (
  `users_key` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(45) NULL ,
  `last_name` VARCHAR(45) NULL ,
  `email` VARCHAR(128) NULL ,
  `phone` VARCHAR(12) NULL ,
  `uin` INT NULL ,
  `user_roles_key` INT NOT NULL ,
  PRIMARY KEY (`users_key`) ,
  INDEX `fk_user_meta_users1` (`users_key` ASC) ,
  INDEX `fk_user_meta_user_roles1` (`user_roles_key` ASC) ,
  CONSTRAINT `fk_user_meta_users1`
    FOREIGN KEY (`users_key` )
    REFERENCES `reservation_system`.`users` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_meta_user_roles1`
    FOREIGN KEY (`user_roles_key` )
    REFERENCES `reservation_system`.`user_roles` (`key` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservation_system`.`ci_session_44928`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reservation_system`.`ci_session_44928` (
  session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(16) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

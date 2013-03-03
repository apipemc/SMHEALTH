SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dbsmhealth` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `dbsmhealth`;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`user` (
  `UserId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Username` VARCHAR(45) NOT NULL ,
  `Password` VARCHAR(45) NOT NULL ,
  `Status` TINYINT(4) NOT NULL DEFAULT 1 ,
  `ProfileId` INT(11) NOT NULL ,
  PRIMARY KEY (`UserId`) ,
  INDEX `fk_user_profile_idx` (`ProfileId` ASC) ,
  CONSTRAINT `fk_user_profile`
    FOREIGN KEY (`ProfileId` )
    REFERENCES `dbsmhealth`.`profile` (`ProfileId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`profile` (
  `ProfileId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  `Status` TINYINT(4) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`ProfileId`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`doctor` (
  `DoctorId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  `Identification` INT(11) NOT NULL ,
  `Birthday` DATETIME NOT NULL ,
  `StarTime` TIME NOT NULL ,
  `EndTime` TIME NOT NULL ,
  `Status` TINYINT(4) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`DoctorId`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`patient` (
  `PatientId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Identification` INT(11) NOT NULL ,
  `Birthday` DATETIME NOT NULL ,
  `Phone` VARCHAR(45) NULL DEFAULT NULL ,
  `Observation` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`PatientId`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`specialization` (
  `SpecializationId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  `Status` TINYINT(4) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`SpecializationId`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`specialization_x_doctor` (
  `SpecializationXdoctorId` INT(11) NOT NULL AUTO_INCREMENT ,
  `SpecializationId` INT(11) NOT NULL ,
  `DoctorId` INT(11) NOT NULL ,
  INDEX `fk_specialization_x_doctor_specialization1_idx` (`SpecializationId` ASC) ,
  INDEX `fk_specialization_x_doctor_doctor1_idx` (`DoctorId` ASC) ,
  PRIMARY KEY (`SecializationXdoctorId`) ,
  CONSTRAINT `fk_specialization_x_doctor_specialization1`
    FOREIGN KEY (`SpecializationId` )
    REFERENCES `dbsmhealth`.`specialization` (`SpecializationId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_specialization_x_doctor_doctor1`
    FOREIGN KEY (`DoctorId` )
    REFERENCES `dbsmhealth`.`doctor` (`DoctorId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `dbsmhealth`.`booking` (
  `BookingId` INT(11) NOT NULL AUTO_INCREMENT ,
  `Reservationdate` DATETIME NOT NULL ,
  `Registrationdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `DoctorId` INT(11) NOT NULL ,
  `PatientId` INT(11) NOT NULL ,
  `UserId` INT(11) NOT NULL ,
  `Status` TINYINT(4) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`BookingId`) ,
  INDEX `fk_booking_doctor1_idx` (`DoctorId` ASC) ,
  INDEX `fk_booking_patient1_idx` (`PatientId` ASC) ,
  INDEX `fk_booking_user1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_booking_doctor1`
    FOREIGN KEY (`DoctorId` )
    REFERENCES `dbsmhealth`.`doctor` (`DoctorId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_patient1`
    FOREIGN KEY (`PatientId` )
    REFERENCES `dbsmhealth`.`patient` (`PatientId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_user1`
    FOREIGN KEY (`UserId` )
    REFERENCES `dbsmhealth`.`user` (`UserId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

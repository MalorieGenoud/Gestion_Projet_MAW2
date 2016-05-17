-- MySQL Script generated by MySQL Workbench
-- 05/17/16 14:18:33
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bones
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bones
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bones` DEFAULT CHARACTER SET utf8 ;
USE `bones` ;

-- -----------------------------------------------------
-- Table `bones`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`projects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `created_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(20) NOT NULL,
  `lastname` VARCHAR(20) NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  `role_id` INT NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `remember_token` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_role1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `bones`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`tasks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `duration` VARCHAR(45) NOT NULL,
  `date_jalon` DATE NULL,
  `statut` VARCHAR(15) NOT NULL,
  `priority` INT NOT NULL,
  `project_id` INT NOT NULL,
  `parent_id` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tasks_projects1_idx` (`project_id` ASC),
  INDEX `fk_tasks_tasks1_idx` (`parent_id` ASC),
  CONSTRAINT `fk_tasks_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `bones`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_tasks1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `bones`.`tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `url` VARCHAR(45) NOT NULL,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_files_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_files_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `bones`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`users_tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`users_tasks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  INDEX `fk_users_has_tasks_tasks1_idx` (`task_id` ASC),
  INDEX `fk_users_has_tasks_users1_idx` (`user_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_has_tasks_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bones`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_tasks_tasks1`
    FOREIGN KEY (`task_id`)
    REFERENCES `bones`.`tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`durations_tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`durations_tasks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `ended_at` DATETIME NULL,
  `user_task_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_durations_tasks_users_tasks1_idx` (`user_task_id` ASC),
  CONSTRAINT `fk_durations_tasks_users_tasks1`
    FOREIGN KEY (`user_task_id`)
    REFERENCES `bones`.`users_tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`invitations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`invitations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(45) NOT NULL,
  `statut` VARCHAR(45) NULL,
  `guest_id` INT NULL,
  `host_id` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_invitations_users1_idx` (`guest_id` ASC),
  INDEX `fk_invitations_users2_idx` (`host_id` ASC),
  INDEX `fk_invitations_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_invitations_users1`
    FOREIGN KEY (`guest_id`)
    REFERENCES `bones`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invitations_users2`
    FOREIGN KEY (`host_id`)
    REFERENCES `bones`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invitations_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `bones`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bones`.`projects_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bones`.`projects_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `project_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  INDEX `fk_projects_has_users_users1_idx` (`user_id` ASC),
  INDEX `fk_projects_has_users_projects_idx` (`project_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_projects_has_users_projects`
    FOREIGN KEY (`project_id`)
    REFERENCES `bones`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projects_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bones`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

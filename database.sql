--- Listing table

CREATE TABLE `workopia`.`listings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  `salary` VARCHAR(45) NULL,
  `tags` VARCHAR(255) NULL,
  `company` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `city` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `requirements` LONGTEXT NULL,
  `benifits` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- USER TABLE

CREATE TABLE `workopia`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `city` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

ALTER TABLE `workopia`.`listings` 
ADD INDEX `fk_listings_user_idx` (`user_id` ASC) VISIBLE;
;
ALTER TABLE `workopia`.`listings` 
ADD CONSTRAINT `fk_listings_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `workopia`.`users` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

-- INSERT user table data 
INSERT INTO `workopia`.`users` (`name`, `email`, `password`, `city`, `state`) VALUES ('Tahir', '01tahirahmed@gmail.com', 'tahir123', 'Morigaon', 'Assam');
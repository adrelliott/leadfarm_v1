--
-- Table structure for table `Contact_Search`
--

DROP TABLE IF EXISTS `Contact_Search`;
CREATE TABLE `Contact_Search` (
  `Id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Contact_id` INT(50) NOT NULL COMMENT 'Contact.Id' REFERENCES `Contact` (`Id`),
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` timestamp NOT NULL,
  `name` VARCHAR(64) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `contact_idx` (`Contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `Contact_Search_Criteria`
--

DROP TABLE IF EXISTS `Contact_Search_Criteria`;
CREATE TABLE `Contact_Search_Criteria` (
  `Id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Search_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'Contact_Search.Id' REFERENCES `Contact_Search` (`Id`),
  `field` VARCHAR(255) NOT NULL,
  `operation` ENUM('equal', 'notequal', 'greaterthan', 'lessthan') NOT NULL,
  `value` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `search_field_idx` (`Search_id`, `field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `Contact_Search_Tag`
--

DROP TABLE IF EXISTS `Contact_Search_Tag`;
CREATE TABLE `Contact_Search_Tag` (
  `Id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Search_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'Contact_Search.Id' REFERENCES `Contact_Search` (`Id`),
  `Tag_id` INT(5) NOT NULL COMMENT '__tagjoin.__Id' REFERENCES `__tagjoin` (`__Id`),
  `include` BOOLEAN NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `search_tag_idx` (`Search_id`, `Tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
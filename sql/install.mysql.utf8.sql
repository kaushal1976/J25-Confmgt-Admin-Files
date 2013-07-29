CREATE TABLE IF NOT EXISTS `#__confmgt_tracs` (
	`id` int(11) NOT NULL auto_increment,
	`track_leader` INT(11) NOT NULL ,
	`track_name` VARCHAR(255) NOT NULL ,
	`track_description` TEXT NOT NULL ,
	`ordering` INT(11) ,
	`published` INT(11) ,
	`modification_date` DATE ,
	`creation_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_themes` (
	`id` int(11) NOT NULL auto_increment,
	`track` INT(11) NOT NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`description` TEXT NOT NULL ,
	`theme_page` VARCHAR(255) DEFAULT '0' ,
	`ordering` INT(11) ,
	`published` INT(11) ,
	`modification_date` DATE ,
	`creation_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_authors` (
	`id` int(11) NOT NULL auto_increment,
	`added_by` INT(11) ,
	`title` VARCHAR(255) NOT NULL ,
	`first_name` VARCHAR(255) NOT NULL ,
	`surname` VARCHAR(255) NOT NULL ,
	`email` VARCHAR(255) NOT NULL ,
	`affiliation` VARCHAR(255) NOT NULL ,
	`attending_the_conference` TINYINT NOT NULL DEFAULT 1 ,
	`user` INT(11) ,
	`paid_and_registered` TINYINT DEFAULT 0 ,
	`ordering` INT(11) ,
	`modification_date` DATE ,
	`creation_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_main` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` VARCHAR(255) NOT NULL ,
	`link_id` VARCHAR(255) NOT NULL DEFAULT '0' ,
	`user` INT(11) NOT NULL ,
	`title` VARCHAR(255) NOT NULL ,
	`abstract` TEXT NOT NULL ,
	`theme` INT(11) NOT NULL ,
	`key_words` VARCHAR(255) NOT NULL ,
	`student_paper` TINYINT DEFAULT 0 ,
	`creation_date` DATE ,
	`modification_date` DATE ,
	`publish` TINYINT DEFAULT 1 ,
	`full_paper` INT(11) ,
	`camera_ready_paper` INT(11) ,
	`presentation` INT(11) ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_revrs` (
	`id` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL ,
	`first_name` VARCHAR(255) NOT NULL ,
	`surname` VARCHAR(255) NOT NULL ,
	`email` VARCHAR(255) NOT NULL ,
	`affiliation` VARCHAR(255) NOT NULL ,
	`remind_pending` TINYINT ,
	`user` INT(11) NOT NULL ,
	`accepted` TINYINT NOT NULL DEFAULT 0 ,
	`rnd` VARCHAR(255) ,
	`creation_date` DATE ,
	`modification_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_revs` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` INT(11) NOT NULL ,
	`mode` VARCHAR(255) NOT NULL DEFAULT 'abs' ,
	`reviewer` INT(11) NOT NULL ,
	`comments_to_author` TEXT NOT NULL ,
	`comments_to_coordinator` TEXT ,
	`comments_on_title` TEXT ,
	`comments_on_originality` TEXT ,
	`comments_on_methodology` TEXT ,
	`comments_on_formatting` TEXT ,
	`comments_on_language` TEXT ,
	`attachment` VARCHAR(255) ,
	`recommondation` VARCHAR(255) NOT NULL ,
	`rating` INT(11) NOT NULL DEFAULT 0 ,
	`post` TINYINT NOT NULL DEFAULT 1 ,
	`modification_date` DATE ,
	`creation_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_revspapers` (
	`id` int(11) NOT NULL auto_increment,
	`paper` INT(11) NOT NULL ,
	`reviewer` INT(11) NOT NULL ,
	`creation_date` DATE ,
	`modification_date` DATE ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_camera` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` INT(11) ,
	`title` VARCHAR(255) NOT NULL ,
	`abstract` TEXT NOT NULL ,
	`camera_ready_paper` VARCHAR(255) NOT NULL ,
	`keywords` VARCHAR(255) ,
	`copyright_transfer` TINYINT NOT NULL ,
	`modification_date` DATE ,
	`creation_date` DATE ,
	`publish` TINYINT DEFAULT 1 ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_presentation` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` INT(11) NOT NULL ,
	`presentation` VARCHAR(255) NOT NULL ,
	`biography` TEXT ,
	`presenter` INT(11) NOT NULL ,
	`creation_date` DATE ,
	`modification_date` DATE ,
	`publish` TINYINT ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_fullpapers` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` INT(11) ,
	`full_paper` VARCHAR(255) ,
	`modification_date` DATE ,
	`creation_date` DATE ,
	`publish` TINYINT ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_revoutcomes` (
	`id` int(11) NOT NULL auto_increment,
	`paper_id` INT(11) ,
	`mode` VARCHAR(255) NOT NULL DEFAULT 'full' ,
	`review_outcome` VARCHAR(255) NOT NULL DEFAULT '0' ,
	`review_comment` TEXT ,
	`attachment` VARCHAR(255) ,
	`creation_date` DATE ,
	`modification_date` DATE ,
	`published` INT(11) ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__confmgt_authpapers` (
	`id` int(11) NOT NULL auto_increment,
	`author_id` INT(11) NOT NULL ,
	`paper_id` INT(11) NOT NULL ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




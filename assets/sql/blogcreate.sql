USE australia;

DROP TABLE IF EXISTS blog;

CREATE TABLE IF NOT EXISTS blog (
	id int unsigned NOT NULL auto_increment,
	title varchar(255) NOT NULL,
	precis text NOT NULL,
	article text NOT NULL,
	updated timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	created timestamp NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (id)
) ENGINE=InnoDB;

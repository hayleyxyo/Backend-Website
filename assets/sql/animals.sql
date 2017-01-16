DROP TABLE IF EXISTS animals;
CREATE TABLE animals (
	id INT UNSIGNED AUTO_INCREMENT, --automative mubering the photo
	name VARCHAR(48) NOT NULL, --original name
	src VARCHAR(60) NOT NULL,  --file name
	title VARCHAR(60) NOT NULL, --friendly name eg. Tasmania Devil (for humen to read)
	description varchar(255) DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=INNODB;

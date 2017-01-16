USE australia;
DROP TABLE IF EXISTS animals;
CREATE TABLE animals (
	id INT UNSIGNED AUTO_INCREMENT,
	title VARCHAR(60) NOT NULL,
	description VARCHAR(255) DEFAULT NULL,
	url VARCHAR(255) DEFAULT NULL,
	image VARCHAR(48),
	PRIMARY KEY (id),
	CONSTRAINT image FOREIGN KEY (image) REFERENCES images(src)
		ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=INNODB;
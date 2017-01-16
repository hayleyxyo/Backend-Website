DROP DATABASE IF EXISTS australia;

CREATE DATABASE australia;
USE australia;

-- DELETE FROM users WHERE user_login = 'ozadmin'@'localhost';
GRANT USAGE ON *.* TO 'ozadmin'@'localhost';
DROP USER ozadmin@localhost;
CREATE USER ozadmin@localhost IDENTIFIED BY 'password';
-- CREATE USER 'ozadmin'@'localhost' IDENTIFIED BY 'secret';

GRANT SELECT,INSERT,UPDATE,DELETE ON australia.*  TO ozadmin@localhost;

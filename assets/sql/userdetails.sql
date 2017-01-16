DROP VIEW IF EXISTS userdetails;

CREATE VIEW userdetails AS
SELECT id, email, familyname, givenname, passwd, admin,
	concat(givenname,' ',familyname) as username
FROM users;
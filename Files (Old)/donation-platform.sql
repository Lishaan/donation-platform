CREATE DATABASE IF NOT EXISTS donation-platform;

DROP TABLE IF EXISTS users;

-- alter session set NLS_DATE_FORMAT='DD/MM/YYYY';

CREATE TABLE users (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
	uid varchar(128) not null,
	eid varchar(128) not null,
	pwd varchar(128) not null,

	full_name varchar(128) not null,
	gender char(1) not null,
	birthday datetime not null,
	phone_number char(7) not null
);

INSERT INTO users (id, uid, eid, pwd, full_name, gender, birthday, phone_number) 
	VALUES (0, 'admin', 'admin@sunway.com', '$2y$10$0rqgL.L0hRFnP9KHSUsp/ui2n.N/4Azn359OsHQ/CdQKRPPp.5D1W', 'Lishan Abbas', 'M', '1998-06-25', '9894449');
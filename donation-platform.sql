DROP TABLE IF EXISTS donators;
DROP TABLE IF EXISTS organisations;

CREATE TABLE donators (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
);

CREATE TABLE organisations (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
);

CREATE TABLE followers {
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	follower_id int(11) NOT NULL,
}

INSERT INTO donators (id, name, email, password) 
VALUES (0, 'John Smith', 'john@email.com', '$2y$10$0rqgL.L0hRFnP9KHSUsp/ui2n.N/4Azn359OsHQ/CdQKRPPp.5D1W');

INSERT INTO organisations (id, name, email, password) 
VALUES (0, 'GiveWell', 'givewell@email.com', '$2y$10$0rqgL.L0hRFnP9KHSUsp/ui2n.N/4Azn359OsHQ/CdQKRPPp.5D1W');
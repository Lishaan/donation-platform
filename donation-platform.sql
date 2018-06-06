DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts_likes;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    type char(1) NOT NULL -- 'D' (Donators) or O (organisations)
);

CREATE TABLE followers (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	follower_user_id int(11) NOT NULL,
	follow_date datetime NOT NULL
);

CREATE TABLE posts (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    poster_user_id int(11) NOT NULL, 
    posted_at datetime NOT NULL,

    likes int(11) NOT NULL,
    title varchar(32) NOT NULL,
    body varchar(512) NOT NULL,

	FOREIGN KEY (poster_user_id) REFERENCES users (id)
);

CREATE TABLE comments (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	post_id int(11) NOT NULL,
	commenter_user_id int(11) NOT NULL,
	comment_body text NOT NULL,
	posted_at datetime NOT NULL,

	FOREIGN KEY (post_id) REFERENCES posts (id),
	FOREIGN KEY (commenter_user_id) REFERENCES users (id)
);

CREATE TABLE posts_likes (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	post_id int(11) NOT NULL,
	user_id int(11) NOT NULL,

	FOREIGN KEY (post_id) REFERENCES posts (id),
	FOREIGN KEY (user_id) REFERENCES users (id)
);


INSERT INTO users (name, email, password, type) 
VALUES ('John Smith', 'john@email.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

INSERT INTO users (name, email, password, type) 
VALUES ('GiveWell', 'givewell@email.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts_likes;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS pledges;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS donators_info;
DROP TABLE IF EXISTS organisations_info;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    type char(1) NOT NULL, -- 'D' (Donators) or O (organisations)
    contact_number varchar(16)
);

CREATE TABLE donators_info (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	profile_picture_directory varchar(128),
	profile_bio varchar(128)

	-- FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE organisations_info (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	profile_picture_directory varchar(128),
	profile_description varchar(128),
	category varchar(128)

	-- FOREIGN KEY (user_id) REFERENCES users (id)
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
    title varchar(32),
    body varchar(512) NOT NULL,

	FOREIGN KEY (poster_user_id) REFERENCES users (id)
);

CREATE TABLE comments (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	post_id int(11),
	event_id int(11),
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

CREATE TABLE events (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	poster_user_id int(11) NOT NULL,
	posted_at datetime NOT NULL,

	pledges int(11),
	title varchar(32),
	body varchar(512) NOT NULL,
	fundsNeeded int(11) NOT NULL,
	fundsGathered int(11),

	FOREIGN KEY (poster_user_id) REFERENCES users (id)
);

CREATE TABLE pledges (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_id int(11) NOT NULL,
	pledger_user_id int(11) NOT NULL,
	pledge_amount int(11) NOT NULL,

	FOREIGN KEY (event_id) REFERENCES events (id),
	FOREIGN KEY (pledger_user_id) REFERENCES users (id)
);

INSERT INTO users (id, name, email, password, type) 
VALUES (1, 'John Smith', 'john@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
VALUES (1, 'assets/img/profile_pictures/default_profile_picture.jpg', 'I am from KL, Malaysia. Follow me!');

INSERT INTO users (id, name, email, password, type) 
VALUES (2, 'GiveWell', 'john@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
VALUES (2, "assets/img/profile_pictures/default_profile_picture.jpg", "We find outstanding charities and publish the full details of our analysis to help donors decide where to give.", "International");
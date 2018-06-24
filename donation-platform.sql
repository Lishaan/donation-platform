DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts_likes;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS events_likes;
DROP TABLE IF EXISTS events_donations;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS donators_info;
DROP TABLE IF EXISTS organisations_info;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;

CREATE TABLE users (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(32) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    type char(1) NOT NULL, -- 'D' (Donators) or O (organisations)
    contact_number varchar(16)
);

CREATE TABLE donators_info (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	profile_picture_directory varchar(128),
	profile_bio varchar(256)

	-- FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE organisations_info (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	profile_picture_directory varchar(128),
	profile_description varchar(256),
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
	image_directory varchar(128) NOT NULL,
	poster_user_id int(11) NOT NULL,
	posted_at datetime NOT NULL,

	likes int(11),
	title varchar(32),
	body varchar(512) NOT NULL,
	fundsNeeded int(11) NOT NULL,
	fundsGathered int(11),

	FOREIGN KEY (poster_user_id) REFERENCES users (id)
);

CREATE TABLE events_likes (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_id int(11) NOT NULL,
	user_id int(11) NOT NULL,

	FOREIGN KEY (event_id) REFERENCES events (id),
	FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE events_donations (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_id int(11) NOT NULL,
	donator_user_id int(11) NOT NULL,
	donation_amount int(11) NOT NULL,
	donated_at datetime NOT NULL,

	FOREIGN KEY (event_id) REFERENCES events (id),
	FOREIGN KEY (donator_user_id) REFERENCES users (id)
);


CREATE TABLE categories (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	category varchar(128) NOT NULL
);

INSERT INTO categories (category) VALUES ("Animal and Pet Welfare");
INSERT INTO categories (category) VALUES ("Environment");
INSERT INTO categories (category) VALUES ("Education");
INSERT INTO categories (category) VALUES ("Poverty");
INSERT INTO categories (category) VALUES ("Hunger");
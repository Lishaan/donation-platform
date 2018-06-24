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



-- Populating

	-- Inserting donators in USERS

	INSERT INTO users (id, name, email, password, type) 
	VALUES (1, 'John Smith', 'john@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (2, 'Sarah Pallin', 'sPallin@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (3, 'Peter Parker', 'peterP@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (4, 'Ned Dahn', 'neddahn@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (5, 'Marie Fitz', 'MaFitz@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (6, 'Ellen Fabien', 'ellenfabien@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (7, 'Logan Huffman', 'LogHuff@yahoo.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (8, 'Daniella Steele', 'DSteele@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (9, 'George Davis', 'g_davis01@hotmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (10, 'Yap Jia Yung', '15046824@imail.sunway.edu.my', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (11, 'Maria Baker', 'mBaker@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (12, 'Hannah Baker', 'han_bake@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (13, 'Floyd Patterson', 'floyd_patterson@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (14, 'Jack Dempsey', 'j_dempsey@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (15, 'Rocky Marcianno', 'R_Marcianno@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (16, 'Rocky Balboa', 'R_balboa@yahoo.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (17, 'Lo Yi Lau', 'lylau@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (18, 'Mike Tyson', 'm_tyson@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (19, 'Connor McGreggor', 'c_irishbadass@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (20, 'Collete DeChamps', 'colDechamps@yahoo.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (21, 'Raymon Ray', 'R_Ray@outlook.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (22, 'Trishalee Ramdun', 'T_Ramdun@outlook.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (23, 'Akhil Maulloo', 'akoulous69@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (24, 'Girish Jeewoth', 'girish_jeewoth@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (25, 'Ranveer Dindoyal', 'R_dindoyal@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'D');


	-- Inserting donators info in DONATORS_INFO

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (1, 'assets/img/profile_pictures/profile_picture_uid_1.jpg', 'I am from KL, Malaysia. Follow me!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (2, 'assets/img/profile_pictures/profile_picture_uid_2.jpg', 'Hi, I am from the USA. Animal Rights are very important to me!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (3, 'assets/img/profile_pictures/profile_picture_uid_3.jpg', 'Hi, I am from the USA. I think Poverty is a big issue worldwide! ');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (4, 'assets/img/profile_pictures/default_profile_picture.jpg', 'I am part of Stop Hunger Now, come follow and donate to our Organisation Account! <3');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (5, 'assets/img/profile_pictures/default_profile_picture.jpg', 'Greeting from UK, donate to save lives everybody!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (6, 'assets/img/profile_pictures/profile_picture_uid_6.jpg', 'Bonjour from France! Hunger is one of the hardest issue worldwide and everyone should contribute their part somehow!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (7, 'assets/img/profile_pictures/profile_picture_uid_7.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (8, 'assets/img/profile_pictures/default_profile_picture.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (9, 'assets/img/profile_pictures/profile_picture_uid_9.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (10, 'assets/img/profile_pictures/profile_picture_uid_10.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (11, 'assets/img/profile_pictures/profile_picture_uid_11.jpg', 'My niece killed herself because of bullying, please be aware of this threat and support the organisations that can help many young kids away from the knife.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (12, 'assets/img/profile_pictures/profile_picture_uid_12.jpg', 'Hi, my name is Hannah, Hannah Baker. There are many reasons why I am on this platform, but i mostly want to support the Environmental Efforts in Malaysia!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (13, 'assets/img/profile_pictures/profile_picture_uid_13.jpg', 'Hello, I am a retired boxer who hopes to accomplish things beyond what my fists could!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (14, 'assets/img/profile_pictures/profile_picture_uid_14.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (15, 'assets/img/profile_pictures/profile_picture_uid_15.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (16, 'assets/img/profile_pictures/profile_picture_uid_16.jpg', 'Even if I am a boxer; a man of violence, I want to demonstrate my philatropist lifestyle on this platform!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (17, 'assets/img/profile_pictures/default_profile_picture.jpg', 'Malaysia many problems ah! I hope with my publicity and help can make Malaysia better place for everyone !');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (18, 'assets/img/profile_pictures/profile_picture_uid_18.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (19, 'assets/img/profile_pictures/profile_picture_uid_19.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (20, 'assets/img/profile_pictures/profile_picture_uid_20.jpg', 'No bio.');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (21, 'assets/img/profile_pictures/profile_picture_uid_21.jpg', 'Ardent supporter of organistions such as PETA, I want to show my support towards NGOs which act against animal cruelty present on this platform!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (22, 'assets/img/profile_pictures/profile_picture_uid_22.jpg', 'Island Girl from Mauritius! Loves helping out causes and any body that works to make this world a better place!');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (23, 'assets/img/profile_pictures/profile_picture_uid_23.jpg', 'Software Developer aiming to make the world better. ');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (24, 'assets/img/profile_pictures/profile_picture_uid_24.jpg', 'Cooking is my passion, to feed is my goal, but alone there is only so much one can do! I hope that my cooking and donations can help the hungry people around the globe! ');

	INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) 
	VALUES (25, 'assets/img/profile_pictures/profile_picture_uid_25.jpg', 'No bio.');


	-- INSERTING organisations in USERS


	INSERT INTO users (id, name, email, password, type) 
	VALUES (26, 'People For Animals', 'PeopleForAnimals@comcast.net', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (27, 'Stop Hunger Now', 'tkeh@stophungernow.org.my', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (28, 'MNAWF', 'secretary@mnawf.org.my', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (29, 'MENGO', 'admin@mengo.org', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (30, 'Rescue', 'DonorServices@rescue.org', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (31, 'Bread for the World', 'institute@bread.org', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (32, 'PETA', 'peta@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');

	INSERT INTO users (id, name, email, password, type) 
	VALUES (33, 'UNICEF', 'unicef@gmail.com', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');
	
	INSERT INTO users (id, name, email, password, type) 
	VALUES (34, 'Global Education Fund', 'info@globaleducationfund.org', '$2y$10$IH/0ugqbuVVlev.rA6haM.vvRepgLTyOmzM58j194Em0aYqjcbMy6', 'O');
	





	-- INSERTING Organisation info in ORGANISATION_INFO

	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (26, 'assets/img/profile_pictures/profile_picture_uid_26.jpg', 'Founded in 1986, People For Animals is an all volunteer, not for-profit animal protection organization
	http://www.peopleforanimals.net', 'Animal and pet welfare');

	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (27, 'assets/img/profile_pictures/profile_picture_uid_27.jpg', 'Stop Hunger Now is an international nonprofit organization with a mission to end hunger in our lifetime
	http://intl.riseagainsthunger.org/', 'Hunger');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (28, 'assets/img/profile_pictures/profile_picture_uid_28.jpg', 'The Malaysian National Animal Welfare Foundation was formed in April 1998 to promote a caring Malaysian society.
	FInd out more: http://mnawf.org.my', 'Animal and pet welfare');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (29, 'assets/img/profile_pictures/profile_picture_uid_29.jpg', 'A grouping of Malaysian Environmental NGOs (MENGO) was formed in November 2001 strengthen their impact.
	Come visit us at: http://mengo.org', 'Environment');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (30, 'assets/img/profile_pictures/profile_picture_uid_30.jpg', 'We give direct help for people trying to feed their families and find a safe place to live
	Come help us at https://www.rescue.org/outcome/economic-wellbeing', 'Poverty');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (31, 'assets/img/profile_pictures/profile_picture_uid_31.jpg', 'Bread for the World is a collective Christian voice urging our nation’s decisions makers to end hunger at home and abroad. Moved by God’s grace in Jesus Christ, we advocate for a world without hunger.
	Discover more on http://www.bread.org/history-mission', 'Hunger');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (32, 'assets/img/profile_pictures/profile_picture_uid_32.jpg', 'People for the Ethical Treatment of Animals (PETA) is the largest animal rights organization in the world
	Find out more on https://www.peta.org/about-peta/', 'Animal and pet welfare');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (33, 'assets/img/profile_pictures/profile_picture_uid_33.jpg', 'All children have a right to survive, thrive and fulfill their potential to the benefit of a better world
	Help give a child a chance
	https://www.unicef.org', 'Poverty');


	INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) 
	VALUES (34, 'assets/img/profile_pictures/profile_picture_uid_34.jpg', 'We find, fund and partner with educators and organizations that are leading local innovative ways to improve the  quality of education for children living in poverty. 
More at: http://www.globaleducationfund.org/about-us', 'Education');



	-- Inserting Posts in POSTS


	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (1,	1,"2018-06-18 14:00:00",	2,"	My Experience with Charity" , "I have attended several events and donated more than a thousand ringgits in the year 2018 already. I feel good about myelf when I know I am helping others!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (2,	2,"2018-06-19 11:32:36",	2,"	Anyone from the US?","I would like to meet fellow animal supporters around my area. Contact me below!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (3,	3,"2018-06-19 12:00:20",	2,"	Poor people","I joined this community in hopes that I help poor people beyond my physical grasp");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (4,	4,"2018-06-19 12:30:30",	2,"	We had to leave","Little NGO could not stay on the platform sadly");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (5,	5,"2018-06-19 14:32:36",	2,"	Why donating is important.","What is RM10 to you? A meal maybe. But to a man in need, it's hope, hope for better days!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (6,	6,"2018-06-19 18:20:05",	2,"	Giveth and taketh", "Donate and you shall receive. Love each other, peace!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (7,	7,"2018-06-20 1:30:30",	2,"	Tranquility in Charity","Donating to charities gives a sense of well-being, anyone also feeling the same way?");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (8,	8,"2018-06-20 2:15:00",	2,"	Truth on PETA","PETA is an extremist organisation!, man is superior to animals as we have the power to dominate them as a species, or treat them better.");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (9,	9,"2018-06-20 4:30:26",	1,"	Dancing in charity","I danced for an event last night for PETA");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (10,	10,"2018-06-20 6:25:33",	1,"	Donate","I recently donated to this organisation called MENGO, I hope it's worth it");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (11,	11,"2018-06-20 10:00:36",	1,"	Anti-Bully society","I want to form an NGO and make an account on this platform to fight against bullying");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (12,	12,"2018-06-20 12:25:36",	1,"	Green and black","The environment seems nicer when 6 feet underground");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (13,	13,"2018-06-20 12:32:36",	1,"	Legends Never Die","I may be dead but my name shall be used for the better cause!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (14,	14,"2018-06-20 13:35:36",	1,"	Children of Africa","There are alot of starving children in Africa, Help Rescue them!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (15,	15,"2018-06-20 14:32:36",	1,"	Dying country","	My country, Greece, is dying from our poor economy, please help us");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (16,	16,"2018-06-20 14:33:36",	1,"	My latest movie	","Go see my latest movie Rocky 4! 50 percent of the profits will go to charity!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (17,	17,"2018-06-20 14:34:36",	1,"	Malaysia got NGO!?","	I not know Malaysia had so many NGOs mah, Me donate my best to them already since i see them!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (18,	18,"2018-06-20 14:45:36",	1,"	Kill the killers!","Support PETA and prevent more animals from a senseless death!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (19,	19,"2018-06-20 15:32:20",	1,"	Charities a gogo	","Supporter les differentes organisations present sur cette platforme");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (20,	20,"2018-06-20 15:32:30",	2,"	I love to give back	","My recents donations brought me some recognition in my social life! <3");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (21,	21,"2018-06-20 16:32:36",	2,"	I am a Witness	","We all have at least witnessed one act of cruelty towards animals in our lives, and what have we done? Nothing! It's time to redeem yourselves! support PETA!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (22,	22,"2018-06-20 17:20:20",	4,"	Destruction of our fauna and flora","	Our paradise island is slowly becoming modern, but to what expense?");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (23,	23,"2018-06-20 17:32:36",	2,"	Charities and development","I like to do everything in my room, thats why i like this website");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (24,	24,"2018-06-20 18:00:00",	1,"	Food for the Hungry!","	We need to increase our efforts to bring food to the hungry");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (25,	25,"2018-06-20 18:30:36",	1,"	The importance of Accountancy","I volounteer to teach accountancy to the people who cannot afford courses!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (26,	26,"2018-06-20 19:20:00",	5,"	An Appeal for Donations!","We are in urgent need of funds due to our rise in demand after joining the community! We have limited staff but your funds may allow us to recruit more people!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (27,	26,"2018-06-20 20:32:36",	8,"	Amazing response from our followers!","	We'd like to thank our supporters for their quick reaction to our previous post! We count on you all for the coming months!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (28,	28,"2018-06-21 10:00:25",	6,"	New Family!","	One of our dogs just gave birth!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (29,	28,"2018-06-21 14:32:36",	3,"	If you see abuse!","Please tell us if you are witness to any animal abuse if you yourself are not in a position to act!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (30,	27,"2018-06-21 14:50:55",	2,"	We just distributed food in Indonesia","We deistributed 1000 packets of food in a poor village of Indonesia");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (31,	27,"2018-06-21 18:00:00",	3,"	Stay Tuned!","We are going to host an event soon! Keep checking for more info!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (32,	29,"2018-06-21 9:25:00",	1,"	Witness any environmental issue?","Call Us on +601116643552 in case you witness a significant act of pollution, for example, an illegal landfill or a polluted river!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (33,	29,"2018-06-21 10:20:56",	1,"	Be more aware!","We are going to run a campaign to raise awareness about littering! Please stay tuned");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (34,	30,"2018-06-21 13:13:13",	3,"	We want to help people around you!","Reply to this post if you know of people around you that are in need of food!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (35,	30,"2018-06-21 14:13:12",	4,"	Help us help others!","We are going to host an event to give shelter to a family who are currently surviving on the streets! Stay Tuned");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (36,	31,"2018-06-21 19:34:36",	5,"	Let us pray for each other","We want to encourage prayers for those who are in need");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (37,	31,"2018-06-22 5:30:30",	3,"	Prayer Event!","We are going to hold prayers around the world with the aim to improve our charity efforts for the peopel in need of food and shelter");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (38,	32,"2018-06-22 7:30:36",	1,"	Animal Rights","Animals have rights! They are living beings equal to us! They feel emotions such as pain and happiness!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (39,	32,"2018-06-22 10:32:36",	1,"	Let us Fight for those who can't!","We are holding an international walk for animal rights!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (40,	33,"2018-06-22 20:32:36",	3,"	Kids in Africa","So many kids in africa are in need of food and shelter!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (41,	33,"2018-06-22 11:31:21",	5,"	Help young africans !","We are holding a special charity to fund our efforts for the children in Africa!");

	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (42,	34,"2018-06-22 11:35:21",	4,"	Our effort to educate ","We want to help the young ones who cannot afford a proper education!");
	
	INSERT INTO posts(id,poster_user_id,posted_at,likes,title,body)
	VALUES (43,	34,"2018-06-22 11:40:21",	6,"	Changing the world","Knowledge is power. What if, the knowledge to the next generation of technology was locked in the head of a poor child who cannot afford education and is thus destined to not be able to accompish his/her potential? Help us help them, help us change the world.");

	-- INSERTING LIKES in POST_LIKES


	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (1,	1,	2);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (2,	1,	3);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (3,	2,	3);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (4,	2,	1);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (5,	3,	1);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (6,	3,	2);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (7,	4,	20);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (8,	4,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (9,	5,	30);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (10,	5,	15);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (11,	6,	13);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (12,	6,	5);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (13,	7,	6);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (14,	7,	8);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (15,	8,	7);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (16,	8,	9);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (17,	9,	7);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (18,	10,	11);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (19,	11,	10);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (20,	12,	13);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (21,	13,	12);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (22,	14,	15);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (23,	15,	14);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (24,	16,	17);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (25,	17,	16);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (26,	18,	17);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (27,	19,	18);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (28,	20,	19);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (29,	20,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (30,	21,	20);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (31,	21,	22);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (32,	22,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (33,	22,	23);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (34,	22,	28);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (35,	22,	24);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (36,	23,	24);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (37,	23,	25);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (38,	24,	25);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (39,	25,	30);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (40,	26,	27);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (41,	26,	28);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (42,	26,	29);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (43,	26,	12);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (44,	26,	31);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (45,	27,	28);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (46,	27,	27);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (47,	27,	29);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (48,	27,	32);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (49,	27,	33);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (50,	27,	30);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (51,	27,	1);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (52,	27,	2);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (53,	28,	3);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (54,	28,	4);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (55,	28,	5);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (56,	28,	6);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (57,	28,	7);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (58,	28,	8);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (59,	29,	1);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (60,	29,	10);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (61,	29,	11);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (62,	30,	23);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (63,	30,	24);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (64,	31,	15);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (65,	31,	10);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (66,	31,	13);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (67,	32,	12);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (68,	33,	14);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (69,	34,	33);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (70,	34,	23);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (71,	34,	31);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (72,	35,	31);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (73,	35,	2);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (74,	35,	16);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (75,	35,	17);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (76,	36,	18);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (77,	36,	19);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (78,	36,	20);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (79,	36,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (80,	36,	14);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (81,	37,	11);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (82,	37,	7);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (83,	37,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (84,	38,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (85,	39,	21);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (86,	40,	24);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (87,	40,	25);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (88,	40,	26);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (89,	41,	27);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (90,	41,	32);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (91,	41,	26);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (92,	41,	19);

	INSERT INTO posts_likes(id, post_id, user_id)
	VALUES (93,	41,	21);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (94,42,	1);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (95,42,	2);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (96,42,	3);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (97,42,	33);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (98,43,	33);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (99,43,	22);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (100,43,	23);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (101,43,	24);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (102,43,	25);

	INSERT INTO posts_likes(id,post_id,user_id)
	VALUES (103,43,	10);


	-- Insert followers in FOLLOWERS

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (1,	2,	"2018-06-21 17:44:45");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (1,	3,	"2018-06-18 5:43:35");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (2,	3,	"2018-06-18 4:13:48");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (2,	1,	"2018-06-20 16:28:31");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (3,	1,	"2018-06-19 9:57:4");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (3,	2,	"2018-06-21 14:57:30");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (4,	20,	"2018-06-20 20:5:39");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (4,	21,	"2018-06-18 19:55:15");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (5,	30,	"2018-06-20 17:12:5");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (6,	13,	"2018-06-18 12:39:6");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (6,	5,	"2018-06-18 0:32:33");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (6,	1,	"2018-06-20 19:10:54");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (7,	6,	"2018-06-18 3:25:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (7,	8,	"2018-06-19 20:5:20");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (8,	7,	"2018-06-19 8:10:34");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (8,	9,	"2018-06-21 7:44:22");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (8,	6,	"2018-06-18 7:28:2");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (9,	7,	"2018-06-20 21:28:42");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (10,	11,	"2018-06-18 6:40:55");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (11,	10,	"2018-06-20 12:2:27");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (12,	13,	"2018-06-19 2:21:15");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (13,	12,	"2018-06-20 7:51:32");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (20,	19,	"2018-06-18 12:47:14");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (22,	23,	"2018-06-20 23:51:8");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (22,	28,	"2018-06-19 22:9:55");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (22,	24,	"2018-06-20 5:16:34");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (23,	25,	"2018-06-19 6:37:42");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (25,	1,	"2018-06-19 20:9:15");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	27,	"2018-06-19 13:46:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	28,	"2018-06-21 0:15:34");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	29,	"2018-06-19 23:1:42");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	12,	"2018-06-20 22:28:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	3,	"2018-06-20 4:6:47");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	5,	"2018-06-21 3:6:51");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	12,	"2018-06-18 22:24:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	2,	"2018-06-20 2:30:37");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	4,	"2018-06-19 9:28:47");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	7,	"2018-06-19 15:59:53");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	8,	"2018-06-18 11:14:35");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (26,	9,	"2018-06-18 6:55:31");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	10,	"2018-06-19 3:58:49");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	11,	"2018-06-20 6:13:48");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	12,	"2018-06-19 16:17:7");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	13,	"2018-06-19 15:2:18");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	1,	"2018-06-19 18:4:11");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	14,	"2018-06-21 21:44:38");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	15,	"2018-06-18 9:49:21");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	16,	"2018-06-21 23:16:0");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (27,	17,	"2018-06-19 14:45:33");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	26,	"2018-06-21 13:4:7");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	27,	"2018-06-21 7:39:57");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	2,	"2018-06-19 21:0:18");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	3,	"2018-06-19 6:49:23");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	4,	"2018-06-20 0:41:5");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	5,	"2018-06-18 4:37:17");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	6,	"2018-06-18 4:40:37");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	7,	"2018-06-20 5:3:41");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	8,	"2018-06-21 12:4:32");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (28,	18,	"2018-06-19 22:29:26");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	19,	"2018-06-18 1:37:38");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	20,	"2018-06-20 17:22:15");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	21,	"2018-06-18 5:16:3");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	22,	"2018-06-21 18:51:9");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	23,	"2018-06-18 11:30:33");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	24,	"2018-06-21 3:6:55");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (29,	25,	"2018-06-18 11:6:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (30,	23,	"2018-06-21 21:5:22");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (30,	26,	"2018-06-19 11:46:36");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (30,	21,	"2018-06-18 10:59:47");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (30,	18,	"2018-06-20 13:0:0");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (30,	19,	"2018-06-20 17:20:38");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	11,	"2018-06-21 19:52:13");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	13,	"2018-06-18 11:20:24");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	14,	"2018-06-20 16:20:2");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	21,	"2018-06-18 22:18:57");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	7,	"2018-06-19 17:39:6");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (31,	21,	"2018-06-18 7:26:57");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (32,	23,	"2018-06-19 4:11:26");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	1,	"2018-06-19 5:1:13");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	2,	"2018-06-19 19:36:11");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	3,	"2018-06-21 11:22:7");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	4,	"2018-06-21 7:32:31");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	5,	"2018-06-19 17:50:59");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	6,	"2018-06-20 1:17:27");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	7,	"2018-06-21 21:8:58");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	8,	"2018-06-21 8:29:33");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	9,	"2018-06-19 21:30:5");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	10,	"2018-06-18 6:32:53");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	11,	"2018-06-19 7:24:7");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	14,	"2018-06-21 4:38:46");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	15,	"2018-06-21 14:33:4");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	16,	"2018-06-20 0:48:11");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	17,	"2018-06-20 18:39:19");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	23,	"2018-06-18 11:8:29");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	26,	"2018-06-20 21:40:29");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	27,	"2018-06-18 5:57:39");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	28,	"2018-06-21 7:45:29");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	29,	"2018-06-21 8:21:11");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	31,	"2018-06-19 14:43:43");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	32,	"2018-06-20 19:11:21");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (33,	19,	"2018-06-19 1:16:4");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	1,	"2018-06-20 10:16:36");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	2,	"2018-06-19 15:6:13");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	3,	"2018-06-18 7:54:53");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	4,	"2018-06-19 0:53:54");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	10,	"2018-06-21 18:21:48");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	22,	"2018-06-21 9:55:51");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	23,	"2018-06-19 13:29:43");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	33,	"2018-06-18 6:54:20");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	26,	"2018-06-19 20:26:25");

INSERT INTO followers(user_id, follower_user_id, follow_date)
VALUES (34,	25,	"2018-06-20 7:12:29");


-- Inserting events in EVENTS

INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_1.jpg',26 ,'2018-06-20 21:18:22',13 , 'Opening New Shelter', 'We are planning the opening of a new shelter towards the end of the year and we want to make an appeal to all the animal lovers here to help us better the lives of animals ',30000 , 1000);


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_2.jpg',27 ,'2018-06-19 18:19:0',7 , 'Food Distribution in Poor Areas of KL', 'We are in need of helping hands and funds to carry out a campaign to feed the poor people in KL.
We are going to have multiple distribution sprees on the following dates and locations:
2018-06-30 from 0800 to 1200 at Ampang
2018-06-31 from 0800 to 1200 at Sunway Velocity
 ', 10000,2000 );

INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_3.jpg', 28,'2018-06-18 11:13:11', 9, 'Mass collection of Strays!', ' MNAWF is going to collect the strays in KL! In need of volounteers and funds !
Date: 05/07/2018
Time: 8.00am to 5.00pm
Meeting location: KLCC ', 2000,500);


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_4.jpg',29 ,'2018-06-18 5:19:0',18 , 'Mass Cleanup of Sunway', ' MENGO is once again acting to clean up malaysia little by little. Support via donation or you can even attend the event and help us make Sunway a cleaner, and thus better place.
Date: 20/07/2018
Time: 9am
Meeting Location: Sunway University', 3000, 1000);


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_5.jpg',30 ,'2018-06-19 22:23:30', 15, 'Help the Drake Family!', 'We recently met a large family living on the streets of America and we want to help give them a new start! Please help us raise the funds needed to give them their basic needs', 10000, 1500);


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_6.jpg',31 ,'2018-06-20 11:35:18', 13, 'Prayer for Yemen', 'The situation of Yemen has been increasingly alarming and we would like to dedicate prayers to them as well as contribute to the relevant charities. 
We will hold the prayers in the church of Saint Thomas in London, at 9am.
Please do give yur prayers to them from home if coming is not possible', 5000,400 );


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_7.jpg',32 ,'2018-06-18 6:17:42',2 , 'Closedown of Abusive farm', 'We are holding protests to close down the Chillfurrow Farm at Bordeaux, France. We have video proof of torturous practice towards animals there and we want it closed down!
We need money to run the protest!
Location: Bordeaux, France
TIme: 14:00',1000 ,25 );


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_8.jpg',33 ,'2018-06-18 11:40:25',14 , 'Charity for Yemen', ' We are raising funds to carry out humanitarian operations in the warring areas of Yemen. Please help us help those innocents who are victims of the millitary powers of two sides of their country.
Expected date of operation: 5/12/2018', 100000, 50000);


INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_9.jpg', 33,'2018-06-18 4:30:45', 27, 'Charity efforts in Europe', ' We are organising a campaign to raise awareness and help the poor people in Europe.
Start Date: 10/09/2018
End Date: 30/10/2018
More details on our wesites!',50000, 25000);

INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_10.jpg', 34,'2018-06-21 13:18:0', 10, 'Volounteer teaching', ' We are looking for volounteers to teach a few basic subjects to young kids in the defavourised areas of Rio, Brazil to celebrate Education Day! We also welcome donations in regards to that event to help organise transport, food and security.
Date: 20 November 2018
From: 8am to 3pm
Meeting location: gef hq brazil',10000, 5000);


-- Inserting event likes to EVENTS_LIKES

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	3);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	4);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	5);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	6);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	7);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	8);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	9);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	12);

INSERT INTO events_likes(event_id,user_id)
VALUES (1,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	16);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	17);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	18);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	19);

INSERT INTO events_likes(event_id,user_id)
VALUES (2,	20);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	21);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	22);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	23);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (3,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	12);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	22);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	23);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	5);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	3);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	7);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	9);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	20);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	16);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	17);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	18);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	19);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (4,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	3);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	4);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	5);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	6);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	7);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	8);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	9);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	12);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (5,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (7,	21);

INSERT INTO events_likes(event_id,user_id)
VALUES (7,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	23);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	22);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	5);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	7);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	8);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	9);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (8,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	17);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	19);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	20);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	2);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	4);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	6);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	8);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	12);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	16);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	18);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	26);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	22);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	3);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	5);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	7);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	9);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	27);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	28);

INSERT INTO events_likes(event_id,user_id)
VALUES (9,	23);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	11);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	12);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	13);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	14);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	16);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	17);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	18);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	19);

INSERT INTO events_likes(event_id,user_id)
VALUES (6,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	1);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	33);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	15);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	22);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	20);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	23);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	24);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	25);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	10);

INSERT INTO events_likes(event_id,user_id)
VALUES (10,	5);


-- Inserting comments in COMMENTS

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (2,	NULL,	3,"	I am from the US but my main concern is poverty, not pets.	","2018-06-19 11:50:30");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (5,	NULL,	22,"	I totally agree with you!	","2018-06-19 18:20:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (8,	NULL,	21,"	LIES! PETA has a true philosophy! PETA aims to be fair to man and animal alike!	","2018-06-20 2:15:01");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (11,	NULL,	12,"	Well we only take action once we have a cadaver huh	","2018-06-20 11:00:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (11,	NULL,	11,"	I am so sorry for what happened to you!	","2018-06-20 11:15:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (14,	NULL,	33,"	We are directing some of our efforts towards that! follow us!	","2018-06-22 18:30:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (17,	NULL,	29,"	Yes Malaysia got..	","2018-06-20 15:34:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (17,	NULL,	17,"	Wait me donate you immediately!	","2018-06-20 15:34:50");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (18,	NULL,	21,"	YESS	","2018-06-20 14:55:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (1,	NULL,	20,"	I understand the feeling!	","2018-06-18 15:00:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (28,	NULL,	21,"	Thats so nicee	","2018-06-21 11:00:25");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (32,	NULL,	17,"	Come to KL mah, Rivers of thrash in capital, shameful i tell you	","2018-06-21 19:25:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (36,	NULL,	2,"	Amen!	","2018-06-21 20:34:36");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (38,	NULL,	21,"	I wish more people would understand...	","2018-06-22 7:31:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (39,	NULL,	21,"	Wooff	","2018-06-22 10:32:40");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (43,	NULL,	33,"	Let us Change world Hand in Hand!	","2018-06-22 11:50:21");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	1,	1,"	Looking Forward to it!	","2018-06-20 22:18:22");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	2,	13,"	I'll come help!	","2018-06-19 19:19:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	3,	21,"	Can i shelter some?	","2018-06-18 11:13:11");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	4,	22,"	I want to help, I live nearby!	","2018-06-18 5:30:00");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	5,	4,"	Isn't Drake a Singer??	","2018-06-19 22:30:30");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	5,	30,"	They are not related.	","2018-06-19 23:30:30");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	6,	17,"	Ameen	","2018-06-20 23:35:18");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	7,	21,"	I WILL STAND READY TO DIE!	","2018-06-18 6:18:42");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	8,	31,"	Lets work together!	","2018-06-18 11:50:25");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	9,	5,"	Donated	","2018-06-18 4:30:45");

INSERT INTO comments(post_id,event_id,commenter_user_id,comment_body,posted_at)
VALUES (NULL,	10,	25,"	I can teach basic accounting!	","2018-06-22 13:18:00");



-- Inserting donations in EVENTS_DONATIONS

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (1,	1,	500,	"2018-06-20 21:20:22");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (1,	2,	500,	"2018-06-20 21:25:22");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (2,	3,	1200,	"2018-06-19 19:19:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (2,	3,	100,	"2018-06-19 20:19:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (2,	4,	200,	"2018-06-19 21:19:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (3,	5,	200,	"2018-06-18 11:15:11");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (3,	7,	300,	"2018-06-18 11:30:11");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (4,	22,	200,	"2018-06-18 8:49:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (4,	23,	500,	"2018-06-18 9:19:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (4,	24,	300,	"2018-06-18 10:29:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (5,	15,	200,	"2018-06-19 22:40:30");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (5,	14,	300,	"2018-06-19 22:59:30");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (5,	13,	400,	"2018-06-19 23:23:30");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (5,	12,	600,	"2018-06-19 23:25:30");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (6,	8,	400,	"2018-06-20 11:35:20");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (7,	21,	25,	"2018-06-18 6:17:42");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	1,	25000,	"2018-06-18 12:40:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	13,	1000,	"2018-06-18 13:40:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	15,	4000,	"2018-06-18 13:50:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	17,	200,	"2018-06-18 14:10:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	20,	100,	"2018-06-18 14:20:15");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	22,	700,	"2018-06-18 14:32:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	23,	5000,	"2018-06-18 14:40:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	4,	7000,	"2018-06-18 14:42:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	3,	4000,	"2018-06-18 14:50:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (8,	2,	2000,	"2018-06-18 14:55:25");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	8,	10000,	"2018-06-18 7:30:45");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	1,	5000,	"2018-06-18 8:30:45");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	3,	5000,	"2018-06-18 8:30:46");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	5,	2000,	"2018-06-18 9:30:45");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	22,	500,	"2018-06-18 10:30:45");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (9,	23,	2500,	"2018-06-18 11:30:45");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	24,	100,	"2018-06-21 13:20:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	25,	400,	"2018-06-21 13:28:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	20,	500,	"2018-06-21 13:38:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	19,	1000,	"2018-06-21 13:58:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	4,	2000,	"2018-06-21 14:18:00");

INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (10,	4,	1000,	"2018-06-21 15:18:00");



-- For JY stats Graph. Unicef Event with donations year wide





INSERT INTO events(image_directory,poster_user_id,posted_at,likes,title,body,fundsneeded,fundsgathered)
VALUES ('assets/img/event_pictures/event_picture_id_1.jpg', 33,'2018-01-01 0:00:00', 0, 'Charity efforts', 'We are organising a campaign to raise awareness and help the poor
Start Date: 01/01/2018
End Date: 31/12/2018
More details on our wesite!',1000000, 181745);




INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	26,	286,	"2018-01-08 13:35:33");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1888,	"2018-05-04 19:23:41");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	193,	"2018-05-02 14:52:44");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1544,	"2018-01-21 16:54:58");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	3,	1448,	"2018-05-02 15:10:27");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	29,	790,	"2018-05-22 17:43:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1697,	"2018-04-16 19:25:58");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1276,	"2018-02-17 19:16:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1335,	"2018-03-13 4:36:14");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	312,	"2018-06-18 0:39:7");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	1839,	"2018-01-16 21:23:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	1296,	"2018-04-12 16:6:8");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	9,	1323,	"2018-04-07 9:27:10");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	1822,	"2018-01-18 17:9:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	4,	1485,	"2018-05-23 18:44:42");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	31,	1991,	"2018-03-31 20:38:10");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	30,	602,	"2018-04-19 23:58:29");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	4,	1204,	"2018-03-18 10:9:30");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	998,	"2018-01-04 21:42:15");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	1553,	"2018-04-29 0:44:21");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	5,	1761,	"2018-01-09 6:14:40");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	11,	883,	"2018-06-17 5:11:34");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	4,	1975,	"2018-01-05 19:42:13");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	924,	"2018-04-29 19:1:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	1879,	"2018-06-11 13:19:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	1501,	"2018-01-02 11:7:31");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	4,	261,	"2018-01-14 2:40:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	30,	631,	"2018-02-09 0:41:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	1267,	"2018-02-15 4:55:1");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	919,	"2018-04-08 7:38:11");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	1674,	"2018-02-23 8:13:0");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1426,	"2018-01-11 17:8:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	601,	"2018-04-08 14:21:56");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	4,	1953,	"2018-02-24 16:58:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	16,	1987,	"2018-06-01 1:54:30");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	29,	1340,	"2018-04-17 2:44:9");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	934,	"2018-02-22 15:2:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	24,	1299,	"2018-02-09 10:49:3");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1205,	"2018-02-09 19:17:11");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	677,	"2018-04-30 2:0:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	915,	"2018-06-15 13:14:59");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1249,	"2018-04-22 7:46:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1313,	"2018-04-30 4:13:56");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1832,	"2018-04-19 23:55:52");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	192,	"2018-06-14 18:38:20");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	189,	"2018-03-17 13:28:36");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	27,	1804,	"2018-05-02 10:14:43");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	26,	577,	"2018-04-27 15:4:2");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	1004,	"2018-05-14 12:8:0");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	18,	635,	"2018-03-30 10:8:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	1806,	"2018-03-30 15:53:19");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	10,	116,	"2018-05-05 0:37:48");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	26,	734,	"2018-05-12 2:19:1");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	1661,	"2018-02-01 1:9:25");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	21,	428,	"2018-03-19 15:49:27");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	1865,	"2018-06-10 4:18:26");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1933,	"2018-04-06 20:34:33");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	962,	"2018-03-24 22:11:14");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1777,	"2018-03-15 4:13:27");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	1863,	"2018-05-02 21:43:9");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	5,	1896,	"2018-04-02 6:28:35");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	165,	"2018-03-02 19:12:2");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	24,	1896,	"2018-01-11 23:57:32");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	1748,	"2018-03-19 2:14:14");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	27,	706,	"2018-01-14 1:3:36");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	27,	1134,	"2018-05-24 22:7:43");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	24,	427,	"2018-03-06 20:49:50");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	690,	"2018-02-17 0:47:0");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	31,	1655,	"2018-03-02 1:13:7");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	2,	1028,	"2018-06-17 22:30:21");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	586,	"2018-05-31 1:14:20");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	588,	"2018-04-11 3:24:9");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	6,	964,	"2018-04-22 1:4:8");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1730,	"2018-01-17 18:10:22");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	30,	1306,	"2018-05-11 16:1:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	18,	1351,	"2018-04-21 23:50:17");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	771,	"2018-04-08 4:13:38");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	1129,	"2018-02-22 2:12:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	605,	"2018-01-11 22:54:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	858,	"2018-05-28 1:1:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	28,	1035,	"2018-06-08 14:8:4");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	28,	930,	"2018-04-15 6:34:30");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	498,	"2018-02-24 10:37:32");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	18,	837,	"2018-02-17 23:17:20");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	458,	"2018-03-08 22:4:22");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	775,	"2018-02-05 7:26:49");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1277,	"2018-06-07 12:19:41");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1063,	"2018-02-17 0:24:41");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	29,	1335,	"2018-01-09 6:15:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	764,	"2018-03-31 23:7:25");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	24,	659,	"2018-02-27 0:46:49");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	657,	"2018-04-13 2:46:17");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1593,	"2018-01-12 2:20:26");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	400,	"2018-02-20 22:20:16");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	718,	"2018-06-05 16:46:51");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	31,	1098,	"2018-02-16 0:55:27");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	1291,	"2018-01-25 22:4:7");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	24,	368,	"2018-01-15 23:10:51");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	21,	1280,	"2018-01-18 10:0:16");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	486,	"2018-06-09 3:31:56");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	20,	595,	"2018-05-07 13:59:17");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	18,	817,	"2018-05-06 0:22:34");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	20,	408,	"2018-01-29 8:34:36");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	3,	1786,	"2018-04-11 15:56:2");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	19,	204,	"2018-03-10 3:16:1");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	27,	907,	"2018-06-17 3:26:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	1547,	"2018-01-25 12:4:54");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	9,	1771,	"2018-02-21 17:0:9");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	405,	"2018-03-15 15:20:30");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	9,	1526,	"2018-04-25 4:21:18");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	29,	1769,	"2018-04-14 6:18:21");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	10,	813,	"2018-05-27 14:38:47");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	1711,	"2018-03-05 13:31:26");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1716,	"2018-06-12 16:34:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	1318,	"2018-04-26 6:53:23");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	943,	"2018-05-13 6:13:23");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	382,	"2018-06-02 15:7:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	1556,	"2018-05-20 21:59:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	1399,	"2018-03-14 21:11:23");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	1057,	"2018-04-22 11:19:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	1070,	"2018-02-21 10:28:23");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	16,	1850,	"2018-03-07 23:54:7");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	11,	1442,	"2018-02-09 8:59:58");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	11,	1785,	"2018-02-09 12:46:44");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	8,	1580,	"2018-01-10 21:58:49");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	186,	"2018-03-30 17:27:18");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	26,	1639,	"2018-01-31 11:24:44");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	7,	279,	"2018-02-11 5:33:45");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	15,	1521,	"2018-03-07 15:4:1");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	3,	861,	"2018-02-05 17:12:3");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	16,	1296,	"2018-04-17 2:58:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	20,	928,	"2018-01-29 19:53:36");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	1662,	"2018-04-02 23:44:16");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	1076,	"2018-02-20 16:47:45");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	373,	"2018-03-04 9:20:45");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	1921,	"2018-03-03 11:24:5");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	14,	1872,	"2018-03-08 22:44:54");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	9,	630,	"2018-02-15 6:57:51");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	31,	1397,	"2018-03-03 21:13:40");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	1702,	"2018-04-21 16:20:47");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	21,	1696,	"2018-02-08 4:5:29");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	2,	995,	"2018-06-02 7:41:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	17,	467,	"2018-02-06 16:34:57");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	1722,	"2018-04-21 10:42:36");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	20,	607,	"2018-01-25 14:50:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	32,	1119,	"2018-02-28 8:3:37");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	26,	434,	"2018-03-23 2:28:46");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	13,	1754,	"2018-03-12 15:51:56");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1905,	"2018-01-10 9:49:41");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	1848,	"2018-01-13 15:27:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	1816,	"2018-03-02 11:39:52");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	25,	368,	"2018-04-27 8:43:14");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	22,	1449,	"2018-04-21 2:31:27");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	1,	446,	"2018-02-14 16:5:38");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	5,	1223,	"2018-02-10 6:29:34");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	12,	1103,	"2018-01-27 8:39:6");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	23,	1983,	"2018-04-06 0:10:55");
INSERT INTO events_donations(event_id,donator_user_id,donation_amount,donated_at)
VALUES (11,	11,	1521,	"2018-06-21 3:26:7");
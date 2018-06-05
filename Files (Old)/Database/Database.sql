DROP TABLE IF EXISTS Post_Feedback;
DROP TABLE IF EXISTS Donation;
DROP TABLE IF EXISTS Event_Feedback;
DROP TABLE IF EXISTS Event;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS Donator;
DROP TABLE IF EXISTS Organisation;


CREATE TABLE Donator (
    DonorID int(20) NOT NULL,
    FirstName varchar(20),
    LastName varchar(20),
    Email varchar(30),
    Password varchar(20),
    CONSTRAINT Donator_PK PRIMARY KEY (DonorID)
);

CREATE TABLE Organisation (
    OrgID int(20) NOT NULL,
    OrgName varchar(30),
    Email varchar(30),
    Contact varchar(20),
    Password varchar(20),
    CONSTRAINT Organisation_PK PRIMARY KEY (OrgID)
);

CREATE TABLE Post (
    PostID int(20) NOT NULL,
    Description text,
    Media blob,
    DonorID int,
    OrgID int,
    CONSTRAINT Post_PK PRIMARY KEY (PostID),
    CONSTRAINT POST_FK1 FOREIGN KEY(DonorID) REFERENCES Donator(DonorID) ON DELETE CASCADE,
    CONSTRAINT POST_FK2 FOREIGN KEY(OrgID) REFERENCES Organisation(OrgID) ON DELETE CASCADE
);

CREATE TABLE Event (
    EventID int(20) NOT NULL,
    Description text,
    Media blob,
    OrgID int(20),
    CONSTRAINT PK_Event PRIMARY KEY(EventID),
    CONSTRAINT Event_FK1 FOREIGN KEY(OrgID) REFERENCES Organisation(OrgID) ON DELETE CASCADE
);

CREATE TABLE Event_Feedback (
    DonorID int(20) NOT NULL,
    EventID int(20) NOT NULL,
    Comment text,
    Pledge int(20),
    CONSTRAINT Event_Feedback_PK PRIMARY KEY(DonorID, EventID),
    CONSTRAINT Event_Feedback_FK1 FOREIGN KEY(DonorID) REFERENCES Donator(DonorID) ON DELETE CASCADE,
    CONSTRAINT Event_Feedback_FK2 FOREIGN KEY(EventID) REFERENCES Event(EventID) ON DELETE CASCADE
);

CREATE TABLE Donation (
    DonorID int(20) NOT NULL,
    EventID int(20) NOT NULL,
    Amount int(20) NOT NULL,
    FirstName varchar(20) NOT NULL,
    LastName varchar(20) NOT NULL,
    CardNum varchar(20) NOT NULL,
    CONSTRAINT DONATION_PK PRIMARY KEY(DonorID, EventID),
    CONSTRAINT DONATION_FK1 FOREIGN KEY(DonorID) REFERENCES Donator(DonorID) ON DELETE CASCADE,
    CONSTRAINT DONATION_FK2 FOREIGN KEY(EventID) REFERENCES Event(EventID) ON DELETE CASCADE
);

CREATE TABLE Post_Feedback (
    FeedbackID int(20) NOT NULL,
    Comment text,
    Likes int(20),
    PostID int(20),
    DonorID int(20),
    OrgID int(20),
    CONSTRAINT Post_Feedback_PK PRIMARY KEY(FeedbackID),
    CONSTRAINT  Post_Feedback_FK1 FOREIGN KEY(DonorID) REFERENCES Donator(DonorID) ON DELETE CASCADE,
    CONSTRAINT  Post_Feedback_FK2 FOREIGN KEY(OrgID) REFERENCES Organisation(OrgID) ON DELETE CASCADE,
    CONSTRAINT Post_Feedback_FK3 FOREIGN KEY(PostID) REFERENCES Post(PostID) ON DELETE CASCADE
);
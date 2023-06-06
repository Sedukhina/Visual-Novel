CREATE DATABASE IF NOT EXISTS users_db;
USE users_db;
CREATE TABLE IF NOT EXISTS  Users
(
	User_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Email VARCHAR(254) NOT NULL,
    Username VARCHAR(30) NOT NULL,
    Birthday Date NOT NULL,
    Registration_Date Date NOT NULL,
    Hashed_Password VARCHAR(300) NOT NULL,
    Money INT UNSIGNED NOT NULL,
    Energy INT UNSIGNED NOT NULL,
    IsAdmin bool, 
    primary key (User_ID),
    unique key (Username),
    unique key (Email)
);

CREATE TABLE IF NOT EXISTS  Characters
(
	Username VARCHAR(30) NOT NULL,
    Hair_Type INT UNSIGNED, 
    Eyes_Type INT UNSIGNED, 
    Brows_Type INT UNSIGNED, 
    Nose_Type INT UNSIGNED NOT NULL, 
    Mouth_Type INT UNSIGNED NOT NULL,
	Gender VARCHAR(6) NOT NULL
);

CREATE TABLE IF NOT EXISTS GameProgress
(
	Username VARCHAR(30) NOT NULL,
    CurrentEpisode INT UNSIGNED,
    CurrentDialogue INT UNSIGNED,
    NextDialogue INT UNSIGNED,
    CurrentCue INT UNSIGNED,
    CurrentLocation VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS CompletedEpisodes
(
	Username VARCHAR(30) NOT NULL,
    Episode_ID INT UNSIGNED
);

CREATE DATABASE IF NOT EXISTS game_db;
USE game_db;

CREATE TABLE IF NOT EXISTS  Locations
(
	CurrentLocation VARCHAR(100),
    LeftLocation VARCHAR(100),
    RightLocation VARCHAR(100),
    ForwardLocation VARCHAR(100),
    BackLocation VARCHAR(100)
);
INSERT INTO Locations (CurrentLocation, ForwardLocation) VALUES ('Main', 'City_Entrance');
INSERT INTO Locations (CurrentLocation, BackLocation) VALUES ('City_Entrance', 'Main');

CREATE TABLE IF NOT EXISTS  Prices
(
	CoinsAmount INT,
    Price FLOAT
);

CREATE TABLE IF NOT EXISTS Episodes
(
	Episode_ID INT UNSIGNED NOT NULL, 
	EpisodName VARCHAR(50) NOT NULL,
    Synopsis VARCHAR(500)
);

CREATE DATABASE IF NOT EXISTS forum_db;
USE forum_db;

CREATE TABLE IF NOT EXISTS Topics
(
	Topic_ID INT NOT NULL AUTO_INCREMENT,
    Closed bool,
    Topic_Name VARCHAR(50),
	primary key (Topic_ID)
);

CREATE TABLE IF NOT EXISTS Messages
(
	Topic_ID INT,
    Message_ID INT NOT NULL AUTO_INCREMENT,
    Message VARCHAR(1000),
    Username VARCHAR(30),
    CreationTime datetime,
	primary key (Message_ID)
);

CREATE TABLE IF NOT EXISTS  ForumImages
(
	MessageID INT,
    PathToImage VARCHAR(250)
);

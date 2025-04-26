CREATE DATABASE IF NOT EXISTS basketball_stats;
USE basketball_stats;

CREATE TABLE IF NOT EXISTS teams (
    teamID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    totalWins INT,
    totalGames INT,
    wins INT
);

CREATE TABLE IF NOT EXISTS players (
    playerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    surname VARCHAR(100),
    teamID INT,
    totalGames INT,
    totalPoints INT,
    totalAssists INT,
    attemptedFieldGoals INT,
    successfulFieldGoals INT,
    steals INT,
    blocks INT,
    FOREIGN KEY (teamID) REFERENCES teams(teamID)
);

CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(25) NOT NULL PRIMARY KEY,
    password VARCHAR(256) NOT NULL,
    name VARCHAR(100),
    surname VARCHAR(100)
);

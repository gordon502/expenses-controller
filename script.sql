DROP DATABASE IF EXISTS expensescontroller;
DROP USER IF EXISTS 'somequietguy';


CREATE DATABASE expensescontroller;

CREATE USER 'somequietguy' IDENTIFIED BY 'g';

GRANT ALL PRIVILEGES ON expensescontroller.* TO 'somequietguy';

USE expensescontroller;

CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(45) UNIQUE NOT NULL,
    email VARCHAR(45) UNIQUE NOT NULL,
    salt CHAR(64) NOT NULL,
    pass CHAR(64) NOT NULL,
    active BIT NOT NULL,
    CONSTRAINT CHK_email CHECK (email like '%_@__%.__%'),
    CONSTRAINT CHK_salt CHECK (LENGTH(salt) = 64),
    CONSTRAINT CHK_pass CHECK (LENGTH(pass) = 64),
    INDEX(email)
);

CREATE TABLE Activation (
    id int PRIMARY KEY AUTO_INCREMENT,
    link CHAR(30) NOT NULL,
    user_id int UNIQUE NOT NULL,
    CONSTRAINT FK_ActivationUser FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE Reset (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    code CHAR(6) NOT NULL,
    created_at DATETIME NOT NULL,
    used bit NOT NULL,
    CONSTRAINT FK_ResetUser FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE Category (
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    user_id int NOT NULL,
    CONSTRAINT FK_CategoryUser FOREIGN KEY(user_id) REFERENCES Users(id)
);

CREATE TABLE Recharge (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    amount INT NOT NULL CHECK(amount > 0),
    start_date datetime NOT NULL,
    end_date datetime,
    CONSTRAINT FK_RechargeUsers FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Loads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    description VARCHAR(100) NOT NULL,
    date DATETIME,
    amount INT NOT NULL,
    category_id INT NOT NULL,
    CONSTRAINT FK_LoadsUsers FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT FK_LoadsCategory FOREIGN KEY (category_id) REFERENCES category(id)
);


CREATE TABLE users (
    username VARCHAR(30),
    fullname VARCHAR(30),
    password VARCHAR(20),
    email VARCHAR(254),
    PRIMARY KEY (username)
);

CREATE TABLE news (
    id INTEGER AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    title VARCHAR(255),  -- Added title, wasen't in master
    news VARCHAR(500),
    ts TIMESTAMP DEFAULT NOW(),
    score INTEGER DEFAULT 0,
    upvotes INTEGER DEFAULT 0,  -- Added upvotes, wasen't in master
    downvotes INTEGER DEFAULT 0,  -- Added downvotes, wasen't in master
    PRIMARY KEY (id)
);

CREATE TABLE pluses (
    id INTEGER AUTO_INCREMENT,
    username VARCHAR(30),
    newsid INTEGER,
    score INTEGER
 
DEFAULT
 
1,
    ts TIMESTAMP
 
DEFAULT NOW(),
    PRIMARY KEY (id)
);

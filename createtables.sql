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
    title VARCHAR(255),  
    news VARCHAR(500),
    ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    score INTEGER DEFAULT 0,
    upvotes INTEGER DEFAULT 0, 
    downvotes INTEGER DEFAULT 0,  
    PRIMARY KEY (id),
    FOREIGN KEY (username) REFERENCES users(username)
);

CREATE TABLE pluses (
    id INTEGER AUTO_INCREMENT,
    username VARCHAR(30),
    newsid INTEGER,
    score INTEGER DEFAULT 1,
    ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (username) REFERENCES users(username),
    FOREIGN KEY (newsid) REFERENCES news(id)
);


DEFAULT
 
1,
    ts TIMESTAMPs
 
DEFAULT NOW(),
    PRIMARY KEY (id)
);

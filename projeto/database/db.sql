CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR,
  birth_day INTEGER,
  gender VARCHAR,
  email VARCHAR,
  nationality VARCHAR
);

CREATE TABLE channels (
  name VARCHAR PRIMARY KEY,
  author VARCHAR REFERENCES users,
  description VARCHAR
);

CREATE TABLE stories (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  text VARCHAR,
  author VARCHAR REFERENCES users,
  date INTEGER,
  coverImage BLOB,
  track BLOB
);

CREATE TABLE comments (
  id INTEGER PRIMARY KEY,
  story_id INTEGER REFERENCES stories,
  author VARCHAR REFERENCES users,
  date INTEGER,
  text VARCHAR
);

CREATE TABLE vote (
  id INTEGER PRIMARY KEY,
  type VARCHAR, -- either 'UP' or 'DOWN'
  author VARCHAR REFERENCES users,
  story_id INTEGER REFERENCES stories, -- either story_id or comment_id is NULL
  comment_id INTEGER REFERENCES comments
);

CREATE TABLE subscribed (
  id INTEGER PRIMARY KEY,
  user VARCHAR REFERENCES users,
  channel VARCHAR REFERENCES channels
);

CREATE TABLE storyInChannel (
  id INTEGER PRIMARY KEY,
  story VARCHAR REFERENCES stories,
  channel VARCHAR REFERENCES channels
);

INSERT INTO users VALUES ("admin", "d033e22ae348aeb5660fc2140aec35850c4da997", "admin", "", "", "", ""); -- password in SHA-1 format
INSERT INTO channels VALUES ("general", "admin", "main channel");
INSERT INTO subscribed VALUES (NULL, "admin", "general");
INSERT INTO stories VALUES (0, "test", NULL, NULL, NULL, NULL, NULL);
INSERT INTO stories VALUES (1, "test1", NULL, NULL, NULL, NULL, NULL);
INSERT INTO storyInChannel VALUES (NULL, 0, "general");
INSERT INTO storyInChannel VALUES (NULL, 1, "general");
INSERT INTO comments VALUES (0, 0, "admin", NULL, "sdfknsdlfnsdlf");
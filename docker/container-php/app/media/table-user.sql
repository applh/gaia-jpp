CREATE TABLE IF NOT EXISTS `user`
(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    email TEXT,
    description TEXT,
    passhash TEXT,
    level INTEGER,
    code TEXT,
    created TEXT,
    updated TEXT
);
CREATE TABLE IF NOT EXISTS `geocms` 
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    content TEXT,
    cat TEXT,
    tags TEXT,
    created TEXT,
    updated TEXT,
    x REAL,
    y REAL,
    z REAL,
    t REAL
);

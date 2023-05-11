CREATE TABLE IF NOT EXISTS `geocms` 
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    path TEXT,
    filename TEXT,
    code TEXT,
    title TEXT,
    content TEXT,
    media TEXT,
    cat TEXT,
    tags TEXT,
    created TEXT,
    updated TEXT,
    hash TEXT,
    x REAL,
    y REAL,
    z REAL,
    t REAL
);

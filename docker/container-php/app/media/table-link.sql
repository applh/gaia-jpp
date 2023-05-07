CREATE TABLE IF NOT EXISTS `link`
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    quality TEXT, 
    link1 INTEGER,
    link2 INTEGER,
    link3 INTEGER,
    quantity REAL,
    tags TEXT,
    cat TEXT,
    created TEXT,
    updated TEXT
);
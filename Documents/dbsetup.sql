CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    email VARCHAR(90) UNIQUE NOT NULL,
    password CHAR(64) NOT NULL,
    role TINYINT NOT NULL
);

CREATE TABLE Release (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE NOT NULL
);

CREATE TABLE Article (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    status TINYINT,
    id_release INT,
    FOREIGN KEY (id_release) REFERENCES Release(id)
);

CREATE TABLE WrittenBy (
    id_user INT,
    id_article INT,
    PRIMARY KEY (id_user, id_article),
    FOREIGN KEY (id_user) REFERENCES User(id),
    FOREIGN KEY (id_article) REFERENCES Article(id)
);

CREATE TABLE ReviewBy (
    id_user INT,
    id_article INT,
    PRIMARY KEY (id_user, id_article),
    FOREIGN KEY (id_user) REFERENCES User(id),
    FOREIGN KEY (id_article) REFERENCES Article(id)
);

CREATE TABLE Review (
    id_user INT,
    id_article INT,
    text TEXT,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES User(id),
    FOREIGN KEY (id_article) REFERENCES Article(id)
);
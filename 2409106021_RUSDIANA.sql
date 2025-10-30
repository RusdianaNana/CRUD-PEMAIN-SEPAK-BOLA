CREATE DATABASE IF NOT EXISTS db_crud_rusdiana
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE db_crud_rusdiana;

DROP TABLE IF EXISTS pemain;

CREATE TABLE pemain (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    posisi VARCHAR(50) NOT NULL,
    klub VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pemain (nama, posisi, klub) VALUES
('Lionel Messi', 'Forward', 'Inter Miami'),
('Pedri', 'Midfielder', 'FC Barcelona'),
('Robert Lewandowski', 'Forward', 'FC Barcelona'),
('Frenkie de Jong', 'Midfielder', 'FC Barcelona'),
('Marc-André ter Stegen', 'Goalkeeper', 'FC Barcelona'),
('Ronald Araújo', 'Defender', 'FC Barcelona'),
('Ilkay Gündogan', 'Midfielder', 'FC Barcelona'),
('Ansu Fati', 'Forward', 'Brighton & Hove Albion'),
('João Cancelo', 'Defender', 'FC Barcelona'),
('Xavi Hernández', 'Coach', 'FC Barcelona');

SELECT * FROM pemain;
SHOW TABLES;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password)
VALUES 
('admin', MD5('admin123')); -- username: admin, password: admin123

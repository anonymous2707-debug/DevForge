CREATE DATABASE IF NOT EXISTS devforge_db;
USE devforge_db;

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100) NOT NULL,
    tech VARCHAR(50) NOT NULL,
    link VARCHAR(255) DEFAULT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO projects (title, author, tech, link, description) 
VALUES ('Student Task Tracker', 'Riya Tiwari', 'PHP / MySQL', 'https://github.com', 'A simple task management tool to keep track of semester deadlines and practical submissions.');
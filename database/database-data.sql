-- Drop if exists
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS superusers;
DROP TABLE IF EXISTS users;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20)
);

-- SUPERUSERS TABLE
CREATE TABLE superusers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- POSTS TABLE
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- COMMENTS TABLE
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Seed users (MD5 for now)
INSERT INTO users (username, password, name, email, phone)
VALUES
('Anvitha', MD5('Anvitha'), 'Anvitha Battineni', 'anvitha@example.com', '1111111111'),
('Neeraj', MD5('Neeraj'), 'Neeraj Akhnoor', 'neeraj@example.com', '2222222222'),
('Ryan', MD5('Ryan'), 'Ryan Cheng', 'ryan@example.com', '3333333333');

-- Superuser
INSERT INTO superusers (username, password)
VALUES ('admin', MD5('admin123'));
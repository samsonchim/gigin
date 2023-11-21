CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    time_needed INT NOT NULL,
    people INT NOT NULL,
    category VARCHAR(255) NOT NULL,
    language VARCHAR(255) NOT NULL,
    datetime DATETIME NOT NULL
);

ALTER TABLE posts ADD COLUMN meeting_id VARCHAR(255);
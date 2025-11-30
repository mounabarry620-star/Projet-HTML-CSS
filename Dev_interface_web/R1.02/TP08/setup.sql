CREATE DATABASE IF NOT EXISTS recettes_db;

USE recettes_db;

CREATE TABLE IF NOT EXISTS recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  photo VARCHAR(255),
  rating INT DEFAULT 0,
  short_desc TEXT,
  long_desc TEXT
);

INSERT INTO recipes (title, photo, rating, short_desc, long_desc) VALUES
('Recette 1', 'recette1.jpg', 4, 'Description de la recette 1.', 'Description longue de la recette 1.'),
('Recette 2', 'recette2.jpg', 5, 'Description de la recette 2.', 'Description longue de la recette 2.'),
('Recette 3', 'recette3.jpg', 3, 'Description de la recette 3.', 'Description longue de la recette 3.'),
('Recette 4', 'recette4.jpg', 4, 'Description de la recette 4.', 'Description longue de la recette 4.'),
('Recette 5', 'recette5.jpg', 3, 'Description de la recette 5.', 'Description longue de la recette 5.'),
('Recette 6', 'recette6.jpg', 5, 'Description de la recette 6.', 'Description longue de la recette 6.');
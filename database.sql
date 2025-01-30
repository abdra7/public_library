-- Create Books Table
DROP TABLE IF EXISTS books;
CREATE TABLE books (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  author varchar(255) NOT NULL,
  description text DEFAULT NULL,
  cover_image varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Users Table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  role enum('admin','user') NOT NULL DEFAULT 'user',
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Contacts Table
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  message text NOT NULL,
  submission_date timestamp NOT NULL DEFAULT current_timestamp(),
  status enum('unread','read') DEFAULT 'unread',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert Books Data
INSERT INTO books (id, title, author, description, cover_image) VALUES
(21, 'To Kill a Mockingbird', 'Harper Lee', 'A classic novel about racial injustice and childhood innocence in the American South.', 'https://upload.wikimedia.org/wikipedia/commons/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg'),
(22, '1984', 'George Orwell', 'A dystopian novel exploring themes of totalitarianism and surveillance society.', 'https://m.media-amazon.com/images/I/61ZewDE3beL.jpg'),
(24, 'The Hunger Games', 'Suzanne Collins', 'A dystopian novel about a televised battle to the death in a post-apocalyptic society.', 'https://upload.wikimedia.org/wikipedia/en/d/dc/The_Hunger_Games.jpg'),
(25, 'The Catcher in the Rye', 'J.D. Salinger', 'A story about teenage alienation and rebellion in 1950s America.', 'https://upload.wikimedia.org/wikipedia/commons/8/89/The_Catcher_in_the_Rye_%281951%2C_first_edition_cover%29.jpg'),
(26, 'Atomic Habits', 'James Clear', 'A self-help book about building good habits and breaking bad ones through small changes.', 'https://m.media-amazon.com/images/I/51B7kuFwQFL.jpg'),
(27, 'The Great Gatsby', 'F. Scott Fitzgerald', 'A story of decadence and idealism in the Jazz Age, set in Long Island and New York City.', 'https://upload.wikimedia.org/wikipedia/commons/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg'),
(28, 'Pride and Prejudice', 'Jane Austen', 'A romantic novel of manners that charts the emotional development of Elizabeth Bennet.', 'https://upload.wikimedia.org/wikipedia/commons/1/17/PrideAndPrejudiceTitlePage.jpg'),
(29, 'The Alchemist', 'Paulo Coelho', 'A philosophical book about a young shepherd pursuing his personal legend.', 'https://m.media-amazon.com/images/I/71aFt4+OTOL.jpg'),
(30, 'The Da Vinci Code', 'Dan Brown', 'A mystery thriller that combines art history, religion, and conspiracy theories.', 'https://upload.wikimedia.org/wikipedia/en/6/6b/DaVinciCode.jpg'),
(31, 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', 'Essential book about writing maintainable, clean code with practical examples', 'https://m.media-amazon.com/images/I/41xShlnTZTL._SX376_BO1,204,203,200_.jpg'),
(32, 'The Pragmatic Programmer', 'Andrew Hunt, David Thomas', 'Classic guide to practical programming and career development', 'https://m.media-amazon.com/images/I/71f1jieYHNL.jpg'),
(33, 'Design Patterns: Elements of Reusable Object-Oriented Software', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides', 'The seminal "Gang of Four" patterns book that defined software architecture', 'https://m.media-amazon.com/images/I/51szD9HC9pL._SY445_SX342_.jpg'),
(34, 'Structure and Interpretation of Computer Programs (SICP)', 'Harold Abelson, Gerald Jay Sussman', 'Foundational computer science textbook using Scheme programming language', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/SICP_cover.jpg/220px-SICP_cover.jpg'),
(35, 'Cracking the Coding Interview', 'Gayle Laakmann McDowell', 'Essential preparation for technical programming interviews', 'https://m.media-amazon.com/images/I/61mIq2iJUXL._SY466_.jpg'),
(36, 'Refactoring: Improving the Design of Existing Code', 'Martin Fowler', 'Definitive guide to restructuring code without changing functionality', 'https://m.media-amazon.com/images/I/71e6ndHEwqL._AC_UF894,1000_QL80_.jpg'),
(37, 'You Don\'t Know JS Yet', 'Kyle Simpson', 'In-depth series on JavaScript language fundamentals', 'https://m.media-amazon.com/images/I/71mKvD89oEL._SY466_.jpg'),
(38, 'The Art of Invisibility', 'Kevin Mitnick', 'A cybersecurity guide exploring digital privacy, identity protection, and modern surveillance countermeasures.', 'https://m.media-amazon.com/images/I/61jHBH3wewL.jpg');

-- Insert Users Data
INSERT INTO users (id, name, email, password, role, created_at) VALUES
(8, 'abd', 'aa@aa', '$2y$10$frgumk6aQ4tyylMXTnxpNet.zXuDTsFmsMETjJP8k2F/DGxmFMDwC', 'admin', '2025-01-30 05:45:09'),
(9, 'العميد', 'mgmarkting22@outlook.com', '$2y$10$dl2Hh1tTNDT7cIH2h9HpdOEkYhHDUpRKg477FO425gAOY6aseDVwS', 'user', '2025-01-30 06:40:10');

-- Reset Auto Increments
ALTER TABLE books AUTO_INCREMENT = 39;
ALTER TABLE users AUTO_INCREMENT = 10;
ALTER TABLE contacts AUTO_INCREMENT = 49;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'writer', 'subscriber') DEFAULT 'subscriber',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password_hash, role) VALUES 
('Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT INTO posts (user_id, title, content, image_url, created_at) VALUES
(1, 'Elder Quest', 'Un RPG epico con mundo abierto, misiones profundas y combate tactico.', NULL, '2025-12-16 00:00:00'),
(1, 'Cyber Drift', 'Carreras futuristas con coches modificables y pistas neon.', NULL, '2025-12-16 00:00:00'),
(1, 'Mystic Saga', 'Aventura narrativa con puzles y decisiones que cambian la historia.', NULL, '2025-12-16 00:00:00'),
(1, 'Racing Turbo', 'Simulador de carreras arcade con multijugador local.', NULL, '2025-12-16 00:00:00'),
(1, 'Space Outlaws', 'Shooter espacial con exploración y comercio entre sistemas.', NULL, '2025-12-16 00:00:00');

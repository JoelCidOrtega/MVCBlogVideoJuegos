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

INSERT IGNORE INTO users (id, username, email) 
VALUES (1, 'GamingEditor', 'redaccion@pixelblog.com');


INSERT INTO posts (user_id, title, content, image_url, created_at) VALUES
(1, 
 'Elden Ring: El desafío definitivo de FromSoftware', 
 'Elden Ring no es solo un juego, es una experiencia que redefine lo que esperamos de un mundo abierto. La colaboración entre Hidetaka Miyazaki y George R.R. Martin ha dado lugar a las Tierras Entre, un lugar donde la belleza y el peligro acechan en cada esquina. A diferencia de otros juegos, aquí no hay marcadores que te saturen el mapa; la curiosidad es tu única guía. Desde el imponente Castillo de Velo Tormentoso hasta las profundidades de la Ciudad Eterna de Nokron, cada secreto descubierto se siente como un triunfo personal. El sistema de combate, refinado tras años de experiencia con la saga Souls, ofrece una libertad táctica asombrosa, permitiendo que cada jugador encuentre su propio estilo entre hechizos, armas pesadas o sigilo.', 
 'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?w=800', 
 NOW()),

(1, 
 'Zelda: Tears of the Kingdom - Una oda a la imaginación', 
 'La secuela de Breath of the Wild ha logrado lo que parecía imposible: superar a su predecesor en todos los aspectos. En Tears of the Kingdom, Hyrule se expande verticalmente con las misteriosas islas celestiales y las oscuras profundidades del subsuelo. Pero la verdadera revolución es la habilidad de la Ultramano, que convierte al jugador en un ingeniero improvisado capaz de crear desde botes simples hasta tanques de guerra complejos. Esta mecánica de construcción, integrada perfectamente con las leyes de la física del juego, hace que no existan dos formas iguales de resolver un santuario o derrotar a un campamento de monstruos. Es un patio de recreo infinito donde el único límite es tu propia capacidad de inventiva.', 
 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800', -- Imagen de ambiente Nintendo/Aventura
 NOW()),

(1, 
 'Baldurs Gate 3: La nueva vara de medir para el RPG', 
 'Lo que Larian Studios ha conseguido con Baldur’s Gate 3 es un hito histórico en la industria. Nunca antes un videojuego había logrado trasladar con tanta fidelidad la libertad de una partida de rol de mesa de Dungeons & Dragons. Cada línea de diálogo, cada tirada de dados y cada elección moral tienen un peso real que puede alterar el curso de la historia de formas drásticas. Los personajes que te acompañan no son simples herramientas de combate, sino compañeros con trasfondos profundos, deseos y miedos que evolucionan según cómo interactúes con ellos. Es un juego que te invita a experimentar, a fracasar y a vivir con las consecuencias de tus actos, ofreciendo una rejugabilidad prácticamente infinita.', 
 'https://images.unsplash.com/photo-1519074063912-ad2fe3f51964?w=800', 
 NOW()),

(1, 
 'Cyberpunk 2077: El resurgir de la distopía de neón', 
 'Tras un lanzamiento accidentado, Cyberpunk 2077 ha logrado redimirse y convertirse en el RPG de acción que todos soñamos. Night City es, sin duda, la ciudad más inmersiva jamás creada en un videojuego; un laberinto de luces de neón, rascacielos corporativos y callejones peligrosos donde la vida no vale nada. Con la actualización 2.0 y la expansión Phantom Liberty, el sistema de habilidades y el combate policial han sido rediseñados por completo, ofreciendo una experiencia visceral y fluida. La historia de V y su lucha interna con el "biochip" de Johnny Silverhand nos plantea preguntas profundas sobre la identidad y el transhumanismo, todo ello envuelto en una estética "cyber" que es simplemente espectacular.', 
 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=800', 
 NOW()),

(1, 
 'God of War Ragnarök: El cierre épico de la saga nórdica', 
 'Kratos y Atreus regresan para enfrentarse al fin de los tiempos en una de las historias más maduras y emocionantes de PlayStation. Ragnarök no es solo un despliegue de violencia brutal y épica visual; es, en su corazón, una historia sobre la paternidad, el crecimiento y el miedo a dejar ir. El sistema de combate, ya excelente en la entrega de 2018, se siente más dinámico que nunca con la introducción de nuevas habilidades para las Espadas del Caos y el Hacha Leviatán. Explorar los Nueve Reinos es un deleite constante gracias a una dirección de arte soberbia y a un diseño de sonido que te sumerge por completo en la mitología nórdica. Un cierre perfecto para una etapa inolvidable del Fantasma de Esparta.', 
 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=800', 
 NOW());
-- AI-assisted migration of the Laravel migrations/seeders to Docker-first MariaDB initialization.
SET NAMES utf8mb4;

CREATE TABLE property_types (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE style_of_homes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE accessibility_features (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE properties (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    price INT UNSIGNED NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    rooms INT UNSIGNED NOT NULL,
    baths INT UNSIGNED NOT NULL,
    size INT UNSIGNED NOT NULL,
    property_type_id INT UNSIGNED NOT NULL,
    style_of_home_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_properties_property_type FOREIGN KEY (property_type_id) REFERENCES property_types(id),
    CONSTRAINT fk_properties_style FOREIGN KEY (style_of_home_id) REFERENCES style_of_homes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE property_images (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    property_id INT UNSIGNED NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_main_image TINYINT(1) NOT NULL DEFAULT 0,
    CONSTRAINT fk_property_images_property FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE accessibility_feature_property (
    property_id INT UNSIGNED NOT NULL,
    accessibility_feature_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (property_id, accessibility_feature_id),
    CONSTRAINT fk_afp_property FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    CONSTRAINT fk_afp_feature FOREIGN KEY (accessibility_feature_id) REFERENCES accessibility_features(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO property_types (name) VALUES
('House'), ('Apartment'), ('Villa'), ('Cabin');

INSERT INTO style_of_homes (name) VALUES
('A-Frame'), ('Bungalow'), ('Cottage'), ('Dome'), ('Spanish');

INSERT INTO accessibility_features (name) VALUES
('Wheelchair accessible'), ('Elevator'), ('Accessible parking'), ('Step-free access'), ('Ground-floor access');

INSERT INTO properties (title, price, location, description, rooms, baths, size, property_type_id, style_of_home_id) VALUES
('Modern family house', 325000, 'Žilina', 'Priestranný rodinný dom s moderným interiérom a pokojnou lokalitou.', 4, 2, 145, 1, 2),
('City apartment', 185000, 'Bratislava', 'Svetlý byt v blízkosti centra, vhodný na bývanie aj investíciu.', 3, 1, 78, 2, 3),
('Quiet cottage', 149000, 'Orava', 'Útulná nehnuteľnosť v tichom prostredí s prírodou na dosah.', 3, 1, 92, 1, 3),
('Premium villa', 790000, 'Trnava', 'Veľká vila s dostatkom priestoru, súkromím a kvalitným vybavením.', 6, 3, 260, 3, 5);

INSERT INTO property_images (property_id, image_path, is_main_image) VALUES
(1, 'img/house1.png', 1),
(1, 'img/house2.png', 0),
(1, 'img/house3.png', 0),
(2, 'img/house2.png', 1),
(3, 'img/house3.png', 1),
(4, 'img/house4.png', 1);

INSERT INTO accessibility_feature_property (property_id, accessibility_feature_id) VALUES
(1, 1), (1, 3), (2, 2), (2, 4), (3, 3), (4, 1), (4, 2), (4, 3);

USE bcnrestaurantes;

CREATE TABLE rol (
    id_rol BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE users (
    id_users BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(9) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    id_rol BIGINT NOT NULL,
    profile_image TEXT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
) ENGINE=InnoDB;

CREATE TABLE zones (
    id_zones BIGINT AUTO_INCREMENT PRIMARY KEY,
    name_zone VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE restaurants (
    id_restaurants BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location TEXT NOT NULL,
    img_restaurant TEXT NULL,
    average_price INT NULL,
    phone VARCHAR(15) NULL,
    opening_hours TIME NULL,
    closing_hours TIME NULL,
    manager_id_users BIGINT NOT NULL,
    id_zones BIGINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (manager_id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_zones) REFERENCES zones(id_zones)
) ENGINE=InnoDB;

CREATE TABLE tags (
    id_tags BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE restaurant_tags (
    id_restaurant_tags BIGINT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id_restaurants BIGINT NOT NULL,
    tag_id_tags BIGINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants),
    FOREIGN KEY (tag_id_tags) REFERENCES tags(id_tags)
) ENGINE=InnoDB;

CREATE TABLE food_images (
    id_foods_images BIGINT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id_restaurants BIGINT NOT NULL,
    image_url TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;

CREATE TABLE reviews (
    id_reviews BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id_users BIGINT NOT NULL,
    restaurant_id_restaurants BIGINT NOT NULL,
    score INT NOT NULL CHECK (score BETWEEN 1 AND 5),
    comment TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id_users) REFERENCES users(id_users),
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;

CREATE TABLE favorites (
    id_favorites BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id_users BIGINT NOT NULL,
    restaurant_id_restaurants BIGINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id_users) REFERENCES users(id_users),
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;
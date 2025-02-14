use bcnrestaurantes;

CREATE TABLE rol (
    id_rol BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE users (
    id_users BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(9) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    id_rol BIGINT(20) NOT NULL,
    profile_image LONGTEXT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
) ENGINE=InnoDB;

CREATE TABLE restaurants (
    id_restaurants BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    location LONGTEXT NOT NULL,
    img_restaurant LONGTEXT NULL,
    average_price INT(11) NULL,
    phone VARCHAR(9) NULL,
    opening_hours TIME NULL,
    closing_hours TIME NULL,
    manager_id_users BIGINT(20) NOT NULL,
    id_zones BIGINT(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (manager_id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_zones) REFERENCES zones(id_zones)
) ENGINE=InnoDB;

CREATE TABLE tags (
    id_tags BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE restaurant_tags (
    id_restaurant_tags BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    restaurant_id_restaurants BIGINT(20) NOT NULL,
    tag_id_tags BIGINT(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants),
    FOREIGN KEY (tag_id_tags) REFERENCES tags(id_tags)
) ENGINE=InnoDB;

CREATE TABLE food_images (
    id_foods_images BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    restaurant_id_restaurants BIGINT(20) NOT NULL,
    image_url LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;

CREATE TABLE reviews (
    id_reviews BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    user_id_users BIGINT(20) NOT NULL,
    restaurant_id_restaurants BIGINT(20) NOT NULL,
    score INT(11) NOT NULL CHECK (score BETWEEN 1 AND 5),
    comment LONGTEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id_users) REFERENCES users(id_users),
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;

CREATE TABLE favorites (
    id_favorites BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    user_id_users BIGINT(20) NOT NULL,
    restaurant_id_restaurants BIGINT(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id_users) REFERENCES users(id_users),
    FOREIGN KEY (restaurant_id_restaurants) REFERENCES restaurants(id_restaurants)
) ENGINE=InnoDB;


CREATE TABLE zones (
    id_zones BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    name_zone VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    phone VARCHAR(30) NOT NULL,
    address TEXT NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('utilisateur','employe','administrateur')
        NOT NULL DEFAULT 'utilisateur',
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE themes(id INT AUTO_INCREMENT PRIMARY KEY,label VARCHAR(80) NOT NULL UNIQUE); CREATE TABLE diets(id INT AUTO_INCREMENT PRIMARY KEY,label VARCHAR(80) NOT NULL UNIQUE); CREATE TABLE dish_categories(id INT AUTO_INCREMENT PRIMARY KEY,label VARCHAR(80) NOT NULL UNIQUE);
CREATE TABLE dishes(id INT AUTO_INCREMENT PRIMARY KEY, category_id INT NOT NULL, name VARCHAR(150) NOT NULL, description TEXT, FOREIGN KEY(category_id) REFERENCES dish_categories(id));
CREATE TABLE dish_allergens(id INT AUTO_INCREMENT PRIMARY KEY, dish_id INT NOT NULL, allergen VARCHAR(80) NOT NULL, FOREIGN KEY(dish_id) REFERENCES dishes(id) ON DELETE CASCADE);
CREATE TABLE menus(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(150) NOT NULL,description TEXT NOT NULL,conditions TEXT NOT NULL,theme_id INT NOT NULL,diet_id INT NOT NULL,min_people INT NOT NULL,base_price DECIMAL(10,2) NOT NULL,stock INT NOT NULL DEFAULT 0,image_url VARCHAR(255),is_active BOOLEAN DEFAULT TRUE,created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(theme_id) REFERENCES themes(id),FOREIGN KEY(diet_id) REFERENCES diets(id));
CREATE TABLE menu_dishes(menu_id INT NOT NULL,dish_id INT NOT NULL,PRIMARY KEY(menu_id,dish_id),FOREIGN KEY(menu_id) REFERENCES menus(id) ON DELETE CASCADE,FOREIGN KEY(dish_id) REFERENCES dishes(id));
CREATE TABLE orders(id INT AUTO_INCREMENT PRIMARY KEY,reference VARCHAR(40) UNIQUE NOT NULL,user_id INT NOT NULL,menu_id INT NOT NULL,customer_first_name VARCHAR(80),customer_last_name VARCHAR(80),customer_email VARCHAR(180),customer_phone VARCHAR(30),service_address TEXT,service_city VARCHAR(100),service_date DATE,delivery_time TIME,people_count INT,distance_km DECIMAL(6,2) DEFAULT 0,menu_total DECIMAL(10,2),discount DECIMAL(10,2),delivery_fee DECIMAL(10,2),total DECIMAL(10,2),status ENUM('recue','accepte','en_preparation','en_livraison','livre','attente_retour_materiel','terminee','annulee') DEFAULT 'recue',cancel_contact_mode VARCHAR(40),cancel_reason TEXT,created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id),FOREIGN KEY(menu_id) REFERENCES menus(id));
CREATE TABLE order_status_history(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,status VARCHAR(60) NOT NULL,note TEXT,created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE);
CREATE TABLE reviews(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,user_id INT NOT NULL,rating TINYINT NOT NULL CHECK(rating BETWEEN 1 AND 5),comment TEXT NOT NULL,status ENUM('pending','approved','refused') DEFAULT 'pending',created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(order_id) REFERENCES orders(id),FOREIGN KEY(user_id) REFERENCES users(id));
CREATE TABLE contacts(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(150) NOT NULL,email VARCHAR(180) NOT NULL,message TEXT NOT NULL,created_at DATETIME DEFAULT CURRENT_TIMESTAMP);
CREATE INDEX idx_orders_status ON orders(status); CREATE INDEX idx_orders_service_date ON orders(service_date); CREATE INDEX idx_menus_filters ON menus(theme_id,diet_id,base_price,min_people);

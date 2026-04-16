CREATE TABLE IF NOT EXISTS tb_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    icon VARCHAR(100) NULL,
    status ENUM('active', 'draft', 'archived') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tb_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    sku VARCHAR(80) NOT NULL UNIQUE,
    category_id INT NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    compare_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    badge VARCHAR(80) NULL,
    featured TINYINT(1) NOT NULL DEFAULT 0,
    is_new TINYINT(1) NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,
    secondary_image VARCHAR(255) NULL,
    rating DECIMAL(3,2) NOT NULL DEFAULT 4.6,
    reviews INT NOT NULL DEFAULT 0,
    sizes VARCHAR(120) NULL,
    colors VARCHAR(120) NULL,
    stock INT NOT NULL DEFAULT 0,
    status ENUM('active', 'draft', 'archived') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES tb_categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tb_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(120) NOT NULL,
    lastName VARCHAR(120) NOT NULL,
    Email VARCHAR(180) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    confirmPassword VARCHAR(255) NOT NULL,
    phone VARCHAR(40) NOT NULL UNIQUE,
    address TEXT NULL,
    Gender VARCHAR(30) NULL,
    CreateTime VARCHAR(60) NULL,
    activity TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tb_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(80) NOT NULL UNIQUE,
    user_id INT NULL,
    customer_name VARCHAR(180) NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(40) NULL,
    address TEXT NULL,
    city VARCHAR(120) NULL,
    postal_code VARCHAR(30) NULL,
    country VARCHAR(120) NULL,
    payment_method VARCHAR(80) NULL,
    subtotal DECIMAL(10,2) NOT NULL DEFAULT 0,
    shipping DECIMAL(10,2) NOT NULL DEFAULT 0,
    tax DECIMAL(10,2) NOT NULL DEFAULT 0,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    status VARCHAR(30) NOT NULL DEFAULT 'pending',
    items_json JSON NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tb_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NULL,
    product_name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NULL,
    size VARCHAR(40) NULL,
    color VARCHAR(40) NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 1,
    line_total DECIMAL(10,2) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES tb_orders(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tb_contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(180) NOT NULL,
    email VARCHAR(180) NOT NULL,
    subject VARCHAR(180) NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tb_newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(180) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tb_categories (name, slug, description, image, icon, status)
SELECT 'Dresses', 'dresses', 'Romantic silhouettes for daytime and evening.', 'assets/images/cat_dresses.png', 'fa-person-dress', 'active'
WHERE NOT EXISTS (SELECT 1 FROM tb_categories WHERE slug = 'dresses');

INSERT INTO tb_categories (name, slug, description, image, icon, status)
SELECT 'Tops', 'tops', 'Layerable pieces that stay in rotation.', 'assets/images/cat_tops.png', 'fa-shirt', 'active'
WHERE NOT EXISTS (SELECT 1 FROM tb_categories WHERE slug = 'tops');

INSERT INTO tb_categories (name, slug, description, image, icon, status)
SELECT 'Bottoms', 'bottoms', 'Tailored skirts and trousers with clean lines.', 'assets/images/cat_bottoms.png', 'fa-layer-group', 'active'
WHERE NOT EXISTS (SELECT 1 FROM tb_categories WHERE slug = 'bottoms');

INSERT INTO tb_categories (name, slug, description, image, icon, status)
SELECT 'Accessories', 'accessories', 'Finish the look with refined accents.', 'assets/images/cat_accessories.png', 'fa-gem', 'active'
WHERE NOT EXISTS (SELECT 1 FROM tb_categories WHERE slug = 'accessories');

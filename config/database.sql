-- ============================================================
-- Shapehugs E-Commerce Database Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_shapehugs;
USE db_shapehugs;

-- -----------------------------------------------------------
-- Users
-- -----------------------------------------------------------
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    phone      VARCHAR(20),
    role       ENUM('user', 'admin') DEFAULT 'user',
    is_verified TINYINT      DEFAULT 0,
    created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------
-- Product Categories
-- -----------------------------------------------------------
CREATE TABLE product_categories (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description TEXT,
    image       VARCHAR(255),
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------
-- Products
-- -----------------------------------------------------------
CREATE TABLE products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(200)   NOT NULL,
    description TEXT,
    price       DECIMAL(10,2)  NOT NULL,
    sale_price  DECIMAL(10,2)  NULL,
    category_id INT            NOT NULL,
    stock       INT            DEFAULT 0,
    image       VARCHAR(255),
    size        VARCHAR(50),
    color       VARCHAR(50),
    is_featured TINYINT        DEFAULT 0,
    status      ENUM('active', 'draft', 'archived') DEFAULT 'active',
    created_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id) REFERENCES product_categories(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_products_status   ON products(status);
CREATE INDEX idx_products_featured ON products(is_featured);

-- -----------------------------------------------------------
-- Cart
-- -----------------------------------------------------------
CREATE TABLE cart (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    product_id INT NOT NULL,
    quantity   INT DEFAULT 1,
    size       VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cart_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_cart_product
        FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_cart_user ON cart(user_id);

-- -----------------------------------------------------------
-- Orders
-- -----------------------------------------------------------
CREATE TABLE orders (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    user_id          INT            NOT NULL,
    total_amount     DECIMAL(10,2)  NOT NULL,
    status           ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_address TEXT,
    billing_address  TEXT,
    payment_method   VARCHAR(50),
    tracking_number  VARCHAR(100),
    created_at       TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_orders_user   ON orders(user_id);
CREATE INDEX idx_orders_status ON orders(status);

-- -----------------------------------------------------------
-- Order Items
-- -----------------------------------------------------------
CREATE TABLE order_items (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    order_id   INT           NOT NULL,
    product_id INT           NOT NULL,
    quantity   INT           NOT NULL,
    price      DECIMAL(10,2) NOT NULL,
    size       VARCHAR(20),
    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id) REFERENCES orders(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product
        FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_order_items_order ON order_items(order_id);

-- -----------------------------------------------------------
-- Wishlist
-- -----------------------------------------------------------
CREATE TABLE wishlist (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_wishlist_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_wishlist_product
        FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_wishlist_user ON wishlist(user_id);

-- -----------------------------------------------------------
-- Contact Messages
-- -----------------------------------------------------------
CREATE TABLE contact_messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    subject    VARCHAR(200),
    message    TEXT         NOT NULL,
    is_read    TINYINT      DEFAULT 0,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_contact_messages_read ON contact_messages(is_read);

-- -----------------------------------------------------------
-- Newsletter Subscribers
-- -----------------------------------------------------------
CREATE TABLE newsletter (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Seed Data
-- ============================================================

-- Admin user (password: admin123)
INSERT INTO users (name, email, password, role, is_verified) VALUES
('Admin', 'admin@shapehugs.com', '$2y$10$Qz57AkN.sNddcJp/.GWG.uZ/pxbxXtlJLhbgc6ONBXN1Q0lu//MCC', 'admin', 1);

-- Product Categories
INSERT INTO product_categories (name, description, image) VALUES
('Dresses',     'Elegant dresses for every occasion — from casual day dresses to glamorous evening gowns.', 'categories/dresses.jpg'),
('Tops',        'Stylish tops, blouses, and shirts to elevate your everyday look.',                         'categories/tops.jpg'),
('Bottoms',     'Comfortable and trendy pants, skirts, and shorts for every season.',                       'categories/bottoms.jpg'),
('Accessories', 'Complete your outfit with our curated collection of bags, jewellery, and scarves.',        'categories/accessories.jpg'),
('Sale',        'Grab amazing deals on your favourite styles — limited time only!',                         'categories/sale.jpg');

-- Products
INSERT INTO products (name, description, price, sale_price, category_id, stock, image, size, color, is_featured, status) VALUES
-- Dresses (category 1)
('Velvet Wrap Midi Dress',
 'A luxurious velvet wrap dress that flatters every figure. Features a V-neckline, adjustable waist tie, and a flowing midi-length skirt perfect for dinner dates and special occasions.',
 89.99, NULL, 1, 35, 'products/velvet-wrap-midi.jpg', 'S,M,L,XL', 'Burgundy', 1, 'active'),

('Floral Summer Maxi Dress',
 'Light and breezy maxi dress in a vibrant floral print. Adjustable spaghetti straps and a smocked bodice give a comfortable, relaxed fit ideal for warm-weather outings.',
 69.99, 49.99, 1, 50, 'products/floral-summer-maxi.jpg', 'XS,S,M,L', 'Multicolor', 1, 'active'),

-- Tops (category 2)
('Silk Button-Down Blouse',
 'Timeless silk blouse with a relaxed fit and mother-of-pearl buttons. Pair it with tailored trousers for the office or denim for a polished weekend look.',
 79.99, NULL, 2, 40, 'products/silk-button-blouse.jpg', 'S,M,L', 'Ivory', 0, 'active'),

('Ribbed Knit Crop Top',
 'A versatile ribbed-knit crop top that hugs in all the right places. Great layered under a blazer or worn solo with high-waisted jeans.',
 34.99, 29.99, 2, 60, 'products/ribbed-knit-crop.jpg', 'XS,S,M,L,XL', 'Black', 1, 'active'),

-- Bottoms (category 3)
('High-Waist Wide-Leg Trousers',
 'Flattering high-waist trousers with a wide leg that elongates your silhouette. Made from a soft crepe fabric with a comfortable elastic waistband.',
 64.99, NULL, 3, 45, 'products/wide-leg-trousers.jpg', 'S,M,L,XL', 'Navy', 0, 'active'),

('Stretch Denim Pencil Skirt',
 'A wardrobe staple — this knee-length pencil skirt is crafted from premium stretch denim for all-day comfort and a sleek silhouette.',
 54.99, NULL, 3, 30, 'products/denim-pencil-skirt.jpg', 'XS,S,M,L', 'Indigo', 0, 'active'),

-- Accessories (category 4)
('Quilted Leather Crossbody Bag',
 'Chic quilted crossbody bag made from genuine leather with gold-tone hardware. Compact enough for essentials yet roomy with three interior compartments.',
 149.00, NULL, 4, 25, 'products/quilted-crossbody.jpg', NULL, 'Blush Pink', 1, 'active'),

('Layered Gold Chain Necklace',
 'Delicate layered necklace featuring three chains of varying lengths with dainty pendant accents. Hypoallergenic gold-plated stainless steel.',
 39.99, NULL, 4, 80, 'products/layered-gold-necklace.jpg', NULL, 'Gold', 0, 'active'),

-- Sale (category 5)
('Off-Shoulder Ruffle Top',
 'Playful off-shoulder top with cascading ruffles and a relaxed silhouette. Originally $59.99 — now at an unbeatable price!',
 59.99, 34.99, 5, 20, 'products/off-shoulder-ruffle.jpg', 'S,M,L', 'Coral', 1, 'active'),

('Classic Trench Coat',
 'A lightweight classic trench coat with a belted waist, storm flaps, and a water-resistant finish. Timeless style that transitions seamlessly between seasons.',
 129.99, 89.99, 5, 15, 'products/classic-trench-coat.jpg', 'S,M,L,XL', 'Camel', 1, 'active');

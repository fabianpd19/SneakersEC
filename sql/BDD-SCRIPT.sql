/*
 * ===========================================
 * CREACIÓN DE USUARIO 
 * ===========================================
 *
 */

CREATE USER sneakeradmin WITH PASSWORD '123456789';

ALTER USER sneakeradmin WITH SUPERUSER;

ALTER USER sneakeradmin CREATEROLE;

ALTER USER sneakeradmin LOGIN;

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO sneakeradmin;

CREATE EXTENSION IF NOT EXISTS pgcrypto;

/* 
 * ===========================================
 * CREACIÓN DE LAS TABLAS DE LA BASE DE DATOS 
 * ===========================================
 *
 */

-- Tabla de usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password CHAR(32) NOT NULL, -- MD5 produce una cadena de 32 caracteres
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    phone VARCHAR(20),
    website VARCHAR(100),
    about TEXT
);

-- Tabla de perfiles de usuario
CREATE TABLE perfiles (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    nombre_completo VARCHAR(100),
    telefono VARCHAR(20),
    foto_url VARCHAR(255), -- URL o ruta de la foto del usuario
    direccion VARCHAR(255),
    sobre TEXT, -- Descripción o "sobre" del usuario
    hobbies TEXT,
    website VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de insignias (badges)
CREATE TABLE badges (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Relación entre usuarios e insignias (badges)
CREATE TABLE usuarios_badges (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    badge_id INT REFERENCES badges(id) ON DELETE CASCADE,
    asignado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de actividad reciente de usuarios
CREATE TABLE actividad_reciente (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    descripcion VARCHAR(255) NOT NULL, -- Descripción de la actividad
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de pedidos de los usuarios
CREATE TABLE pedidos (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) CHECK (estado IN ('Delivered', 'Pending', 'Cancelled')), -- Estados válidos
    total NUMERIC(10, 2) CHECK (total >= 0), -- Valor total del pedido
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de categorías de productos
CREATE TABLE categorias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de géneros de productos (Hombres, Mujeres, Unisex)
CREATE TABLE generos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de marcas de productos
CREATE TABLE marcas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de productos
CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL, -- Nombre del producto
    descripcion TEXT, -- Descripción del producto
    precio NUMERIC(10, 2) CHECK (precio >= 0), -- Precio del producto
    precio_original NUMERIC(10, 2), -- Precio original (antes del descuento)
    stock INT CHECK (stock >= 0), -- Cantidad de productos disponibles
    marca_id INT REFERENCES marcas(id) ON DELETE SET NULL, -- Relación con la tabla de marcas
    categoria_id INT REFERENCES categorias(id) ON DELETE SET NULL, -- Relación con la tabla de categorías
    genero_id INT REFERENCES generos(id) ON DELETE SET NULL, -- Relación con la tabla de géneros
    imagen_url VARCHAR(255), -- URL de la imagen del producto
    calificacion INT CHECK (calificacion BETWEEN 1 AND 5), -- Calificación del producto
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Relación entre productos y pedidos (para reflejar qué productos se compraron en un pedido)
CREATE TABLE pedidos_productos (
    id SERIAL PRIMARY KEY,
    pedido_id INT REFERENCES pedidos(id) ON DELETE CASCADE,
    producto_id INT REFERENCES productos(id) ON DELETE CASCADE,
    cantidad INT CHECK (cantidad > 0), -- Cantidad de cada producto en el pedido
    precio NUMERIC(10, 2) CHECK (precio >= 0) -- Precio del producto en el momento de la compra
);

-- Tabla de usuarios guardando productos en su carrito (productos en el carrito)
CREATE TABLE carrito (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    producto_id INT REFERENCES productos(id) ON DELETE CASCADE,
    cantidad INT CHECK (cantidad > 0), -- Cantidad de cada producto en el carrito
    agregado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de cuando se agregó el producto al carrito
);

-- Tabla de productos favoritos
CREATE TABLE favoritos (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id) ON DELETE CASCADE,
    producto_id INT REFERENCES productos(id) ON DELETE CASCADE,
    agregado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha en la que se añadió a favoritos
);

/*
 * =========================
 * =========================
 * 	INSERCIÓN DE DATOS
 * =========================
 * =========================
 */

-- Inserción de usuarios
INSERT INTO usuarios (username, password, email, phone, website, about)
VALUES 
    ('fabian', MD5('12345'), 'fapalma1@espe.edu.ec', '123-456-7890', 'www.fabian.com', 'Enthusiastic sneaker collector.'),
    ('jhonson', MD5('12345'), 'jbmendoza@espe.edu.ec', '098-765-4321', 'www.jhonson.com', 'Passionate about streetwear and sneakers.');

-- Inserción de detalles del perfil del usuario
INSERT INTO perfiles (usuario_id, nombre_completo, telefono, foto_url, direccion, sobre, hobbies, website)
VALUES 
    (1, 'Fabián Palma', '123-456-7890', 'https://bootdey.com/img/Content/avatar/avatar7.png', '1234 Elm Street', 'Sneaker Enthusiast and Collector.', 'Sneaker collecting, streetwear fashion, basketball', 'www.johndoe.com'),
    (2, 'Jhonson Mendoza', '098-765-4321', 'https://bootdey.com/img/Content/avatar/avatar8.png', '5678 Oak Avenue', 'Streetwear aficionado and sneakerhead.', 'Fashion, Sneakers, Art', 'www.janedoe.com');

-- Inserción de badges
INSERT INTO badges (nombre) VALUES ('nike'), ('adidas'), ('jordan'), ('yeezy'), ('new balance');

-- Asignación de badges a usuarios
INSERT INTO usuarios_badges (usuario_id, badge_id)
VALUES 
    (1, 1), -- Usuario 1 tiene badge 'nike'
    (1, 2), -- Usuario 1 tiene badge 'adidas'
    (1, 3), -- Usuario 1 tiene badge 'jordan'
    (2, 4), -- Usuario 2 tiene badge 'yeezy'
    (2, 5); -- Usuario 2 tiene badge 'new balance'

-- Inserción de actividad reciente de usuarios
INSERT INTO actividad_reciente (usuario_id, descripcion)
VALUES 
    (1, 'John bought Air Jordan 1 just now'),
    (1, 'John reviewed Nike Dunk Low 10 minutes ago'),
    (1, 'John added Yeezy Boost 350 V2 to wishlist 30 minutes ago'),
    (2, 'Jane bought Adidas UltraBoost 5 minutes ago'),
    (2, 'Jane reviewed Yeezy Boost 350 V2 15 minutes ago');

-- Inserción de pedidos de los usuarios
INSERT INTO pedidos (usuario_id, fecha, estado, total)
VALUES 
    (1, '2023-01-15 10:00:00', 'Delivered', 150.00),
    (1, '2023-02-10 12:00:00', 'Pending', 200.00),
    (1, '2023-03-05 14:00:00', 'Cancelled', 250.00),
    (2, '2023-04-15 16:00:00', 'Delivered', 180.00),
    (2, '2023-05-10 18:00:00', 'Pending', 220.00);

-- Inserción de marcas
INSERT INTO marcas (nombre) VALUES ('Adidas'), ('Nike'), ('Puma'), ('Reebok'), ('Vans');

-- Inserción de categorías
INSERT INTO categorias (nombre) VALUES ('Deportivos'), ('Casuales'), ('Formales'), ('Botas');

-- Inserción de géneros
INSERT INTO generos (nombre) VALUES ('Hombres'), ('Mujeres'), ('Unisex');

-- Inserción de productos
INSERT INTO productos (titulo, descripcion, precio, precio_original, stock, marca_id, categoria_id, genero_id, imagen_url, calificacion)
VALUES 
    ('Deportivo Adidas', 'Zapatillas deportivas Adidas para correr.', 39.42, 49.99, 10, 1, 1, 1, 'https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png', 4),
    ('Casual Nike', 'Zapatillas casuales Nike para uso diario.', 31.93, 39.99, 15, 2, 2, 2, 'https://www.transparentpng.com/thumb/nike/aSEQ60-nike-transparent-image.png', 3),
    ('Formal Puma', 'Zapatos formales Puma para eventos especiales.', 49.44, 59.99, 8, 3, 3, 3, 'https://www.transparentpng.com/thumb/adidas/O86IC7-adidas-shoe-clipart-photo.png', 5),
    ('Bota Reebok', 'Botas Reebok para hombres, ideales para el invierno.', 45.99, 55.99, 12, 4, 4, 1, 'https://www.police.com.ec/wp-content/uploads/2023/10/Bota-3455.png', 4),
    ('Casual Vans', 'Zapatillas casuales Vans para mujeres.', 37.89, 47.99, 10, 5, 2, 2, 'https://resources.sears.com.mx/imgsplaza-sears/sears/?tp=p&id=795048&t=original&scale=500&qlty=75', 4),
    ('Deportivo Nike', 'Zapatillas deportivas Nike unisex para cualquier ocasión.', 52.30, 62.99, 7, 2, 1, 3, 'https://atleta.ec/4421/zapatos-nike-star-runner-3-gs-negro-da2776-001.jpg', 5);

-- Inserción de productos en pedidos
INSERT INTO pedidos_productos (pedido_id, producto_id, cantidad, precio)
VALUES 
    (1, 1, 2, 39.42), -- Pedido 1 incluye 2 unidades del producto 1 (Deportivo Adidas)
    (1, 4, 1, 45.99), -- Pedido 1 incluye 1 unidad del producto 4 (Bota Reebok)
    (2, 2, 1, 31.93), -- Pedido 2 incluye 1 unidad del producto 2 (Casual Nike)
    (2, 5, 2, 37.89), -- Pedido 2 incluye 2 unidades del producto 5 (Casual Vans)
    (3, 3, 1, 49.44), -- Pedido 3 incluye 1 unidad del producto 3 (Formal Puma)
    (4, 6, 1, 52.30); -- Pedido 4 incluye 1 unidad del producto 6 (Deportivo Nike)

-- Consulta para verificar productos con categorías, géneros y marcas
SELECT p.id, p.titulo, p.precio, p.precio_original, p.calificacion, p.imagen_url, c.nombre as categoria, g.nombre as genero, m.nombre as marca
FROM productos p
JOIN categorias c ON p.categoria_id = c.id
JOIN generos g ON p.genero_id = g.id
JOIN marcas m ON p.marca_id = m.id;

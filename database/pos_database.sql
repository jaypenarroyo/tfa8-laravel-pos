-- IT0049 TFA8 database export
-- MySQL-compatible copy of the schema and sample records used by the Laravel migrations and seeder.

CREATE DATABASE IF NOT EXISTS pos_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pos_database;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    avatar VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL
);

INSERT INTO customers (full_name, email, phone, created_at) VALUES
    ('Maria Santos', 'maria.santos@example.com', '0917-123-4567', '2026-10-09 12:00:00'),
    ('Juan Dela Cruz', 'juan.delacruz@example.com', '0918-234-5678', '2026-10-09 12:00:00'),
    ('Angela Reyes', 'angela.reyes@example.com', '0919-345-6789', '2026-10-09 12:00:00'),
    ('Carlo Mendoza', 'carlo.mendoza@example.com', '0920-456-7890', '2026-10-09 12:00:00'),
    ('Nicole Garcia', 'nicole.garcia@example.com', '0921-567-8901', '2026-10-09 12:00:00');

INSERT INTO users (username, full_name, email, password, created_at) VALUES
    ('admin', 'Andrea Lim', 'admin@example.com', '$2y$10$KhOJbcL71MfwjAH88zYo7uNh1lkoFqMPLDo340XffVqiEUL8phTdG', '2026-10-09 12:00:00'),
    ('cashier01', 'Paolo Cruz', 'cashier01@example.com', '$2y$10$KhOJbcL71MfwjAH88zYo7uNh1lkoFqMPLDo340XffVqiEUL8phTdG', '2026-10-09 12:00:00'),
    ('cashier02', 'Ella Ramos', 'cashier02@example.com', '$2y$10$KhOJbcL71MfwjAH88zYo7uNh1lkoFqMPLDo340XffVqiEUL8phTdG', '2026-10-09 12:00:00'),
    ('manager01', 'Miguel Torres', 'manager01@example.com', '$2y$10$KhOJbcL71MfwjAH88zYo7uNh1lkoFqMPLDo340XffVqiEUL8phTdG', '2026-10-09 12:00:00'),
    ('inventory01', 'Sofia Navarro', 'inventory01@example.com', '$2y$10$KhOJbcL71MfwjAH88zYo7uNh1lkoFqMPLDo340XffVqiEUL8phTdG', '2026-10-09 12:00:00');

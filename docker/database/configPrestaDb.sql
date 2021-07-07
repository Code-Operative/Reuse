CREATE DATABASE prestashop COLLATE utf8mb4_general_ci;

CREATE USER 'root'@'localhost' IDENTIFIED BY "root";
GRANT ALL PRIVILEGES ON prestashop.* TO 'root'@'localhost';

FLUSH PRIVILEGES;

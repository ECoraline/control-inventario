query para la base de datos:

CREATE DATABASE inv_poo;
USE inv_poo;

CREATE TABLE inventario (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    cantidad INT(11) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

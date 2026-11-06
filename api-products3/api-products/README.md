# API REST de Gestión de Usuarios (PHP Nativo + MVC)

Proyecto backend desarrollado como API RESTful para la gestión del recurso **Usuarios**, implementando un patrón MVC básico con PHP nativo y PDO.

## Requisitos previos
- XAMPP (Apache y MySQL activos).
- PHP 8.0 o superior.
- Postman o Thunder Client para probar los endpoints.

## 1. Configuración de la Base de Datos
1. Abre **phpMyAdmin** (`http://localhost/phpmyadmin/`).
2. Crea una nueva base de datos llamada **`usuarios`**.
3. Selecciona la base de datos y ejecuta el siguiente script SQL en la pestaña **SQL**:

```sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
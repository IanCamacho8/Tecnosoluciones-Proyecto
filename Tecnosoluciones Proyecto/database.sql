-- ============================================
-- BASE DE DATOS PARA SISTEMA DE GESTION DE PROYECTOS
-- TECNOSOLUCIONES S.A.
-- ============================================

CREATE DATABASE IF NOT EXISTS tecnosoluciones_db;
USE tecnosoluciones_db;

-- ============================================
-- TABLA: usuarios
-- ============================================
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLA: clientes
-- ============================================
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(20),
    direccion TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLA: proyectos
-- ============================================
CREATE TABLE IF NOT EXISTS proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_proyecto VARCHAR(150) NOT NULL,
    cliente_id INT NOT NULL,
    descripcion TEXT,
    estado ENUM('recibido', 'validado', 'en_preparacion', 'despachado', 'confirmado') DEFAULT 'recibido',
    fecha_inicio DATE,
    fecha_entrega DATE,
    monto DECIMAL(10,2),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

-- ============================================
-- USUARIO ADMIN POR DEFECTO
-- Contrasena: admin123
-- ============================================
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@tecnosoluciones.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- ============================================
-- DATOS DE EJEMPLO (CLIENTES)
-- ============================================
INSERT INTO clientes (nombre, email, telefono, direccion) VALUES
('Empresa Alpha', 'contacto@alpha.com', '987654321', 'Av. Siempre Viva 123'),
('Corporacion Beta', 'info@beta.com', '987654322', 'Calle Los Pinos 456'),
('Servicios Gamma', 'ventas@gamma.com', '987654323', 'Jr. Las Flores 789');

-- ============================================
-- DATOS DE EJEMPLO (PROYECTOS)
-- ============================================
INSERT INTO proyectos (nombre_proyecto, cliente_id, descripcion, estado, monto) VALUES
('Sistema de Ventas', 1, 'Desarrollo de sistema de ventas para tienda online', 'confirmado', 3500.00),
('App Movil Beta', 2, 'Aplicacion movil para atencion al cliente', 'en_preparacion', 5200.00),
('Pagina Web Corporativa', 3, 'Diseño y desarrollo de sitio web institucional', 'recibido', 1800.00);
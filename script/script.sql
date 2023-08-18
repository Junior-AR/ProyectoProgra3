CREATE DATABASE Tienda;

USE Tienda;

-- Tabla de Productos
CREATE TABLE Productos (
    ID_Producto INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Descripcion TEXT,
    Precio DECIMAL(10, 2),
    Cantidad INT
);

-- Tabla de Clientes
CREATE TABLE Clientes (
    ID_Cliente INT PRIMARY KEY AUTO_INCREMENT,
    NombreCompleto VARCHAR(255),
    Direccion VARCHAR(255),
    Telefono VARCHAR(20),
    CorreoElectronico VARCHAR(255)
);

-- Tabla de Proveedores
CREATE TABLE Proveedores (
    ID_Proveedor INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Contacto VARCHAR(255),
    Telefono VARCHAR(20),
    CorreoElectronico VARCHAR(255)
);

-- Tabla de Empleados
CREATE TABLE Empleados (
    ID_Empleado INT PRIMARY KEY AUTO_INCREMENT,
    NombreCompleto VARCHAR(255),
    Cargo VARCHAR(255),
    Salario DECIMAL(10, 2),
    FechaContratacion DATE
);

-- Tabla de Ventas
CREATE TABLE Ventas (
    ID_Venta INT PRIMARY KEY AUTO_INCREMENT,
    ID_Cliente INT,
    ID_Producto INT,
    FechaVenta DATE,
    Total DECIMAL(10, 2),
    FOREIGN KEY (ID_Cliente) REFERENCES Clientes(ID_Cliente),
    FOREIGN KEY (ID_Producto) REFERENCES Productos(ID_Producto)
);

-- Tabla de Pedidos
CREATE TABLE Pedidos (
    ID_Pedido INT PRIMARY KEY AUTO_INCREMENT,
    ID_Producto INT,
    ID_Proveedor INT,
    FechaPedido DATE,
    Estado VARCHAR(50),
    FOREIGN KEY (ID_Producto) REFERENCES Productos(ID_Producto),
    FOREIGN KEY (ID_Proveedor) REFERENCES Proveedores(ID_Proveedor)
);

-- Tabla de Facturas
CREATE TABLE Facturas (
    ID_Factura INT PRIMARY KEY AUTO_INCREMENT,
    ID_Venta INT,
    ID_Cliente INT, 
    ID_Producto INT, 
    FechaFactura DATE,
    MontoTotal DECIMAL(10, 2),
    FOREIGN KEY (ID_Venta) REFERENCES Ventas(ID_Venta),
    FOREIGN KEY (ID_Cliente) REFERENCES Clientes(ID_Cliente), 
    FOREIGN KEY (ID_Producto) REFERENCES Productos(ID_Producto) 
);

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    ID_Usuario INT PRIMARY KEY AUTO_INCREMENT,
    Usuario VARCHAR(50),
    Password VARCHAR(255)
);

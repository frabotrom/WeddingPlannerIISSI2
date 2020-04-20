ALTER SESSION SET nls_date_format = 'dd/mm/yyyy hh24:mi:ss';

DROP TABLE alergeno_cliente;
DROP TABLE alergeno_invitado;
DROP TABLE plato_alergeno;
DROP TABLE menu_plato;
DROP TABLE evento_menu;
DROP TABLE platos;
DROP TABLE menus;
DROP TABLE empresas;
DROP TABLE alergenos;
DROP TABLE invitados;
DROP TABLE eventos;
DROP TABLE proyectos;
DROP TABLE clientes;
DROP TABLE empleados;

CREATE TABLE empleados (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
dni CHAR(9) NOT NULL,
telefono CHAR(9) NOT NULL,
correo VARCHAR(50) NOT NULL,
usuario VARCHAR(50) NOT NULL,
contrasena VARCHAR(50),
es_administrador NUMBER(1)
);

CREATE TABLE clientes (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
dni CHAR(9) NOT NULL,
telefono CHAR(9) NOT NULL,
correo VARCHAR(50) NOT NULL,
direccion VARCHAR(100),
id_empleado NOT NULL,
--LLAVES
FOREIGN KEY (id_empleado) REFERENCES empleados);

CREATE TABLE proyectos (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
fecha_inicio DATE NOT NULL,
fecha_final DATE NOT NULL,
/*TIPOBODA ENUM:
1: Civil, 2: Católica
*/
tipo_boda INT NOT NULL,
presupuesto NUMBER(8,2) NOT NULL,
id_cliente INT NOT NULL,
--LLAVES
FOREIGN KEY (id_cliente) REFERENCES clientes,
--RESTRICCIONES
CONSTRAINT fechas_proyecto CHECK (fecha_inicio < fecha_final),
CONSTRAINT presupuesto_proyecto CHECK (presupuesto > 0));

CREATE TABLE eventos (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
lugar VARCHAR(50) NOT NULL,
direccion VARCHAR(100) NOT NULL,
fecha_inicio DATE NOT NULL,
fecha_final DATE NOT NULL,
precio NUMBER(8,2) NOT NULL,
id_proyecto INT NOT NULL,
--LLAVES
FOREIGN KEY (id_proyecto) REFERENCES proyectos,
--RESTRICCIONES
CONSTRAINT fechas_eventos CHECK (fecha_inicio < fecha_final),
CONSTRAINT precio_evento CHECK (precio > 0));

CREATE TABLE empresas (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
telefono CHAR(9) NOT NULL,
correo VARCHAR(50) NOT NULL,
direccion VARCHAR(100) NOT NULL);

CREATE TABLE menus (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
/*TIPOMENU ENUM:
1: Completo, 2: Vegetariano, 3: Vegano*/
tipo_menu INT NOT NULL,
nombre VARCHAR(30) NOT NULL,
id_empresa INT NOT NULL,
--LLAVES
FOREIGN KEY (id_empresa) REFERENCES empresas);

CREATE TABLE platos (
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
precio NUMBER(8,2) NOT NULL,
descripcion VARCHAR(150),
--RESTRICCIONES
CONSTRAINT precio_platos CHECK (precio > 0));

CREATE TABLE alergenos (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL);

CREATE TABLE invitados (
--COLUMNAS
id INT NOT NULL PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
direccion VARCHAR(100),
id_evento INT NOT NULL,
--LLAVES
FOREIGN KEY (id_evento) REFERENCES eventos);

CREATE TABLE evento_menu (
--COLUMNAS
id_evento INT NOT NULL,
id_menu INT NOT NULL,
cantidad INT,
--LLAVES
CONSTRAINT evento_menu_PK PRIMARY KEY (id_evento, id_menu),
FOREIGN KEY (id_evento) REFERENCES eventos,
FOREIGN KEY (id_menu) REFERENCES menus,
--RESTRICIONES
CONSTRAINT cantidad_menus CHECK (cantidad > 0));

CREATE TABLE menu_plato(
--COLUMNAS
id_menu INT NOT NULL,
id_plato INT NOT NULL,
--LLAVES
CONSTRAINT menu_plato_PK PRIMARY KEY (id_menu, id_plato),
FOREIGN KEY (id_menu) REFERENCES menus,
FOREIGN KEY (id_plato) REFERENCES platos);

CREATE TABLE plato_alergeno(
--COLUMNAS
id_plato INT NOT NULL,
id_alergeno INT NOT NULL,
--LLAVES
CONSTRAINT plato_alergeno_PK PRIMARY KEY (id_plato, id_alergeno),
FOREIGN KEY (id_plato) REFERENCES platos,
FOREIGN KEY (id_alergeno) REFERENCES alergenos);

CREATE TABLE alergeno_invitado(
--COLUMNAS
id_alergeno INT NOT NULL,
id_invitado INT NOT NULL,
--LLAVES
CONSTRAINT alergeno_invitado_PK PRIMARY KEY (id_alergeno, id_invitado),
FOREIGN KEY (id_alergeno) REFERENCES alergenos,
FOREIGN KEY (id_invitado) REFERENCES invitados);

CREATE TABLE alergeno_cliente(
--COLUMNAS
id_alergeno INT NOT NULL,
id_cliente INT NOT NULL,
--LLAVES
CONSTRAINT alergeno_cliente_PK PRIMARY KEY (id_alergeno, id_cliente),
FOREIGN KEY (id_alergeno) REFERENCES alergenos,
FOREIGN KEY (id_cliente) REFERENCES clientes);
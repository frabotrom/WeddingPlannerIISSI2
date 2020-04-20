/* Empleados */

CREATE OR REPLACE PROCEDURE MODIFICAR_EMPLEADO
(w_id IN empleados.id%TYPE,
 w_nombre IN empleados.nombre%TYPE,
 w_apellidos IN empleados.apellidos%TYPE,
 w_dni IN empleados.dni%TYPE,
 w_telefono IN empleados.telefono%TYPE,
 w_correo IN empleados.correo%TYPE,
 w_usuario IN empleados.usuario%TYPE,
 w_contrasena IN empleados.contrasena%TYPE,
 w_es_administrador IN empleados.es_administrador%TYPE) IS
BEGIN
  UPDATE empleados SET nombre=w_nombre, apellidos=w_apellidos, dni = w_dni,
  telefono=w_telefono, correo=w_correo, usuario=w_usuario, contrasena=w_contrasena,
  es_administrador=w_es_administrador WHERE id = w_id;
END;
/

CREATE OR REPLACE PROCEDURE CREAR_EMPLEADO
(w_nombre IN empleados.nombre%TYPE,
 w_apellidos IN empleados.apellidos%TYPE,
 w_dni IN empleados.dni%TYPE,
 w_telefono IN empleados.telefono%TYPE,
 w_correo IN empleados.correo%TYPE,
 w_usuario IN empleados.usuario%TYPE,
 w_contrasena IN empleados.contrasena%TYPE,
 w_es_administrador IN empleados.es_administrador%TYPE) IS
BEGIN
  INSERT INTO empleados (nombre, apellidos, dni, telefono, correo, usuario, contrasena, es_administrador)
VALUES (w_nombre, w_apellidos, w_dni, w_telefono, w_correo, w_usuario, w_contrasena, w_es_administrador); 
END;
/

CREATE OR REPLACE PROCEDURE ELIMINAR_EMPLEADO
(w_id IN empleados.id%TYPE) IS
BEGIN
  DELETE FROM empleados WHERE id=w_id;
END;
/

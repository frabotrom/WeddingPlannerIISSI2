<?php
session_start();

if(isset($_SESSION["empleado"]))
    $empleado = $_SESSION["empleado"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Wedding Planner</title>
</head>

<body>

    <main>

        <form method="post" action="guardarEmpleado.php">

            <input id="ID" type="hidden" name="ID"
                   value="<?php echo isset($empleado) ? $empleado["ID"] : ""?>"/>

            Nombre: <input required id="NOMBRE" type="text" name="NOMBRE"
                   value="<?php echo isset($empleado) ? $empleado["NOMBRE"] : ""?>"/>
            <br>
            Apellidos: <input required id="APELLIDOS" type="text" name="APELLIDOS"
                           value="<?php echo isset($empleado) ? $empleado["APELLIDOS"] : ""?>"/>
            <br>
            DNI: <input required id="DNI" type="text" name="DNI" pattern="(\d{8})([A-Z]{1})" placeholder="12345678A"
                              value="<?php echo isset($empleado) ? $empleado["DNI"] : ""?>"/>
            <br>
            Teléfono: <input required id="TELEFONO" type="text" name="TELEFONO" placeholder="123456789"
                        value="<?php echo isset($empleado) ? $empleado["TELEFONO"] : ""?>"/>
            <br>
            Correo: <input required id="CORREO" type="email" name="CORREO" placeholder="ejemplo@dominio.es"
                             value="<?php echo isset($empleado) ? $empleado["CORREO"] : ""?>"/>
            <br>
            Usuario: <input required id="USUARIO" type="text" name="USUARIO"
                             value="<?php echo isset($empleado) ? $empleado["USUARIO"] : ""?>"/>
            <br>
            Contraseña: <input required id="CONTRASENA" type="password" name="CONTRASENA"
                             value="<?php echo isset($empleado) ? $empleado["CONTRASENA"] : ""?>"/>
            <br>
            Vuelva a introducir la contraseña: <input required id="CONTRASENA2" type="password" name="CONTRASENA2"
                               value="<?php echo isset($empleado) ? $empleado["CONTRASENA"] : ""?>"/>
            <br>
            <button id="guardar" name="guardar" type="submit" class="guardarEmpleado">Guardar</button>
            <button id="cancelar" name="cancelar" type="submit" formnovalidate class="cancelar">Cancelar</button>
        </form>

    </main>

</body>
</html>

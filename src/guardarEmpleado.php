<?php
session_start();

include_once("gestionBD.php");
if(isset($_REQUEST["guardar"])) {

    $conexion = crearConexionBD();

    $empleado["ID"] = $_REQUEST["ID"];
    $empleado["NOMBRE"] = $_REQUEST["NOMBRE"];
    $empleado["APELLIDOS"] = $_REQUEST["APELLIDOS"];
    $empleado["DNI"] = $_REQUEST["DNI"];
    $empleado["TELEFONO"] = $_REQUEST["TELEFONO"];
    $empleado["CORREO"] = $_REQUEST["CORREO"];
    $empleado["USUARIO"] = $_REQUEST["USUARIO"];
    $empleado["CONTRASENA"] = $_REQUEST["CONTRASENA"];

    try {
        //Editar empleado
        if (isset($_SESSION["empleado"])) {

            $query = "CALL MODIFICAR_EMPLEADO(:id,:nombre,:apellidos,:dni,:telefono,:correo,:usuario,:contrasena,0)";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $empleado["ID"]);
            $stmt->bindParam(':nombre', $empleado["NOMBRE"]);
            $stmt->bindParam(':apellidos', $empleado["APELLIDOS"]);
            $stmt->bindParam(':dni', $empleado["DNI"]);
            $stmt->bindParam(':telefono', $empleado["TELEFONO"]);
            $stmt->bindParam(':correo', $empleado["CORREO"]);
            $stmt->bindParam(':usuario', $empleado["USUARIO"]);
            $stmt->bindParam(':contrasena', $empleado["CONTRASENA"]);
            $stmt->execute();

            //Guardar nuevo empleado
        } else {

            $query = "CALL CREAR_EMPLEADO(:nombre, :apellidos, :dni, :telefono, :correo, :usuario, :contrasena, 0)";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $empleado["NOMBRE"]);
            $stmt->bindParam(':apellidos', $empleado["APELLIDOS"]);
            $stmt->bindParam(':dni', $empleado["DNI"]);
            $stmt->bindParam(':telefono', $empleado["TELEFONO"]);
            $stmt->bindParam(':correo', $empleado["CORREO"]);
            $stmt->bindParam(':usuario', $empleado["USUARIO"]);
            $stmt->bindParam(':contrasena', $empleado["CONTRASENA"]);
            $stmt->execute();
        }

    } catch (PDOException $e) {
        $_SESSION["excepcion"] = $e->GetMessage();

        //TODO: Crear página de error
        $_SESSION['excepcion'] = $e->GetMessage();
//        header("Location: error.php");
    }

    unset($_SESSION["empleado"]);
    cerrarConexionBD($conexion);

}
Header("Location: listEmpleado.php");
?>
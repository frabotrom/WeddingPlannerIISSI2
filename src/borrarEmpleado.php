<?php
session_start();

include_once("gestionBD.php");
if (isset($_SESSION["idEmpleado"])) {
    try {
        $conexion = crearConexionBD();

        $query = "CALL ELIMINAR_EMPLEADO(:id)";

        $stmt = $conexion->prepare($query);
        $stmt->bindParam(":id", $_SESSION["idEmpleado"]);
        $stmt->execute();
    } catch (PDOException $e){
        $_SESSION["excepcion"] = $e->getMessage();
        //Header("Location: error.php");
    }

    unset($_SESSION["idEmpleado"]);
    cerrarConexionBD($conexion);
}

Header("Location: listEmpleado.php");
?>

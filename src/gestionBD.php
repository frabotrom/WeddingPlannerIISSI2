<?php

function crearConexionBD()
{
    $host="oci:WeddingPlannerSimplified=localhost/XE;charset=UTF8";
    $usuario="WEDDINGPLANNER";
    $password="IISSI2";

    try{
        //Mantiene la conexión abierta
        $conexion=new PDO($host,$usuario,$password,array(PDO::ATTR_PERSISTENT => true));

        //Permite el tratamiento de excepciones
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }catch(PDOException $e) {
        $_SESSION['excepcion'] = $e->GetMessage();
        //header("Location: error.php");
    }
}

function cerrarConexionBD($conexion){
    $conexion=null;
}
?>
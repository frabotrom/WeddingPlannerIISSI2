<?php
session_start();

class utilidades {

    //Constantes
    const host = "oci:WeddingPlannerSimplified=localhost/XE";
    const username = "DIEGOCRESPO";
    const password = "IISSI2";


    //Métodos
    public static function getConexionBBDD() {
        try {
            $conexion = new PDO(self::host, self::username, self::password, array(PDO::ATTR_PERSISTENT => true));
            $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: ", $e->getMessage();
        }
    }
}
?>
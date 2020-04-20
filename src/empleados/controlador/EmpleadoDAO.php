<?php
session_start();

include_once("Utilidades.php");
include_once("empleados/modelo/Empleado.php");

class EmpleadoDAO {

    //Atributos
    private $conexion;
    private $nombre;
    private $apellidos;
    private $dni;
    private $telefono;
    private $correo;
    private $usuario;
    private $contrasena;
    private $esAdministrador;

    //Métodos
    public function __construct() {
        $this->conexion = Utilidades::getConexionBBDD();
    }

    public function cargarDatos(Empleado $empleado) {
        $this->nombre = $empleado->getNombre();
        $this->apellidos = $empleado->getApellidos();
        $this->dni = $empleado->getDni();
        $this->telefono = $empleado->getTelefono();
        $this->correo = $empleado->getCorreo();
        $this->usuario = $empleado->getUsuario();
        $this->contrasena = $empleado->getContrasena();
        $this->esAdministrador= $empleado->getEsAdministrador();
    }

    public function getListado() {
        try {
            return $this->conexion->query(
                "SELECT * FROM empleados;");
        } catch (PDOException $e) {
            echo "Error de conexión: ", $e->getMessage();
        }
    }

    public function getEmpleadoPorId($id) {
        try {
            $query = $this->conexion->prepare(
                "SELECT * FROM empleados WHERE id = :id;");
            $query->bindParam(":id", $id);
            $query->execute();
        } catch (PDOException $e) {
            echo "Error de conexión: ", $e->getMessage();
        }
    }

    public function insertEmpleado(Empleado $empleado) {
        try {
            $query = $this->conexion->prepare(
                "INSERT INTO empleados (nombre, apellidos, dni, telefono, correo, usuario, contrasena, es_administrador)
                    VALUES (:nombre, :apellidos, :dni, :telefono, :correo, :usuario, :contrasena, :es_administrador)");

            $this->cargarDatos($empleado);
            $query->bindParam(":nombre", $this->nombre);
            $query->bindParam(":apellidos", $this->apellidos);
            $query->bindParam(":dni", $this->dni);
            $query->bindParam(":telefono", $this->telefono);
            $query->bindParam(":correo", $this->correo);
            $query->bindParam(":usuario", $this->usuario);
            $query->bindParam(":contrasena", $this->contrasena);
            $query->bindParam(":es_administrador", $this->esAdministrador);
            $query->execute();
        } catch (PDOException $e) {
            echo "Error de conexión: ", $e->getMessage();
        }
    }

    public function deleteEmpleado($id) {
        try {
            $query = $this->conexion->prepare(
                "DELETE FROM empleados WHERE id = :id;");
            $query->bindParam(":id", $id);
            $query->execute();
        } catch (PDOException $e) {
            echo "Error de conexión: ", $e->getMessage();
        }
    }
}
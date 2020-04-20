<?php
session_start();

class Empleado {

    //Atributos
    private $id;
    private $nombre;
    private $apellidos;
    private $dni;
    private $telefono;
    private $correo;
    private $usuario;
    private $contrasena;
    private $esAdministrador;

    //Métodos
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getContrasena(){
        return $this->contrasena;
    }

    public function setContrasena($contrasena){
        $this->contrasena = $contrasena;
    }

    public function getEsAdministrador(){
        return $this->esAdministrador;
    }

    public function setEsAdministrador($esAdministrador){
        $this->esAdministrador = $esAdministrador;
    }

}
?>
<?php
session_start();

if (isset($_REQUEST["editar"])) {
    $empleado["ID"] = $_REQUEST["ID"];
    $empleado["NOMBRE"] = $_REQUEST["NOMBRE"];
    $empleado["APELLIDOS"] = $_REQUEST["APELLIDOS"];
    $empleado["DNI"] = $_REQUEST["DNI"];
    $empleado["TELEFONO"] = $_REQUEST["TELEFONO"];
    $empleado["CORREO"] = $_REQUEST["CORREO"];
    $empleado["USUARIO"] = $_REQUEST["USUARIO"];
    $empleado["CONTRASENA"] = $_REQUEST["CONTRASENA"];
    $empleado["USUARIO"] = $_REQUEST["USUARIO"];
    $empleado["USUARIO"] = $_REQUEST["USUARIO"];

    $_SESSION["empleado"] = $empleado;

    Header("Location: formEmpleado.php");
} elseif (isset($_REQUEST["borrar"])) {
    $_SESSION["idEmpleado"] = $_REQUEST["ID"];
    Header("Location: borrarEmpleado.php");
} elseif (isset($_REQUEST["crear"])) {
    Header("Location: formEmpleado.php");
} else {
    Header("Location: listEmpleado.php");
}
?>
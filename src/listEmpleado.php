<?php
session_start();

include_once("gestionBD.php");
include_once("gestionPaginacion.php");

unset($_SESSION["empleado"]);

//Comprobamos si accedemos por primera vez o se debe a un cambio en la paginación
if (isset($_SESSION["paginacion"])) {
    $paginacion = $_SESSION["paginacion"];
}

$pagSeleccionada = isset($_GET["numPagina"]) ? (int)$_GET["numPagina"] : (isset($paginacion) ? (int)$paginacion["numPagina"] : 1);
$tamPagina = isset($_GET["tamPagina"]) ? (int)$_GET["tamPagina"] : (isset($paginacion) ? (int)$paginacion["tamPagina"] : 5);

if ($pagSeleccionada < 1)
    $pagSeleccionada = 1;
if ($tamPagina < 1)
    $tamPagina = 5;

//Borrar los datos de sesión respecto la paginación para evitar confusión
unset($_SESSION["paginacion"]);

//Se crea la conexión a la BD
$conexion = crearConexionBD();

// Petición a la BD
$query = 'SELECT * FROM empleados ORDER BY id DESC';

$totalEmpleados = totalConsulta($conexion, $query);
$totalPaginas = (int)($totalEmpleados / $tamPagina);

if ($totalEmpleados % $tamPagina > 0)
    $totalPaginas++;
if ($pagSeleccionada > $totalPaginas)
    $pagSeleccionada = $totalPaginas;

//Se genera la nueva sesión para la paginación
$paginacion["numPagina"] = $pagSeleccionada;
$paginacion["tamPagina"] = $tamPagina;

$listEmpleados = consultaPaginada($conexion, $query, $pagSeleccionada, $tamPagina);

cerrarConexionBD($conexion);
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
    <form method="post" action="controladorEmpleado.php" style="display: flex">
    <h3>Empleados</h3>
    <button id="crear" name="crear" type="submit" class="crearFila">
                            <img src="../images/suma.png" class="crearFila" alt="Crear empleado" width="25"
                                 height="25">
                        </button>
    </form>

    <nav>

        <div id="paginacion">

            <?php

            for ($pagina = 1; $pagina <= $totalPaginas; $pagina++)

                if ($pagina == $pagSeleccionada) { ?>

                    <span class="current"><?php echo $pagina; ?></span>

                <?php } else { ?>

                    <a href="listEmpleado.php?numPagina=<?php echo $pagina; ?>&tamPagina=<?php echo $tamPagina; ?>"><?php echo $pagina; ?></a>

                <?php } ?>

        </div>


        <form method="get" action="controladorEmpleado.php">

            <input id="numPagina" name="numPagina" type="hidden" value="<?php echo $pagSeleccionada ?>"/>

            Mostrando

            <input id="tamPagina" name="tamPagina" type="number"

                   min="1" max="<?php echo $totalEmpleados; ?>"

                   value="<?php echo $totalEmpleados < 5 ? $totalEmpleados : $tamPagina ?>" autofocus="autofocus"/>

            entradas de <?php echo $totalEmpleados ?>

            <input type="submit" value="Cambiar">

        </form>

    </nav>

    <table width="100%">

        <tr>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Correo</th>
        </tr>

        <?php

        foreach ($listEmpleados as $empleado) {

            ?>
            <tr>
                <td><?php echo $empleado["NOMBRE"] . " " . $empleado["APELLIDOS"] ?></td>
                <td><?php echo $empleado["DNI"] ?></td>
                <td><?php echo $empleado["TELEFONO"] ?></td>
                <td><?php echo $empleado["CORREO"] ?></td>

                <td>
                    <form method="post" action="controladorEmpleado.php">

                        <input id="ID" name="ID" type="hidden"
                               value="<?php echo $empleado["ID"] ?>">

                        <input id="NOMBRE" name="NOMBRE" type="hidden"
                               value="<?php echo $empleado["NOMBRE"] ?>">

                        <input id="APELLIDOS" name="APELLIDOS" type="hidden"
                               value="<?php echo $empleado["APELLIDOS"] ?>">

                        <input id="DNI" name="DNI" type="hidden"
                               value="<?php echo $empleado["DNI"] ?>">

                        <input id="TELEFONO" name="TELEFONO" type="hidden"
                               value="<?php echo $empleado["TELEFONO"] ?>">

                        <input id="CORREO" name="CORREO" type="hidden"
                               value="<?php echo $empleado["CORREO"] ?>">

                        <input id="USUARIO" name="USUARIO" type="hidden"
                               value="<?php echo $empleado["USUARIO"] ?>">

                        <input id="CONTRASENA" name="CONTRASENA" type="hidden"
                               value="<?php echo $empleado["CONTRASENA"] ?>">

                        <input id="ES_ADMINISTRADOR" name="ES_ADMINISTRADOR" type="hidden"
                               value="<?php echo $empleado["ES_ADMINISTRADOR"] ?>">

                        <button id="editar" name="editar" type="submit" class="editarFila">
                            <img src="../images/lapiz.png" class="editarFila" alt="Editar empleado" width="25"
                                 height="25">
                        </button>

                        <button id="borrar" name="borrar" type="submit" class="borrarFila">
                            <img src="../images/papelera.png" class="borrarFila" alt="Borrar empleado" width="25"
                                 height="25">
                        </button>

                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</main>
</body>
</html>

<?php

session_start();

require_once __DIR__ . "/../modelo/ConectorPDO.php";
require_once __DIR__ . "/../modelo/AccesoDatosUsuario.php";
require_once __DIR__ . "/../modelo/Login.php";

$cedulaIngresada = $_POST["cedula"];
$claveIngresada = $_POST["password"];

$conectorPDO = new ConectorPDO("localhost", "root", "", "sgrsi");
$conexion = $conectorPDO->establecerConexion();

$accesoDatosUsuario = new AccesoDatosUsuario($conexion);
$login = new Login($accesoDatosUsuario);

$usuario = $login->autenticar($cedulaIngresada, $claveIngresada);
$conectorPDO->desconectar();

if ($usuario === null) {
    $motivo = $login->getUltimoError();

    if ($motivo === "inactivo") {
        header("Location: login.php?error=2");
    } elseif ($motivo === "sinRoles") {
        header("Location: login.php?error=3");
    } else {
        header("Location: login.php?error=1"); // credenciales incorrectas
    }
    exit;
}

$_SESSION["cedula"] = $usuario->getCedula();
$_SESSION["administrativo"] = $usuario->esAdministrativo();
$_SESSION["tecnico"] = $usuario->esTecnico();
$_SESSION["docente"] = $usuario->esDocente();
$_SESSION["direccion"] = $usuario->esDireccion();
$_SESSION["estudiante"] = $usuario->esEstudiante();

if ($usuario->esAdministrativo()) {
    header("Location: administrador.php");
} elseif ($usuario->esTecnico()) {
    header("Location: tecnico.php");
} elseif ($usuario->esDocente()) {
    header("Location: docente.php");
} elseif ($usuario->esDireccion()) {
    header("Location: direccion.php");
} elseif ($usuario->esEstudiante()) {
    header("Location: estudiante.php");
} else {
    header("Location: login.php?error=1");
}
exit;

?>
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
    header("Location: login.php?error=1");
    exit;
}

$_SESSION["cedula"] = $usuario->getCedula();
$_SESSION["administrativo"] = $usuario->esAdministrativo();
$_SESSION["tecnico"] = $usuario->esTecnico();
$_SESSION["docente"] = $usuario->esDocente();
$_SESSION["direccion"] = $usuario->esDireccion();
$_SESSION["estudiante"] = $usuario->esEstudiante();

if ($usuario->esAdministrativo()) {
    header("Location: administrativo.html");
} elseif ($usuario->esTecnico()) {
    header("Location: tecnico.html");
} elseif ($usuario->esDocente()) {
    header("Location: docente.html");
} elseif ($usuario->esDireccion()) {
    header("Location: direccion.html");
} elseif ($usuario->esEstudiante()) {
    header("Location: estudiante.html");
} else {
    header("Location: login.php?error=1");
}
exit;

?>
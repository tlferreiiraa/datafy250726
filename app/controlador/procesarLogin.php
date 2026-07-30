<?php
require_once __DIR__ . "/../modelo/Usuarios.php";

$cedulaIngresada = $_POST["cedula"];
$claveIngresada = $_POST["password"];

$usuarios = obtenerUsuarios();

$rolEncontrado = null;

if ($cedulaIngresada === $usuarios[0]["cedula"] && $claveIngresada === $usuarios[0]["clave"]) {
    $rolEncontrado = $usuarios[0]["rol"];
} elseif ($cedulaIngresada === $usuarios[1]["cedula"] && $claveIngresada === $usuarios[1]["clave"]) {
    $rolEncontrado = $usuarios[1]["rol"];
} elseif ($cedulaIngresada === $usuarios[2]["cedula"] && $claveIngresada === $usuarios[2]["clave"]) {
    $rolEncontrado = $usuarios[2]["rol"];
} elseif ($cedulaIngresada === $usuarios[3]["cedula"] && $claveIngresada === $usuarios[3]["clave"]) {
    $rolEncontrado = $usuarios[3]["rol"];
}

if ($rolEncontrado === "docente") {
    header("Location: docente.html");
} elseif ($rolEncontrado === "administrativo") {
    header("Location: administrador.html");
} elseif ($rolEncontrado === "tecnico") {
    header("Location: tecnico.html");
} elseif ($rolEncontrado === "direccion") {
    header("Location: direccion.html");
} else {
    header("Location: login.php?error=1");
}
exit;
?>
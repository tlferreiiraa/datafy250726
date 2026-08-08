<?php

require_once __DIR__ . "/AccesoDatosUsuario.php";

class Login {

    private AccesoDatosUsuario $accesoDatosUsuario;
    private string $ultimoError = ""; // Guarda el motivo del último fallo

    public function __construct(AccesoDatosUsuario $accesoDatosUsuario) {
        $this->accesoDatosUsuario = $accesoDatosUsuario;
    }

    public function autenticar(string $cedula, string $clave): ?Usuario {
        $usuario = $this->accesoDatosUsuario->buscarUsuario($cedula);

        if ($usuario === null) {
            $this->ultimoError = "credenciales";
            return null;
        }

        if ($usuario->getEstado() === false) {
            $this->ultimoError = "inactivo";
            return null;
        }

        if (!password_verify($clave, $usuario->getContrasenaHash())) {
            $this->ultimoError = "credenciales";
            return null;
        }

        if (
            !$usuario->esAdministrativo() &&
            !$usuario->esTecnico() &&
            !$usuario->esDocente() &&
            !$usuario->esDireccion() &&
            !$usuario->esEstudiante()
        ) {
            $this->ultimoError = "sinRoles";
            return null;
        }

        return $usuario;
    }

    public function getUltimoError(): string {
        return $this->ultimoError;
    }
}

?>
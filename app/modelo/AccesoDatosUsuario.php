<?php

require_once __DIR__ . "/Usuario.php";

class AccesoDatosUsuario {

    private PDO $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    public function buscarUsuario(string $cedula): ?Usuario {
        $sql = "
            SELECT
                u.Cedula,
                u.Contrasena,
                u.Estado,

                CASE WHEN d.Cedula IS NOT NULL THEN TRUE ELSE FALSE END AS docente,
                CASE WHEN a.Cedula IS NOT NULL THEN TRUE ELSE FALSE END AS administrativo,
                CASE WHEN t.Cedula IS NOT NULL THEN TRUE ELSE FALSE END AS tecnico,
                CASE WHEN dir.Cedula IS NOT NULL THEN TRUE ELSE FALSE END AS direccion,
                CASE WHEN e.Cedula IS NOT NULL THEN TRUE ELSE FALSE END AS estudiante

            FROM USUARIO AS u
                LEFT JOIN DOCENTE AS d ON d.Cedula = u.Cedula
                LEFT JOIN ADMINISTRATIVO AS a ON a.Cedula = u.Cedula
                LEFT JOIN TECNICO AS t ON t.Cedula = u.Cedula
                LEFT JOIN DIRECCION AS dir ON dir.Cedula = u.Cedula
                LEFT JOIN ESTUDIANTE AS e ON e.Cedula = u.Cedula

            WHERE u.Cedula = :cedula
        ";

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute(["cedula" => $cedula]);

        $fila = $consulta->fetch(PDO::FETCH_ASSOC);

        $consulta = null; 

        if ($fila === false) {
            return null; 
        }

        return new Usuario(
            $fila["Cedula"],
            $fila["Contrasena"],
     (bool) $fila["Estado"],
     (bool) $fila["docente"],
     (bool) $fila["administrativo"],
     (bool) $fila["tecnico"],
     (bool) $fila["direccion"],
     (bool) $fila["estudiante"]
    );
}
}
?>
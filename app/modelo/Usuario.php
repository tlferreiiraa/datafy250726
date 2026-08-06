<?php
class Usuario {

    private string $cedula;
    private string $contrasenaHash;
    private bool $estado;
    private bool $docente;
    private bool $administrativo;
    private bool $tecnico;
    private bool $direccion;
    private bool $estudiante;

    public function __construct(
        string $cedula,
        string $contrasenaHash,
        bool $estado,
        bool $docente,
        bool $administrativo,
        bool $tecnico,
        bool $direccion,
        bool $estudiante
    ) {
        $this->cedula = $cedula;
        $this->contrasenaHash = $contrasenaHash;
        $this->estado = $estado;
        $this->docente = $docente;
        $this->administrativo = $administrativo;
        $this->tecnico = $tecnico;
        $this->direccion = $direccion;
        $this->estudiante = $estudiante;
    }
    public function getCedula(): string {
        return $this->cedula;
    }
    public function getContrasenaHash(): string {
        return $this->contrasenaHash;
    }
    public function getEstado(): bool {
        return $this->estado;
    }
    public function esDocente(): bool {
        return $this->docente;
    }    
    public function esAdministrativo(): bool {
        return $this->administrativo;
    }    
    public function esTecnico(): bool {
        return $this->tecnico;
    }
    public function esDireccion(): bool {
        return $this->direccion;
    }
    public function esEstudiante(): bool {
        return $this->estudiante;
    }
}
?>
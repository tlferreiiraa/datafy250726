<?php

class ConectorPDO {

    private string $servidor;
    private string $usuario;
    private string $clave;
    private string $baseDeDatos;
    private ?PDO $conexion;  
    public function __construct(string $servidor, string $usuario, string $clave, string $baseDeDatos) {
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->baseDeDatos = $baseDeDatos;
        $this->conexion = null;  
    }
    public function establecerConexion(): PDO {
        try {
            $this->conexion = new PDO(
                "mysql:host=$this->servidor;dbname=$this->baseDeDatos",
                $this->usuario,
                $this->clave
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Error al conectar con la base de datos: " . $error->getMessage();
        }
        return $this->conexion;
    }
    public function desconectar(): void {
        $this->conexion = null;
    }
}

?>
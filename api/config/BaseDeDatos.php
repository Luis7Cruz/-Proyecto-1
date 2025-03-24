<?php
class BaseDeDatos {
    private $servidor = "localhost";
    private $nombre_bd = "tienda_online";
    private $usuario = "root";
    private $contrasena = "";
    public $conexion;

    public function obtenerConexion() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->nombre_bd, $this->usuario, $this->contrasena);
            $this->conexion->exec("set names utf8");
        } catch(PDOException $excepcion) {
            echo "Error de conexión: " . $excepcion->getMessage();
        }
        return $this->conexion;
    }
}
?>
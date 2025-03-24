<?php
class UsuarioModelo {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registrar($nombre_usuario, $contrasena, $email) {
        $consulta = "INSERT INTO usuarios (nombre_usuario, contrasena, email) VALUES (:nombre_usuario, :contrasena, :email)";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":nombre_usuario", $nombre_usuario);
        $stmt->bindParam(":contrasena", password_hash($contrasena, PASSWORD_BCRYPT));
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }

    public function autenticar($nombre_usuario, $contrasena) {
        $consulta = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":nombre_usuario", $nombre_usuario);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
        return false;
    }
}
?>
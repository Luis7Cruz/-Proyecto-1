<?php
class UsuarioControlador {
    private $usuarioModelo;

    public function __construct($db) {
        $this->usuarioModelo = new UsuarioModelo($db);
    }

    public function registrar() {
        $datos = json_decode(file_get_contents("php://input"));
        if ($this->usuarioModelo->registrar($datos->nombre_usuario, $datos->contrasena, $datos->email)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Usuario registrado con éxito"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al registrar usuario"]);
        }
    }

    public function iniciarSesion() {
        $datos = json_decode(file_get_contents("php://input"));
        $usuario = $this->usuarioModelo->autenticar($datos->nombre_usuario, $datos->contrasena);
        if ($usuario) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Inicio de sesión exitoso", "usuario" => $usuario]);
        } else {
            http_response_code(401);
            echo json_encode(["mensaje" => "Credenciales inválidas"]);
        }
    }
}
?>
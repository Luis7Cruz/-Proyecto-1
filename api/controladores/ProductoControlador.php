<?php
class ProductoControlador {
    private $productoModelo;

    public function __construct($db) {
        $this->productoModelo = new ProductoModelo($db);
    }

    public function crear() {
        $datos = json_decode(file_get_contents("php://input"));
        if ($this->productoModelo->crear($datos->nombre, $datos->descripcion, $datos->precio, $datos->stock)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Producto creado"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al crear producto"]);
        }
    }

    public function obtenerTodos() {
        $productos = $this->productoModelo->obtenerTodos();
        http_response_code(200);
        echo json_encode($productos);
    }

    public function obtenerPorId($id) {
        $producto = $this->productoModelo->obtenerPorId($id);
        if ($producto) {
            http_response_code(200);
            echo json_encode($producto);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Producto no encontrado"]);
        }
    }

    public function actualizar($id) {
        $datos = json_decode(file_get_contents("php://input"));
        if ($this->productoModelo->actualizar($id, $datos->nombre, $datos->descripcion, $datos->precio, $datos->stock)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Producto actualizado"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al actualizar"]);
        }
    }

    public function eliminar($id) {
        if ($this->productoModelo->eliminar($id)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Producto eliminado"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al eliminar"]);
        }
    }
}
?>
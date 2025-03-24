<?php
class ProductoModelo {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function crear($nombre, $descripcion, $precio, $stock) {
        $consulta = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (:nombre, :descripcion, :precio, :stock)";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock);
        return $stmt->execute();
    }

    public function obtenerTodos() {
        $consulta = "SELECT * FROM productos";
        $stmt = $this->db->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $consulta = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $stock) {
        $consulta = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $consulta = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
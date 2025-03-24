<?php
require_once __DIR__ . '/../config/BaseDeDatos.php';
require_once __DIR__ . '/../modelos/UsuarioModelo.php';
require_once __DIR__ . '/../modelos/ProductoModelo.php';
require_once __DIR__ . '/../controladores/UsuarioControlador.php';
require_once __DIR__ . '/../controladores/ProductoControlador.php';

$db = (new BaseDeDatos())->obtenerConexion();
$usuarioControlador = new UsuarioControlador($db);
$productoControlador = new ProductoControlador($db);

$metodo = $_SERVER["REQUEST_METHOD"];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Endpoints para usuarios
if ($uri[2] === 'usuarios') {
    if ($metodo === 'POST' && $uri[3] === 'registrar') {
        $usuarioControlador->registrar();
    } elseif ($metodo === 'POST' && $uri[3] === 'login') {
        $usuarioControlador->iniciarSesion();
    }
}

// Endpoints para productos
if ($uri[2] === 'productos') {
    if ($metodo === 'GET' && empty($uri[3])) {
        $productoControlador->obtenerTodos();
    } elseif ($metodo === 'GET' && is_numeric($uri[3])) {
        $productoControlador->obtenerPorId($uri[3]);
    } elseif ($metodo === 'POST' && empty($uri[3])) {
        $productoControlador->crear();
    } elseif ($metodo === 'PUT' && is_numeric($uri[3])) {
        $productoControlador->actualizar($uri[3]);
    } elseif ($metodo === 'DELETE' && is_numeric($uri[3])) {
        $productoControlador->eliminar($uri[3]);
    }
}
?>
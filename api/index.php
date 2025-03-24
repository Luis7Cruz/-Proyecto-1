<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Captura la URL solicitada
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];
$url = parse_url($request_uri, PHP_URL_PATH);

// Elimina la parte de /api/ si existe
$url = str_replace(dirname($script_name), '', $url);
$url = ltrim($url, '/');

// Incluye el archivo de rutas
require_once __DIR__ . '/rutas/api.php';
?>
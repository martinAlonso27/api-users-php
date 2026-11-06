<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../src/config/Database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

try {
    $db = Database::connect();
    $controller = new UserController($db);

    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($path === '/api/users') {
        if ($method === 'GET') { $controller->index(); exit; }
        if ($method === 'POST') { $controller->store(); exit; }
    }

    if (preg_match('#^/api/users/([1-9][0-9]*)$#', $path, $matches)) {
        $id = (int) $matches[1];
        if ($method === 'GET') { $controller->show($id); exit; }
        if ($method === 'PUT') { $controller->update($id); exit; }
        if ($method === 'DELETE') { $controller->destroy($id); exit; }
    }

    http_response_code(404);
    echo json_encode(['error' => 'Endpoint no encontrado']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
}
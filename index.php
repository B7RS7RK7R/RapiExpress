<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

ob_start();
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use RapiExpress\Controllers\FrontController;
use RapiExpress\Helpers\Lang;

require_once __DIR__ . '/src/helpers/lang.php';

Lang::init();

$c = preg_replace('/[^a-z]/', '', strtolower($_GET['c'] ?? 'auth'));
$a = preg_replace('/[^a-zA-Z]/', '', ($_GET['a'] ?? 'login'));

try {
    $frontController = new FrontController();
    $frontController->handle($c, $a);
} catch (\Exception $e) {
    ob_clean();
    http_response_code(500);
    echo "<h1>Error del Sistema</h1>";
    echo "<p>Ha ocurrido un error. Por favor, contacte al administrador.</p>";
    error_log("Error fatal: " . $e->getMessage() . " en " . $e->getFile() . ":" . $e->getLine());
}

ob_end_flush();
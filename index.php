<?php


declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $dossiers = ['core', 'models', 'controllers'];
    foreach ($dossiers as $dossier) {
        $fichier = __DIR__ . "/{$dossier}/{$class}.php";
        if (is_file($fichier)) {
            require_once $fichier;
            return;
        }
    }
});

require_once __DIR__ . '/core/helpers.php';

// --- Routage ---
$controllerName = $_GET['controller'] ?? 'article';
$action = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    http_response_code(404);
    die('Contrôleur introuvable.');
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    die('Action introuvable.');
}

$controller->$action();

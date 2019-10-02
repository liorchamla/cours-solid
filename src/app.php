<?php

// Autoloading, pas besoin de require partout pour charger nos classes et chargement
// automatique de nos librairies
require_once('../vendor/autoload.php');

// Définitions de chemins utiles dans l'application
define('TEMPLATES_DIR', __DIR__ . '/../templates/');
define('SRC_DIR', __DIR__ . '/');
define('PUBLIC_DIR', __DIR__ . '/../public/');

/**
 * Ce tableau met en relation des routes avec des méthodes de controller
 */
$routes = [
    '/report-creator' => [
        'GET' => 'App\Controller\ReportCreatorController@show',
        'POST' => 'App\Controller\ReportCreatorController@execute'
    ],
    '/bulk-report' => [
        'GET' => 'App\Controller\BulkReportController@show',
        'POST' => 'App\Controller\BulkReportController@execute'
    ]
];

// Récupération de la route actuelle et de la méthode HTTP actuelle
$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    // Si la route actuelle n'existe pas dans le tableau des routes
    if (!array_key_exists($path, $routes)) {
        throw new Exception("La page correspondant à l'URL `$path` n'existe pas, corrigez le tableau des routes ou l'URL dans votre barre d'adresse");
    }

    // Sinon, on récupère les informations du tableau des routes
    $route = $routes[$path];
    [$className, $methodName] = getControllerForRoute($route, $method);

    // Si la classe demandée n'existe pas
    if (!class_exists($className)) {
        throw new Exception("La classe <strong>$className</strong> n'existe pas et ne peut donc pas répondre à cette route ! Vous devriez construire cette classe ou alors corriger vos routes !");
    }

    // On instancie la classe concernée
    $controller = new $className();

    // Si la méthode n'existe pas
    if (!method_exists($controller, $methodName)) {
        throw new Exception("La classe <strong>$className</strong> n'a aucune méthode <strong>$methodName</strong> ! Vous devriez créer cette méthode ou corriger vos routes !");
    }

    // On appelle la méthode sur l'instance du controller
    call_user_func([$controller, $methodName]);
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once(TEMPLATES_DIR . "error.html.php");
}


/**
 * Retourne un tableau contenant le nom de la classe et la méthode à appeler pour une route et une
 * méthode HTTP données
 *
 * @param array $route
 * @param string $httpMethod
 *
 * @return array
 */
function getControllerForRoute(array $route, string $httpMethod = 'GET'): array
{
    $controller = $route[$httpMethod];
    $className = substr($controller, 0, strpos($controller, '@'));
    $methodName = substr($controller, strpos($controller, '@') + 1);

    return [$className, $methodName];
}

<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Charger la connexion à la base de données
require_once dirname(__DIR__) . '/config/database.php';

// Charger le container PHP-DI
$container = require_once dirname(__DIR__) . '/config/container.php';

// Charger les routes
$routes = require dirname(__DIR__) . '/routes/web.php';

// Créer le dispatcher FastRoute
$dispatcher = simpleDispatcher($routes);

// Récupérer la méthode HTTP
$httpMethod = $_SERVER['REQUEST_METHOD'];

// Récupérer uniquement le chemin sans la query string
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Dispatcher la requête
$routeInfo = $dispatcher->dispatch($httpMethod, $path);

switch ($routeInfo[0]) {

    case Dispatcher::NOT_FOUND:

        http_response_code(404);

        require dirname(__DIR__) . '/templates/error/404.php';

        break;

    case Dispatcher::METHOD_NOT_ALLOWED:

        http_response_code(405);

        header('Allow: ' . implode(', ', $routeInfo[1]));

        require dirname(__DIR__) . '/templates/error/405.php';

        break;

    case Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controllerClass, $method] = $handler;

        $controller = $container->get($controllerClass);

        $controller->$method(...array_values($vars));

        break;
}

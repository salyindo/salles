<?php

namespace App;

use FastRoute\Dispatcher;

class Application
{
    public function __construct(
        private Dispatcher $dispatcher,
        private \Closure $controllerResolver
    ) {
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = $_SERVER['REQUEST_URI'];

        $path = parse_url($uri, PHP_URL_PATH);

        $routeInfo = $this->dispatcher->dispatch($method, $path);

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

                $controller = ($this->controllerResolver)($controllerClass);

                $controller->$method(...array_values($vars));

                break;
        }
    }
}

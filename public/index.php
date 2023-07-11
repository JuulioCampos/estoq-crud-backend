<?php
use App\Routes\Routes;

require_once '../vendor/autoload.php';
try {

    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        $r = (new Routes($r))->getRoutes();
    });

    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            http_response_code(404);
            echo '404 Not Found';
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            http_response_code(405);
            echo '405 Method Not Allowed';
            break;
        case FastRoute\Dispatcher::FOUND:
            [$controller, $method] = explode('@', $routeInfo[1]);
            $params = $routeInfo[2];

            // $controller = 'App\\Controllers\\' . $controller;
            $controllerInstance = new $controller();

            call_user_func_array([$controllerInstance, $method], $params);
            break;
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
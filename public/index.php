<?php
use App\Routes\Routes;

require_once '../vendor/autoload.php';
try {

    // Configuração das rotas
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        $r = (new Routes($r))->getRoutes();
    });

    // Obter o método HTTP e a URI
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    // Remover os parâmetros da URI, se houver
    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }

    // Disparar a rota correspondente
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

            // Chamar o método do controlador
            call_user_func_array([$controllerInstance, $method], $params);
            break;
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
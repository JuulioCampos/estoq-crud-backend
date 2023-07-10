<?php
namespace App\Routes;
use FastRoute\RouteCollector;

use App\Controllers\ProductType;
class Routes
{
    private RouteCollector $route;
    public function __construct(RouteCollector $route) {
        $this->route = $route;
    }

    public function getRoutes(): RouteCollector {
        //products
        $this->route->addRoute('GET', "/product-type", ProductType::class . '@index');
        $this->route->addRoute('POST', "/product-type", ProductType::class . '@store');
        $this->route->addRoute('PUT', "/product-type/{id:\d+}", ProductType::class . '@edit');
        $this->route->addRoute('DELETE', "/product-type/{id:\d+}", ProductType::class . '@delete');



        return $this->route;
    }
}
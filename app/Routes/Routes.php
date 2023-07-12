<?php
namespace App\Routes;

use FastRoute\RouteCollector;

use App\Controllers\ProductType;
use App\Controllers\Product;
use App\Controllers\Sales;

class Routes
{
    private RouteCollector $route;
    public function __construct(RouteCollector $route)
    {
        $this->route = $route;
    }

    public function getRoutes(): RouteCollector
    {
        $this->route->addGroup('/api', function (RouteCollector $r) {
            //products type
            $this->route->addRoute('GET', "/product-type", ProductType::class . '@index');
            $this->route->addRoute('POST', "/product-type", ProductType::class . '@store');
            $this->route->addRoute('PUT', "/product-type/{id:\d+}", ProductType::class . '@edit');
            $this->route->addRoute('DELETE', "/product-type/{id:\d+}", ProductType::class . '@delete');

            //products
            $this->route->addRoute('GET', "/product", Product::class . '@index');
            $this->route->addRoute('POST', "/product", Product::class . '@store');
            $this->route->addRoute('PUT', "/product/{id:\d+}", Product::class . '@edit');
            $this->route->addRoute('DELETE', "/product/{id:\d+}", Product::class . '@delete');

            //sales
            $this->route->addRoute('GET', "/sales", Sales::class . '@index');
            $this->route->addRoute('POST', "/sales", Sales::class . '@store');
            $this->route->addRoute('PUT', "/sales/{id:\d+}", Sales::class . '@edit');
            $this->route->addRoute('DELETE', "/sales/{id:\d+}", Sales::class . '@delete');

        });
        return $this->route;
    }
}
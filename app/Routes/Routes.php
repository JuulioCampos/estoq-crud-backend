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
        //products type
        $this->route->addRoute('GET', "/api/product-type", ProductType::class . '@index');
        $this->route->addRoute('POST', "/api/product-type", ProductType::class . '@store');
        $this->route->addRoute('PUT', "/api/product-type/{id:\d+}", ProductType::class . '@edit');
        $this->route->addRoute('DELETE', "/api/product-type/{id:\d+}", ProductType::class . '@delete');

        //products
        //products
        $this->route->addRoute('GET', "/api/product", Product::class . '@index');
        $this->route->addRoute('POST', "/api/product", Product::class . '@store');
        $this->route->addRoute('PUT', "/api/product/{id:\d+}", Product::class . '@edit');
        $this->route->addRoute('DELETE', "/api/product/{id:\d+}", Product::class . '@delete');

        //sales
        //products
        $this->route->addRoute('GET', "/api/sales", Sales::class . '@index');
        $this->route->addRoute('POST', "/api/sales", Sales::class . '@store');
        $this->route->addRoute('PUT', "/api/sales/{id:\d+}", Sales::class . '@edit');
        $this->route->addRoute('DELETE', "/api/sales/{id:\d+}", Sales::class . '@delete');

        return $this->route;
    }
}
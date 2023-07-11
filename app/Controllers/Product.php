<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;

class Product extends Controller
{
    public function find($id): void
    {
        try {
            $_product_type = new ProductModel();
            $this->handleResponse($_product_type->findById($id));
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }

    }
    function index(): void
    {
        try {
            $_product_type = new ProductModel();
            $this->handleResponse($_product_type->getAll());
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function edit()
    {
        echo 'edit nós';
    }

    public function store()
    {
        echo 'store nós';
    }
    public function delete()
    {
        echo 'delete nós';
    }
}
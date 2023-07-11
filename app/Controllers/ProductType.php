<?php

namespace App\Controllers;

use App\Models\ProductType as ProductTypeModel;

class ProductType extends Controller
{
    public function find($id): void
    {
        try {
            $_product_type = new ProductTypeModel();
            $this->handleResponse($_product_type->findById($id));
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }

    }
    function index(): void
    {
        try {
            $_product_type = new ProductTypeModel();
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
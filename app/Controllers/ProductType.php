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
    public function edit($id)
    {
        try {
            $_product_type = new ProductTypeModel();
            $response = $_product_type->edit($id, $this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }

    public function store()
    {
        try {
            $_product_type = new ProductTypeModel();
            $response = $_product_type->create($this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function delete($id)
    {
        try {
            $_product_type = new ProductTypeModel();
            $response = $_product_type->delete($id);
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
}
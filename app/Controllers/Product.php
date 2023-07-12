<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;

class Product extends Controller
{
    public function find($id): void
    {
        try {
            $_product = new ProductModel();
            $this->handleResponse($_product->findById($id));
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }

    }
    function index(): void
    {
        try {
            $_product = new ProductModel();
            $this->handleResponse($_product->getAll());
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function edit($id)
    {
        try {
            $_product = new ProductModel();
            $response = $_product->edit($id, $this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }

    public function store()
    {
        try {
            $_product_type = new ProductModel();
            $response = $_product_type->create($this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function delete($id)
    {
        try {
            $_product = new ProductModel();
            $response = $_product->delete($id);
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
}
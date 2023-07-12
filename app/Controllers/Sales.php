<?php

namespace App\Controllers;

use App\Models\Sales as SalesModel;

class Sales extends Controller
{
    public function find($id): void
    {
        try {
            $_sales = new SalesModel();
            $this->handleResponse($_sales->findById($id));
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }

    }
    function index(): void
    {
        try {
            $_sales = new SalesModel();
            $this->handleResponse($_sales->getAll());
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function edit($id)
    {
        try {
            $_sales = new SalesModel();
            $response = $_sales->edit($id, $this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }

    public function store()
    {
        try {
            $_sales = new SalesModel();
            $response = $_sales->create($this->getBody());
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
    public function delete($id)
    {
        try {
            $_sales = new SalesModel();
            $response = $_sales->delete($id);
            $this->handleResponse($response);
        } catch (\Throwable $th) {
            $this->handleResponse($th);
        }
    }
}
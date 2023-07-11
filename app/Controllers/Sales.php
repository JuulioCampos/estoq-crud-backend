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
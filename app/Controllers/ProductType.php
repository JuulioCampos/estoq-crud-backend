<?php

namespace App\Controllers;
use App\Models\ProductType as ProductTypeModel;
class ProductType extends Controller
{
    public function index()
    {
        $_product_type = new ProductTypeModel();
        print_r($_product_type->findById(1));
        die;
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
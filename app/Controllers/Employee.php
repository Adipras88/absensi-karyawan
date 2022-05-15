<?php

namespace App\Controllers;

class Employee extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Product Catalog',
            'brand' => 'Smartphone Xiaomi',
            'product' => ['Redmi Note 9', 'Redmi Note 9 Pro', 'Mi Note 10', 'Mi Note 10 Pro']
        ];

        return view('layouts/pages/employee/index', $data);
    }

    public function create()
    {
        echo view('layouts/pages/employee/create');
    }
}
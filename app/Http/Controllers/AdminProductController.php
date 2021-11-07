<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function list()
    {
        return view('admin.product.list');
    }

    public function add() {
        return view('admin.product.add');
    }

    public function storeCat(Request $request)
    {

    }
}

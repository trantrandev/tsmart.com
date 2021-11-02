<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCatProductController extends Controller
{
    function listCat()
    {
        return view('admin/product/listCat');
    }

    function storeCat(Request $request)
    {
        dd($request->all());
    }
}

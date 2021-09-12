<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    function list() {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    function add(Request $request) {
        if($request->input('btn_add')) {
            return $request->input('btn_add');
        }
        return view('admin.user.add');
    }
}
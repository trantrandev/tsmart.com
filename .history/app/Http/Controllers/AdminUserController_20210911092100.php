<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    function list() {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    function add(Request $request) {
        if($request->input('btn_add')) {
            return $request->input();
        }
        return view('admin.user.add');
    }

    function store(Request $request) {
        $request -> validate(
            [
                'name' => 'required|string|max:255',
                'email' => ''
            ]
        )
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    function list()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    function add(Request $request)
    {
        if ($request->input('btn_add')) {
            return $request->input();
        }
        return view('admin.user.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['same:password'],
                'gender' => 'required',
                'status' => 'required',
                'avatar' => 'mimes:png, jpeg, jpg|max:5432'
            ],
            [
                'required' => ':attribute không được để trống',
                'confirm.same' => ':attribute không trùng khớp',
                'unique' => ':attribute đã tồn tại trong hệ thống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'avatar.max' => 'Chỉ cho phép kích thước lớn nhất :max KB',
            ],
            [
                'name' => 'Họ tên',
                'password' => 'Mật khẩu',
                'confirm' => 'Nhập lại mật khẩu',
                'email' => 'Email',
                'gender' => 'Giới tính',
                'avatar' => 'Ảnh đại diện',
                'status' => 'trạng thái'
            ]
        );
    }
}

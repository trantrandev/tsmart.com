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
                'confirm_password.same' => ':attribute không trùng khớp',
                'unique' => ':attribute đã tồn tại trong hệ thống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required' => 'Hãy chọn :attribute',
                'gender.required' => 'Hãy chọn :attribute',
                'avatar.max' => 'Chỉ cho phép kích thước lớn nhất :max KB',
                'avatar.mimes' => 'Chỉ cho phép ảnh thuộc loại: png, jpeg, jpg'
            ],
            [
                'name' => 'Họ tên',
                'password' => 'Mật khẩu',
                'confirm_password' => 'Nhập lại mật khẩu',
                'email' => 'Email',
                'gender' => 'Giới tính',
                'avatar' => 'Ảnh đại diện',
                'status' => 'trạng thái'
            ]);

            // if($request->hasfile('avatar')) {
            //     $file = $request->file('avatar'); //lấy hết dữ liệu file
            //     $new_name = rand() . '.' . $file->getClientOriginalExtension();
            //     // Di chuyển file
            //     $file->move(public_path('img\profiles'), $new_name);
            // }

            return redirect('admin/user/list')->with
    }
}

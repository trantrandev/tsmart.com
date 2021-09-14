<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Toastr;

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
            ]
        );

        // check choose file
        if ($request->hasFile('avatar')) {
            //create name images have time() for not same name
            $newImageName = time() . '-' . $request->name . '.' . $request->avatar->extension();
        }

        //create folder if not exists
        if (!file_exists(public_path('admin/images'))) {
            // mkdir('user', 0777, true);
            echo "not exist";
        }else{
            echo "exitest";
        }

        die;

        $request->avatar->move(public_path('admin.'));
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
        ]);

        Toastr::success('Thêm mới tài khoản thành công', 'Thành công');
        return redirect('admin/user/list');
    }
}

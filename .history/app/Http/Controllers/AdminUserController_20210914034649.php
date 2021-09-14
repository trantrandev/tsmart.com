<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;

class AdminUserController extends Controller
{
    function list(Request $request)
    {
        $status = $request->input('status');
        if ($status == "trash") {
            $users = User::onlyTrashed()->get();
        }else if($status == "inactive"){
            $users = User::where('status', 'inactive')->get();
        }else {
            // active
            $users = User::where('status', 'active')->get();
        }

        // count
        $count_user_active = User::where('status', 'active')->count();
        $count_user_inactive = User::where('status', 'inactive')->count();
        $count_user_trash = User::onlyTrashed()->count();
        // group count
        $count = [$count_user_active, $count_user_inactive, $count_user_trash];
        return view('admin.user.list', compact('users', 'count'));
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

        $newImageName = "";
        // check choose file
        if ($request->hasFile('avatar')) {
            //create folder if not exists
            if (!file_exists(public_path('admin/images/users'))) {
                mkdir(public_path('admin/images/users'), 0777, true);
            }

            //create name images have time() for not same name
            $newImageName = time() . '-' . $request->name . '.' . $request->avatar->extension();
            // upload file into folder
            $request->avatar->move(public_path('admin/images/users'), $newImageName);
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'phone' => str_replace('-', '', $request->input('phone')),
            'address' => $request->input('address'),
            'avatar' => $newImageName
        ]);

        Toastr::success('Thêm mới tài khoản thành công', 'Thêm tài khoản');
        return redirect('admin/user/list');
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();

            // Thông báo
            Toastr::success('Xóa tài khoản thành công', 'Xóa tài khoản');
            return redirect('admin/user/list');
        } else {
            Toastr::warning('Bạn không thể tự xóa mình ra khỏi hệ thống', 'Cảnh báo');
            return redirect('admin/user/list');
        }
    }

    function action(Request $request) {
        // $list_check = $request->input('list_check');
        // dd($list_check);
    }
}

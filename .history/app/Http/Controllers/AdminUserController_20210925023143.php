<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Toastr;
use File;
use DataTables;

class AdminUserController extends Controller
{
    function list(Request $request)
    {
        $status = $request->input('status');

        // Trong trạng thái bình thường thì action nó sẽ là:
        $list_act = [
            'inactive' => 'Vô hiệu hóa',
            'delete' => 'Xóa tạm thời',
        ];
        if ($status == "trash") {
            // Trong trạng thái thùng rác thì action:
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];

            $users = User::onlyTrashed()->orderBy('id', 'desc')->get();
        } else if ($status == "inactive") {
            // Trong trạng thái inactive thì action
            $list_act = [
                'active' => 'Kích hoạt',
                'delete' => 'Xóa tạm thời',
            ];
            $users = User::where('status', 'inactive')->orderBy('id', 'desc')->get();
        } else {
            // active
            $users = User::where('status', 'active')->orderBy('id', 'desc')->get();
        }

        // count
        $count_user_active = User::where('status', 'active')->count();
        $count_user_inactive = User::where('status', 'inactive')->count();
        $count_user_trash = User::onlyTrashed()->count();
        // group count
        $count = [$count_user_active, $count_user_inactive, $count_user_trash];
        return view('admin.user.list', compact('users', 'count', 'list_act'));
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
        //    dd($request->file());
        $request->validate(
            [
                'name'             => ['required', 'string', 'max:255'],
                'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'         => ['required', 'string', 'min:8'],
                'confirm_password' => ['same:password'],
                'gender'           => 'required',
                'status'           => 'required',
                'avatar'           => 'image|mimes:jpeg,png,jpg|max:2048' //* không được cách ra nó sẽ bị lỗi
            ],
            [
                'required'              => ':attribute không được để trống',
                'confirm_password.same' => ':attribute không trùng khớp',
                'unique'                => ':attribute đã tồn tại trong hệ thống',
                'min'                   => ':attribute ít nhất phải :min ký tự',
                'max'                   => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required'       => 'Hãy chọn :attribute',
                'gender.required'       => 'Hãy chọn :attribute',
                'avatar.max'            => 'Chỉ cho phép kích thước lớn nhất :max KB',
                'avatar.mimes'          => 'Chỉ cho phép ảnh thuộc loại: png, jpeg, jpg',
                'avatar.image'          => 'Chỉ cho phép upload hình ảnh'
            ],
            [
                'name'             => 'Họ tên',
                'password'         => 'Mật khẩu',
                'confirm_password' => 'Nhập lại mật khẩu',
                'email'            => 'Email',
                'gender'           => 'Giới tính',
                'avatar'           => 'Ảnh đại diện',
                'status'           => 'trạng thái'
            ]
        );

        $newImageName = null;
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

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            //Check Nếu id đăng nhập nằm trong mảng chọn thì bỏ ra
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }

            // Loại ra nếu còn list check thì xử lý tiếp
            if (!empty($list_check)) {
                // Check action
                $act = $request->input('act');
                if ($act == "inactive") {
                    User::whereIn('id', $list_check)
                        ->update(array('status' => 'inactive'));
                    Toastr::success('Vô hiệu hóa thành công', 'Kích hoạt');
                    return redirect('admin/user/list');
                }

                if ($act == "active") {
                    User::whereIn('id', $list_check)
                        ->update(array('status' => 'active'));
                    Toastr::success('Kích hoạt thành công', 'Kích hoạt');
                    return redirect('admin/user/list');
                }

                if ($act == "delete") {
                    User::destroy($list_check);
                    Toastr::success('Bạn đã xóa thành công', 'Xóa bản ghi');
                    return redirect('admin/user/list');
                }

                if ($act == "restore") {
                    User::withTrashed()
                        // Id thuộc list check
                        ->whereIn('id', $list_check)
                        ->restore();
                    Toastr::success('Bạn đã khôi phục thành công', 'Khôi phục bản ghi');
                    return redirect('admin/user/list');
                }

                if ($act == "forceDelete") {
                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    Toastr::success('Bạn đã xóa vĩnh viễn bản ghi khỏi hệ thống', 'Xóa vĩnh viễn');
                    return redirect('admin/user/list');
                }
            }
            Toastr::warning('Bạn không thể thao tác trên tài khoản của bạn', 'Cảnh báo');
            return redirect('admin/user/list');
        } else {
            Toastr::warning('Bạn cần chọn phần tử thực thi', 'Cảnh báo');
            return redirect('admin/user/list');
        }
    }

    function change_status(Request $request)
    {
        // Check nếu là ở thùng rác thì lấy dl theo trash
        if ($request->action != "trash") {
            $user = User::find($request->user_id);
        } else {
            $user = User::withTrashed()->find($request->user_id);
        }

        $user->status = $request->status;
        $user->save();

        // After change status refresh again number status
        $count_user_active = User::where('status', 'active')->count();
        $count_user_inactive = User::where('status', 'inactive')->count();
        $count_user_trash = User::onlyTrashed()->count();
        // group count
        $count = [$count_user_active, $count_user_inactive, $count_user_trash];

        return response()->json(['status' => 'true', 'count' => $count]);
    }

    function edit(Request $request, $id)
    {

        if ($request->input('action') == 'trash') {
            $user = User::withTrashed()->find($id);
        } else {
            $user = User::find($id);
        }

        return response()->json(['data' => $user, 200]); // 200 là mã lỗi
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name_edit'             => ['required', 'string', 'max:255'],
                'password_edit'         => ['required', 'string', 'min:8'],
                'confirm_password_edit' => ['same:password_edit'],
                'gender_edit'           => 'required',
                'status_edit'           => 'required',
                'avatar_edit'           => 'image|mimes:jpeg,png,jpg|max:2048'  //* không được cách ra nó sẽ bị lỗi
            ],
            [
                'required'                   => ':attribute không được để trống',
                'confirm_password_edit.same' => ':attribute không trùng khớp',
                'unique'                     => ':attribute đã tồn tại trong hệ thống',
                'min'                        => ':attribute ít nhất phải :min ký tự',
                'max'                        => ':attribute nhiều nhất chỉ :max ký tự',
                'status_edit.required'       => 'Hãy chọn :attribute',
                'gender_edit.required'       => 'Hãy chọn :attribute',
                'avatar_edit.max'            => 'Chỉ cho phép kích thước lớn nhất :max KB',
                'avatar_edit.mimes'          => 'Chỉ cho phép ảnh thuộc loại: png, jpeg, jpg',
                'avatar_edit.image'          => 'Chỉ cho phép upload hình ảnh'
            ],
            [
                'name_edit'             => 'Họ tên',
                'password_edit'         => 'Mật khẩu',
                'confirm_password_edit' => 'Nhập lại mật khẩu',
                'email_edit'            => 'Email',
                'gender_edit'           => 'Giới tính',
                'avatar_edit'           => 'Ảnh đại diện',
                'status_edit'           => 'trạng thái'
            ]
        );

        // * Nếu như nằm trong validate thì chuyển thành mảng chuyển đi
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // * Xét để lấy avatar trong csdl ra nếu ko chọn avatar thì giũ nguyên
            // todo: 1. Xét là trash hay bình thường
            // todo: 2. Xét nếu có avatar trong csdl thì lấy ra để ko bị giá trị null khi ko chọn file
            if ($request->input('status_url') == 'trash') {
                $get_avatar = User::select('avatar')->withTrashed()->find($id);
                if ($get_avatar->avatar != null) {
                    $newImageName = $get_avatar->avatar;
                } else {
                    $newImageName = null;
                }
            } else { // *Ở trạng thái bình thường
                $get_avatar = User::select('avatar')->find($id);
                if ($get_avatar->avatar != null) {
                    $newImageName = $get_avatar->avatar;
                } else {
                    $newImageName = null;
                }
            }

            // xử lý choose file
            if ($request->hasFile('avatar_edit')) {
                //create folder if not exists
                if (!file_exists(public_path('admin/images/users'))) {
                    mkdir(public_path('admin/images/users'), 0777, true);
                }

                // ! Các code dưới này dùng để loại bỏ link hình ảnh local và thêm hình ảnh mới vào
                // ! Tạo ảnh mới
                // create name images have time() for not same name
                $newImageName = time() . '-' . $request->name_edit . '.' . $request->avatar_edit->extension();
                // upload file into folder
                $request->avatar_edit->move(public_path('admin/images/users'), $newImageName);

                // * Remove old images
                // * Check trash or normal
                if ($request->input('status_url') == 'trash') {
                    // ! Loại bỏ ảnh cũ
                    // * Chỉ loại bỏ khi avatar trong database != null
                    // get name file was upload in database
                    $name_image = User::select('avatar')->withTrashed()->find($id);
                    if (!is_null($name_image->avatar)) {
                        // get path folder
                        $image_path = public_path('admin/images/users/');
                        // check nếu đúng file thì loại nó ra khỏi local
                        if (File::exists($image_path . $name_image->avatar)) {
                            unlink($image_path . $name_image->avatar);
                        }
                    }
                } else {
                    // ! Loại bỏ ảnh cũ
                    // * Chỉ loại bỏ khi avatar trong database != null
                    // get name file was upload in database
                    $name_image = User::select('avatar')->find($id);
                    if ($name_image->avatar != null) {
                        // get path folder
                        $image_path = public_path('admin/images/users/');
                        // check nếu đúng file thì loại nó ra khỏi local
                        if (File::exists($image_path . $name_image->avatar)) {
                            unlink($image_path . $name_image->avatar);
                        }
                    }
                }
            }

            // UPDATE into database
            // !check xem nếu bên trash thì lấy theo trash
            if ($request->input('status_url') == 'trash') {
                $data = User::withTrashed()->find($id);
            } else {
                $data = User::find($id);
            }

            $data->name     = ($request->name_edit);
            $data->password = (Hash::make($request->password_edit));
            $data->gender   = ($request->gender_edit);
            $data->status   = ($request->status_edit);
            $data->avatar   = ($newImageName);
            $data->phone = (str_replace('-', '', $request->phone_edit));
            $data->address = ($request->address_edit);

            $data->update();
            return response()->json(['code' => 1, 'data' => $data]);
        }
    }
}

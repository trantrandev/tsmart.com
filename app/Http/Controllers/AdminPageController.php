<?php /** @noinspection DuplicatedCode */

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class AdminPageController extends Controller
{
    public function list()
    {
        $pages = Page::with('user')->get();

        return view('admin.page.list')->with(compact('pages'));
    }

    public function add()
    {
        return view('admin.page.add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255'],
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required' => 'Hãy chọn :attribute',
            ],
            [
                'title' => 'Tiêu đề trang',
                'status' => 'Trạng thái',
                'slug' => 'Slug'
            ]
        );

        $data = array(
            'title' => $request->title,
            'slug' => $request->slug,
            'detail' => $request->detail,
            'status' => $request->status,
            'user_id' => Auth::id()
        );

        Page::create($data);
        Toastr::success('Thêm thành công', 'Thêm trang');
        return redirect('admin/page/list');
    }

    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255'],
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required' => 'Hãy chọn :attribute',
            ],
            [
                'title' => 'Tiêu đề trang',
                'status' => 'Trạng thái',
                'slug' => 'Slug'
            ]
        );

        $data = array(
            'title' => $request->title,
            'slug' => $request->slug,
            'detail' => $request->detail,
            'status' => $request->status,
            'updated_by' => Auth::id()
        );

        Page::find($id)->update($data);
        Toastr::success('Cập nhật thành công', 'Cập nhật trang');
        return redirect('admin/page/list');
    }

    public function delete($id)
    {
        Page::find($id)->delete();
        Toastr::success('Xóa thành công', 'Xóa trang');
        return redirect('admin/page/list');
    }
}

<?php /** @noinspection PhpUndefinedFieldInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */

/** @noinspection AccessModifierPresentedInspection */

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class AdminProductCategoryController extends Controller
{
    function listCat()
    {
        $product_categories = ProductCategory::where('status', '=', 'active')->get();
        $list_cat = data_tree($product_categories, 0);
        return view('admin/product/listCat', compact('list_cat'));
    }

    function createCat(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'status' => 'required',
                'slug' => ['required', 'string', 'unique:product_categories'],
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại trong hệ thống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required' => 'Hãy chọn :attribute',
                'slug.unique' => 'Slug đã tồn tại hãy nhập slug khác'
            ],
            [
                'name' => 'Danh mục',
                'slug' => 'Slug',
                'status' => 'trạng thái'
            ]
        );

        $data = array(
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'added_by' => Auth::id(),
            'parent_id' => $request->cat_parent,
        );

        ProductCategory::create($data);
        Toastr::success('Thêm thành công', 'Thêm danh mục');
        return redirect('admin/product/cat/list');
    }
}

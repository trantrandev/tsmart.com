<?php /** @noinspection PhpUndefinedFieldInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */

/** @noinspection AccessModifierPresentedInspection */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class AdminProductCategoryController extends Controller
{
    function listCat()
    {
        $product_categories = ProductCategory::get();

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
            'name' => ucfirst($request->name),
            'slug' => $request->slug,
            'status' => $request->status,
            'added_by' => Auth::id(),
            'parent_id' => $request->cat_parent,
        );

        ProductCategory::create($data);
        Toastr::success('Thêm thành công', 'Thêm danh mục');
        return redirect('admin/product/cat/list');
    }

    function deleteCat($id)
    {
        //check nếu nó còn danh mục con thì không được xóa
        //check nếu nó chứa sản phẩm bên trong thì cũng ko cho xóa

//        $product= ProductCategory::find($id)->products->where('cat_id', '=', $id);
        $cat_parent = ProductCategory::where('parent_id', '=', $id)->get();
        if (count($cat_parent) > 0) {
            //Không được xóa danh mục cha nếu có danh mục con
            Toastr::warning('Bạn phải xóa danh mục con trước khi thực hiện thao tác này', 'Xóa danh mục');
            return redirect('admin/product/cat/list');
        } else {
            //Thực hiện xóa
            ProductCategory::find($id)->delete();
            Toastr::success('Xóa thành công', 'Xóa danh mục');
            return redirect('admin/product/cat/list');
        }
    }
}

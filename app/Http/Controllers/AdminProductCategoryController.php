<?php /** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUnreachableStatementInspection */
/** @noinspection ForgottenDebugOutputInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection UnknownColumnInspection */
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */

/** @noinspection AccessModifierPresentedInspection */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

    function editCat(Request $request, $id)
    {
        $product_cat_by_id = ProductCategory::find($id);
        return response()->json(['data' => $product_cat_by_id]);
    }

    function updateCat(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name_edit' => ['required', 'string', 'max:255'],
                'status_edit' => 'required',
                'slug_edit' => ['required', 'string'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute ít nhất phải :min ký tự',
                'max' => ':attribute nhiều nhất chỉ :max ký tự',
                'status.required' => 'Hãy chọn :attribute',
            ],
            [
                'name_edit' => 'Danh mục',
                'slug_edit' => 'Slug',
                'status_edit' => 'Trạng thái'
            ]
        );

        // * Nếu như nằm trong validate thì chuyển thành mảng chuyển đi
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            /*todo
            1. Kiểm tra nếu có chỉnh sửa slug thì:
                - kiểm tra slug đã nhập có tồn tại trong database chưa
                - Nếu trùng thì báo lỗi, không thì ra ngoài thực hiện cập nhật
            */
            $slug_old = ProductCategory::select('slug')->find($id);
            if ($slug_old->slug !== $request->slug_edit) {
                //check slug trong database nếu trùng thì báo lỗi
                if (ProductCategory::where('slug', '=', $request->slug_edit)->exists()) {
                    //slug đã tồn tại trong hệ thống, xuất lỗi
                    return response()->json(['code' => 0, 'error' => $validator->getMessageBag()->add('slug_edit','Slug đã tồn tại, hãy nhập slug khác')]);
                }
            }

            $data = array(
                'name' => $request->name_edit,
                'slug' => $request->slug_edit,
                'status' => $request->status_edit,
                'updated_by' => Auth::id()
            );

            ProductCategory::find($id)->update($data);
            return response()->json(['code' => 1]);
        }
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

@extends('layouts.admin')

@section('add_css')
    <!--suppress ES6ConvertVarToLetConst, SpellCheckingInspection, JSJQueryEfficiency, JSUnresolvedVariable -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/modal-window-effects/css/md-modal.css') }}">
@endsection
@section('content')

    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-uppercase">Sản phẩm</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- End page-header --}}
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card-header pb-0 border-0">
                                            <h5>Thêm danh mục</h5>
                                        </div>
                                        <div class="card-block ">
                                            {!! Form::open(['method' => 'POST', 'url' => 'admin/product/cat/create']) !!}
                                            <div class="form-group">
                                                {{ Form::label('name', 'Tên danh mục') }}
                                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Tên danh mục', 'onkeyup'=> 'changeToSlug("name")']) !!}
                                                @error('name')
                                                <span class="text-danger d-block mt-1"
                                                      style="font-size: 13px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('name', 'Slug danh mục') }}
                                                {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'Nhập slug', 'id' => 'slug']) !!}
                                                @error('slug')
                                                <span class="text-danger d-block mt-1"
                                                      style="font-size: 13px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('cat_parent', 'Danh mục cha') }}
                                                <select class="form-select form-control" name="cat_parent" id="cat">
                                                    <option selected value="0">Danh mục cha</option>
                                                    @foreach($list_cat as $cat)
                                                        <option
                                                            value="{{ $cat->id }}">{{ show_categories($cat->level, $cat->name)  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('status', 'Trạng thái') }}
                                                {{ Form::select('status', ['active'=>'kích hoạt','inactive'=>'Vô hiệu hóa'], '', ['id' => 'status', 'class' => 'form-control']) }}
                                            </div>
                                            {{ Form::submit('Thêm danh mục', ['class'=> ['form-control', 'btn', 'btn-primary']]) }}
                                            {!! Form::close() !!}
                                        </div>{{-- ENd card block --}}
                                    </div>
                                    {{-- End col-sm-4 --}}
                                    <div class="col-sm-8">
                                        <div class="card-header pb-0 border-0">
                                            <h5>Danh mục</h5>
                                        </div>
                                        <div class="card-block ">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên danh mục</th>
                                                    <th scope="col">Slug</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Tác vụ</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $t = 0;
                                                @endphp
                                                @foreach($list_cat as $cat)
                                                    <tr>
                                                        @php $t++; @endphp
                                                        <th scope="row">{{ $t }}</th>
                                                        <td> {{ show_categories($cat->level, $cat->name)  }}</td>
                                                        <td>{{ $cat->slug }}</td>
                                                        <td>{!! show_status_product_category($cat->status) !!} </td>
                                                        <td>
                                                            <button
                                                                class="btn btn-primary btn-sm btn-action btn-edit md-trigger"
                                                                type="button" data-modal="modal-edit-product-cat"
                                                                data-url="{{ route('product.cat.edit', $cat->id) }}"
                                                                data-id="{{ $cat->id }}">
                                                                <i class="feather icon-edit f-16  text-c-green"></i>
                                                            </button>
                                                            <a class="btn btn-danger btn-sm btn-action btn-delete"
                                                               href="{{ route('product.cat.delete', $cat->id) }}"
                                                               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                                                <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>{{-- ENd card block --}}
                                    </div>
                                    {{-- End col-sm-8 --}}
                                </div>
                            </div>{{-- End card --}}
                        </div>
                    </div>
                </div>{{-- end page-wrapper --}}
            </div>{{-- end main-body --}}
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
    @include('admin.product.editCat')
@endsection

@section('add_js')
    {{-- edit --}}
    <script src="{{ asset('admin/plugins/modal-window-effects/js/classie.js') }}"></script>
    <script src="{{ asset('admin/plugins/modal-window-effects/js/modalEffects.js') }}"></script>
    <script>
        {{--        Hien thi session storage status after update and reload page by ajax--}}
        if (sessionStorage.getItem('update_product_cat') === 'ok') {
            toastr.options = {
                // set time out
                'timeOut': 2000
            }
            toastr['success']("Cập nhật danh mục thành công",
                'Cập nhật');
            sessionStorage.removeItem('update_product_cat');
        }
    </script>
    <script>
        // show info edit
        function edit() {
            $(document).on("click", "button.btn-edit", function (e) {
                // Đưa modal về mặc định
                e.preventDefault();
                // Phải thêm class md-show này vô vì khi update đã bị xóa
                $('#modal-edit-product-cat').addClass('md-show');
                // Lấy url từ data-url kèm id bản ghi để dể controller lấy đc id
                var url = $(this).attr('data-url');

                // Lấy thông tin user đang login để disable trạng thái
                var user_login = {!! Auth()->user() !!};
                // Lấy id có trong view list
                var id = $(this).data('id');
                var data = {
                    id: id
                };
                $.ajax({
                    //phương thức get
                    type: 'get',
                    url: url,
                    // data:data,
                    beforeSend: function () {
                        // Làm mới lại modal mỗi lần load lên
                        $('#form-edit').find('span.error-text').text('');
                        $('#form-edit').trigger('reset');
                    },
                    success: function (response) {
                        console.log(response);
                        // ---- Xuất dữ liệu đưa lên modal ----
                        $('#name-edit').val(response.data.name);
                        $('#slug-edit').val(response.data.slug);

                        // select categories
                        if (response.data.parent_id === 0) {
                            $('#cat-edit option[value="0"]').attr('selected',
                                'selected');
                        } else {
                            $('#cat-edit option[value="' + response.data.parent_id + '"]').attr('selected',
                                'selected');
                        }
                        //select status
                        if (response.data.status === "active") {
                            $('#status-edit option[value="active"]').attr('selected',
                                'selected');
                        } else {
                            $('#status-edit option[value="inactive"]').attr('selected',
                                'selected');
                        }

                        // Thêm data-url chứa route sửa đã được chỉ định vào modal form edit vừa hiện lên để lấy id được chọn
                        $('#form-edit').attr('action',
                            '{{ URL::to('admin/product/cat/update') }}/' +
                            response.data.id);
                    },
                    error: function (error) {

                    }
                })
            })
        }

        // update
        function update() {
            $(document).on('submit', '#form-edit', function (e) {
                e.preventDefault();
                // get
                var form = this;
                var url = $(this).attr('action');
                var form_data = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // Trước khi gửi loại những error validator ra
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.code === 0) {
                            // Mỗi trường lỗi từ response sẽ ứng với class error bên form: class = name_edit_error => xuất lỗi ra
                            $.each(response.error, function (prefix, val) {
                                //xuat loi co class tenid_error
                                $(form).find('span.' + prefix + '_error').text(val[
                                    0]);
                            });
                        } else if (response.code === 1) {
                            sessionStorage.setItem("update_product_cat", "ok");
                            window.location.href = "{{ URL::to('admin/product/cat/list') }}";
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                });

            });
        }

        //thuc thi function
        edit();
        update();
    </script>
@endsection



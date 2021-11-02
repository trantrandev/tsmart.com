@extends('layouts.admin')

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
                                            {!! Form::open(['method' => 'POST', 'url' => 'admin/product/cat/store']) !!}
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
                                                {{ Form::select('cat_parent', ['Danh mục cha',5 =>1, 2], '', ['id' => 'cat-parent', 'class' => 'form-control']) }}
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
                                                    <th scope="col">Tên danh m</th>
                                                    <th scope="col">Slug</th>
                                                    <th scope="col">Tác vụ</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>
                                                        <button
                                                            class="btn btn-primary btn-sm btn-action btn-edit md-trigger"
                                                            type="button" data-modal="modal-edit-user">
                                                            <i class="feather icon-edit f-16  text-c-green"></i>
                                                        </button>
                                                        <a class="btn btn-danger btn-sm btn-action btn-delete"
                                                           href="{{ route('product.cat.delete', 3) }}"
                                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                                            <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
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
@endsection


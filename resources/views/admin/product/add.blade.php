@extends('layouts.admin')
@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title text-uppercase">
                                <h5 class="m-b-10">Sản phẩm</h5>
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
                                <div class="card-header pb-0 border-0">
                                    <h5>Thêm sản phẩm</h5>
                                    <span class="d-block"
                                          style="font-size: 13px; margin-top: 5px; color:#919aa3">Hãy điền vào những trường có dấu
                                        <code>(*)</code></span>
                                </div>

                                <div class="card-block">
                                    {!! Form::open(['METHOD' => 'POST', 'url' => 'admin/product/create', 'files' => 'TRUE']) !!}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('name', 'Tên sản phẩm') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nhập tên sản phẩm', 'value' => 'old(name)']) !!}
                                            @error('name')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('price', 'Giá sản phẩm') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Nhập giá sản phẩm', 'value' => 'old(price)']) !!}
                                            @error('name')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('status', 'Status') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="status" id="" class="form-control">
                                                <option value="" disabled selected>---- Trạng thái ----</option>
                                                <option value="active" {{ old('status') === 'active'?'selected':'' }} >
                                                    Active
                                                </option>
                                                <option
                                                    value="inactive" {{ old('status') === 'inactive'?'selected':'' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('picture', 'Ảnh sản phẩm') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="up-picture"
                                                   name="picture">
                                            <label class="custom-file-label" for="picture" style="margin: 0 15px">Chọn
                                                file</label>
                                            <img src="{{ asset('admin/images/user/150.png') }}" class="mt-2"
                                                 style="max-width: 150px;" id="up-img" alt="up-img">
                                            @error('avatar')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- button submit --}}
                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-10">
                                            {!! Form::submit('Add user', ['class' => ['btn', 'btn-primary', 'btn-sm'], 'name' => 'btn_add']) !!}
                                            {!! Form::reset('Reset', ['class' => ['btn', 'btn-dark', 'btn-sm']]) !!}
                                        </div>
                                    </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

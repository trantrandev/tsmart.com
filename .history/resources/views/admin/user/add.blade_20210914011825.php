@extends('layouts.admin')
@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">USERS</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#!">List user</a></li>
                            </ul>
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
                                    <h5>Add user</h5>
                                    <span class="d-block"
                                        style="font-size: 13px; margin-top: 5px; color:#919aa3">Please fill all field have
                                        <code>(*)</code></span>
                                </div>

                                <div class="card-block">
                                    {!! Form::open(['METHOD' => 'POST', 'url' => 'admin/user/store', 'files' => 'TRUE']) !!}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('name', 'Name') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name input']) !!}
                                            @error('name')
                                                <span class="text-danger d-block mt-1"
                                                    style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('password', 'Password') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                            @error('password')
                                                <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('confirm-password', 'Confirm-password') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'Password confirm', 'name' => 'confirm_password']) !!}
                                            @error('confirm_password')
                                                <span class="text-danger d-block mt-1"
                                                    style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('email', 'Email') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                            @error('email')
                                                <span class="text-danger d-block mt-1"
                                                    style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('gender', 'Gender') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                                        value="male"> Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                                        value="female"> Female
                                                </label>
                                            </div>
                                            @error('gender')
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
                                                <option value="" disabled selected>Select status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger d-block mt-1"
                                                    style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('phone', 'Phone') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('phone', '', ['class' => ['form-control', 'phone'], 'placeholder' => 'Phone input', 'data-mask' => '9999-999-999']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('address', 'Adress') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('address', '', ['class' => 'form-control', 'rows' => 'auto']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('avatar', 'Avatar') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" class="custom-file-input" accept="image/*" id="up-avatar"
                                                name="avatar">
                                            <label class="custom-file-label" for="avatar" style="margin: 0 15px">Chọn
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

@section('add_js')
    {{-- <script src="{{ asset('admin/plugins/inputmask/js/inputmask.min.js') }}"></script> --}}
    <script src="{{ asset('admin/plugins/inputmask/js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".phone").inputmask({
                mask: "9999-999-999"
            });
        });
    </script>
@endsection

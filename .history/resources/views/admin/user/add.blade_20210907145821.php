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
                                    <h5>List user</h5>
                                    <span class="d-block"
                                        style="font-size: 13px; margin-top: 5px; color:#919aa3">Please fill all field have
                                        <code>(*)</code></span>
                                </div>

                                <div class="card-block">
                                    <form id="form-add-user" method="post" action="/" novalidate="">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="name">Full name <span class="text-danger" style="font-size:12px">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Fullname input">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="password">Password <span class="text-danger" style="font-size:12px">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password input">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="confirm-password">Confirm Password <span class="text-danger" style="font-size:12px">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email <span class="text-danger" style="font-size:12px">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter valid e-mail address">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked=""> Male
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female"> Female
                                                    </label>
                                                </div>
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2 col-form-label">Status</div>
                                            <div class="col-sm-10">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2">Address</label>
                                            <div class="col-sm-10">
                                                <textarea name="address" class="form-control"></textarea>
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2">Avatar</label>
                                            <div class="col-sm-10">
                                                <div class="jFiler-input">
                                                    <div class="jFiler-input-caption">
                                                        <span>Choose files To Upload</span>
                                                    </div>
                                                    <div class="jFiler-input-button">Choose Files</div></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" name="add" class="btn btn-primary m-b-0">add user</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

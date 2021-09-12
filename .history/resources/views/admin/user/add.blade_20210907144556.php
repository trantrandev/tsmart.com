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
                                    <a href="http://localhost/tsmartpro/admin/user/add" type="button"
                                        class="btn btn-primary waves-effect waves-light float-right d-inline-block md-trigger"
                                        data-modal="modal-13"> <i class="feather icon-plus m-r-5"></i> Add User
                                    </a>
                                </div>
                                <div class="card-block pb-0 pt-0">
                                    <div class="analytic">
                                        <a href="http://localhost/storeESmart/admin/user/list?status=all"
                                            class="text-primary">All<span class="text-muted"> (1) |</span></a>
                                        <a href="http://localhost/storeESmart/admin/user/list?status=active"
                                            class="text-primary">Active<span class="text-muted"> (1) |</span></a>
                                        <a href="http://localhost/storeESmart/admin/user/list?status=trash"
                                            class="text-primary">Inactive<span class="text-muted"> (2) </span></a>
                                    </div>
                                    <div class="form-action form-inline pt-3">
                                        <select class="form-control form-control-sm">
                                            <option selected="">select</option>
                                            <option>Large select</option>
                                        </select>
                                        <input type="submit" name="btn-search" value="Áp dụng"
                                            class="btn btn-sm btn-primary m-0">
                                    </div>
                                </div>
                                <div class="card-block">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

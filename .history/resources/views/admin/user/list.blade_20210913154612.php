@extends('layouts.admin')

@section('add_css')

    <link rel="stylesheet" href="{{ asset('admin/plugins/data-tables/css/datatables.min.css') }}">
@endsection

@section('content')

    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="page-header">
                @if (Session)

                @endif
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
                                    <div class="table-responsive">
                                        <table id="fixed-header"
                                            class="display table table-checkall nowrap table-striped table-hover"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="checkall"></th>
                                                    <th>STT</th>
                                                    <th>Avatar</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Created date</th>
                                                    <th>Status</th>
                                                    <th>Created date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $t = 0;
                                                @endphp
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="check"><input type="checkbox" name="[]"></td>
                                                        @php
                                                            $t++;
                                                        @endphp
                                                        <th>{{ $t }}</th>
                                                        <td><img style="width: 50px"
                                                                src="{{ asset(show_string_avatar($user->gender)) }}"
                                                                alt=""></td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            {{ $user->email }}
                                                        </td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>
                                                            {!! show_status_user($user->status, $user->id) !!}
                                                        </td>
                                                        <td>2011/04/25</td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm btn-action" href="#!">
                                                                <i class="feather icon-edit f-16  text-c-green"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-sm btn-action" href="#!" >
                                                                <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
    <script src="{{ asset('admin/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tbl-datatable-custom.js') }}"></script>
    {{-- bootstrap --}}
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
@endsection

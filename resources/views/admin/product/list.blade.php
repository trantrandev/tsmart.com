@extends('layouts.admin')

@section('add_css')
    <!--suppress SpellCheckingInspection, ES6ConvertVarToLetConst -->
    <link rel="stylesheet" href="{{ asset('admin/css/switch.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/modal-window-effects/css/md-modal.css') }}">
@endsection

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
                                    <h5>Danh sách sản phẩm</h5>
                                    <a href="{{ url('admin/product/add') }}" type="button"
                                       class="btn btn-primary waves-effect waves-light float-right d-inline-block">
                                        <i class="feather icon-plus m-r-5"></i> Thêm sản phẩm
                                    </a>
                                </div>

                                <div class="card-block pt-0 pb-0">
                                    <div class="analytic">
                                        <a href=""
                                           class="text-primary active">Kích hoạt
                                            <span class="text-muted"> (221) |</span></a>
                                        <a href=""
                                           class="text-primary active">Vô hiệu hóa
                                            <span class="text-muted"> (221) |</span></a>
                                    </div>
                                </div>

                                <div class="card-block pt-0">
                                    <form action="{{ url('admin/product/action') }}" method="POST">
                                        @csrf
                                        <div class="form-action form-inline pt-3 pb-3">
                                            <select class="form-control form-control-sm mr-1" name="act">
                                                <option selected="" disabled>select</option>
                                                <option value="">1</option>
                                                <option value="">1</option>
                                            </select>
                                            <input type="submit" name="btn_action" value="Áp dụng"
                                                   class="btn btn-sm btn-primary m-0">
                                        </div>

                                        <div class="table-responsive">
                                            <table id="users-table"
                                                   class="display table table-checkall nowrap table-striped table-hover"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="checkall"></th>
                                                    <th>STT</th>
                                                    <th>Ảnh</th>
                                                    <th>Tên</th>
                                                    ẩm
                                                    <th>Giá</th>
                                                    <th>Giảm giá(%)</th>
                                                    <th>Trạng thái</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>{{-- ENd card block --}}
                            </div>{{-- End card --}}
                        </div>
                    </div>
                </div>{{-- end page-wrapper --}}
            </div>{{-- end main-body --}}
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}

@endsection


@section('add_js')
    <script src="{{ asset('admin/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tbl-datatable-custom.js') }}"></script>
    {{-- edit --}}
    <script src="{{ asset('admin/plugins/modal-window-effects/js/classie.js') }}"></script>
    <script src="{{ asset('admin/plugins/modal-window-effects/js/modalEffects.js') }}"></script>

@endsection

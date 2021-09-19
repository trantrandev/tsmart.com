@extends('layouts.admin')

@section('add_css')
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
                                    <a href="{{ url('admin/user/add') }}" type="button"
                                        class="btn btn-primary waves-effect waves-light float-right d-inline-block">
                                        <i class="feather icon-plus m-r-5"></i> Add User
                                    </a>
                                </div>

                                <div class="card-block pt-0 pb-0">
                                    <div class="analytic">
                                        <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}"
                                            class="text-primary active">Active
                                            <span class="text-muted"> ({{ $count[0] }}) |</span></a>
                                        <a href="{{ request()->fullUrlWithQuery(['status' => 'inactive']) }}"
                                            class="text-primary inactive">Inactive
                                            <span class="text-muted"> ({{ $count[1] }}) | </span></a>
                                        <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}"
                                            class="text-primary trash">Trash
                                            <span class="text-muted"> ({{ $count[2] }})
                                            </span></a>
                                    </div>
                                </div>

                                <div class="card-block pt-0">
                                    <form action="{{ url('admin/user/action') }}" method="POST">
                                        @csrf
                                        <div class="form-action form-inline pt-3 pb-3">
                                            <select class="form-control form-control-sm mr-1" name="act">
                                                <option selected="" disabled>select</option>
                                                @foreach ($list_act as $k => $act)
                                                    <option value="{{ $k }}">{{ $act }}</option>
                                                @endforeach
                                            </select>
                                            <input type="submit" name="btn_action" value="Áp dụng"
                                                class="btn btn-sm btn-primary m-0">
                                        </div>
                                        <div class="table-responsive">
                                            <table id="fixed-header"
                                                class="display table table-checkall nowrap table-striped table-hover tbl-list-user"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        {{-- <th><input type="checkbox" name="checkall"></th> --}}
                                                        <th>STT</th>
                                                        <th>Avatar</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Created date</th>
                                                        <th>Status</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $t = 0;
                                                    @endphp

                                                    @foreach ($users as $user)
                                                        <tr>
                                                            {{-- <td class="check"><input type="checkbox"
                                                                    name="list_check[]" value="{{ $user->id }}"></td> --}}
                                                            @php
                                                                $t++;
                                                            @endphp
                                                            <td><b>{{ $t }}</b></td>
                                                            @if ($user->avatar != null)
                                                                <td><img style="width: 50px"
                                                                        src="{{ asset('admin/images/users/' . $user->avatar) }}"
                                                                        alt="img avatar"></td>

                                                            @else
                                                                {{-- show image default follow gender --}}
                                                                <td>
                                                                    <img style="width: 50px"
                                                                        src="{{ asset(show_string_avatar($user->gender)) }}"
                                                                        alt="img avatar">
                                                                </td>

                                                            @endif
                                                            <td>{{ $user->name }}</td>
                                                            <td>
                                                                {{ $user->email }}
                                                            </td>
                                                            <td>{{ $user->created_at }}</td>
                                                            <td class="status">
                                                                {!! Auth::id() == $user->id ? show_status_user_current($user->id) : show_status_user($user->status, $user->id) !!}
                                                            </td>
                                                            {{-- <td>
                                                                <button class="btn btn-primary btn-sm btn-action md-trigger"
                                                                    type="button" data-modal="modal-7">
                                                                    <i class="feather icon-edit f-16  text-c-green"></i>
                                                                </button>

                                                                @if (Auth::id() != $user->id)
                                                                    <a class="btn btn-danger btn-sm btn-action"
                                                                        href="{{ route('delete_user', $user->id) }}"
                                                                        onclick="return confirm('Bạn có chắc chắc muốn xóa tài khoản này?')">
                                                                        <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                                    </a>
                                                                @endif
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        {{-- <th><input type="checkbox" name="checkall"></th> --}}
                                                         <th>STT</th>
                                                        <th>Avatar</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Created date</th>
                                                        <th>Status</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </tfoot>
                                            </table>
                                    </form>
                                </div>{{-- ENd card block --}}
                            </div>{{-- End card --}}
                        </div>
                    </div>
                </div>{{-- end page-wrapper --}}
            </div>{{-- end main-body --}}
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
    @include('admin.user.edit')
@endsection


@section('add_js')
    <script src="{{ asset('admin/plugins/data-tables/js/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/pages/tbl-datatable-custom.js') }}"></script> --}}

    {{-- custom ajax --}}
    <script src="{{ asset('admin/js/pages/user.js') }}"></script>

    {{-- edit --}}
    <script src="{{ asset('admin/plugins/modal-window-effects/js/classie.js') }}"></script>
    <script src="{{ asset('admin/plugins/modal-window-effects/js/modalEffects.js') }}"></script>

    <script>
        $(document).ready(function() {
            function getParameter(parameterName) {
                let parameters = new URLSearchParams(window.location.search);
                return parameters.get(parameterName);
            }

            // change status
            $("table td.status input").on("change", function() {
                var status = $(this).prop('checked') == true ? "active" : "inactive";
                var user_id = $(this).data('id');
                // lấy action là trash hay bình thường để lấy User bên controller
                var action = getParameter('status');
                data = {
                    status: status,
                    user_id: user_id,
                    action: action
                };

                $.ajax({
                    url: '{{ route('change_status_user') }}',
                    type: 'GET',
                    data: data, // Dữ liệu truyền lên Server
                    dataType: 'JSON', // html, text, json
                    success: function(response) {
                        if (response.status == "true") {

                            // display count number record
                            $(".analytic a.active span").text(" (" + response.count[0] + ") |");
                            $(".analytic a.inactive span").text(" (" + response.count[1] + ") |");
                            $(".analytic a.trash span").text(" (" + response.count[2] + ")");
                            var table = $('table').DataTable({
                                ajax: "{{ route('index_user') }}",
                                // data -> tên các cột trong database và phải theo thứ tự cột của datable
                                // name -> tên cột dùng trong controller
                                columns: [
                                    // DT_RowIndex: thứ tự tự tăng
                                    {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                                    {'data': "avatar", name: "avatar"},
                                    {'data': "name", name: "name"},
                                    {'data': "email", name: "email"},
                                    {'data': "created_at", name: "created_at"},
                                    {'data': "status", name: "status"},
                                ]
                            });
                            table.ajax.reload();

                            // $('table').DataTable().draw();
                            // show status
                            toastr.options = {
                                'timeOut': 2000
                            }
                            toastr['success']("Thay đổi trạng thái thành công",
                                'Trạng thái');
                        }
                    }
                });
            });

        }); // END JQUERY
    </script>
@endsection

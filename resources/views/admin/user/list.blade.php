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
                                            <input type="submit" name="btn_action" value="??p d???ng"
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
                                                    <th>Avatar</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Created date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $t = 0;
                                                @endphp

                                                @foreach ($users as $user)
                                                    <tr id="item-{{ $user->id }}">
                                                        <td class="check"><input type="checkbox"
                                                                                 name="list_check[]"
                                                                                 value="{{ $user->id }}"></td>
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
                                                        <td>
                                                            <button
                                                                class="btn btn-primary btn-sm btn-action btn-edit md-trigger"
                                                                type="button" data-modal="modal-edit-user"
                                                                data-url="{{ route('user.edit', $user->id) }}"
                                                                data-id="{{ $user->id }}"
                                                                data-stt="{{ $t }}">
                                                                <i class="feather icon-edit f-16  text-c-green"></i>
                                                            </button>

                                                            @if (Auth::id() != $user->id)
                                                                <a class="btn btn-danger btn-sm btn-action btn-delete"
                                                                   href="{{ route('user.delete', $user->id) }}"
                                                                   onclick="return confirm('B???n c?? ch???c ch???n mu???n x??a t??i kho???n n??y?')">
                                                                    <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
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
    <script src="{{ asset('admin/js/pages/tbl-datatable-custom.js') }}"></script>
    {{-- custom ajax --}}
    <script src="{{ asset('admin/js/pages/user.js') }}"></script>

    {{-- edit --}}
    <script src="{{ asset('admin/plugins/modal-window-effects/js/classie.js') }}"></script>
    <script src="{{ asset('admin/plugins/modal-window-effects/js/modalEffects.js') }}"></script>
    {{-- <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> --}}
    <script>
        $(document).ready(function () {
            // fixed header for talbe
            var table = $('#users-table').dataTable();
            new $.fn.dataTable.FixedHeader(table);

            // D??ng ????? l???y action tr??n url
            function getParameter(parameterName) {
                let parameters = new URLSearchParams(window.location.search);
                return parameters.get(parameterName);
            }

            // change status
            function change_status() {
                $(document).on("change", 'table#users-table td.status input', function () {
                    // get status
                    var status = $(this).prop('checked') == true ? "active" : "inactive";
                    var user_id = $(this).data('id');
                    // l???y action l?? trash hay b??nh th?????ng ????? l???y User b??n controller
                    var action = getParameter('status');
                    var _this = $(this);

                    data = {
                        status: status,
                        user_id: user_id,
                        action: action
                    };

                    $.ajax({
                        url: '{{ route('user.change_status') }}',
                        type: 'GET',
                        data: data, // D??? li???u truy???n l??n Server
                        dataType: 'JSON', // html, text, json
                        success: function (response) {
                            if (response.status == "true") {
                                // display count number record
                                $(".analytic a.active span").text(" (" + response.count[0] +
                                    ") |");
                                $(".analytic a.inactive span").text(" (" + response.count[1] +
                                    ") |");
                                $(".analytic a.trash span").text(" (" + response.count[2] +
                                    ")");

                                // Lo???i b??? th??? v???a thay ?????i tr???ng th??i, n???u l?? trash th?? ko
                                if (action != 'trash') {
                                    // reload data b???ng sau khi x??a
                                    var item = $('tr#item-' + response.id);
                                    var table = $('#users-table').DataTable();
                                    table.row(item).remove().draw();

                                }

                                // show status
                                toastr.options = {
                                    // set time out
                                    'timeOut': 2000
                                }
                                toastr['success']("Thay ?????i tr???ng th??i th??nh c??ng",
                                    'Tr???ng th??i');
                            }
                        }
                    });
                });
            }

            // show info edit
            function edit() {
                $(document).on("click", "button.btn-edit", function (e) {
                    // ????a modal v??? m???c ?????nh
                    e.preventDefault();
                    // Ph???i th??m class md-show n??y v?? v?? khi update ???? b??? x??a
                    $('#modal-edit-user').addClass('md-show');
                    // L???y url t??? data-url k??m id b???n ghi ????? d??? controller l???y ??c id
                    var url = $(this).attr('data-url');
                    // l???y action ????? bi???t n???u ??ang ??? tr???ng th??i trash th?? show dl theo trash
                    var action = getParameter('status');
                    var data = {
                        action: action
                    };

                    // L???y th??ng tin user ??ang login ????? disable tr???ng th??i
                    var user_login = {!! Auth()->user() !!};
                    // L???y id c?? trong view list
                    var id = $(this).data('id');
                    var stt = $(this).data('stt');

                    $.ajax({
                        //ph????ng th???c get
                        type: 'get',
                        url: url,
                        data: data,
                        beforeSend: function () {
                            // N???u c??i status c?? id edit == id ????ng nh???p th?? disable n??
                            if (user_login['id'] === id) {
                                $('select#status-edit').attr('disabled', 'disabled');
                            } else {
                                $('select#status-edit').removeAttr('disabled');
                            }
                            // L??m m???i l???i modal m???i l???n load l??n
                            $('#form-edit').find('span.error-text').text('');
                            $('#form-edit').trigger('reset');
                            $('.file-avatar label.custom-file-label').text('Ch???n file');
                        },
                        success: function (response) {
                            // ---- Xu???t d??? li???u ????a l??n modal ----
                            $('#name-edit').val(response.data.name);
                            $('#email-edit').val(response.data.email);
                            // gender
                            if (response.data.gender === "male") {
                                // x??a checked ???? check tr?????c
                                $('#female-edit').removeAttr('checked');
                                $('#male-edit').attr('checked', 'true');
                            } else {
                                $('#male-edit').removeAttr('checked');
                                $('#female-edit').attr('checked', 'true');
                            }
                            //select status
                            if (response.data.status === "active") {
                                $('#status-edit option[value="active"]').attr('selected',
                                    'selected');
                            } else {
                                $('#status-edit option[value="inactive"]').attr('selected',
                                    'selected');
                            }
                            // phone
                            $(".phone").inputmask({
                                mask: "9999-999-999"
                            });
                            $('#phone-edit').val(response.data.phone);
                            $('#address-edit').val(response.data.address);

                            // avatar: N???u c?? avatar th?? hi???n th??? ra :  h??nh th?? m???c ?????nh
                            if (response.data.avatar != null) {
                                $("img#up-img").attr('src',
                                    '{{ URL::asset('admin/images/users') }}' + "/" +
                                    response.data.avatar);
                            } else {
                                $("img#up-img").attr('src',
                                    '{{ URL::asset('admin/images/user/150.png') }}');
                            }

                            // Th??m data-url ch???a route s???a ???? ???????c ch??? ?????nh v??o modal form edit v???a hi???n l??n
                            $('#form-edit').attr('data-url',
                                '{{ URL::to('admin/user/update') }}/' +
                                response.data.id);
                            $('#form-edit').attr('data-id',
                                response.data.id);
                            $('#form-edit').attr('data-stt', stt);
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
                    var url = $(this).attr('data-url');
                    var status_url = getParameter('status');

                    var form_data = new FormData(form);
                    // G???i tr???ng th??i hi???n t???i tr??n url l?? trash hay g?? ????? l???y d??? li???u ra
                    form_data.append('status_url', status_url);
                    var stt = $(form).data('stt');
                    form_data.append('stt', stt);

                    // L???y th??ng tin user ??ang login g???i status cho controller ????? c?? gi?? tr???
                    // v?? khi g???i qua formData th?? tr?????ng b??? disable s??? ko l???y ??c gi?? tr???
                    var user_login = {!! Auth()->user() !!};

                    // L???y id trong form ????? so s??nh
                    var id = $(form).data('id');
                    // N???u c??i status c?? id edit == id ????ng nh???p add gi?? tr??? c?? cho n?? ????? g???i ??i
                    if (user_login['id'] === id) {
                        var active = 'active';
                        form_data.append('status_edit', active);
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: form_data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        // Tr?????c khi g???i lo???i nh???ng error validator ra
                        beforeSend: function () {
                            $(form).find('span.error-text').text('');
                        },
                        success: function (response) {
                            if (response.code === 0) {
                                // M???i tr?????ng l???i t??? response s??? ???ng v???i class error b??n form: class = name_edit_error => xu???t l???i ra
                                $.each(response.error, function (prefix, val) {
                                    $(form).find('span.' + prefix + '_error').text(val[
                                        0]);
                                });
                            } else {
                                if (response.code === 1) {
                                    if (response.html !== '') {
                                        $('tr#item-' + response.id).html(response.html);
                                    } else {
                                        // $('tr#item-' + response.id).hide();
                                        // reload l???i data b???ng sau khi remove n??
                                        var item = $('tr#item-' + response.id);
                                        var table = $('#users-table').DataTable();
                                        table.row(item).remove().draw();
                                    }
                                }
                                // reset form
                                $(form).trigger('reset');
                                // ????ng modal
                                $('#modal-edit-user').removeClass('md-show');
                                // show status
                                toastr.options = {
                                    // set time out
                                    'timeOut': 2000
                                }
                                toastr['success']("C???p nh???t b???n ghi th??nh c??ng",
                                    'C???p nh???t');
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            //x??? l?? l???i t???i ????y
                        }
                    });

                });
            }

            // th???c thi function
            change_status();
            edit();
            update();

        }); // END JQUERY
    </script>
@endsection

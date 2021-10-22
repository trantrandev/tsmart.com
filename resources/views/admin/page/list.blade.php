@extends('layouts.admin')

@section('content')

    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">PAGES</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#!">List page</a></li>
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
                                    <h5>List page</h5>
                                    <a href="{{ url('admin/page/add') }}" type="button"
                                       class="btn btn-primary waves-effect waves-light float-right d-inline-block">
                                        <i class="feather icon-plus m-r-5"></i> Add page
                                    </a>
                                </div>
                                <div class="card-block ">
                                    <div class="table-responsive">
                                        <table id="pages-table" class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên trang</th>
                                                <th>Slug</th>
                                                <th>Trạng thái</th>
                                                <th>Người tạo</th>
                                                <th>Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $t = 0;
                                            @endphp
                                            @foreach ($pages as $page)
                                                @php
                                                    $t++;
                                                @endphp
                                                <tr>
                                                    <td><b>{{ $t }}</b></td>
                                                    <td>
                                                        <a href="{{ route('page.edit', $page->id) }}">{{ $page->title }}</a>
                                                    </td>
                                                    <td>{{ $page->slug }}</td>
                                                    <td>{!! show_status_page($page->status) !!}</td>
                                                    <td>{{ $page->user->name ?? '' }}</td>

                                                    <td>
                                                        <a class="btn btn-primary btn-sm btn-action"
                                                           href="{{ route('page.edit', $page->id) }}">
                                                            <i class="feather icon-edit f-16  text-c-green"></i>
                                                        </a>

                                                        <a class="btn btn-danger btn-sm btn-action btn-delete"
                                                           href="{{ route('page.delete', $page->id) }}"
                                                           onclick="return confirm('Bạn có chắc chắn muốn xóa trang này?')">
                                                            <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>{{-- ENd card block --}}
                            </div>{{-- End card --}}
                        </div>
                    </div>
                </div>{{-- end page-wrapper --}}
            </div>{{-- end main-body --}}
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

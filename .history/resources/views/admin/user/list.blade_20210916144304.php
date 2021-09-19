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
                                        class="btn btn-primary waves-effect waves-light float-right d-inline-block md-trigger"
                                        data-modal="modal-13"> <i class="feather icon-plus m-r-5"></i> Add User
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
                                                        <tr>
                                                            <td class="check"><input type="checkbox"
                                                                    name="list_check[]" value="{{ $user->id }}"></td>
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
                                                                <button class="btn btn-primary btn-sm btn-action md-trigger"
                                                                    type="button" data-modal="modal-7">
                                                                    <i class="feather icon-edit f-16  text-c-green"></i>
                                                                </button>
                                                                <div class="md-modal md-effect-7" id="modal-7">
                                                                    <div class="md-content">
                                                                        <h3 class="theme-bg2">Modal Dialog</h3>
                                                                        <div>
                                                                            <p>This is a modal window. You can do the
                                                                                following things with it:</p>
                                                                            <ul>
                                                                                <li><strong>Read:</strong> modal windows
                                                                                    will probably tell you something
                                                                                    important so don't forget to read what
                                                                                    they say.</li>
                                                                                <li><strong>Look:</strong> a modal window
                                                                                    enjoys a certain kind of attention; just
                                                                                    look at it and appreciate its presence.
                                                                                </li>
                                                                                <li><strong>Close:</strong> click on the
                                                                                    button below to close the modal.</li>
                                                                            </ul>
                                                                            <button class="btn btn-primary md-close">Close
                                                                                me!</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @if (Auth::id() != $user->id)
                                                                    <a class="btn btn-danger btn-sm btn-action"
                                                                        href="{{ route('delete_user', $user->id) }}"
                                                                        onclick="return confirm('Bạn có chắc chắc muốn xóa tài khoản này?')">
                                                                        <i class="feather icon-trash-2 f-16 text-c-red"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
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

    {{-- test --}}

    <body>
        


        <header class="navbar pcoded-header navbar-expand-lg navbar-light">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
                <a href="index.html" class="b-brand">
                    <div class="b-bg">
                        <i class="feather icon-trending-up"></i>
                    </div>
                    <span class="b-title">Datta Able</span>
                </a>
            </div>
            <a class="mobile-menu" id="mobile-header" href="#!">
                <i class="feather icon-more-horizontal"></i>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                                class="feather icon-maximize"></i></a></li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Dropdown</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#!">Action</a></li>
                            <li><a class="dropdown-item" href="#!">Another action</a></li>
                            <li><a class="dropdown-item" href="#!">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <div class="main-search">
                            <div class="input-group">
                                <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                                <a href="#!" class="input-group-append search-close">
                                    <i class="feather icon-x input-group-text"></i>
                                </a>
                                <span class="input-group-append search-btn btn btn-primary">
                                    <i class="feather icon-search input-group-text"></i>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                    class="icon feather icon-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right notification">
                                <div class="noti-head">
                                    <h6 class="d-inline-block m-b-0">Notifications</h6>
                                    <div class="float-right">
                                        <a href="#!" class="m-r-10">mark as read</a>
                                        <a href="#!">clear all</a>
                                    </div>
                                </div>
                                <ul class="noti-body">
                                    <li class="n-title">
                                        <p class="m-b-0">NEW</p>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-1.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>John Doe</strong><span class="n-time text-muted"><i
                                                            class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                                <p>New ticket Added</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="n-title">
                                        <p class="m-b-0">EARLIER</p>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-2.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                            class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                                <p>Prchace New Theme and make payment</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-3.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i
                                                            class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                                <p>currently login</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="noti-footer">
                                    <a href="#!">show all</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="#!" class="displayChatbox"><i class="icon feather icon-mail"></i></a></li>
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon feather icon-settings"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="assets/images/user/avatar-1.jpg" class="img-radius"
                                        alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <a href="auth-signin.html" class="dud-logout" title="Logout">
                                        <i class="feather icon-log-out"></i>
                                    </a>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i>
                                            Settings</a></li>
                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-user"></i> Profile</a>
                                    </li>
                                    <li><a href="message.html" class="dropdown-item"><i class="feather icon-mail"></i> My
                                            Messages</a></li>
                                    <li><a href="auth-signin.html" class="dropdown-item"><i
                                                class="feather icon-lock"></i> Lock Screen</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>


        <section class="header-user-list">
            <div class="h-list-header">
                <div class="input-group">
                    <input type="text" id="search-friends" class="form-control" placeholder="Search Friend . . .">
                </div>
            </div>
            <div class="h-list-body">
                <a href="#!" class="h-close-text"><i class="feather icon-chevrons-right"></i></a>
                <div class="main-friend-cont scroll-div ps ps--active-y">
                    <div class="main-friend-list">
                        <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image ">
                                <div class="live-status">3</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Josephin Doe<small class="d-block text-c-green">Typing . .
                                    </small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Lary Doe<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Alice<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="4" data-status="offline" data-username="Alia">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Alia<small class="d-block text-muted">10 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="5" data-status="offline" data-username="Suzen">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-4.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Suzen<small class="d-block text-muted">15 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image ">
                                <div class="live-status">3</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Josephin Doe<small class="d-block text-c-green">Typing . .
                                    </small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Lary Doe<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Alice<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="4" data-status="offline" data-username="Alia">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Alia<small class="d-block text-muted">10 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="5" data-status="offline" data-username="Suzen">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-4.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Suzen<small class="d-block text-muted">15 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image ">
                                <div class="live-status">3</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Josephin Doe<small class="d-block text-c-green">Typing . .
                                    </small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Lary Doe<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Alice<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="4" data-status="offline" data-username="Alia">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Alia<small class="d-block text-muted">10 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="5" data-status="offline" data-username="Suzen">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-4.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Suzen<small class="d-block text-muted">15 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image ">
                                <div class="live-status">3</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Josephin Doe<small class="d-block text-c-green">Typing . .
                                    </small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Lary Doe<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Alice<small class="d-block text-c-green">online</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="4" data-status="offline" data-username="Alia">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                <div class="live-status">1</div>
                            </a>
                            <div class="media-body">
                                <h6 class="chat-header">Alia<small class="d-block text-muted">10 min ago</small></h6>
                            </div>
                        </div>
                        <div class="media userlist-box" data-id="5" data-status="offline" data-username="Suzen">
                            <a class="media-left" href="#!"><img class="media-object img-radius"
                                    src="assets/images/user/avatar-4.jpg" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <h6 class="chat-header">Suzen<small class="d-block text-muted">15 min ago</small></h6>
                            </div>
                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 332px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 68px;"></div>
                    </div>
                </div>
            </div>
        </section>


        <section class="header-chat">
            <div class="h-list-header">
                <h6>Josephin Doe</h6>
                <a href="#!" class="h-back-user-list"><i class="feather icon-chevron-left"></i></a>
            </div>
            <div class="h-list-body">
                <div class="main-chat-cont scroll-div ps ps--active-y">
                    <div class="main-friend-chat">
                        <div class="media chat-messages">
                            <a class="media-left photo-table" href="#!"><img
                                    class="media-object img-radius img-radius m-t-5" src="assets/images/user/avatar-2.jpg"
                                    alt="Generic placeholder image"></a>
                            <div class="media-body chat-menu-content">
                                <div class="">
									<p class=" chat-cont">hello Datta! Will you tell me something</p>
                                    <p class="chat-cont">about yourself?</p>
                                </div>
                                <p class="chat-time">8:20 a.m.</p>
                            </div>
                        </div>
                        <div class="media chat-messages">
                            <div class="media-body chat-menu-reply">
                                <div class="">
									<p class=" chat-cont">Ohh! very nice</p>
                                </div>
                                <p class="chat-time">8:22 a.m.</p>
                            </div>
                        </div>
                        <div class="media chat-messages">
                            <a class="media-left photo-table" href="#!"><img
                                    class="media-object img-radius img-radius m-t-5" src="assets/images/user/avatar-2.jpg"
                                    alt="Generic placeholder image"></a>
                            <div class="media-body chat-menu-content">
                                <div class="">
									<p class=" chat-cont">can you help me?</p>
                                </div>
                                <p class="chat-time">8:20 a.m.</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 232px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 132px;"></div>
                    </div>
                </div>
            </div>
            <div class="h-list-footer">
                <div class="input-group">
                    <input type="file" class="chat-attach" style="display:none">
                    <a href="#!" class="input-group-prepend btn btn-success btn-attach">
                        <i class="feather icon-paperclip"></i>
                    </a>
                    <input type="text" name="h-chat-text" class="form-control h-send-chat" placeholder="Write hear . . ">
                    <button type="submit" class="input-group-append btn-send btn btn-primary">
                        <i class="feather icon-message-circle"></i>
                    </button>
                </div>
            </div>
        </section>


        <section class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Modal</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html"><i
                                                        class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Advance Components</a></li>
                                            <li class="breadcrumb-item"><a href="#!">Modal</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="main-body">
                            <div class="page-wrapper">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-primary" role="alert">
                                            <p>Use our extra helper file for quick setup Advance Components in your page -
                                                <a href="index-ac-package.html" target="_blank"
                                                    class="alert-link">CHECKOUT</a>
                                            </p>
                                            <label class="text-muted">Copy/paste source code in your page in just
                                                couples of seconds.</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Animeted Model</h5>
                                            </div>
                                            <div class="card-block">
                                                <p>use button with class<code> md-effect-1 to 18</code> to use effect.</p>
                                                <div class="main clearfix">
                                                    <div class="column">
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-1">Fade in &amp; Scale</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-2">Slide in (right)</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-3">Slide in (bottom)</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-4">Newspaper</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-5">Fall</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-6">Side Fall</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-7">Sticky Up</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-8">3D
                                                            Flip (horizontal)</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-9">3D
                                                            Flip (vertical)</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-10">3D
                                                            Sign</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-11">Super Scaled</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-12">Just Me</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-13">3D
                                                            Slit</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-14">3D
                                                            Rotate Bottom</button>
                                                        <button class="btn btn-primary md-trigger" data-modal="modal-15">3D
                                                            Rotate In Left</button>
                                                        <button class="btn btn-primary md-trigger"
                                                            data-modal="modal-16">Blur</button>
                                                        <button class="btn btn-primary md-trigger md-setperspective"
                                                            data-modal="modal-17">Let me in</button>
                                                        <button class="btn btn-primary md-trigger md-setperspective"
                                                            data-modal="modal-18">Make way!</button>
                                                        <button class="btn btn-primary md-trigger md-setperspective"
                                                            data-modal="modal-19">Slip from top</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="md-modal md-effect-1" id="modal-1">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-2" id="modal-2">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-3" id="modal-3">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-4" id="modal-4">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-5" id="modal-5">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-6" id="modal-6">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-7" id="modal-7">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-8" id="modal-8">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-9" id="modal-9">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-10" id="modal-10">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-11" id="modal-11">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-12" id="modal-12">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-13" id="modal-13">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-14" id="modal-14">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-15" id="modal-15">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-16" id="modal-16">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-17" id="modal-17">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-18" id="modal-18">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-19" id="modal-19">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-20" id="modal-20">
            <div class="md-content">
                <h3 class="theme-bg2">Modal Dialog</h3>
                <div>
                    <p>This is a modal window. You can do the following things with it:</p>
                    <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul>
                    <button class="btn btn-primary md-close">Close me!</button>
                </div>
            </div>
        </div>
        <div class="md-overlay"></div>



        <!--[if lt IE 11]>
                    <div class="ie-warning">
                        <h1>Warning!!</h1>
                        <p>You are using an outdated version of Internet Explorer, please upgrade
                           <br/>to any of the following web browsers to access this website.
                        </p>
                        <div class="iew-container">
                            <ul class="iew-download">
                                <li>
                                    <a href="http://www.google.com/chrome/">
                                        <img src="assets/images/browser/chrome.png" alt="Chrome">
                                        <div>Chrome</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                                        <img src="assets/images/browser/firefox.png" alt="Firefox">
                                        <div>Firefox</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.opera.com">
                                        <img src="assets/images/browser/opera.png" alt="Opera">
                                        <div>Opera</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.apple.com/safari/">
                                        <img src="assets/images/browser/safari.png" alt="Safari">
                                        <div>Safari</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                        <img src="assets/images/browser/ie.png" alt="">
                                        <div>IE (11 & above)</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <p>Sorry for the inconvenience!</p>
                    </div>
                <![endif]-->


        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/pcoded.min.js"></script>
        <script src="assets/js/menu-setting.min.js"></script>

        <script src="assets/plugins/modal-window-effects/js/classie.js"></script>
        <script src="assets/plugins/modal-window-effects/js/modalEffects.js"></script>


        <div id="styleSelector" class="menu-styler">
            <div class="style-toggler"><a href="#!"></a></div>
            <div class="style-block">
                <h6 class="mb-2">Datta Able Live Menu Customizer</h6>
                <hr class="my-0">
                <h6>Layouts</h6>
                <div class="theme-color layout-type"><a href="#!" class=" active" data-value="menu-dark"
                        data-toggle="tooltip" title="Default Layout"><span></span><span></span></a><a href="#!"
                        class="" data-value=" menu-light" data-toggle="tooltip"
                        title="Light"><span></span><span></span></a><a href="#!" class="" data-value=" dark"
                        data-toggle="tooltip" title="Dark"><span></span><span></span></a><a href="#!"
                        class="" data-value=" reset" data-toggle="tooltip" title="Reset">Reset to Default</a></div>
                <h6>Prebuild Layout</h6>
                <p class="f-12"><span class="text-c-red">*</span> in Prebuild Layout you redirect to new
                    page</p>
                <div class="theme-color prelayout-color"><a href="index-2.html" class="" data-value=" l2"
                        target="_blank"><span></span><span></span></a><a href="index-2-2.html" class="" data-value=" l2-2"
                        target="_blank"><span></span><span></span></a><a href="index-3.html" class="" data-value=" l3"
                        target="_blank"><span></span><span></span></a><a href="index-4.html" class="" data-value=" l4"
                        target="_blank"><span></span><span></span></a><a href="index-4-2.html" class="" data-value=" l4-2"
                        target="_blank"><span></span><span></span></a><a href="index-5-h.html" class="" data-value=" l5-h"
                        target="_blank"><span></span><span></span></a><a href="index-light.html" class="" data-value="
                        l-lite" target="_blank"><span></span><span></span></a><a href="index-6.html" class="" data-value="
                        l6" target="_blank"><span></span><span></span></a><a href="index-8.html" class="" data-value=" l8"
                        target="_blank"><span></span><span></span></a><a href="index-1.html" class="" data-value=" l1"
                        target="_blank"><span></span><span></span></a></div>
                <div class="form-group mb-3">
                    <div class="switch switch-primary d-inline m-r-10"><input type="checkbox" id="icon-colored"><label
                            for="icon-colored" class="cr"></label></div><label>Icon Color</label>
                </div>
                <ul class="nav nav-pills mb-2" id="pills-cust-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="pills-color-tab" data-toggle="pill"
                            href="#pills-color" role="tab" aria-controls="pills-color" aria-selected="true">Color</a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-pages-tab" data-toggle="pill"
                            href="#pills-pages" role="tab" aria-controls="pills-pages" aria-selected="false">Layout</a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-extra-tab" data-toggle="pill"
                            href="#pills-extra" role="tab" aria-controls="pills-extra" aria-selected="false">Extra</a></li>
                </ul>
                <div class="tab-content ps ps--active-y" id="pills-cust-tabContent"
                    style="height: calc(100vh - 430px); position: relative;">
                    <div class="tab-pane fade show active" id="pills-color" role="tabpanel"
                        aria-labelledby="pills-color-tab">
                        <h6>header background</h6>
                        <div class="theme-color header-color"><a href="#!" class=" active"
                                data-value="header-default"><span></span><span></span></a><a href="#!"
                                class="" data-value=" header-blue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" header-red"><span></span><span></span></a><a href="#!"
                                class="" data-value=" header-purple"><span></span><span></span></a><a href="#!"
                                class="" data-value=" header-lightblue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" header-dark"><span></span><span></span></a></div>
                        <h6>Menu background</h6>
                        <div class="theme-color navbar-color"><a href="#!" class=" active"
                                data-value="navbar-default"><span></span><span></span></a><a href="#!"
                                class="" data-value=" navbar-blue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" navbar-red"><span></span><span></span></a><a href="#!"
                                class="" data-value=" navbar-purple"><span></span><span></span></a><a href="#!"
                                class="" data-value=" navbar-lightblue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" navbar-dark"><span></span><span></span></a></div>
                        <h6>Menu Brand Color</h6>
                        <div class="theme-color brand-color"><a href="#!" class=" active"
                                data-value="brand-default"><span></span><span></span></a><a href="#!"
                                class="" data-value=" brand-blue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" brand-red"><span></span><span></span></a><a href="#!"
                                class="" data-value=" brand-purple"><span></span><span></span></a><a href="#!"
                                class="" data-value=" brand-lightblue"><span></span><span></span></a><a href="#!"
                                class="" data-value=" brand-dark"><span></span><span></span></a></div>
                        <h6>Navbar Image</h6>
                        <div class="theme-color navbar-images"><a href="#!" class="" data-value="
                                navbar-image-1"><span></span><span></span></a><a href="#!" class="" data-value="
                                navbar-image-2"><span></span><span></span></a><a href="#!" class="" data-value="
                                navbar-image-3"><span></span><span></span></a><a href="#!" class="" data-value="
                                navbar-image-4"><span></span><span></span></a><a href="#!" class="" data-value="
                                navbar-image-5"><span></span><span></span></a></div>
                    </div>
                    <div class="tab-pane fade" id="pills-pages" role="tabpanel" aria-labelledby="pills-pages-tab">
                        <div class="form-group mb-0">
                            <div class="switch switch-primary d-inline m-r-10"><input type="checkbox" id="theme-rtl"><label
                                    for="theme-rtl" class="cr"></label></div><label>RTL</label>
                        </div>
                        <div class="form-group mb-0">
                            <div class="switch switch-primary d-inline m-r-10"><input type="checkbox" id="menu-fixed"
                                    checked=""><label for="menu-fixed" class="cr"></label></div><label>Menu
                                Fixed</label>
                        </div>
                        <div class="form-group mb-0">
                            <div class="switch switch-primary d-inline m-r-10"><input type="checkbox"
                                    id="header-fixed"><label for="header-fixed" class="cr"></label></div>
                            <label>Header Fixed</label>
                        </div>
                        <div class="form-group mb-0">
                            <div class="switch switch-primary d-inline m-r-10"><input type="checkbox"
                                    id="box-layouts"><label for="box-layouts" class="cr"></label></div>
                            <label>Box Layouts</label>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-extra" role="tabpanel" aria-labelledby="pills-extra-tab">
                        <h6>Menu Dropdown Icon</h6>
                        <div class="theme-color">
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in-1"
                                        id="drpicon-1" checked="" onchange="drpicon('style1')"><label for="drpicon-1"
                                        class="cr"><i class="feather icon-chevron-right"></i></label></div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in-1"
                                        id="drpicon-2" onchange="drpicon('style2')"><label for="drpicon-2"
                                        class="cr"><i class="feather icon-chevrons-right"></i></label></div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in-1"
                                        id="drpicon-3" onchange="drpicon('style3')"><label for="drpicon-3"
                                        class="cr"><i class="feather icon-plus"></i></label></div>
                            </div>
                        </div>
                        <h6>Menu List Icon</h6>
                        <div class="theme-color">
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-1" checked="" onchange="menuitemicon('style1')"><label for="subitem-1"
                                        class="cr"><i class=" "> </i> </label></div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-2" onchange="menuitemicon('style2')"><label for="subitem-2"
                                        class="cr"><i class="feather icon-minus"></i></label></div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-3" onchange="menuitemicon('style3')"><label for="subitem-3"
                                        class="cr"><i class="feather icon-check"></i></label></div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-4" onchange="menuitemicon('style4')"><label for="subitem-4"
                                        class="cr"><i class="icon feather icon-corner-down-right"></i></label>
                                </div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-5" onchange="menuitemicon('style5')"><label for="subitem-5"
                                        class="cr"><i class="icon feather icon-chevrons-right"></i></label>
                                </div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-primary d-inline"><input type="radio" name="radio-in"
                                        id="subitem-6" onchange="menuitemicon('style6')"><label for="subitem-6"
                                        class="cr"><i class="icon feather icon-chevron-right"></i></label>
                                </div>
                            </div>
                        </div>
                        <h6>Active Color</h6>
                        <div class="theme-color active-color small"><a href="#!" class=" active"
                                data-value="active-default"></a><a href="#!" class="" data-value=" active-blue"></a><a
                                href="#!" class="" data-value=" active-red"></a><a href="#!" class="" data-value="
                                active-purple"></a><a href="#!" class="" data-value=" active-lightblue"></a><a href="#!"
                                class="" data-value=" active-dark"></a></div>
                        <h6>Menu Title Color</h6>
                        <div class="theme-color title-color small"><a href="#!" class=" active"
                                data-value="title-default"></a><a href="#!" class="" data-value=" title-blue"></a><a
                                href="#!" class="" data-value=" title-red"></a><a href="#!" class="" data-value="
                                title-purple"></a><a href="#!" class="" data-value=" title-lightblue"></a><a href="#!"
                                class="" data-value=" title-dark"></a></div>
                        <div class="form-group mb-0">
                            <div class="switch switch-primary d-inline m-r-10"><input type="checkbox"
                                    id="caption-hide"><label for="caption-hide" class="cr"></label></div>
                            <label>Menu Title Hide</label>
                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 30px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: -10px; height: 40px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection


@section('add_js')
    <script src="{{ asset('admin/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tbl-datatable-custom.js') }}"></script>

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
                    success: function(data) {
                        if (data.status == "true") {
                            // display count number record
                            $(".analytic a.active span").text(" (" + data.count[0] + ") |");
                            $(".analytic a.inactive span").text(" (" + data.count[1] + ") |");
                            $(".analytic a.trash span").text(" (" + data.count[2] + ")");

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
    {{-- @include('admin.user.edit') --}}
@endsection

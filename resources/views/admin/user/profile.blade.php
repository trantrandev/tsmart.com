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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.list') }}">User</a></li>
                                <li class="breadcrumb-item"><a href="#!">Profile</a></li>
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
                                    <h5>Profile</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card user-card user-card-1">
                                                <div class="card-body pb-0">
                                                    <div class="media user-about-block align-items-center mt-0 mb-3">
                                                        <div class="position-relative d-inline-block">
                                                            @if ($user->avatar != null)
                                                                <img class="img-radius img-fluid wid-80"
                                                                    src="{{ asset('admin/images/users/' . $user->avatar) }}"
                                                                    alt="User image">
                                                            @else
                                                                <img class="img-radius img-fluid wid-80"
                                                                    src="{{ asset(show_string_avatar($user->gender)) }}"
                                                                    alt="User image">
                                                            @endif
                                                        </div>

                                                        <div class="media-body ml-3">
                                                            <h6 class="mb-1">{{ $user->name }}</h6>
                                                            <p class="mb-0 text-muted">Administrator</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="f-w-500"><i
                                                                class="feather icon-mail m-r-10"></i>Email</span>
                                                        <span class="text-body float-right">{{ $user->email }}</span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="f-w-500"><i
                                                                class="feather icon-phone-call m-r-10"></i>Phone</span>
                                                        <span
                                                            class="float-right text-body">{{ show_phone_number($user->phone) }}</span>
                                                    </li>
                                                    <li class="list-group-item border-bottom-0">
                                                        <span class="f-w-500"><i
                                                                class="feather icon-map-pin m-r-10"></i>Address</span>
                                                        <span class="float-right">{{ $user->address }}</span>
                                                    </li>
                                                </ul>

                                                {{-- list group item --}}
                                                <div class="nav flex-column nav-pills list-group list-group-flush list-pills"
                                                    id="user-set-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link list-group-item active list-group-item-action"
                                                        id="user-set-information-tab" data-toggle="pill"
                                                        href="#user-set-information" role="tab"
                                                        aria-controls="user-set-information" aria-selected="true">
                                                        <span class="f-w-500"><i
                                                                class="feather icon-user m-r-10 h5 "></i>Personal
                                                            Information</span>
                                                        <span class="float-right"><i
                                                                class="feather icon-chevron-right"></i></span>
                                                    </a>
                                                    <a class="nav-link list-group-item list-group-item-action"
                                                        id="user-set-passwort-tab" data-toggle="pill"
                                                        href="#user-set-passwort" role="tab"
                                                        aria-controls="user-set-passwort" aria-selected="false">
                                                        <span class="f-w-500"><i
                                                                class="feather icon-shield m-r-10 h5 "></i>Change
                                                            Password</span>
                                                        <span class="float-right"><i
                                                                class="feather icon-chevron-right"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- tab-pane --}}
                                        <div class="col-lg-8">
                                            <div class="tab-content bg-transparent p-0 shadow-none"
                                                id="user-set-tabContent">
                                                {{-- tab pane Personal information --}}
                                                <div class="tab-pane fade show active" id="user-set-information"
                                                    role="tabpanel" aria-labelledby="user-set-information-tab">
                                                    <div class="card">
                                                        <form action="updateProfile" method="POST" accept-charset="UTF-8"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <section>
                                                                <div class="card-header">
                                                                    <h5>
                                                                        <i class="feather icon-user text-c-blue wid-20"></i>
                                                                        <span class="p-l-5">Personal
                                                                            Information</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body pb-1 pt-2">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="name">Name
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control"
                                                                                    name="name" id="name"
                                                                                    value="{{ $user->name }}">
                                                                                @error('name')
                                                                                    <span class="text-danger d-block mt-1"
                                                                                        style="font-size: 13px">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Gender <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="gender">
                                                                                    <option
                                                                                        {{ $user->gender == 'male' ? 'selected' : '' }}
                                                                                        value="male">Male</option>
                                                                                    <option
                                                                                        {{ $user->gender == 'female' ? 'selected' : '' }}
                                                                                        value="female">Female</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="custom-file-label"
                                                                                    for="avatar"
                                                                                    style="margin: 0 15px;">Chọn
                                                                                    file</label>
                                                                                <input type="file" class="custom-file-input"
                                                                                    accept="image/*" id="up-avatar"
                                                                                    name="avatar">

                                                                                @error('avatar')
                                                                                    <span class="text-danger d-block mt-1"
                                                                                        style="font-size: 13px">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            @if ($user->avatar != null)
                                                                                <img src="{{ asset('admin/images/users/' . $user->avatar) }}"
                                                                                    class=""
                                                                                id="up-img" alt="up-img" style=" max-width:
                                                                                150px;">
                                                                            @else
                                                                                <img src="{{ asset('admin/images/user/150.png') }}"
                                                                                    class="" style=" max-width:
                                                                                    150px;" id="up-img" alt="up-img">
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            {{-- contact --}}
                                                            <section>
                                                                <div class="card-header">
                                                                    <h5><i
                                                                            class="feather icon-map-pin text-c-blue wid-20"></i><span
                                                                            class="p-l-5">Contact
                                                                            Information</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body pt-2 pb-1">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="phone">Contact
                                                                                    Phone</label>
                                                                                <input type="text" id="phone" name="phone"
                                                                                    class="form-control phone"
                                                                                    data-mask="9999-999-999"
                                                                                    value="{{ $user->phone }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="form-label">Address</label>
                                                                                <textarea class="form-control"
                                                                                    name="address">{{ $user->address }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <div class="card-footer text-right p-1">
                                                                <button class="btn btn-primary">Update Profile</button>
                                                                <button class="btn btn-outline-dark ml-2"
                                                                    type="reset">Clear</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="user-set-passwort" role="tabpanel"
                                                    aria-labelledby="user-set-passwort-tab">
                                                    <div class="card">
                                                        <form action="{{ route('user.change_password') }}" method="POST">
                                                            @csrf
                                                            <div class="card-header">
                                                                <h5><i data-feather="lock"
                                                                        class="icon-svg-primary wid-20"></i><span
                                                                        class="p-l-5">Change Password</span></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="current-password">Current Password
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" id="current-password"
                                                                                name="current_password"
                                                                                class="form-control"
                                                                                placeholder="Enter Your current password">
                                                                            <small class="form-text text-muted">Forgot
                                                                                password? <a href="#!">Click
                                                                                    here</a></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="new-password">New Password <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" id="new-password"
                                                                                name="new_password" class="form-control"
                                                                                placeholder="Enter New password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="confirm-password">Confirm Password
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" id="confirm-password"
                                                                                name="confirm_password"
                                                                                class="form-control"
                                                                                placeholder="Enter your password again">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-right">
                                                                <button class="btn btn-danger" type="submit">Change
                                                                    Password</button>
                                                                <button class="btn btn-outline-dark ml-2"
                                                                    type="reset">Clear</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- end tab-pane change password --}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- end main-body --}}

        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

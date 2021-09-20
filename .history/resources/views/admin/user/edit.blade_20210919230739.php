<div class="md-modal md-effect-7 scroll-div modal-edit-user" id="modal-edit-user">
    <div class="md-content">
        <h3 class="theme-bg2">Edit User</h3>
        <div>
            {!! Form::open(['METHOD' => 'POST', 'files' => 'TRUE', 'id' => 'form-edit']) !!}
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('name-edit', 'Name') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name input', 'id' => 'name-edit']) !!}
                    @error('name_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('password-edit', 'Password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password-edit']) !!}
                    @error('password_edit')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('confirm-password-edit', 'Confirm-password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'Password confirm', 'name' => 'confirm_password', 'id' => 'confirm-password-edit']) !!}
                    @error('confirm_password_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('email-edit', 'Email') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email-edit', 'disabled' ]) !!}
                    @error('email_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('gender', 'Gender') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input"
                                type="radio" name="gender" id="male-edit" value="male"> Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input"
                                type="radio" name="gender" id="female-edit" value="female"> Female
                        </label>
                    </div>
                    @error('gender_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('status', 'Status') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    <select name="status_edit" id="status-edit" class="form-control">
                        <option value="" disabled selected>Select status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('phone-edit', 'Phone') !!}
                </div>
                <div class="col-sm-10">
                    {!! Form::text('phone', '', ['class' => ['form-control', 'phone'], 'placeholder' => 'Phone input', 'data-mask' => '9999-999-999', 'id' => 'phone-edit']) !!}
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('address-edit', 'Adress') !!}
                </div>
                <div class="col-sm-10">
                    {!! Form::textarea('address', '', ['class' => 'form-control', 'rows' => 'auto','id' => 'address-edit']) !!}
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('avatar', 'Avatar') !!}
                </div>
                <div class="col-sm-10">
                    <input type="file" class="custom-file-input" accept="image/*" id="up-avatar" name="avatar-edit">
                    <label class="custom-file-label" for="avatar" style="margin: 0 15px">Chọn
                        file</label>
                    <img src="{{ asset('admin/images/user/150.png') }}" class="mt-2"
                        style="max-width: 150px;" id="up-img" alt="up-img">
                    @error('avatar_edit')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            {{-- button submit --}}
            <div class="form-group row align-items-center">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    {!! Form::submit('Update', ['class' => ['btn', 'btn-primary', 'btn-sm', 'mb-0'], 'name' => 'btn_update_edit']) !!}
                    <button class="btn btn-dark md-close btn-sm d-inline-block" type="button" style="font-size: 13px">Close !</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="md-overlay"></div>
<script>
    $(document).ready(function() {
        new PerfectScrollbar('.modal-edit-user.scroll-div', {
            wheelSpeed: .5,
            swipeEasing: 0,
            suppressScrollX: !0,
            wheelPropagation: 1,
            minScrollbarLength: 40,
        });


    });
</script>

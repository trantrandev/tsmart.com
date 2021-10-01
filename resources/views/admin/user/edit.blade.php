<div class="md-modal md-effect-7 scroll-div" id="modal-edit-user">
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
                    {!! Form::text('name-edit', '', ['class' => 'form-control', 'placeholder' => 'Name input', 'name' => 'name_edit']) !!}
                    <span class="text-danger d-block mt-1 error-text name_edit_error" style="font-size: 13px"></span>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('password-edit', 'Password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::password('password-edit', ['class' => 'form-control', 'placeholder' => 'Password', 'name' => 'password_edit']) !!}
                    <span class="text-danger d-block mt-1 error-text password_edit_error"
                        style="font-size: 13px"></span>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('confirm-password-edit', 'Confirm-password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::password('confirm-password-edit', ['class' => 'form-control', 'placeholder' => 'Password confirm', 'name' => 'confirm_password_edit']) !!}
                    <span class="text-danger d-block mt-1 error-text confirm_password_edit_error"
                        style="font-size: 13px"></span>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('email-edit', 'Email') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::email('email-edit', '', ['class' => 'form-control', 'placeholder' => 'Email', 'disabled', 'name' => 'email_edit']) !!}
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('gender-edit', 'Gender') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender_edit" id="male-edit" value="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender_edit" id="female-edit"
                                value="female"> Female
                        </label>
                    </div>
                    <span class="text-danger d-block mt-1 error-text gender_edit_error" style="font-size: 13px"></span>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('status-edit', 'Status') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    <select name="status_edit" id="status-edit" class="form-control">
                        <option value="" disabled>Select status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span class="text-danger d-block mt-1 error-text status_edit_error" style="font-size: 13px"></span>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('phone-edit', 'Phone') !!}
                </div>
                <div class="col-sm-10">
                    {!! Form::text('phone-edit', '', ['class' => ['form-control', 'phone'], 'placeholder' => 'Phone input', 'data-mask' => '9999-999-999', 'name' => 'phone_edit']) !!}
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('address-edit', 'Adress') !!}
                </div>
                <div class="col-sm-10">
                    {!! Form::textarea('address-edit', '', ['class' => 'form-control', 'rows' => 'auto', 'name' => 'address_edit']) !!}
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('avatar', 'Avatar') !!}
                </div>
                <div class="col-sm-10 file-avatar">
                    <input type="file" class="custom-file-input" accept="image/*" id="up-avatar" name="avatar_edit">
                    <label class="custom-file-label" for="avatar" style="margin: 0 15px">Chọn
                        file</label>
                    <img src="{{ asset('admin/images/user/150.png') }}" class="mt-2"
                        style="max-width: 150px;" id="up-img" alt="up-img">
                    <span class="text-danger d-block mt-1 error-text avatar_edit_error" style="font-size: 13px"></span>
                </div>
            </div>


            {{-- button submit --}}
            <div class="form-group row align-items-center">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    {!! Form::submit('Update', ['class' => ['btn', 'btn-primary', 'btn-sm', 'mb-0'], 'name' => 'btn_update_edit']) !!}
                    <button class="btn btn-dark md-close btn-sm d-inline-block" type="button"
                        style="font-size: 13px">Close !</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- màng chắn --}}
<div class="md-overlay"></div>
<script>
    $(document).ready(function() {
        // sử dụng function trong vendor-all.min.js
        new PerfectScrollbar('#modal-edit-user.scroll-div', {
            wheelSpeed: .5,
            swipeEasing: 0,
            suppressScrollX: !0,
            wheelPropagation: 1,
            minScrollbarLength: 40,
        });


    });
</script>

<div class="md-modal md-effect-7" id="modal-7">
    <div class="md-content">
        <h3 class="theme-bg2">Edit User</h3>
        <div>
            {!! Form::open() !!}
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('name', 'Name') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name input', 'value' => 'old(name)']) !!}
                    @error('name')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('password', 'Password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    @error('password')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('confirm-password', 'Confirm-password') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'Password confirm', 'name' => 'confirm_password']) !!}
                    @error('confirm_password')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('email', 'Email') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'value' => 'old(email)']) !!}
                    @error('email')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('gender', 'Gender') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" {{ old('gender') == 'male' ? 'checked' : '' }}
                                type="radio" name="gender" id="male" value="male"> Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" {{ old('gender') == 'female' ? 'checked' : '' }}
                                type="radio" name="gender" id="female" value="female"> Female
                        </label>
                    </div>
                    @error('gender')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-sm-3">
                    {!! Form::label('status', 'Status') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-9">
                    <select name="status" id="" class="form-control">
                        <option value="" disabled selected>Select status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row  align-items-center ">
                <div class="col-sm-3">
                    {!! Form::label('phone', 'Phone') !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::text('phone', '', ['class' => ['form-control', 'phone'], 'placeholder' => 'Phone input', 'data-mask' => '9999-999-999', 'value' => 'old(phone)']) !!}
                </div>
            </div>
            <div class="form-group row  align-items-center ">
                <div class="col-sm-3">
                    {!! Form::label('address', 'Adress') !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::textarea('address', '', ['class' => 'form-control', 'rows' => 'auto', 'value' => 'old(address)']) !!}
                </div>
            </div>
            <div class="form-group row  align-items-center ">
                <div class="col-sm-3">
                    {!! Form::label('avatar', 'Avatar') !!}
                </div>
                <div class="col-sm-9">
                    <input type="file" class="custom-file-input" accept="image/*" id="up-avatar" name="avatar">
                    <label class="custom-file-label" for="avatar" style="margin: 0 15px">Chọn
                        file</label>
                    <img src="{{ asset('admin/images/user/150.png') }}" class="mt-2"
                        style="max-width: 150px;" id="up-img" alt="up-img">
                    @error('avatar')
                        <span class="text-danger d-block mt-1" style="font-size: 13px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="md-overlay"></div>

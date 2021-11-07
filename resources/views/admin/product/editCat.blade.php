<div class="md-modal md-effect-7 scroll-div" id="modal-edit-product-cat">
    <div class="md-content">
        <h3 class="theme-bg2">Chỉnh sửa danh mục</h3>
        <div>
            {!! Form::open(['id' => 'form-edit', 'autocomplete'=>"off"]) !!}
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {!! Form::label('name-edit', 'Name') !!}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::text('name-edit', '', ['class' => 'form-control', 'placeholder' => 'Name input', 'name' => 'name_edit', 'onkeyup'=> 'changeToSlug("name-edit", "slug-edit")']) !!}
                    <span class="text-danger d-block mt-1 error-text name_edit_error" style="font-size: 13px"></span>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {{ Form::label('slug-edit', 'Slug danh mục') }}
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    {!! Form::text('slug-edit', old('slug_edit'), ['class' => 'form-control', 'placeholder' => 'Nhập slug', 'name' => 'slug_edit']) !!}
                    <span class="text-danger d-block mt-1 error-text slug_edit_error" style="font-size: 13px"></span>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {{ Form::label('cat-edit', 'Danh mục cha') }}
                </div>
                <div class="col-sm-10">
                    <select class="form-select form-control" name="cat_edit" id="cat-edit" disabled>
                        <option value="0">Danh mục cha</option>
                        @foreach($list_cat as $cat)
                            <option
                                value="{{ $cat->id }}">{{ show_categories($cat->level, $cat->name)  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    {{ Form::label('status-edit', 'Trạng thái') }}
                </div>
                <div class="col-sm-10">
                    {{ Form::select('status-edit', ['active'=>'kích hoạt','inactive'=>'Vô hiệu hóa'], '', ['name' => 'status_edit', 'class' => 'form-control']) }}
                </div>
            </div>

            {{-- button submit --}}
            <div class="form-group row align-items-center">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    {!! Form::submit('Cập nhật', ['class' => ['btn', 'btn-primary', 'btn-sm', 'mb-0'], 'name' => 'btn_update_edit']) !!}
                    <button class="btn btn-dark md-close btn-sm d-inline-block" type="button"
                            style="font-size: 13px">Đóng !
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- màng chắn --}}
<div class="md-overlay"></div>


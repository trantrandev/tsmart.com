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
                                    <h5>Add page</h5>
                                </div>
                                <div class="card-block ">
                                    {!! Form::open(['method' => 'POST', 'url' => 'admin/page/store']) !!}
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2">
                                            {!! Form::label('title', 'title page') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Name input', 'onkeyup'=> 'changeToSlug("title")']) !!}
                                            @error('title')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2">
                                            {!! Form::label('slug', 'Slug') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'Slug input']) !!}
                                            @error('slug')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2">
                                            {!! Form::label('detail', 'Detail') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('detail', old('detail'), ['class' => 'form-control', 'placeholder' => 'detail input']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2">
                                            {!! Form::label('status', 'Status') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="status" id="status" class="form-control">
                                                <option value="" disabled>Select status</option>
                                                <option value="active">
                                                    Hoạt động
                                                </option>
                                                <option
                                                    value="inactive">
                                                    Không hoạt động
                                                </option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger d-block mt-1"
                                                  style="font-size: 13px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {!! Form::submit('add', ['class' => ['btn', 'btn-primary', 'btn-sm', 'mb-0'], 'name' => 'btn_add']) !!}
                                    <button class="btn btn-dark btn-sm d-inline-block mb-0" type="reset">Reset</button>

                                    {!! Form::close() !!}
                                </div>{{-- End card --}}
                            </div>
                        </div>
                    </div>{{-- end page-wrapper --}}
                </div>{{-- end main-body --}}
            </div>{{-- End pcoded-inner-content --}}
        </div>{{-- End pcoded-conent --}}

        <script>
            var editor_config = {
                path_absolute: "/",
                selector: 'textarea',
                relative_urls: false,
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'table emoticons template paste help',
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern"
                ],
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons | help',
                menu: {
                    favs: {
                        title: 'My Favorites',
                        items: 'code visualaid | searchreplace | emoticons'
                    }
                },
                menubar: 'favs file edit view insert format tools table help',
                file_picker_callback: function (callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                        'body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document
                        .getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                    if (meta.filetype === 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                        url: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no",
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });
                }
            };

            tinymce.init(editor_config);

            $(document).ready(function () {

            });
        </script>
@endsection


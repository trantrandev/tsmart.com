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
                                    <span class="d-block"
                                        style="font-size: 13px; margin-top: 5px; color:#919aa3">Please fill all field have
                                        <code>(*)</code></span>
                                </div>

                                <div class="card-block">
                                    {!! Form::open(['method' => 'POST']) !!}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('name', 'Full name') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Fullname input']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('password', 'Password') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('confirm-passwosd', 'Confirm-password') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'Password confirm', 'name' => 'confirm_password']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('email', 'Email') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('gender', 'Gender') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                                        value="male" checked=""> Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                                        value="female"> Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('status', 'Status') !!}
                                            <span class="text-danger" style="font-size:12px">(*)</span>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="status" id="" class="form-control">
                                                <option value="" disabled selected>Select gender</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('address', 'Adress') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('address', '', ['class' => 'form-control', 'rows' => 'auto']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!! Form::label('avatar', 'Avatar') !!}
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" class="custom-file-input" accept="image/*" id="up-avatar"
                                                name="avatar">
                                            <label class="custom-file-label" for="avatar">Chọn file</label>
                                        </div>
                                    </div>
                                    <style>
                                        #profile {
                                            border-radius: 100%;
                                            width: 200px;
                                            height: 200px;
                                            margin: 0 auto;
                                            position: relative;
                                            top: -80px;
                                            margin-bottom: -80px;
                                            cursor: pointer;
                                            background: #f4f4f4;
                                            display: table;
                                            background-size: cover;
                                            background-position: center center;
                                            box-shadow: 0 5px 8px rgba(black, 0.35);

                                            .dashes {
                                                position: absolute;
                                                top: 0;
                                                left: 0;
                                                border-radius: 100%;
                                                width: 100%;
                                                height: 100%;
                                                border: 4px dashed #ddd;
                                                opacity: 1;
                                            }

                                            label {
                                                display: table-cell;
                                                vertical-align: middle;
                                                text-align: center;
                                                padding: 0 30px;
                                                color: grey;
                                                opacity: 1;
                                            }

                                            &.dragging {
                                                background-image: none !important;

                                                .dashes {
                                                    animation-duration: 10s;
                                                    animation-name: spin;
                                                    animation-iteration-count: infinite;
                                                    animation-timing-function: linear;
                                                    opacity: 1 !important;
                                                }

                                                label {
                                                    opacity: 0.5 !important;
                                                }
                                            }

                                            &.hasImage {

                                                .dashes,
                                                label {
                                                    opacity: 0;
                                                    pointer-events: none;
                                                    user-select: none;
                                                }
                                            }
                                        }

                                        h1 {
                                            text-align: center;
                                            font-size: 28px;
                                            font-weight: normal;
                                            letter-spacing: 1px;
                                        }

                                        .stat {
                                            width: 50%;
                                            text-align: center;
                                            float: left;
                                            padding-top: 20px;
                                            border-top: 1px solid #ddd;

                                            .label {
                                                font-size: 11px;
                                                font-weight: bold;
                                                letter-spacing: 1px;
                                                text-transform: uppercase
                                            }

                                            .num {
                                                font-size: 21px;
                                                padding: 3px 0;
                                            }
                                        }

                                        .editable {
                                            position: relative;

                                            i {
                                                position: absolute;
                                                top: 10px;
                                                right: -20px;
                                                opacity: 0.3
                                            }
                                        }

                                        button {
                                            width: 100%;
                                            -webkit-appearance: none;
                                            line-height: 40px;
                                            color: #fff;
                                            border: none;
                                            background-color: #ea4c89;
                                            margin-top: 30px;
                                            font-size: 13px;
                                            -webkit-font-smoothing: antialiased;
                                            font-weight: bold;
                                            letter-spacing: 1px;
                                            text-transform: uppercase
                                        }

                                    </style>
                                    {{-- // --}}
                                    <div id="profile">
                                        <div class="dashes"></div>
                                        <label>Click to browse or drag an image here</label>
                                    </div>
                                    <div class="editable"><i class="fa fa-pencil"></i>
                                        <h1 contenteditable>Drew Vosburg</h1>
                                    </div>
                                    <div class="stat">
                                        <div class="label">Shots</div>
                                        <div class="num">40</div>
                                    </div>
                                    <div class="stat">
                                        <div class="label">Projects</div>
                                        <div class="num">1</div>
                                    </div>
<script>
    // ----- On render -----
$(function() {

$('#profile').addClass('dragging').removeClass('dragging');
});

$('#profile').on('dragover', function() {
$('#profile').addClass('dragging')
}).on('dragleave', function() {
$('#profile').removeClass('dragging')
}).on('drop', function(e) {
$('#profile').removeClass('dragging hasImage');

if (e.originalEvent) {
  var file = e.originalEvent.dataTransfer.files[0];
  console.log(file);

  var reader = new FileReader();

  //attach event handlers here...

  reader.readAsDataURL(file);
  reader.onload = function(e) {
    console.log(reader.result);
    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

  }

}
})
$('#profile').on('click', function(e) {
console.log('clicked')
$('#mediaFile').click();
});
window.addEventListener("dragover", function(e) {
e = e || event;
e.preventDefault();
}, false);
window.addEventListener("drop", function(e) {
e = e || event;
e.preventDefault();
}, false);
$('#mediaFile').change(function(e) {

var input = e.target;
if (input.files && input.files[0]) {
  var file = input.files[0];

  var reader = new FileReader();

  reader.readAsDataURL(file);
  reader.onload = function(e) {
    console.log(reader.result);
    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
  }
}
})
</script>
                                    {{-- button submit --}}
                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-10">
                                            {!! Form::submit('Add user', ['class' => ['btn', 'btn-primary', 'btn-sm']]) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- End pcoded-inner-content --}}
    </div>{{-- End pcoded-conent --}}
@endsection

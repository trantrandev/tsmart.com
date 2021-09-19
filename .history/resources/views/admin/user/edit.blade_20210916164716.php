<div class="md-modal md-effect-7" id="modal-7">
    <div class="md-content">
        <h3 class="theme-bg2">Edit User</h3>
        <div>
            {!! Form::open() !!}
            <div class="form-group row align-items-center">
                <div class="col-sm-2">
                    <label for="name">Name</label>
                    <span class="text-danger" style="font-size:12px">(*)</span>
                </div>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Name input" value="" name="name" type="text" id="name">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="md-overlay"></div>

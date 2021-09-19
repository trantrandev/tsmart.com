@extends('layouts.admin')
@section('content')
    <div class="md-modal md-effect-7 md-show" id="modal-7">
        <div class="md-content">
            <h3 class="theme-bg2">Modal Dialog</h3>
            <div>
                <p>This is a modal window. You can do the following things with it:</p>
                <ul>
                    <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to
                        read what they say.</li>
                    <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and
                        appreciate its presence.</li>
                    <li><strong>Close:</strong> click on the button below to close the modal.</li>
                </ul>
                <button class="btn btn-primary md-close">Close me!</button>
            </div>
        </div>
    </div>
@endsection
@section('add_js')
    
@endsection

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
                            <img src="{{ asset('') }}admin/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="{{ asset('') }}admin/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="{{ asset('') }}admin/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="{{ asset('') }}admin/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="{{ asset('') }}admin/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                        </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
@hasSection('link_js')
    @yield('link_js')
@else
    <script data-cfasync="false" src="{{ asset('admin/plugins/email/email-decode.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- Ch???a c??c sk click menu, load... --}}
    <script src="{{ asset('admin/js/pcoded.min.js') }}"></script>

    {{-- ch???a n??t setting menu --}}
    <script src="{{ asset('admin/js/menu-setting.min.js') }}"></script>

    {{-- toastr --}}
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>

    {{-- input mask --}}
    <script src="{{ asset('admin/plugins/inputmask/js/inputmask.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/inputmask/js/jquery.inputmask.min.js') }}"></script>

@endif
@yield('add_js')
<script>
    // Checked checkbox
    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td.check input:checkbox').prop('checked', checked);
    });

    //show image upload
    $(function () {
        $('#up-avatar').change(function (e) {
            var name_file = this.files[0].name;
            var x = URL.createObjectURL(e.target.files[0]);
            $('#up-img').attr("src", x);
            $('.custom-file-label').text(name_file);
        });
    });

    function changeToSlug(id_name, id_slug = 'slug') {
        let slug;
        //L???y text t??? th??? input title
        slug = document.getElementById(id_name).value;
        slug = slug.toLowerCase();

        //?????i k?? t??? c?? d???u th??nh kh??ng d???u
        slug = slug.replace(/[??????????????????????????????????????????????]/gi, 'a');
        slug = slug.replace(/[??????????????????????????????]/gi, 'e');
        slug = slug.replace(/[i????????????]/gi, 'i');
        slug = slug.replace(/[??????????????????????????????????????????????]/gi, 'o');
        slug = slug.replace(/[?????????????????????????????]/gi, 'u');
        slug = slug.replace(/[??????????????]/gi, 'y');
        slug = slug.replace(/??/gi, 'd');
        //X??a c??c k?? t??? ?????t bi???t
        slug = slug.replace(/[`~!@#|$%^&*()+=,.\/?><'":;_]/gi, '');
        //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
        slug = slug.replace(/ /gi, "-");
        //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
        //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
        slug = slug.replace(/-----/gi, '-');
        slug = slug.replace(/----/gi, '-');
        slug = slug.replace(/---/gi, '-');
        slug = slug.replace(/--/gi, '-');
        //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
        slug = '@' + slug + '@';
        slug = slug.replace(/@-|-@|@/gi, '');
        //In slug ra textbox c?? id ???slug???
        document.getElementById(id_slug).value = slug;
    }

    //  mask phone
    $(document).ready(function () {
        $(".phone").inputmask({
            mask: "9999-999-999"
        });
    });
</script>

{!! Toastr::message() !!}
</body>

</html>

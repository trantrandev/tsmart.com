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
     {{-- Chứa các sk click menu, load... --}}
     <script src="{{ asset('admin/js/pcoded.min.js') }}"></script>

     {{-- chứa nút setting menu --}}
     <script src="{{ asset('admin/js/menu-setting.min.js') }}"></script>

     {{-- toast thong bao --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 @endif
 @yield('add_js')
 <script>
     // Checked checkbox
     $("input[name='checkall']").click(function() {
         var checked = $(this).is(':checked');
         $('.table-checkall tbody tr td.check input:checkbox').prop('checked', checked);
     });

     //show image upload
     $(function() {
         $('#up-avatar').change(function(e) {
             var name_file = this.files[0].name;
             var x = URL.createObjectURL(e.target.files[0]);
             $('#up-img').attr("src", x);
             $('.custom-file-label').text(name_file);
         });
     });
 </script>
 </body>

 </html>

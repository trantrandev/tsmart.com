$(document).ready(function() {
    function active_status() {
        $("table td.status input").on("change", function() {
            var status = $(this).attr();
            // alert(status);
        });

        // $.ajax({
        //     url: $(form).attr('action'), // Trang xử lý, mặc định trang hiện tại
        //     method: $(form).attr('method'), // Phương thức  truyền cuẩ form
        //     data: data, // Dữ liệu truyền lên Server
        //     dataType: 'json', // html, text, json
        //     success: function(data) {
        //             //Them thanh cong
        //             if ($.isEmptyObject(data.message)) {


        //             } else {
        //                 // alert('not response');
        //             }
        //         } // end susccess
        // });
    }

    active_status();


}); // END JQUERY

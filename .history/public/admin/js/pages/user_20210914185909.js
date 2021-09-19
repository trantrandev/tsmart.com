$(document).ready(function() {

    function active_status() {
        $("table td.status input").on("change", function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            data = { status: status, user_id: user_id };
            $.ajax({
                type: 'GET',
                data: data, // Dữ liệu truyền lên Server
                dataType: 'JSON', // html, text, json
                success: function(data) {
                        //Them thanh cong
                        if ($.isEmptyObject(data.message)) {


                        } else {
                            // alert('not response');
                        }
                    } // end susccess
            });
        });
    }

    active_status();


}); // END JQUERY

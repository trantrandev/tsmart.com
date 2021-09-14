$(document).ready(function() {
    function active_status() {
        $(document).on('table td.status input').click() {
            alert('ok');
        }
    }

    active_status();
});
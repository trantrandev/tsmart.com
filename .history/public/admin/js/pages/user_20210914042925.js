$(document).ready(function() {
    function active_status() {
        $(document).on('table td.status').click() {
            alert('ok');
        }
    }

    active_status();
});